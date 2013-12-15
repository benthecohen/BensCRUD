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
		<td><?php echo $_SESSION["username"];?></td>
	</tr>
	<tr>
		<th>First Name: </th>
		<td><?php echo $_SESSION["firstname"];?></td>
	</tr>
	<tr>
		<th>Last Name: </th>
		<td><?php echo $_SESSION["lastname"];?></td>
	</tr>
	<tr>
		<th>Email: </th>
		<td><?php echo $_SESSION["email"];?></td>
	</tr>
</table>

<a href="dashboard.php?action=logout">Log out</a>
</body>