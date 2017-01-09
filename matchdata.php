<?php

$db = mysqli_connect("http://ubuntu@ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "defaultUser", "YHHQte6UXP26cFpe", "mm_queue");

$ID = $_POST['id'];

$stmt = $db->prepare("SELECT * FROM matches WHERE `Player1_ID`=?");
$stmt->bind_param('s', $ID);

$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result)>0) {
	echo mysqli_fetch_array($result)['Player2_ID'];
} else {
	$stmt = $db->prepare("SELECT * FROM matches WHERE `Player2_ID`=?");
	$stmt->bind_param('s', $ID);

	$stmt->execute();
	$result = $stmt->get_result();
	
	echo mysqli_fetch_array($result)['Player1_ID'];
}

?>