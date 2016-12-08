<?php

$accounts = mysqli_connect("10.0.1.121", "root", "") or die (mysql_error());
mysql_select_db("accounts", $accounts);

$username = $_GET['name'];
$password = $_GET['pass'];

$sql = "
INSERT INTO players (Username,Password) VALUES('$username', '$password')
"

mysqil_query($sql, $accounts);

?>