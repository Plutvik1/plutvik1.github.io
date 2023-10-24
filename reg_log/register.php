<?php
	session_start();

	function ListErrors($name) {
		if (isset($_SESSION["error"][$name])) {
			echo $_SESSION["error"][$name];
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/login.css">
	<title>register</title>
</head>
<body>
	<a href="../index.php">Zpět na úvodní stranu</a>
	<form method="post" action="register_action.php">
		<label for="name">jméno</label>
		<input type="text" name="name" autocomplete="off">
		<?=ListErrors("name")?>
		<label for="surname">příjmení</label>
		<input type="text" name="surname" autocomplete="off">
		<?=ListErrors("surname")?>
		<label for="email">email</label>
		<input type="email" name="email" autocomplete="off">
		<?=ListErrors("email")?>
		<label for="password">heslo</label>
		<input type="password" name="password" autocomplete="off">
		<?=ListErrors("password")?>
		<label for="password_sec">heslo znovu</label>
		<input type="password" name="password_sec" autocomplete="off">
		<?=ListErrors("password_sec")?>
		<input type="submit" name="submit" value="registrovat se">
		<div id="login">Pokud již máte účet tak se <a href="login.php">Přihlašte</a></div>
	</form>
</body>
</html>
<?php
	unset($_SESSION["error"]);
?>