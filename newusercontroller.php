<?php
include("usermodel.php");

function submitRegistration(){
		if (User::isUsernameAvailable($_POST["username"])){
			$usr = new User();
			$usr->setNewUserInfo($_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["email"]); //initialize the user data locally
			$usr->saveNewUserInfo(); //save user data to the database
			echo 'Your account has been registered! <a href="login.php">Click here to log in.</a>';
		} else {
			echo 'Sorry, that username is not available.';
		}
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
		submitRegistration();
	}

?>