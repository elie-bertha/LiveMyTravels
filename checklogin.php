<?php
	session_start();
	session_unset();	
	$errorMessage = "";

	if($_POST['email'] == ""){
		$errorMessage = "Please fill out the email field";
		header("location: index.php");
	}
	else{
		if ($_POST['password'] == "") {
			$errorMessage = "Please fill out the password field";
			header("location: index.php");
		}
		else{
			include ('database_connection.php');
			$email = mysql_real_escape_string($_POST['email']);
			$password = mysql_real_escape_string($_POST['password']);
			$result = mysql_query("SELECT * from user WHERE email='$email'"); //Query the user table if there are matching rows equal to $email
			$exists = mysql_num_rows($result); //Checks if email exists
			$table_user = "";
			$table_password = "";
			if($exists > 0) //IF there are no returning rows or no existing email
			{
				while($row = mysql_fetch_assoc($result)) //display all rows from result
				{
					$table_user = $row['email']; // the first email row is passed on to $table_user, and so on until the query is finished
					$table_password = $row['password']; // the first password row is passed on to $table_user, and so on until the query is finished
					$table_firstname = $row['firstname'];
					$table_lastname = $row['lastname'];
					$table_is_admin = $row['is_admin'];
					$table_is_activated = $row['is_activated'];
				}
				if(($email == $table_user) && (password_verify($password, $table_password))) // checks if there are any matching fields
				{
						if(password_verify($password, $table_password))
						{
							if($table_is_activated){
								$_SESSION['email'] = $email; //set the email in a session. This serves as a global variable
								$_SESSION['firstname'] = $table_firstname; //set the email in a session. This serves as a global variable
								$_SESSION['lastname'] = $table_lastname; //set the email in a session. This serves as a global variable
								$_SESSION['is_admin'] = $table_is_admin; //set the email in a session. This serves as a global variable
								header("location: home.php"); // redirects the user to the authenticated home page
							}
							else{
								$errorMessage = "Your account is not activated !";
								header("location: index.php");
								//Print '<script>alert("Your account is not activated!");</script>'; //Prompts the user
								//Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
							}
						}
						
				}
				else
				{
					$errorMessage = "Incorrect Password !";
					header("location: index.php");
					//Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
					//Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
				}
			}
			else
			{
				$errorMessage = "Incorrect email !";
				header("location: index.php");
				//Print '<script>alert("Incorrect email!");</script>'; //Prompts the user
				//Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
			}
			mysql_close($connection);
		}
	}
	$_SESSION['errorMessage'] = $errorMessage;
?>