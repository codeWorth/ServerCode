<?php

echo "Making match... <br/>";

$db = mysqli_connect("ec2-54-212-208-231.us-west-2.compute.amazonaws.com", "mm_User", "c01f148554b4a2b", "mm_queue");

mysqli_query($db, "INSERT INTO `matches` (`Player1_ID`, `Player2_ID`, `Player1_Data`, `Player2_Data`) VALUES ('', '', '', '')");

?>
