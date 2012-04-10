<?php
	
	// Set a variable to contain the from page hidden input, if there is none set then use the home page.
	$from_page = (isset($_GET['from_page'])) ? $_GET['from_page'] : '/index.php';
	
	$from_page = str_replace('!Q', '?', $from_page);
	
	session_start();
	
	if (isset($_COOKIE[session_name()])) {	//	did the user's browser send a cookie for this session?
	    setcookie(session_name(), '', time()-42000, '/');	//	reset the cookie (empty it)
	}

	session_destroy();

	header('Location: ' . $from_page);
	
?>