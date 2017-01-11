<?php

$userID = $_POST['id'];

$db = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "mm_queue");

$stmt = $db->prepare("DELETE FROM `matches` WHERE `Player1_ID` = ? OR `Player2_ID` = ?");
$stmt->bind_param('ss', $userID, $userID);

$stmt->execute();

?>