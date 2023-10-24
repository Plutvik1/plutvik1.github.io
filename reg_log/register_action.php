<?php
	include "../db.php";

	if (isset($_POST["email"]) AND !empty($_POST["email"])) {
		$email = $_POST["email"];
	} else {
		$error["email"] = "Vyplňte email";
	}

	if (isset($_POST["name"]) AND !empty($_POST["name"])) {
		$name = $_POST["name"];
	} else {
		$error["name"] = "Vyplňte své jméno";
	}

	if (isset($_POST["surname"]) AND !empty($_POST["surname"])) {
		$surname = $_POST["surname"];
	} else {
		$error["surname"] = "Vyplňte své příjmení";
	}

	if (isset($_POST["password"]) AND !empty($_POST["password"])) {
		$password_hashed = password_hash($_POST["password"], PASSWORD_BCRYPT);
		$password = $_POST["password"];
	} else {
		$error["password"] = "Zadejte heslo";
	}

	if (isset($_POST["password_sec"]) AND !empty($_POST["password_sec"])) {
		$password_sec = $_POST["password_sec"];
	} else {
		$error["password_sec"] = "Zedejte heslo";
	}

	if (isset($password) AND isset($password_sec) AND $password === $password_sec) {
		
	} else {
		$error["password"] = "Hesla se neshodují";
	}

///////////////////////////////////////////////////////////////////////////////////////////

	if (!isset($error)) {
		$sql_check_email = "SELECT COUNT(email) FROM CMS_users WHERE email = :email";

		$check_email_input = array(":email" => $email);

		$sql_check_email_com = $db->prepare($sql_check_email);
		$sql_check_email_com->execute($check_email_input);
		$check_email = $sql_check_email_com->fetchColumn();



		if ($check_email == 0) {
			$sql_register = "INSERT INTO CMS_users (name, surname, email, password) VALUES (:name, :surname, :email, :password)";

			$register_inputs = array(":email" => $email, ":password" => $password_hashed, ":name" => $name, ":surname" => $surname);

			$sql_register_com = $db->prepare($sql_register);
			$sql_register_com->execute($register_inputs);

			exit(header("location: login.php"));
		} else {
			$_SESSION["error"]["email"] = "Účet s tímto emailem již existuje";
			exit(header("location: login.php")); 
		}	
	} else {
		$_SESSION["error"] = $error;
		exit(header("location: register.php"));
	}
?>