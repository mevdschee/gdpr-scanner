<?php
$filename = trim($_SERVER['PATH_INFO'], '/');
$date = substr($filename, 0, 8);
$hash = substr($filename, 8);
if (!file_exists("done/$date/$hash")) {
    die(header('Location: ./'));
}
$reponse = json_decode(gzdecode(file_get_contents("done/$date/$hash")), true);

$comments = [
    'fonts.googleapis.com' => '<a href"https://github.com/google/fonts/issues/1495">GDPR compliance</a>',
    'fonts.gstatic.com' => '<a href"https://github.com/google/fonts/issues/1495">GDPR compliance</a>',
];
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
        <th>Anonimize flag<sup>6</sup></th>
        <th>Comment</th>
    </tr>
    <?php foreach ($reponse['lines'] as $line): ?>
        <tr>
            <?php foreach ($line as $cell): ?>
                <td>
                <?php
                if ($cell === true):
                    echo 'Yes';
                elseif ($cell === false):
                    echo 'No';
                else:
                    echo htmlentities($cell) ?: '';
                endif;
                ?>
                </td>
            <?php endforeach;?>
            <td><?php echo $comments[$line[0]] ?? ''; ?></td>
        </tr>
    <?php endforeach;?>
</table>
<p>
    1) Domain to which connections where made<br />
    2) Ping time to the domain in milliseconds<br />
    3) EU country for domain's IP address*<br />
    4) Country of the domain's IP address*<br />
    5) Organization of the domain's IP address*<br />
    6) Whether an 'anonimyzeIp' flag was detected (Google Analytics only)*<br />
    *) IP address information from: <a href="https://ip-api.com">ip-api.com</a>
</p>
<form action="../"><input type="submit" value="Close" /></form>
<?php include 'footer.php';?>
<!-- <?php echo $filename; ?> -->