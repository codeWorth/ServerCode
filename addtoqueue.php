<?php

echo "Connecting to server... <br/>";
$db = mysqli_connect("localhost", "root", "Smucker77", "accounts");

$usr_ID = $_POST['id'];

if($usr_ID != ""){
	echo "Finding selected player... <br/>";
	$stmt = $db->prepare("SELECT * FROM players WHERE ID = ?");
	$stmt->bind_param('s', $usr_ID);

	$stmt->execute();
	$result = $stmt->get_result();
	$rank = mysqli_fetch_array($result)['Rank'];
	echo $rank;
	
	mysqli_select_db($db, "mm_queue");
	
	echo "Inserting query for matchmaking... <br/>";
	mysqli_query($db, "INSERT INTO queries (`Player ID`, `Player rank`) VALUES ('$usr_ID', '$rank')");
	
	echo "Finding all queries... <br/>";
	$result = mysqli_query($db, "SELECT * FROM queries");

	echo "Queries: <br/>";
	while ($row = mysqli_fetch_array($result)){
		echo "----------- <br/>";
		echo "ID: " . $row['Player ID'] . "<br/>";
		echo "Rank: " . $row['Player rank'] . "<br/>";
	}
} else {
	mysqli_select_db($db, "mm_queue");

	$result = mysqli_query($db, "SELECT * FROM queries");

	echo "Queries: <br/>";
	while ($row = mysqli_fetch_array($result)){
		echo "----------- <br/>";
		echo "ID: " . $row['Player ID'] . "<br/>";
		echo "Rank: " . $row['Player rank'] . "<br/>";
	}
}



?>