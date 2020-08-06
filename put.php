<?php
include 'config.php';

if ($_POST['password'] != $password) {
    die('Access denied');
}

$response = json_decode($_POST['response'], true);
$time = $response['time'];
$date = gmdate('Ymd', $time);
$salt = $response['salt'];
$url = $response['url'];
$hash = sha1($salt . $url);

if (!file_exists("done/$date")) {
    mkdir("done/$date");
}

if ($response) {
    file_put_contents("done/$date/$hash", gzcompress(json_encode($response)));
}
