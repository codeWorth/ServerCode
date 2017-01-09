<?php

echo "Connecting...";
$accounts = mysqli_connect("http://ubuntu@ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "defaultUser", "YHHQte6UXP26cFpe", "accounts");

$username = $_POST['name'];
$password = $_POST['pass']; 

/*$stmt = $accounts->prepare("SELECT * FROM players WHERE `Username` = ? AND `Password` = ?");
$stmt->bind_param('ss', $username, $password);

$stmt->execute();

$me = $stmt->get_result();

if (mysqli_num_rows($me)>0){
	$ID = mysqli_fetch_array($me)['ID'];
	
	echo $ID;
} else {
	echo "No user found with those credentials";
}*/

echo mysqli_query($db, "SELECT * FROM players;");

?>
