<?php
	
	session_start();
	
	// Contain user input in variables
	if ( isset($_POST['reviewTitle']) ) $reviewTitle = $_POST['reviewTitle'];
	if ( isset($_POST['reviewBody']) ) $reviewBody = $_POST['reviewBody'];
	if ( isset($_POST['listingid']) ) $listingid = $_POST['listingid'];
	if ( isset($_POST['reviewRating']) ) $rating = $_POST['reviewRating'];
	
	// Validate required fields
	$message = '?message=';
	
	if (!isset($reviewTitle) || $reviewTitle == '')
	{
		$valid_input = false;
		$message .= '+empty_reviewtitle';
	}
	
	if (!isset($reviewBody) || $reviewBody == 'NULL')
	{
		$valid_input = false;
		$message .= '+empty_reviewbody';
	}
	
	// Send user back to add.php if there are input errors
	if ($message != '?message=') : header('Location: /listing/review.php' . $message); exit; endif;
	
	// Connect to the database
	require_once '../includes/MySQL.php';
	require_once '../includes/db.php';
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	// Sanitize all user input
	$reviewTitle = mysql_real_escape_string(trim($reviewTitle));
	$reviewBody = mysql_real_escape_string(trim($reviewBody));
	$listingid = mysql_real_escape_string(trim($listingid));
	$rating = mysql_real_escape_string(trim($rating));
	
	echo $listingid;
	
	// Insert the listing into the db
	
	$userid = $_SESSION['logged_in_user_id'];
	
	$sql = "INSERT INTO reviews VALUES ('', '$reviewTitle', '$reviewBody', NOW(), $listingid, $userid)";
	$result = $db->query($sql);
	
	$sql = "INSERT INTO ratings (rating, listingID, userID) VALUES ($rating, $listingid, $userid)";
	$result = $db->query($sql);
	
	header('Location: /listing/?view=' . $listingid);
	
 ?>