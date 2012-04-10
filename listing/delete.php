<?php

// Connect to the database
require_once '../includes/MySQL.php';
require_once '../includes/db.php';
$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);

// Delete the listing from the db
$sql = "delete from listings where listingID=" . $_GET['listing'];
$result = $db->query($sql);

$sql = "delete from listingcuisines where listingID='$new_id'";
$result = $db->query($sql);

header('Location: delete_success.php');

?>