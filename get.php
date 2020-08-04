<?php
include 'config.php';

if ($_POST['password'] != $password) {
    die('Access denied');
}

$dir = scandir('todo');
foreach ($dir as $hash) {
    if (is_file("todo/$hash")) {
        $request = json_decode(file_get_contents("todo/$hash"));
        $salt = $request['salt'];
        $url = $request['url'];
        if (sha1($salt . $url) == $hash) {
            unlink("todo/$hash");
            die(json_encode(['salt' => $salt, 'url' => $url]));
        }
    }
}
