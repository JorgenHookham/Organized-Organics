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

// Check that password has been repeated and that the passwords match
if ( ! isset($passwordRepeat) || $userPassword != $passwordRepeat )
{
	$valid_input = false;
	$message .= '+password_mismatch';
}

// If there are any errors with the input, redirect back to the registration page with messages in a query string
if ( $message != '?message=' )
{
	header('Location: edit.php' . $message); exit;
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

session_start();

if ( $_SESSION['logged_in_user'] != $userName )
{
	// Check to see if the username is already in the database
	$sql = "SELECT userName FROM users WHERE userName='$userName'";
	$result = $db->query($sql);
	
	// If we get a result from the db then the username already exists and the user must choose a different one
	if ($result->size() == 1)
	{	
		header('Location: edit.php?message=username_taken'); exit;
	}
}

// Otherwise, we can create a new user!
$sql = "update users set userEmail = '$userEmail', userName = '$userName', userPassword = '$userPassword' where userID = " . $_SESSION['logged_in_user_id'];
$result = $db->query($sql);

// Success!
header('Location: edit.php?message=edit_success');
 
 
 
 
 
 
 
 
 
 
 
 
 
 