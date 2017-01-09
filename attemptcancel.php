<?php

$userID = $_POST['id'];

$db = mysqli_connect("http://ubuntu@ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "defaultUser", "YHHQte6UXP26cFpe", "mm_queue");

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