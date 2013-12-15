<?php
include("usermodel.php");
if (isset($_SESSION["username"])){
	$usr = new User();
	$usr->setUserAttributes("username",$_SESSION["username"]);
	$usr->getUserInfo();
	$_SESSION["firstname"] = $usr->getFirstName();
	$_SESSION["lastname"] = $usr->getLastName();
	$_SESSION["email"] = $usr->getEmail();
} else {
	echo '<script type="text/javascript">window.location="login.php"</script>'; //redirect to login page
}
if ($_GET["action"] == "logout"){
	echo 'logging out';
		// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	    }

// Finally, destroy the session.
	session_destroy();
	echo '<script type="text/javascript">window.location="login.php"</script>'; //redirect to login page

}
?>