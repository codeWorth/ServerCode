<?php

echo "Connecting to server... <br/>";
$db = mysqli_connect("localhost", "user", "tgCTG8jj9Ab8UuVj", "mm_queue");

echo "Getting queries... <br/>";
$queries = mysqli_query($db, "SELECT * FROM queries");
	
while ($currentQuery = mysqli_fetch_array($queries)){
	
	$thisRank = $currentQuery['Player rank'];
	$thisID = $currentQuery['Player ID'];
	
	echo "------ <br/>";
	
	echo "This query has ID $thisID and Rank $thisRank <br/>";
	
	echo "Finding all requests... <br/>";
	$requests = mysqli_query($db, "SELECT * FROM requests");
	
	$needInsert = 1;
	
	while ($row=mysqli_fetch_array($requests)){
		if ($row['Dest'] == $thisID){
			echo "Match found. <br/>";
			echo "Deleting current query... <br/>";	
			mysqli_query($db, "DELETE FROM queries WHERE `ID`=" . mysqli_real_escape_string($db, $currentQuery['ID']));
			
			echo "Deleting current request...  <br/>";
			mysqli_query($db, "DELETE FROM requests WHERE `ID`=" . mysqli_real_escape_string($db, $row['ID']));
			
			echo "Joining match for player $thisID... <br/>";
			
			echo "Adding player ID's to matches... <br/>";
			
			$otherID = $row['Source'];
			
			$randNum = rand(0,1);
			
			if ($randNum == 0) {
				mysqli_query($db, "INSERT INTO `matches` (`Player1_ID`, `Player2_ID`, `Player1_Data`, `Player2_Data`) VALUES ('$thisID', '$otherID', '0started', '')");	
			} else {
				mysqli_query($db, "INSERT INTO `matches` (`Player1_ID`, `Player2_ID`, `Player1_Data`, `Player2_Data`) VALUES ('$thisID', '$otherID', '', '0started')");
			}
			
			$needInsert = 0;
		}
	}
	
	if ($needInsert == 1){
	
		echo "Finding players, Rank must be $thisRank and ID cannot be $thisID... <br/>";
		$otherValidQueries = mysqli_query($db, "SELECT * FROM queries WHERE `Player rank`=" . mysqli_real_escape_string($db, $thisRank) . " AND `Player ID`!=" . mysqli_real_escape_string($db, $thisID));
		
		if (mysqli_num_rows($otherValidQueries) > 0){
			$otherUserId = mysqli_fetch_array($otherValidQueries)['Player ID'];
			echo "Other player ID is $otherUserId <br/>";
			
			echo "Adding request to connect (Source: $thisID, Dest:$otherUserId)... <br/>";
			mysqli_query($db, "INSERT INTO requests (`Source`, `Dest`) VALUES ('$thisID', '$otherUserId');");
			
			echo "Request submitted, removing current query... <br/>";
			mysqli_query($db, "DELETE FROM queries WHERE `ID`=" . mysqli_real_escape_string($db, $currentQuery['ID']));
		}
		
	}
}

echo "Done.";

?>