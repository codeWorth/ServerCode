<?php

$accounts = mysqli_connect("localhost", "user", "pbFMm5PY90tFTIpN", "accounts");

$username = $_POST['name'];
$password = $_POST['pass']; 

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
