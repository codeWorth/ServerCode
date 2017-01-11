<?php

$accounts = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "accounts");

$username = $_GET['name'];
$password = $_GET['pass'];

$sql = "
INSERT INTO players (Username,Password) VALUES('$username', '$password')
"

mysqil_query($sql, $accounts);

?>