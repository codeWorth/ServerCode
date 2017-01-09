<?php

echo "lel";

$accounts = mysqli_connect("http://ubuntu@ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "defaultUser", "YHHQte6UXP26cFpe") or die (mysql_error());
mysql_select_db("accounts", $accounts);

$sql = "SELECT * FROM players;"

echo "lul";

echo(mysqil_query($sql, $accounts));

?>
