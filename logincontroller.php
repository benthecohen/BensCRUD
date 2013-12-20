<?php
include("usermodel.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (User::authenticateUser($_POST["username"], $_POST["password"])) {
		session_start();
		$_SESSION["username"] = $_POST["username"];
		echo '<script type="text/javascript">
			window.location = "dashboard.php"; 
		</script>';
		} else {
		echo 'Wrong username and/or password.';
	}
}
?>
