<?php

$userID = $_POST['id'];

$accounts = mysqli_connect("localhost", "defaultUser", "YHHQte6UXP26cFpe", "accounts");

$stmt = $accounts->prepare("SELECT * FROM players WHERE `ID`= ?");
$stmt->bind_param('s', $userID);

$stmt->execute();

$me = $stmt->get_result();
$me = mysqli_fetch_array($me);

$username = $me['Username'];
$rank = $me['Rank'];

echo "$username,$rank";

?>