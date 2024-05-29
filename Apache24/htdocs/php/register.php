<?php
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $passwd = $_POST["password"];

	// Funzione per crittografare il contenuto dei cookie utilizzando AES
	function encryptCookie($value, $key) {
		$ivSize = openssl_cipher_iv_length('AES-256-CBC');
		$iv = openssl_random_pseudo_bytes($ivSize);
		$encryptedValue = openssl_encrypt($value, 'AES-256-CBC', $key, 0, $iv);
		$cookieValue = base64_encode($encryptedValue . '::' . $iv);
		return $cookieValue;
	}
	$keyBase64 = 'OKxdJ/sg8QXrEw4siQmg+KbxKanMWZGBfbRxnYsDJB0=';
    $key = base64_decode($keyBase64);

    $lk = mysqli_connect("localhost","root",""); 
	mysqli_select_db($lk,"connectiongoat");

    $insertrue = 1;
	$res = mysqli_query($lk,"SELECT email FROM utente");
	for ($row_no = mysqli_num_rows($res) - 1; $row_no >= 0; $row_no--)
    {
		mysqli_data_seek($res,$row_no);
		$row = mysqli_fetch_row($res);
		if($row[0] == $email){	
		    $insertrue = 0;
		}
	}
	if($insertrue) {
		mysqli_query($lk, "INSERT INTO utente( nome,cognome, email, password) VALUES('".$name."','".$surname."','".$email."','".$passwd."')");
		echo " Utente ".$name." con email: ". $email . " registrato corretamente ";
		$res = mysqli_query($lk,"SELECT IdUtente FROM utente WHERE email = '".$email."'");
		$row_no = mysqli_num_rows($res) - 1;
		mysqli_data_seek($res,$row_no);
		$row = mysqli_fetch_row($res);
		$id = $row[0];
		$encryptedValue = encryptCookie($id, $key);

		setcookie("user_id", $encryptedValue, 0, "/");
	}
	else {
		echo " Utente ".$name." con email: ". $email . " è già stato registrato ";
	}
?>