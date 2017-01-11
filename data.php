<?php

$db = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "mm_queue");

$ID = $_POST['id'];

$stmt = $db->prepare("SELECT * FROM matches WHERE `Player1_ID`=?");
$stmt->bind_param('s', $ID);

$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result)>0) {
	echo mysqli_fetch_array($result)['Player2_Data'];
} else {
	$stmt = $db->prepare("SELECT * FROM matches WHERE `Player2_ID`=?");
	$stmt->bind_param('s', $ID);

	$stmt->execute();
	$result = $stmt->get_result();
	
	echo mysqli_fetch_array($result)['Player1_Data'];
}

?>