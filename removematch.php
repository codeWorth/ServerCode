<?php

$userID = $_POST['id'];

$db = mysqli_connect("http://ubuntu@ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "defaultUser", "YHHQte6UXP26cFpe", "mm_queue");

$stmt = $db->prepare("DELETE FROM `matches` WHERE `Player1_ID` = ? OR `Player2_ID` = ?");
$stmt->bind_param('ss', $userID, $userID);

$stmt->execute();

?>