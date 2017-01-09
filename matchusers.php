<?php

echo "Making match... <br/>";

$db = mysqli_connect("localhost", "root", "Smucker77", "mm_queue");

mysqli_query($db, "INSERT INTO `matches` (`Player1_ID`, `Player2_ID`, `Player1_Data`, `Player2_Data`) VALUES ('', '', '', '')");

?>
