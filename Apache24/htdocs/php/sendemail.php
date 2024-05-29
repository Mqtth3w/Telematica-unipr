<?php

	$opt=$_REQUEST['opt']; 
	
	if($opt == 1) { //option 1 user registered
	
		$name=$_REQUEST['name'] . " " . $_REQUEST['surname'];
		$subject="Welcome to connectionGOAT!";
		$email=$_REQUEST['email'];
		$txt=file_get_contents('../html/welcomeemail.html');;
	}
	else { //option 2 user sent email to developers
	
		#$id=$_REQUEST['id'];
		$id=$_COOKIE['user_id'];
		function decryptCookie($cookieValue, $key) {
			$parts = explode('::', base64_decode($cookieValue), 2);
			$decryptedValue = openssl_decrypt($parts[0], 'AES-256-CBC', $key, 0, $parts[1]);
			return $decryptedValue;
		}
		$keyBase64 = 'OKxdJ/sg8QXrEw4siQmg+KbxKanMWZGBfbRxnYsDJB0=';
		$key = base64_decode($keyBase64);
		$id = decryptCookie($id, $key);
	
		$user="root"; $password=""; $host="localhost"; $database="connectiongoat";
		$con=@mysqli_connect($host,$user,$password,$database) or die( "Unable to select database");
		
		$query="SELECT nome, cognome, email FROM utente WHERE IdUtente = ?";
		$stmt = mysqli_prepare($con, $query);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_close($con);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$name=$row['nome'] . " " . $row['cognome'];
			$email=$row['email'];
		}
		
		$parameter="<b>Suggestion from:</b> <br/> <b>User:</b> " . $name . " <br/><b>Email:</b> " 
			. $email . "<br/><br/><b>Suggestion:</b> <br/>" . $_REQUEST['txt'];
		
		$template = file_get_contents('../html/developersemail.html');
		$txt = str_replace("{PARAMETERONE}", $parameter, $template);	
		
		$subject="ConnectionGOAT developer suggestion";
		
	}

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'C:php/PHPMailer/PHPMailer/src/Exception.php';
	require 'C:php/PHPMailer/PHPMailer/src/PHPMailer.php';
	require 'C:php/PHPMailer/PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);

	try {
		
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'localhost';
		$mail->SMTPAuth = true;
		$mail->Username = 'system@connectiongoat.it';
		$mail->Password = '12345';
		//$mail->SMTPSecure = 'tls';
		$mail->Port = 25;
		
		$mail->setFrom('system@connectiongoat.it', 'ConnectionGOAT');
		
		if($opt == 1) { //option 1 user registered
		
			$mail->addAddress($email, $name);
		}
		else { //option 2 user sent email to developers
		
			#$mail->addAddress('matteogianve@gmail.com', 'Mqtth3w');
			#$mail->addAddress('donatobruno10@gmail.com.com', 'Sasy_Xk');
			$mail->addAddress('connectiongoat@gmail.com.com', 'DMgoat');
			
		}
		
		$mail->addReplyTo('system@connectiongoat.it', 'ConnectionGOAT');

		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $txt;
		
		// 1 = High, 3 = Medium, 5 = Low
		$mail->Priority = 1;
		$mail->HeaderLine('X-Priority', '1  (Highest)'); 
		
		$mail->addAttachment('../assets/goat.png', 'logo.png');
		
		$mail->send();
		echo 'Email sent successfully';
		
	} catch (Exception $e) {
		
		echo 'Error sending email: ', $mail->ErrorInfo;
		
	}
?>