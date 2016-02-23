<?php

include("Config.php");
include("Auth.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Prior to new PDO<br>";
$dbh = new PDO("pgsql:host=localhost;dbname=abzu", "enki", "enki14789632");
echo "After new PDO<br>";

$this->config = new PHPAuth\Config($this->dbh);
$this->auth   = new PHPAuth\Auth($this->dbh, $this->config);

$this->auth->login($_POST["username"], $_POST["password"]);

?>


<html>
    <body>
    Let's pretend you just logged in.<br>
    Test username: <?php echo $_POST["username"]; ?><br>
    Test password: <?php echo $_POST["password"]; ?>
    </body>
</html>
