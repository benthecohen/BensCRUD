<?php
require_once("dashboardcontroller.php");
?>

<!DOCTYPE html>

<head></head>

<body>
<h1>User Info</h1>
<table>
	<tr>
		<th>Username: </th>
		<td><?php echo $usr->getUsername();?></td>
	</tr>
	<tr>
		<th>First Name: </th>
		<td><?php echo $usr->getFirstName();?></td>
	</tr>
	<tr>
		<th>Last Name: </th>
		<td><?php echo $usr->getLastName();?></td>
	</tr>
	<tr>
		<th>Email: </th>
		<td><?php echo $usr->getEmail();?></td>
	</tr>

</body>