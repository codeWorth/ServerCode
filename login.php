<?php

$accounts = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "accounts");

$username = $_POST['name'];
$password = $_POST['pass']; 

$stmt = $accounts->prepare("SELECT * FROM players WHERE `Username` = ? AND `Password` = ?");
$stmt->bind_param('ss', $username, $password);

$stmt->execute();

$me = $stmt->get_result();

if (mysqli_num_rows($me)>0){
	$ID = mysqli_fetch_array($me)['ID'];

	echo $ID;
}

#echo mysqli_query($db, "SELECT * FROM players;");

?>
