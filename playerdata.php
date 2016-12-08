<?php

$userID = $_POST['id'];

$accounts = mysqli_connect("10.0.1.121", "root", "eRWhZwhTHwRCfVSx", "accounts");

$stmt = $accounts->prepare("SELECT * FROM players WHERE `ID`= ?");
$stmt->bind_param('s', $userID);

$stmt->execute();

$me = $stmt->get_result();
$me = mysqli_fetch_array($me);

$username = $me['Username'];
$rank = $me['Rank'];

echo "$username,$rank";

?>