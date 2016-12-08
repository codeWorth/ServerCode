<?php

$accounts = mysqli_connect("ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "accounts", "b29f856cb9acc") or die (mysql_error());
mysql_select_db("accounts", $accounts);

$username = $_GET['name'];
$password = $_GET['pass'];

$sql = "
INSERT INTO players (Username,Password) VALUES('$username', '$password')
"

mysqil_query($sql, $accounts);

?>