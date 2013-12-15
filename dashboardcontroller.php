<?php
include("usermodel.php");
if (isset($_SESSION["username"])){
	$usr = new User();
	$usr->setUserAttributes("username",$_SESSION["username"]);
	$usr->getUserInfo();
}
?>