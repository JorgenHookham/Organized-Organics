<?php

	require_once '../includes/EmailAddressValidator.php';
	$validator = new EmailAddressValidator;
	
	// A variable to contain the query string for system messages/errors
	$message = '?message=';
	
	// Variables to contain user input
	$userEmail = $_POST['userEmail'];
	$userName = $_POST['userName'];
	$userPassword = $_POST['userPassword'];
	$passwordRepeat = $_POST['passwordRepeat'];
	
	// Check for a valid password
	if ( ! $validator->check_email_address($userEmail) )
	{
		$valid_input = false;
		$message .= '+invalid_email';
	}
	
	// Check for a valid user name
	if ( ! isset($userName) || $userName == '' )
	{
		$valid_input = false;
		$message .= '+invalid_username';
	}
	
	// Check for a valid password
	if( ! isset($userPassword) || $userPassword == '')
	{
		$valid_input = false;
		$message .= '+invalid_password';
	}
	
	// Check that password has been repeated and that the passwords match
	if ( ! isset($passwordRepeat) || $userPassword != $passwordRepeat )
	{
		$valid_input = false;
		$message .= '+password_mismatch';
	}
	
	// If there are any errors with the input, redirect back to the registration page with messages in a query string
	if ( $message != '?message=' )
	{
		header('Location: register.php' . $message); exit;
	}
	
	// If we have valid input, connect to the database
	require_once '../includes/MySQL.php';
	require_once '../includes/db.php';
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	// Sanitize the user input
	$userName = mysql_real_escape_string(trim($userName));
	$userPassword = mysql_real_escape_string(trim($userPassword));
	
	// Encode the PW input
	$userPassword = sha1($userPassword);
	
	// Check to see if the username is already in the database
	$sql = "SELECT userName FROM users WHERE userName='$userName'";
	$result = $db->query($sql);
	
	// If we get a result from the db then the username already exists and the user must choose a different one
	if ($result->size() == 1)
	{	
		header('Location: register.php?message=username_taken'); exit;
	}

	 // Otherwise, we can create a new user!
	 $sql = "insert into users (userEmail, userName, userPassword) values ('$userEmail', '$userName', '$userPassword');";
	 $result = $db->query($sql);
	 
	 // Success! Send the user to the login page with a happy message.
	 header('Location: /?message=registration_success');
	 
?>