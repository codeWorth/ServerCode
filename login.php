<?php

$accounts = mysqli_connect("ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "accounts", "b29f856cb9acc", "accounts");

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

?>