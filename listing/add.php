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

    </header>
    <div id="main" role="main">
    	<h2 id="page-title">Add a New Listing</h1>
		<form class="listing-add-form" method="post" action="process_add.php">
			<label class="listing-add-label" for="listingName">Name: <input class="listing-add-input" type="text" name="listingName" id="listingName"></label>
			<label class="listing-add-label" for="listingType">Type: 
				<select class="listing-add-input" name="listingType" id="listingType">
					<option value="NULL">Select a type...</option>
					<option value="restaurant">Restaurant</option>
					<option value="market">Market</option>
					<option value="farm">Farm</option>
				</select>
			</label>
			<label class="listing-add-label listing-add-label-textarea" for="listingDescription">Description: <textarea class="listing-add-input listing-add-input-textarea" name="listingDescription" id="listingDescription"></textarea></label>
			<label class="listing-add-label" for="listingStreetAddress">Street Address: <input class="listing-add-input" type="text" name="listingStreetAddress" id="listingStreetAddress"></label>
			<label class="listing-add-label" for="listingCity">City: 
				<select class="listing-add-input" name="listingCity" id="listingCity">
					<option value="NULL">Select a city...</option>
					
					<?php
					
					// Create an option tag for each city in the database
					$cityQ = "SELECT * FROM cities ORDER BY cityName";
					$result = $db->query($cityQ);
			
					while ($row = $result->fetch())
					{
						echo '<option value="' . $row['cityID'] . '">' . $row['cityName'] . '</option>';
					}
					
					?>
					
				</select>
			</label>
			<label class="listing-add-label" for="listingPostalCode">Postal Code: <input class="listing-add-input" type="text" name="listingPostalCode" id="listingPostalCode"></label>
			<label class="listing-add-label" for="listingWebsite">Website: <input class="listing-add-input" type="text" name="listingWebsite" id="listingWebsite"></label>
			<div id="listing-cuisine-inputs" class="s-hidden">
			<label class="listing-add-label">Cuisine:</label>
			<?php
				$cuisineQ = "SELECT * FROM cuisineTypes ORDER BY cuisineName";
				$result = $db->query($cuisineQ);
				
				$i = 1;
				
				while ( $row = $result->fetch() )
				{
					echo '<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" name="cuisines[' . $i . ']" id="listingCuisines" value="' . $row['cuisineTypeID'] . '"></input>' . $row['cuisineName'] . '</label>';
					$i++;
				}
			?>
			</div>
			
			<div id="listing-stock-inputs" class="s-hidden">
				<label class="listing-add-label" for "listingStock">Stocks: </label>
				<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" id="listing-stock" name="stock[1]" value="1"></input> Meat</label>
				<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" id="listing-stock" name="stock[2]" value="2"></input> Vegetables</label>
				<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" id="listing-stock" name="stock[3]" value="3"></input> Dairy</label>
			</div>
			
			<label class="listing-add-label" for="listingLatitude">Latitude: <input class="listing-add-input" type="text" name="listingLatitude" id="listingLatitude"></label>
			<label class="listing-add-label" for="listingLongitude">Longitude: <input class="listing-add-input" type="text" name="listingLongitude" id="listingLongitude"></label>
			<input class="listing-add-input" type="submit" value="Add">
		</form>
    </div>
    
    <?php require_once '../sidebar.php' ?>
    
<?php require_once '../footer.php'; ?>