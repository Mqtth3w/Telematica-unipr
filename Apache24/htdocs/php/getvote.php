<?php
    $lk = mysqli_connect("localhost","root",""); 
	mysqli_select_db($lk,"connectiongoat");
    $id=$_COOKIE['user_id'];
	function decryptCookie($cookieValue, $key) {
        $parts = explode('::', base64_decode($cookieValue), 2);
        $decryptedValue = openssl_decrypt($parts[0], 'AES-256-CBC', $key, 0, $parts[1]);
        return $decryptedValue;
    }
    $keyBase64 = 'OKxdJ/sg8QXrEw4siQmg+KbxKanMWZGBfbRxnYsDJB0=';
    $key = base64_decode($keyBase64);

    $id = decryptCookie($id, $key);
	$res = mysqli_query($lk,"SELECT IdProgetto,voto FROM votazione WHERE IdUtente= ".$id."");
	$votes = array();
	while($row = mysqli_fetch_assoc($res)) {
        $votes[] = $row;
    }
	echo json_encode($votes);
?>
