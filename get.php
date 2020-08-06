<?php
include 'config.php';

if ($_POST['password'] != $password) {
    die('Access denied');
}

$dir = scandir('todo');
foreach ($dir as $filename) {
    if (is_file("todo/$filename")) {
        $request = json_decode(file_get_contents("todo/$filename"), true);
        $date = $request['date'];
        $salt = $request['salt'];
        $url = $request['url'];
        if ($date . sha1($salt . $url) == $filename) {
            unlink("todo/$filename");
            die(json_encode(['date' => $date, 'salt' => $salt, 'url' => $url]));
        }
    }
}
