<?php

$accounts = mysqli_connect("localhost", "root", "Smucker77") or die (mysql_error());
mysql_select_db("accounts", $accounts);

$sql = "SELECT * FROM players;"

mysqil_query($sql, $accounts);

?>