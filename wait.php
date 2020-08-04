<?php
$hash = trim($_SERVER['PATH_INFO'], '/');
$date = gmdate("Y-m-d");
if (file_exists("done/$date/$hash")) {
    die(header('Location: ../show.php/' . $hash));
}
$text = file_exists("todo/$hash") ? 'Wait' : 'Executing';
?>
<?php include 'header.php'; ?>
<form action="../">
    <meta http-equiv="refresh" content="1">
    <?php echo $text; ?>...
    <input type="submit" value="Cancel" />
</form>
<?php include 'footer.php'; ?>