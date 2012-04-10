<?php
	
	session_start();
	
	// Check to make sure the user is logged in
	if ( ! isset($_SESSION['logged_in_user']) )
	{
		header('Location: /user/login.php?message=login_required'); exit;
	}
	
	
	
	require_once '../header.php';
	
	
	
	// Connect to the DB
	require_once '../includes/MySQL.php';
	require_once '../includes/db.php';
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
?>





  <div id="container">
    <div id="main" class="review" role="main">
    
    <?php
    
    if ( !isset($_GET['listing']) && !isset($_GET['message']) )
    {
		echo 'Please choose a listing to review.';
		exit;
	}
	
	$listingID = $_GET['listing'];
	$sql = "SELECT  listingName FROM listings WHERE listingID='$listingID'";
	$result = $db->query($sql);
	while( $row = $result->fetch() )
	{
		$listingName = $row['listingName'];
	}	

	?>

		<h2 id="page-title">Review <?php echo $listingName ?></h2>
    
    
		<form class="listing-add-form" method="post" action="process_review.php">
			<label class="listing-add-label" for="reviewTitle">Title: <input class="listing-add-input" type="text" name="reviewTitle" id="reviewTitle"></label>
			<label class="listing-add-label listing-add-label-textarea" for="reviewBody">Review: <textarea class="listing-add-input listing-add-input-textarea" name="reviewBody" id="reviewBody"></textarea></label>
			<label class="listing-add-label" for="reviewRating">Rating: </label>
			
			<label>1 star</label><input class="listing-add-input" type="radio" name="reviewRating" value="1"><br>
			<label>2 stars</label><input class="listing-add-input" type="radio" name="reviewRating" value="2"><br>
			<label>3 stars</label><input class="listing-add-input" type="radio" name="reviewRating" value="3"><br>
			<label>4 stars</label><input class="listing-add-input" type="radio" name="reviewRating" value="4"><br>
			<label>5 stars</label><input class="listing-add-input" type="radio" name="reviewRating" value="5"><br>
			
			<input type="hidden" name="listingid" id="listingid" value="<?php echo $listingID; ?>">
			<input class="listing-add-input" type="submit" value="Add Review">
		</form>
    </div>
    
    <?php require_once '../sidebar.php' ?>
    
<?php require_once '../footer.php'; ?>