<?php
	include "../db.php";
	session_start();

	if (!empty($_POST["email"])) {
		$email = $_POST["email"];
	} else {
		$error["email"] = "Vyplňte email";
	}

	if (empty($_POST["password"])) {
		$error["password"] = "Vyplňte heslo";
	} else {
		$password = $_POST["password"];
	}


	if (!isset($error)) {
		$sql_email_check = "SELECT ID, password FROM CMS_users WHERE email = :email";

		$email_check_input = array(":email" => $email);

		$sql_email_check_com = $db->prepare($sql_email_check);
		$sql_email_check_com->execute($email_check_input);
		$check_email = $sql_email_check_com->fetchAll(PDO::FETCH_ASSOC);


		if (password_verify($password, $check_email["0"]["password"])) {
			$_SESSION["logged"] = "";
			$_SESSION["user_id"] = $check_email["0"]["ID"];
			exit(header("location: ../index.php"));
		} else {
			$_SESSION["error"]["password"] = "Špatně zadaný email nebo heslo"; 
			exit(header("location: login.php"));
		}
	} else {
		$_SESSION["error"] = $error;
		exit(header("location: login.php"));
	}

	
?>