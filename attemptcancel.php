<?php

$userID = $_POST['id'];

$db = mysqli_connect("localhost", "root", "Smucker77", "mm_queue");

$stmt = $db->prepare("SELECT * FROM matches WHERE `Player1_ID` = ? OR `Player2_ID` = ?");
$stmt->bind_param('ss', $userID, $userID);

$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) == 0) {
	$stmt = $db->prepare("DELETE FROM `queries` WHERE `Player ID` = ?");
	$stmt->bind_param('s', $userID);

	$stmt->execute();
	if (mysqli_affected_rows($db) > 0) {
		echo "y";
	} else {
		echo "n";
	}
} else {
	echo "n";
}

?>