<?php

$accounts = mysqli_connect("localhost", "root", "Smucker77") or die (mysql_error());
mysql_select_db("accounts", $accounts);

$username = $_GET['name'];
$password = $_GET['pass'];

$sql = "
INSERT INTO players (Username,Password) VALUES('$username', '$password')
"

mysqil_query($sql, $accounts);

?>