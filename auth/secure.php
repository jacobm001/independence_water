<?php

include ("Config.php")
include ("Auth.php")

$dbh = new PDO("pgsql:host=abzu.me;dbname=phpauth", "username", "password");

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->islogged()) {
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";

    exit();
}

?>

<html>
<body>
A test page that should only be able to be accessed if you are logged in.
</body>
</html>
