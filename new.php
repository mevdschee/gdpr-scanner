<?php
include 'config.php';

$url = $_POST['url'];
$url = preg_replace('|[^A-Za-z0-9-\._~:/]|', '', $url);
if (strtolower(substr($url, 0, 4)) != 'http') {
    $url = "https://$url";
}
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    die(header('Location: ./'));
}

$salt = bin2hex(openssl_random_pseudo_bytes(12));
$hash = sha1($salt . $url);
file_put_contents("todo/$hash", json_encode(['salt' => $salt, 'url' => $url]));
header('Location: wait.php/' . $hash);
