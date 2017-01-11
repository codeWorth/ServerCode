<?php

echo "lel";

$accounts = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "accounts");
$sql = "SELECT * FROM players;";

echo "lul";

echo(mysqli_fetch_row(mysqli_query($accounts, $sql)));

?>
