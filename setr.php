<?php

$userID = $_POST['id'];
$data = $_POST['data'];

$db = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "mm_queue");

$stmt = $db->prepare("SELECT * FROM matches WHERE `Player1_ID`=?");
$stmt->bind_param('s', $userID);

$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result)>0) {
	$stmt = $db->prepare("UPDATE matches SET `Player1_R` = ? WHERE `Player1_ID` = ?;");
	$stmt->bind_param('ss', $data, $userID);

	$stmt->execute();
} else {
	$stmt = $db->prepare("SELECT * FROM matches WHERE `Player2_ID` = ?");
	$stmt->bind_param('s', $userID);

	$stmt->execute();
	$result = $stmt->get_result();
	
	if (mysqli_num_rows($result)==0){
		die;
	}
	
	$stmt = $db->prepare("UPDATE matches SET `Player2_R` = ? WHERE `Player2_ID` = ?");
	$stmt->bind_param('ss', $data, $userID);

	$stmt->execute();
}

?>