<?php
	session_start();

	function ListErrors($name) {
		if (isset($_SESSION["error"][$name])) {
			echo $_SESSION["error"][$name];
		}
	}


?>
<!DOCTYPE html>
<html lang="cs">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/login.css">
	<title>register</title>
</head>
<body>
	<a href="../index.php">Zpět na úvodní stranu</a>
	<form method="post" action="login_action.php">
		<label for="email">email</label>
		<input type="email" name="email" autocomplete="off">
		<p><?=ListErrors("email")?></p>
		<label for="password">heslo</label>
		<input type="password" name="password" autocomplete="off">
		<p><?=ListErrors("password")?></p>
		<input type="submit" name="submit" value="přihlásit se">
		<div class='register'><p class='text'>Pokud nemáte účet tak se<a href="register.php">Registrujte</a></div>
	</form>
</body>
</html>
<?php
 	unset($_SESSION["error"]);
?>