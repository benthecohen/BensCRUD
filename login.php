<!DOCTYPE html>

<?php include("logincontroller.php");?>
<head>
	<style>
	input {
		display: block;
		clear: both;
	}
	</style>
</head>

<body>
<h1>Log In</h1>
<form action="login.php" method="post">
<input type="text" name="username" placeholder="Your Username" />
<input type="password" name="password" placeholder="Your Password" />
<input type="submit" value="Log In" />
</body>
