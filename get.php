<?php
include 'config.php';

if ($_POST['password'] != $password) {
    die('Access denied');
}

$dir = scandir('todo');
foreach ($dir as $filename) {
    if (is_file("todo/$filename")) {
        $request = json_decode(gzdecode(file_get_contents("todo/$filename.gz")), true);
        $time = $request['time'];
        $date = gmdate('Ymd', $time);
        $salt = $request['salt'];
        $url = $request['url'];
        if ($date . sha1($salt . $url) == $filename) {
            unlink("todo/$filename");
            die(json_encode(['time' => $time, 'salt' => $salt, 'url' => $url]));
        }
    }
}
