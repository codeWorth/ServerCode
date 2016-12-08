<?php

$userID = $_POST['id'];

$db = mysqli_connect("ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "mm_User", "c01f148554b4a2b", "mm_queue");

$stmt = $db->prepare("DELETE FROM `matches` WHERE `Player1_ID` = ? OR `Player2_ID` = ?");
$stmt->bind_param('ss', $userID, $userID);

$stmt->execute();

?>