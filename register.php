<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$successMessage="";
		$errorMessage="";
		$firstname = mysql_real_escape_string($_POST['firstname']);
		$lastname = mysql_real_escape_string($_POST['lastname']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = password_hash(mysql_real_escape_string($_POST['password']), PASSWORD_DEFAULT);
	    $bool = true;
		include ('database_connection.php');
		$query = mysql_query("Select * from user"); //Query the users table
		while($row = mysql_fetch_array($query)) //display all rows from query
		{
			$table_user = $row['email']; // the first email row is passed on to $table_user, and so on until the query is finished
			if($email == $table_user) // checks if there are any matching fields
			{
				$bool = false; // sets bool to false
				$_SESSION['errorMessage'] = "Email already registered !";
				header("location: index.php");
			}
		}
		if($bool) // checks if bool is true
		{
			// Create a unique  activation code:
            $activation = md5(uniqid(rand(), true));

			$result = mysql_query("INSERT INTO user (firstname, lastname, email, password, activation_code) VALUES ('$firstname','$lastname','$email','$password', '$activation')") 
				or die(mysql_error()); //Inserts the value to table user
			if($result){
				// Send the email:
                $message = " To activate your account, please click on this link:\n\n";
                $message .= 'http://localhost/~leslie/LiveMyTravels/activation.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Registration Confirmation', $message, 'From:'.EMAIL);
			}
			$_SESSION['successMessage'] = "Thank you for registering! A confirmation email has been sent to " . $email . ". 
				Please click on the Activation Link to Activate your account.";
				header("location: index.php");
		}
	}
	mysql_close($connection);
?>