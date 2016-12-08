<?php

$userID = $_POST['id'];

$db = mysqli_connect("10.0.1.121", "root", "eRWhZwhTHwRCfVSx", "mm_queue");

$stmt = $db->prepare("DELETE FROM `matches` WHERE `Player1_ID` = ? OR `Player2_ID` = ?");
$stmt->bind_param('ss', $userID, $userID);

$stmt->execute();

?>