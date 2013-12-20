<!DOCTYPE html>

<?php include("newusercontroller.php");?>
<head>
	<style>
	input {
		display: block;
		clear: both;
	}
	</style>
</head>

<body>
	<h1>Register New User Account</h1>
	<form action="newuser.php" method="post">
	<input type="text" name="username" placeholder="Your Username" />
	<input type="password" name="password" placeholder="Your Password" />
	<input type="text" name="firstname" placeholder="Your First Name" />
	<input type="text" name="lastname" placeholder="Your Last Name" />
	<input type="email" name="email" placeholder="Your Email" />
	<input type="submit" value="Submit" />
	</form>
</body>
