<?php
$hash = trim($_SERVER['PATH_INFO'], '/');
$date = gmdate("Y-m-d");
if (file_exists("todo/$hash")) {
    $text = 'Wait...';
} elseif (!file_exists("done/$date/$hash")) {
    $text = 'Executing...';
} else {
    die(header('Location: ../show.php/' . $hash));
}
?>
<?php include 'header.php'; ?>
<form action="../">
    <meta http-equiv="refresh" content="1">
    Wait...
    <input type="submit" value="Cancel" />
</form>
<?php include 'footer.php'; ?>