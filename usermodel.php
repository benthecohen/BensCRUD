<?php

include("config.php");

class User {
	
	private $username;
	private $salt;
	private $hash;
	private $firstname;
	private $lastname;
	private $email;
	
	public function getUsername() {
		return $this->username;
	}
	public function getFirstName() {
		return $this->firstname;
	}
	
	public function getLastName() {
		return $this->lastname;
	}
	
	public function getEmail() {
		return $this->email;
	}	
	
	//check to see if username already exists in database; returns TRUE if username is AVAILABLE
	public static function isUsernameAvailable($un){ 
		global $db;
		try {
			$stmt = $db->prepare('SELECT `ID` FROM `USERS` WHERE `Username` = :username');
			$stmt->bindParam(':username', $un);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($result == null) {
				return true;
			}
			else {
				return false;
			}
		} catch (PDOException $e) {
			error_log("Error!: " . $e->getMessage());
			die();
		}
	}

	//given a username and password, see if they match a user in the database; returns TRUE if user is authenticated
	public static function authenticateUser($un, $pw) {
		global $db;
		try {
			$stmt = $db->prepare('SELECT `Password`,`Salt` FROM `USERS` WHERE `Username` = :username');
			$stmt->bindParam(':username', $un);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($result["Password"] == crypt($pw, "$2a$12$".$result["Salt"])) {
				return true;
			}
			else {
				return false;
			}
			
		} catch (PDOException $e) {
			error_log("Error!: " . $e->getMessage());
			die();
		}
	}
	
	// pull user info (firstname, lastname, email) from the database and set local attributes
	public function getUserInfo(){
		global $db;
		try {
			$stmt = $db->prepare('SELECT `FirstName`,`LastName`,`Email` FROM `USERS` WHERE `Username` = :username');
			$stmt->bindParam(':username', $this->username);
			$stmt->execute();
			$result = $stmt->fetch();
			$this->firstname = $result["FirstName"];
			$this->lastname = $result["LastName"];
			$this->email = $result["Email"];
		} catch (PDOException $e) {
			error_log("Error!: " . $e->getMessage());
			die();
		}
	}
	
	
	// populate local environment with new user info
	public function setNewUserInfo($un, $pw, $fn, $ln, $em) {
		$this->username = $un;
		$this->salt = bin2hex(openssl_random_pseudo_bytes(22));
		$this->hash = crypt($pw, "$2a$12$".$this->salt);
		$this->firstname = $fn;
		$this->lastname = $ln;
		$this->email = $em;
	}
	
	// save current state of user info to the database as new user
	public function saveNewUserInfo() {
		if ($this::isUsernameAvailable($this->username)) {
		global $db;
		try {	
			$db->beginTransaction(); //start transaction
			$stmt = $db->prepare('INSERT INTO `USERS`(`Username`, `Password`, `Salt`, `FirstName`, `LastName`, `Email`) VALUES (:username, :password, :salt, :firstname, :lastname, :email)'); //create prepared statement
			
			$stmt->bindParam(':username', $this->username);
			$stmt->bindParam(':password', $this->hash);
			$stmt->bindParam(':salt', $this->salt);
			$stmt->bindParam(':firstname', $this->firstname);
			$stmt->bindParam(':lastname', $this->lastname);
			$stmt->bindParam(':email', $this->email);
			
			$stmt->execute(); //execute the prepared SQL statement
			
			$db->commit();
		} catch (PDOException $e) {
			error_log("Error!: " . $e->getMessage());
			die();
		}
		} else {
			print "Username is taken.";
		}
	}
	
	//takes attributes and values, either as two matching arrays or as two strings. Sets class attributes.
	public function setUserAttributes($attr, $value) {
		if (is_string($attr) && is_string($value)) { //if the method is passed individual attribute/value as string
			$this->$attr = $value;
		} elseif (is_array($attr) && is_array($value) && count($attr) == count($value)) { //if method is passed two matching arrays
			foreach ($attr as $i => $x) {
				$this->$x = $value[$i];
			}
		} else {
			error_log("Error: arguments for setUserAttributes must be two strings or two matching arrays.");
		}
	}
}

//the code below is for testing the User class only

?>