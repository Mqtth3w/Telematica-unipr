<?php 
	$str=$_REQUEST["usrinput"]; 
	$query="SELECT IdProgetto FROM progetto WHERE nome LIKE ?";
	
	$user="root"; $password=""; $host="localhost"; $database="connectiongoat";
	$con=@mysqli_connect($host,$user,$password,$database) or die( "Unable to select database");
	
	if(isset($str)){
		
		if($stmt = mysqli_prepare($con, $query)){
			 
			mysqli_stmt_bind_param($stmt, "s", $param_term);
			
			$param_term = $str . '%';
			
			if(mysqli_stmt_execute($stmt)){
				$result = mysqli_stmt_get_result($stmt);
				
				if(mysqli_num_rows($result) > 0){
					 
					if($row = mysqli_fetch_assoc($result)){ 
						echo $row['IdProgetto'];
					}
					
				} else {
					echo "";
				}
			} else {
				echo "ERROR: Not able to execute the query " . mysqli_error($con);
			}
    
		}
		
    mysqli_stmt_close($stmt);
		
	}
	mysqli_close($con);
	
?>