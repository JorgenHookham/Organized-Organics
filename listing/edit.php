<?php
	
	session_start();
	
	// Check to make sure the user is logged in
	if ( ! isset($_SESSION['logged_in_user']) )
	{
		header('Location: /user/login.php?message=login_required'); exit;
	}
	
	// If there's no query string, send 'em home.
	if ( ! isset($_GET['listing']) )
	{
		header('Location: /');
	}
	
	require_once '../header.php';
	
	// Connect to the DB
	require_once '../includes/MySQL.php';
	require_once '../includes/db.php';
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	// Get the listing's info form the DB
	$sql = "select * from listings where listingID ='" . $_GET['listing'] . "'";
	$result = $db->query($sql);
	
	while ( $row = $result->fetch() )
	{
		$listingName = $row['listingName'];
		$listingType = $row['listingType'];
		$listingDescription = $row['listingDescription'];
		$listingStreetAddress = $row['listingStreetAddress'];
		$cityID = $row['cityID'];
		$listingPostalCode = $row['listingPostalCode'];
		$listingWebsite = $row['listingWebsite'];
		$listingLatitude = $row['listingLatitude'];
		$listingLongitude = $row['listingLongitude'];
	}
	
	$cuisine = array();
	$stock = array();
	
	// Get cuisine data if it's a restaurant
	if ( $listingType == 'restaurant' )
	{
		$sql = "select ct.cuisineTypeID from listingcuisines c inner join cuisineTypes ct on c.cuisineTypeID = ct.cuisineTypeID where listingID = '" . $_GET['listing'] . "'";
		$result = $db->query($sql);
		
		$i = 0;
		
		while ( $row = $result->fetch() )
		{
			$cuisine[$i] = $row['cuisineTypeID'];
			$i++;
		}
	}
	
	// Get stock data if it's a market or farm
	else if ( $listingType == 'market' || $listingType == 'farm' )
	{
		$sql = "select st.stockTypeID from stock s inner join stockType st on s.stockTypeID = st.stockTypeID where listingID ='" . $_GET['listing'] . "'";
		$result = $db->query($sql);
		
		$i = 0;
	
		while ( $row = $result->fetch() )
		{
			$stock[$i] = $row['stockTypeID'];
			$i++;
		}
	}
	
?>

    </header>
    <div id="main" role="main">
    	<nav id="utility-nav">
			<a id="listing-view-link" href="/listing?view=<?php echo $_GET['listing']; ?>">View this listing</a>
			<a id="listing-delete-link" href="delete.php?listing=<?php echo $_GET['listing']; ?>">Delete this listing</a>
		</nav>
		<h2 id="page-title">Edit <?php echo $listingName; ?></h1>
		<form class="listing-add-form" method="post" action="process_edit.php">
			<label class="listing-add-label" for="listingName">Name: <input class="listing-add-input" type="text" name="listingName" id="listingName" value="<?php echo $listingName; ?>"></label>
			<label class="listing-add-label" for="listingType">Type: 
				<select class="listing-add-input" name="listingType" id="listingType">
					<option value="NULL">Select a type...</option>
					<option value="restaurant"<?php if ( $listingType == 'restaurant' ) echo ' selected'; ?>>Restaurant</option>
					<option value="market"<?php if ( $listingType == 'market' ) echo ' selected'; ?>>Market</option>
					<option value="farm"<?php if ( $listingType == 'farm' ) echo ' selected'; ?>>Farm</option>
				</select>
			</label>
			<label class="listing-add-label listing-add-label-textarea" for="listingDescription">Description: <textarea class="listing-add-input listing-add-input-textarea" name="listingDescription" id="listingDescription"><?php echo $listingDescription; ?></textarea></label>
			<label class="listing-add-label" for="listingStreetAddress">Street Address: <input class="listing-add-input" type="text" name="listingStreetAddress" id="listingStreetAddress" value="<?php echo $listingStreetAddress; ?>"></label>
			<label class="listing-add-label" for="listingCity">City: 
				<select class="listing-add-input" name="listingCity" id="listingCity">
					<option value="NULL">Select a city...</option>
					
					<?php
					
					// Create an option tag for each city in the database
					$cityQ = "SELECT * FROM cities ORDER BY cityName";
					$result = $db->query($cityQ);
			
					while ($row = $result->fetch())
					{
						$selected = ( $row['cityID'] == $cityID ) ? ' selected' : '';
						echo '<option value="' . $row['cityID'] . '"' . $selected . '>' . $row['cityName'] . '</option>';
					}
					
					?>
					
				</select>
			</label>
			<label class="listing-add-label" for="listingPostalCode">Postal Code: <input class="listing-add-input" type="text" name="listingPostalCode" id="listingPostalCode" value="<?php echo $listingPostalCode ?>"></label>
			<label class="listing-add-label" for="listingWebsite">Website: <input class="listing-add-input" type="text" name="listingWebsite" id="listingWebsite" value="<?php echo $listingWebsite ?>"></label>
			<div id="listing-cuisine-inputs" class="s-hidden">
			<label class="listing-add-label">Cuisine:</label>
			<?php
				$cuisineQ = "SELECT * FROM cuisineTypes ORDER BY cuisineName";
				$result = $db->query($cuisineQ);
				
				$i = 1;
				
				while ( $row = $result->fetch() )
				{
					$checked = ( in_array($row['cuisineTypeID'], $cuisine) ) ? 'checked' : '';
					echo '<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" name="cuisines[' . $i . ']" id="listingCuisines" value="' . $row['cuisineTypeID'] . '"' . $checked . '></input>' . $row['cuisineName'] . '</label>';
					$i++;
				}
			?>
			</div>
			
			<div id="listing-stock-inputs" class="s-hidden">
				<label class="listing-add-label" for "listingStock">Stocks: </label>
				<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" id="listing-stock" name="stock[1]" value="1"<?php if ( in_array(1, $stock) ) echo(' checked'); ?>></input> Meat</label>
				<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" id="listing-stock" name="stock[2]" value="2"<?php if ( in_array(2, $stock) ) echo(' checked'); ?>></input> Vegetables</label>
				<label class="listing-checkbox-label"><input type="checkbox" class="listing-checkbox" id="listing-stock" name="stock[3]" value="3"<?php if ( in_array(3, $stock) ) echo(' checked'); ?>></input> Dairy</label>
			</div>
			
			<label class="listing-add-label" for="listingLatitude">Latitude: <input class="listing-add-input" type="text" name="listingLatitude" id="listingLatitude" value="<?php echo $listingLatitude ?>"></label>
			<label class="listing-add-label" for="listingLongitude">Longitude: <input class="listing-add-input" type="text" name="listingLongitude" id="listingLongitude" value="<?php echo $listingLongitude ?>"></label>
			<input type="hidden" name="listingID" id="listingID" value="<?php echo $_GET['listing']; ?>">
			<input class="listing-add-input" type="submit" value="Update">
		</form>
    </div>
    
    <?php require_once '../sidebar.php' ?>
    
<?php require_once '../footer.php'; ?>