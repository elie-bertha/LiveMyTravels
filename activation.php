<?php
	session_start();
	header('Location: index.php') ; 
	$successMessage="";
	$errorMessage="";
	if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',	 $_GET['email'])) {
		$email = $_GET['email'];
	}

	if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
	 //The Activation key will always be 32 since it is MD5 Hash
	{
		$key = $_GET['key'];
	}

	if (isset($email) && isset($key)) {
		include ('database_connection.php');
		// Update the database to set the "activation" field to null
		$result = mysql_query("UPDATE user SET is_activated = 1 WHERE(email ='$email' AND activation_code = '$key') LIMIT 1") or die(mysql_error());
		$rowUpdated = mysql_affected_rows();
		// Print a customized message:
		if ($rowUpdated > 0) //if update query was successfull
		{
			$_SESSION['successMessage'] = "Your account is now active. You may now <a href='index.php'>Log in</a>";
		} else {
			$_SESSION['errorMessage'] = "Oops !Your account could not be activated. Please recheck the link or contact the system administrator.";
		}
		mysql_close($connection);
	} else {
		$_SESSION['successMessage'] = "Error Occured .";
	}
?>
