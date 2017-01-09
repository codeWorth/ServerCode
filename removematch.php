<?php

$userID = $_POST['id'];

$db = mysqli_connect("localhost", "root", "Smucker77", "mm_queue");

$stmt = $db->prepare("DELETE FROM `matches` WHERE `Player1_ID` = ? OR `Player2_ID` = ?");
$stmt->bind_param('ss', $userID, $userID);

$stmt->execute();

?>