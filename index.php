<?php include 'header.php';?>
<a href="https://github.com/mevdschee/gdpr-scanner"><img src="forkme_right_darkblue_121621.svg" style="position:absolute;top:0;right:0;" alt="Fork me on GitHub"></a>
<h1>GDPR scanner</h1>
<p>For more information, read the <a href="https://tqdev.com/2020-free-gdpr-scanner-online">TQdev Blog</a> about the scanner.</p>
<form action="new.php" method="post">
    <label for="url">URL</label><br />
    <input id="url" type="text" name="url" />
    <br /><br />
    <input type="submit" value="Scan" />
</form>
<p>You can see a sample scan result <a href="https://tqdev.com/gdpr-scanner/show.php/2020081818aa35f04858d760caa5370a47aac0288e5745af">here</a></p>
<?php include 'footer.php';?>