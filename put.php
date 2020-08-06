<?php
include 'config.php';

if ($_POST['password'] != $password) {
    die('Access denied');
}

$response = json_decode($_POST['response'], true);
$date = $response['date'];
$salt = $response['salt'];
$url = $response['url'];
$hash = sha1($salt . $url);

if (!file_exists("done/$date")) {
    mkdir("done/$date");
}

if ($response) {
    file_put_contents("done/$date/$hash", json_encode($response));
}
