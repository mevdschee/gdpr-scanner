<?php
include 'config.php';

if ($_POST['password'] != $password) {
    die('Access denied');
}

$response = json_decode($_POST['response'], true);
$salt = $response['salt'];
$url = $response['url'];
$hash = sha1($salt . $url);
$date = gmdate("Y-m-d");

if (!file_exists("done/$date")) {
    mkdir("done/$date");
}

if ($response) {
    file_put_contents("done/$date/$hash", json_encode($response));
}
