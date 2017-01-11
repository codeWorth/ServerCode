<?php

echo "Making match... <br/>";

$db = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "mm_queue");

mysqli_query($db, "INSERT INTO `matches` (`Player1_ID`, `Player2_ID`, `Player1_Data`, `Player2_Data`) VALUES ('', '', '', '')");

?>
