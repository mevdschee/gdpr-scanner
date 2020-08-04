<?php

$hash = trim($_SERVER['PATH_INFO'], '/');
$date = gmdate("Y-m-d");
if (file_exists("todo/$hash")) {
    die('<meta http-equiv="refresh" content="1"><form action="../">Wait.. <input type="submit" value="Cancel"/></form>');
}
if (!file_exists("done/$date/$hash")) {
    die('<meta http-equiv="refresh" content="1"><form action="../">Executing.. <input type="submit" value="Cancel"/></form>');
}

header('Location: ../show.php/' . $hash);
