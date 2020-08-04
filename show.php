<?php

$hash = trim($_SERVER['PATH_INFO'], '/');
$date = gmdate("Y-m-d");
if (!file_exists("done/$date/$hash")) {
    die(header('Location: ./'));
}

$reponse = json_decode(file_get_contents("done/$date/$hash"), true);

?>
<?php include 'header.php'; ?>
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
</style>

<h1><?php echo $reponse['url']; ?></h1>
<table cellspacing="0">
    <tr>
        <th>Domain<sup>1</sup></th>
        <th>Ping<sup>2</sup></th>
        <th>EU<sup>3</sup></th>
        <th>Country<sup>4</sup></th>
        <th>Organization<sup>5</sup></th>
    </tr>
    <?php foreach ($reponse['lines'] as $line) : ?>
        <tr>
            <?php foreach ($line as $cell) : ?>
                <td><?php echo htmlentities($cell); ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<h2>Legend</h2>
<ol>
    <li>Domain to which connections where made</li>
    <li>Ping time to the domain in milliseconds</li>
    <li>EU country for domain's IP address</li>
    <li>Country of the domain's IP address</li>
    <li>Organization of the domain's IP address</li>
</ol>
<br />
<form action="../"><input type="submit" value="Close" /></form>
<?php include 'footer.php'; ?>