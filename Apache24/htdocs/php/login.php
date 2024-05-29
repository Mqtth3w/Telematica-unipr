<?php
    $email = $_POST["email"];
    $passwd = $_POST["password"];
    

    // Funzione per decrittografare il contenuto dei cookie utilizzando AES
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
	$res = mysqli_query($lk,"SELECT IdUtente FROM utente WHERE email = '".$email."' AND password = '".$passwd."'");
	$row_no = mysqli_num_rows($res) - 1;
    if(!($row_no >= 0)) {
        echo "credenziale sbagliate";
        return;
    }
	mysqli_data_seek($res,$row_no);
	$row = mysqli_fetch_row($res);
    $encryptedValue = encryptCookie($row[0], $key);
    setcookie("user_id", $encryptedValue, 0, "/");
    echo "accesso";
    
?>