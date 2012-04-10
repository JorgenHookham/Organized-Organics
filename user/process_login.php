<?php
	
	// Set a variable to contain the from page hidden input, if there is none set then use the home page.
	$from_page = ( isset($_POST['from_page']) ) ? $_POST['from_page'] : '/index.php';
	
	// A variable to contain the query string for system messages/errors
	$message = ( strrpos($from_page,'?') ) ? '&message=' : '?message=';
	
	// Check for a valid user name
	if (!isset($_POST['username']) || $_POST['username'] == '')
	{
		$valid_input = false;
		$message .= '+empty_username';
	}
	
	// Check for a valid password
	if(!isset($_POST['password']) || $_POST['password'] == '')
	{
		$valid_input = false;
		$message .= '+empty_password';
	}
	
	// If UN and/or PW is invalid, redirect to from page with errors in a query string
	if ( $message != '?message=' && $message != '&message=') : header('Location: ' . $from_page . $message); exit; endif;
	
	// If we have valid input, connect to the database
	require_once '../includes/MySQL.php';
	require_once '../includes/db.php';
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	// Sanitize the user input
	$username = mysql_real_escape_string(trim($_POST['username']));
	$password = mysql_real_escape_string(trim($_POST['password']));
	
	// Encode the PW input
	$password = sha1($password);
	
	// Get the user form the database
	$sql = "SELECT userID, userName, userPassword FROM users WHERE userName='$username'";
	$result = $db->query($sql);
	
	// If we get a valid response from the database begin a PHP session and check to see if they entered the right password
	if ($result->size() == 1)
	{
		session_start();	

		while ($row = $result->fetch())
		{
			//echo $row['userPassword'] . ' : ' . $password; exit;
			if ( $row['userPassword'] != $password ) : header('Location: ' . $from_page . $message . 'incorrect_password'); exit; endif;
			$_SESSION['logged_in_user'] = $row['userName'];
			$_SESSION['logged_in_user_id'] = $row['userID'];
		}
		
		header('Location: ' . $from_page . $message . 'login_success'); exit;
	}

	 header('Location: ' . $from_page . $message . 'incorrect_username'); exit;
	
?>