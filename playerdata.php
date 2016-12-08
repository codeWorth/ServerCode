<?php

$userID = $_POST['id'];

$accounts = mysqli_connect("ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "accounts", "b29f856cb9acc", "accounts");

$stmt = $accounts->prepare("SELECT * FROM players WHERE `ID`= ?");
$stmt->bind_param('s', $userID);

$stmt->execute();

$me = $stmt->get_result();
$me = mysqli_fetch_array($me);

$username = $me['Username'];
$rank = $me['Rank'];

echo "$username,$rank";

?>