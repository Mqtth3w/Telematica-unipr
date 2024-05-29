<?php
	
    $lk = mysqli_connect("localhost","root",""); 
	mysqli_select_db($lk,"connectiongoat");
	$res = mysqli_query($lk,"SELECT IdProgetto,SUM(voto) as votazione FROM votazione GROUP BY IdProgetto");
	$votes = array();
	while($row = mysqli_fetch_assoc($res)) {
        $votes[] = $row;
    }
	echo json_encode($votes);
?>
