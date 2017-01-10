<?php

$accounts = mysqli_connect("localhost", "defaultUser", "YHHQte6UXP26cFpe", "accounts");

$username = $_GET['name'];
$password = $_GET['pass'];

$sql = "
INSERT INTO players (Username,Password) VALUES('$username', '$password')
"

mysqil_query($sql, $accounts);

?>