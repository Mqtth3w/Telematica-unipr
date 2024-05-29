<?php
    $name = $_POST["name"];
    $src_image = $_POST["src_image"];
    $description = $_POST["description"];
    $idutente=$_COOKIE['user_id'];
    $data = date('Y-m-d');

    function decryptCookie($cookieValue, $key) {
        $parts = explode('::', base64_decode($cookieValue), 2);
        $decryptedValue = openssl_decrypt($parts[0], 'AES-256-CBC', $key, 0, $parts[1]);
        return $decryptedValue;
    }
    $keyBase64 = 'OKxdJ/sg8QXrEw4siQmg+KbxKanMWZGBfbRxnYsDJB0=';
    $key = base64_decode($keyBase64);

    $idutente = decryptCookie($idutente, $key);

    $lk = mysqli_connect("localhost","root",""); 
	mysqli_select_db($lk,"connectiongoat");
    mysqli_query($lk, "INSERT INTO progetto(nome,descrizione, data, IdUtente,src_image) 
                       VALUES('".$name."','".$description."','".$data."','".$idutente."','".$src_image."')");
    echo "Inserito con successo";

?>