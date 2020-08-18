<?php
$filename = trim($_SERVER['PATH_INFO'], '/');
$date = substr($filename, 0, 8);
$hash = substr($filename, 8);
if (!file_exists("done/$date/$hash")) {
    die(header('Location: ./'));
}
$reponse = json_decode(gzdecode(file_get_contents("done/$date/$hash")), true);
$cookieFields = ['name', 'value', 'domain', 'path', 'expires', 'size', 'httpOnly', 'secure', 'session', 'priority', 'sameSite'];
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

    h1 small {
        font-family: sans-serif;
        font-size: 8px;
    }
</style>
<h1><?php echo $reponse['url']; ?></h1>
<p>Scan date: <?php echo date('Y-m-d H:i:s', $reponse['time']); ?></p>
<p>Scanner location: Amsterdam</p>
<p>Scanned with: Chrome in "incognito" mode (no consent)</p>
<table cellspacing="0">
    <tr>
        <th>Domain<sup>1</sup></th>
        <th>Flags<sup>2</sup></th>
        <th>Ping<sup>3</sup></th>
        <th>Hostname<sup>4</sup></th>
        <th>EU<sup>5</sup></th>
        <th>Country<sup>6</sup></th>
        <th>Organization<sup>7</sup></th>
    </tr>
    <?php foreach (array_values($reponse['data']['domains']) as $i => $line): ?>
        <tr>
            <?php foreach ($line as $j => $cell): ?>
                <td>
                    <?php if (is_array($cell)): ?>
                        <?php foreach ($cell as $flag): ?>
                            <?php echo "<a href=\"../flag_$flag.php\">$flag</a> "; ?>
                        <?php endforeach;?>
                    <?php else: ?>
                        <?php echo htmlentities($cell) ?: '' ?>
                    <?php endif;?>
                </td>
            <?php endforeach;?>
        </tr>
    <?php endforeach;?>
</table>
<p>
    1) Domain to which connections where made<br />
    2) Clickable flags with additional info<br />
    3) Ping time to the domain in milliseconds<br />
    4) Reverse lookup for the domain's IP address<br />
    5) EU country for domain's IP address*<br />
    6) Country of the domain's IP address*<br />
    7) Organization of the domain's IP address*<br />
    *) IP address information from: <a href="https://ip-api.com">ip-api.com</a>
</p>

<table cellspacing="0">
    <tr>
        <?php foreach ($cookieFields as $i => $field): ?>
        <th><?php echo $i == 0 ? 'Cookie' : ucwords($field) ?><sup><?php echo ($i + 1) ?></sup></th>
        <?php endforeach;?>
    </tr>
    <?php foreach ($reponse['data']['cookies'] as $cookie): ?>
        <tr>
            <?php foreach ($cookieFields as $field): ?>
                <td style="max-width: 200px; overflow: hidden;">
                    <?php echo htmlentities(var_export($cookie[$field], true)) ?: '' ?>
                </td>
            <?php endforeach;?>
        </tr>
    <?php endforeach;?>
</table>

<form action="../"><input type="submit" value="Close" /></form>
<?php include 'footer.php';?>
<!-- <?php echo $filename; ?> -->