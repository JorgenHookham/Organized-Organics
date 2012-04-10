<?php
	
	// Contain user input in variables
	if ( isset($_POST['listingName']) ) $listingName = $_POST['listingName'];
	if ( isset($_POST['listingType']) ) $listingType = $_POST['listingType'];
	if ( isset($_POST['listingDescription']) ) $listingDescription = $_POST['listingDescription'];
	if ( isset($_POST['listingStreetAddress']) ) $listingStreetAddress = $_POST['listingStreetAddress'];
	if ( isset($_POST['listingCity']) ) $listingCity = $_POST['listingCity'];
	if ( isset($_POST['listingPostalCode']) ) $listingPostalCode = $_POST['listingPostalCode'];
	if ( isset($_POST['listingWebsite']) ) $listingWebsite = $_POST['listingWebsite'];
	if ( isset($_POST['listingLatitude']) ) $listingLatitude = $_POST['listingLatitude'];
	if ( isset($_POST['listingLongitude']) ) $listingLongitude = $_POST['listingLongitude'];
	if ( isset($_POST['listingID']) ) $listingID = $_POST['listingID'];
	if ( isset($_POST['cuisines']) ) $listingcuisines = $_POST['cuisines'];
	if ( isset($_POST['stock']) ) $stock = $_POST['stock'];
	
	if ( ! preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $listingWebsite) )
	{
		$listingWebsite = 'http://' . $listingWebsite;
	}
	
	// Validate required fields
	$message = '?message=';
	
	if (!isset($listingName) || $listingName == '')
	{
		$valid_input = false;
		$message .= '+empty_listingname';
	}
	
	if (!isset($listingType) || $listingType == 'NULL')
	{
		$valid_input = false;
		$message .= '+empty_listingtype';
	}
	
	if (!isset($listingCity) || $listingCity == 'NULL')
	{
		$valid_input = false;
		$message .= '+empty_listingcity';
	}
	
	// Send user back to edit.php if there are input errors
	if ($message != '?message=') : header('Location: edit.php' . $message); exit; endif;
	
	// Connect to the database
	require_once '../includes/MySQL.php';
	require_once '../includes/db.php';
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	// Sanitize all user input
	$listingName = mysql_real_escape_string(trim($listingName));
	$listingType = mysql_real_escape_string(trim($listingType));
	$listingDescription = mysql_real_escape_string(trim($listingDescription));
	$listingStreetAddress = mysql_real_escape_string(trim($listingStreetAddress));
	$listingCity = mysql_real_escape_string(trim($listingCity));
	$listingPostalCode = mysql_real_escape_string(trim($listingPostalCode));
	$listingWebsite = mysql_real_escape_string(trim($listingWebsite));
	$listingLatitude = mysql_real_escape_string(trim($listingLatitude));
	$listingLongitude = mysql_real_escape_string(trim($listingLongitude));
	
	// Insert the listing into the db
	$sql = "update listings set listingName = '$listingName', listingType = '$listingType', listingDescription = '$listingDescription', listingStreetAddress = '$listingStreetAddress', cityID = '$listingCity', listingPostalCode = '$listingPostalCode', listingWebsite = '$listingWebsite', listingLatitude = '$listingLatitude', listingLongitude = '$listingLongitude' where listingID = '$listingID'";
	$result = $db->query($sql);
	
	
	// Adding the cuisine types
	if( isset($listingcuisines) && $listingType == 'restaurant' )
	{
		$listingcuisines = array_merge($listingcuisines);

		$sql = "delete from listingcuisines where listingID='$listingID'";
		$result = $db->query($sql);
		
		$values = "VALUES";
		
		for ( $i = 0; $i < count($listingcuisines); $i++ )
		{
			$values .= ( $i == count($listingcuisines) - 1 ) ? " ('$listingcuisines[$i]','$listingID')" : " ('$listingcuisines[$i]','$listingID'),";
		}

		$sql = "INSERT INTO listingcuisines (cuisineTypeID, listingID) $values";
		$result = $db->query($sql);
	}
	
	
	// Adding the stock types
	if( isset($stock) && $listingType == 'market' || $listingType == 'farm' )
	{
		$stock = array_merge($stock);

		$sql = "delete from stock where listingID='$listingID'";
		$result = $db->query($sql);
		
		$values = "VALUES";
		
		for ( $i = 0; $i < count($stock); $i++ )
		{
			$values .= ( $i == count($stock) - 1 ) ? " ('$stock[$i]','$listingID')" : " ('$stock[$i]','$listingID'),";
		}

		$sql = "INSERT INTO stock (stockTypeID, listingID) $values";
		echo $sql;
		$result = $db->query($sql);
	}
	
	
	header('Location: edit.php?listing=' . $listingID . '&message=listing_edit_success');
	
 ?>