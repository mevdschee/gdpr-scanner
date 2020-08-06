<?php
$filename = trim($_SERVER['PATH_INFO'], '/');
$date = substr($filename, 0, 8);
$hash = substr($filename, 8);
if (file_exists("done/$date/$hash")) {
    die(header('Location: ../show.php/' . $filename));
}
$text = file_exists("todo/$filename") ? 'Wait' : 'Executing';
?>
<?php include 'header.php'; ?>
<form action="../">
    <meta http-equiv="refresh" content="1">
    <?php echo $text; ?>...
    <input type="submit" value="Cancel" />
</form>
<?php include 'footer.php'; ?>