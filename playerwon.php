<?php

$userID = $_GET['id'];

$accounts = mysqli_connect("localhost", "user", "pbFMm5PY90tFTIpN", "accounts");

$stmt = $accounts->prepare("SELECT * FROM players WHERE `ID`= ?");
$stmt->bind_param('s', $userID);

$stmt->execute();

$me = $stmt->get_result();
$me = mysqli_fetch_array($me);

$newrank = intval($me['Rank']) + 1;

$stmt = $accounts->prepare("UPDATE players SET `Rank` = ? WHERE `ID`= ?");
$stmt->bind_param('ss', $newrank, $userID);

$stmt->execute();

echo "$username,$rank";

?>