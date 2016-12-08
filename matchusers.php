<?php

echo "Making match... <br/>";

$db = mysqli_connect("10.0.1.121", "Drewpew", "", "mm_queue");

mysqli_query($db, "INSERT INTO `matches` (`Player1_ID`, `Player2_ID`, `Player1_Data`, `Player2_Data`) VALUES ('', '', '', '')");

?>
