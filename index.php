<?php include 'header.php'; ?>
<h1>GDPR scanner</h1>
<form action="new.php" method="post">
    <label for="url">URL</label><br />
    <input id="url" type="text" name="url" />
    <br /><br />
    <input type="submit" value="Scan" />
</form>
<?php include 'footer.php'; ?>