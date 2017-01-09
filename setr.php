<?php

$userID = $_POST['id'];
$data = $_POST['data'];

$db = mysqli_connect("http://ubuntu@ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "defaultUser", "YHHQte6UXP26cFpe", "mm_queue");

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