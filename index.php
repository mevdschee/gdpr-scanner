<?php include 'header.php';?>
<a href="https://github.com/mevdschee/gdpr-scanner"><img src="forkme_right_darkblue_121621.svg" style="position:absolute;top:0;right:0;" alt="Fork me on GitHub"></a>
<h1>GDPR scanner</h1>
<p>For more information, read the <a href="https://tqdev.com/">TQdev Blog</a> about the scanner.</p>
<form action="new.php" method="post">
    <label for="url">URL</label><br />
    <input id="url" type="text" name="url" />
    <br /><br />
    <input type="submit" value="Scan" />
</form>
<?php include 'footer.php';?>