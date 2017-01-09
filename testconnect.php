<?php

echo "lel";

$accounts = mysqli_connect("localhost", "root", "Smucker77") or die (mysql_error());
mysql_select_db("accounts", $accounts);

$sql = "SELECT * FROM players;"

echo "lul";

echo(mysqil_query($sql, $accounts));

?>
