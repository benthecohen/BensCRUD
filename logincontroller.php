<?php
include("usermodel.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (User::authenticateUser($_POST["username"], $_POST["password"])) {
		$_SESSION["username"] = $_POST["username"];
		HttpResponse::redirect('dashboard.php');
	} else {
		echo 'Wrong username and/or password.';
	}

}
?>