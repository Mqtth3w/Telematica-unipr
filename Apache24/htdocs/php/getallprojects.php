<?php
	
    $lk = mysqli_connect("localhost","root",""); 
	mysqli_select_db($lk,"connectiongoat");
	$res = mysqli_query($lk,"SELECT * FROM progetto");
	$papers = array();
	while($row = mysqli_fetch_assoc($res)) {
        $papers[] = $row;
    }
	echo json_encode($papers);
?>
