<?php
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Подключение к базе данных MariaDB
		$db = new mysqli("127.0.0.1", "root", "root", "site_fry");

		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}

		$username = $_POST["login"];
		$pass = $_POST["pass"];

		$query = "SELECT id, login, password FROM users WHERE login = ? AND password = ?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ss", $username, $pass);
		$stmt->execute();
		$stmt->bind_result($id, $login, $password);

		if ($stmt->fetch()) {
			$_SESSION["id"] = $id;  // Store the user ID in the session
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			header("Location: index.php");
		} else {
			echo "Неверные номер логин или пароль";
		}
		$stmt->close();
		$db->close();
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Авторизация</title>
		<style>
	
			body {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				margin: 0;
			}
			.login-container {
				width: 200px; /* Увеличьте размер по желанию */
				padding: 10px;
				background: #f2f2f2;
				border: 1px solid #ddd;
				border-radius: 5px;
				text-align: center;
			}
			h1 {
				font-size: 22px;
				font-family: 'Courier New', Courier, monospace;
			}
			input {
				width: 90%;
				padding: 10px;
				margin: 5px 0;
				border: 1px solid #ccc;
				border-radius: 5px;
			}
			button {
				width: 95%;
				padding: 10px;
				background: #000084;
				color: #fff;
				border: none;
				border-radius: 5px;
				cursor: pointer;
			}
		</style>
	</head>
	<body>
	<div class="login-container">
	<header>
		</header>
		<form method="POST" action="login.php">
		<h1 align="center">АВТОРИЗАЦИЯ</h1>
			<input type="text" name="login" placeholder="Логин" required><br>
			<input type="text" name="pass" placeholder="Пароль" required><br>
	<br/><br/>
	<button type="submit">Войти</button>
	</form>
	<a href="reg.php">Регистрация</a>
	</div>
	</body>
	<footer></footer>
	</html>

