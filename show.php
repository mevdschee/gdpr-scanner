<?php

$hash = trim($_SERVER['PATH_INFO'], '/');
$date = gmdate("Y-m-d");
if (!file_exists("done/$date/$hash")) {
    die(header('Location: ./'));
}

$reponse = json_decode(file_get_contents("done/$date/$hash"), true);

?>
<html>

<head>
    <title>GDPR scanner</title>
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
</head>

<body>
    <h1><?php echo $reponse['url']; ?></h1>
    <table cellspacing="0">
        <tr>
            <th>Domain</th>
            <th>Ping &nbsp;</th>
            <th>EU?</th>
            <th>Country</th>
            <th>Organization</th>
        </tr>
        <?php foreach ($reponse['lines'] as $line) : ?>
            <tr>
                <?php foreach ($line as $cell) : ?>
                    <td><?php echo htmlentities($cell); ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <br />
    <form action="../"><input type="submit" value="Close" /></form>
</body>

</html>