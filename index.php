<?php
	include('config.php');

	session_start();
	
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = $connection->prepare("SELECT * FROM login WHERE USERNAME=:username");
		$query->bindParam("username", $username, PDO::PARAM_STR);
		$query->execute();
	
		$result = $query->fetch(PDO::FETCH_ASSOC);
	
		if (!$result) {
			echo '<p class="error">Username password combination is wrong 21!</p>';
		} else {
			if (password_verify($password, $result['pass'])) {
				$_SESSION['user_id'] = $result['ID'];
				echo $_SESSION['user_id'];
				header("Location: dashboard.php");
			} else {
				echo '<p class="error">Username password combination is wrong!</p>';
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Cetis 28 admin</title>
</head>
<body>
    <div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="resource/Image/logo-halcones.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="post" action="" name="signin-form">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
						<br>
						<div class="d-flex justify-content-center mt-3 login_container">
							<form action="javascript:login()">
								<input type="submit" name="login" value="Login" class="btn login_btn"></input>
							</form>
                        </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center">
						<a href="#">Recuperar contraseña</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>