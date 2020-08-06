<?php
$filename = trim($_SERVER['PATH_INFO'], '/');
$date = substr($filename, 0, 8);
$hash = substr($filename, 8);
if (!file_exists("done/$date/$hash")) {
    die(header('Location: ./'));
}
$reponse = json_decode(gzuncompress(file_get_contents("done/$date/$hash"), true));

?>
<?php include 'header.php';?>
<style>
    th {
        text-align: left;
    }

    th,
    td {
        padding: 2px;
        padding-right: 10px;
    }

    td {
        border-top: 1px solid black
    }

    h1 small{
        font-family: sans-serif;
        font-size: 8px;
    }
</style>
<h1><?php echo $reponse['url']; ?></h1>
<p>Scan date: <?php echo date('Y-m-d H:i:s', $reponse['time']); ?></p>
<p>Scanner location: Amsterdam</p>
<table cellspacing="0">
    <tr>
        <th>Domain<sup>1</sup></th>
        <th>Ping<sup>2</sup></th>
        <th>EU<sup>3</sup></th>
        <th>Country<sup>4</sup></th>
        <th>Organization<sup>5</sup></th>
    </tr>
    <?php foreach ($reponse['lines'] as $line): ?>
        <tr>
            <?php foreach ($line as $cell): ?>
                <td><?php echo htmlentities($cell); ?></td>
            <?php endforeach;?>
        </tr>
    <?php endforeach;?>
</table>
<p>
    1) Domain to which connections where made<br />
    2) Ping time to the domain in milliseconds<br />
    3) EU country for domain's IP address*<br />
    4) Country of the domain's IP address*<br />
    5) Organization of the domain's IP address*<br />
    *) IP address information from: <a href="https://ip-api.com">ip-api.com</a>
</p>
<form action="../"><input type="submit" value="Close" /></form>
<?php include 'footer.php';?>
<!-- <?php echo $filename; ?> -->