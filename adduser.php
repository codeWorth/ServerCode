<?php

$accounts = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "accounts");

$username = $_GET['name'];
$password = $_GET['pass']; 

$stmt = $accounts->prepare("SELECT * FROM players WHERE `Username`= ?");
$stmt->bind_param('s', $username);

$stmt->execute();

$me = $stmt->get_result();

if ($username != "" and $password != ""){
	if (mysqli_num_rows($me) != 0){
		echo "-1";
	} else {
		$stmt = $accounts->prepare("INSERT INTO players (Username,Password) VALUES(?, ?)");
		$stmt->bind_param('ss', $username, $password);

		$stmt->execute();
		
		$stmt = $accounts->prepare("SELECT * FROM players WHERE `Username`= ?");
		$stmt->bind_param('s', $username);

		$stmt->execute();

		$me = $stmt->get_result();
		$ID = mysqli_fetch_array($me)['ID'];
		
		echo $ID;
	}
}

?>
