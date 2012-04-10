<?php
	
	if ( ! isset($_GET['view']) )
	{
		header('Location: ../');
	}
	
	require_once '../header.php';
	 
	require_once '../includes/db.php';
	require_once '../includes/MySQL.php';
	
	$listing = $_GET['view'];
	
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	// Review data
	$sql = "SELECT * FROM reviews inner join users on reviews.userID = users.userID WHERE listingID = $listing order by reviewDate desc";
	$reviews = $db->query($sql);
	
	// Rating data
	$sql = "SELECT * FROM ratings WHERE listingID = $listing";
	$ratings = $db->query($sql);
	$rating = 0;
	$ratingsnum = 0;
	$ratingstotal = 0;
	
	while ( $rating = $ratings->fetch() )
	{
		$ratingstotal += intval($rating['rating']);
		$ratingsnum++;
	}
	
	// The average rating:
	if ( $ratingsnum > 0 ) $rating = intval($ratingstotal/$ratingsnum);
	
	// Stock data
	$sql = "SELECT stockTypeName, stockID FROM stock inner join stockType on stock.stockTypeID = stockType.stockTypeID WHERE listingID = $listing";
	$stocks = $db->query($sql);
	
	$i = 0;
	
	// Array to hold all stock data
	while ( $stock = $stocks->fetch() )
	{
		$stock_array[$i]['stockTypeName'] = $stock['stockTypeName'];
		$stock_array[$i]['stockID'] = $stock['stockID'];
		$i++;
	}
	
	// Cuisine data
	$sql = "SELECT listingID, cuisineName FROM listingcuisines INNER JOIN cuisineTypes ON listingcuisines.cuisineTypeID=cuisineTypes.cuisineTypeID WHERE listingID = $listing";
	$result = $db->query($sql);
	$i = 0;
	while ($cuisine = $result->fetch()) {
		$cuisine_array[$i]['cuisineName'] = $cuisine['cuisineName'];
		$i++;
	}
	
	
	
	// Supply to data
	$where_stocks = '';
	if ( isset($stock_array) )
	{
		foreach ( $stock_array as $stock )
		{
			if ( $where_stocks != '' ) $where_stocks .= ' or ';
			$where_stocks .= 'stock.stockID = ' . $stock['stockID'];
		}
		$sql = "SELECT stockTypeName, listingName, supply.listingID FROM stock inner join stockType on stock.stockTypeID = stockType.stockTypeID inner join supply on stock.stockID = supply.stockID inner join listings on supply.listingID = listings.listingID WHERE $where_stocks";
		$supplies_to = $db->query($sql);
		
		$i = 0;
		
		while ( $supply_to = $supplies_to->fetch() )
		{
			$supply_to_array[$i]['stockTypeName'] = $supply_to['stockTypeName'];
			$supply_to_array[$i]['listingName'] = $supply_to['listingName'];
			$supply_to_array[$i]['listingID'] = $supply_to['listingID'];
			$i++;
		}
	}
	
	// Supply from data
	$sql = "SELECT stockTypeName, listingName, stock.listingID FROM supply inner join stock on supply.stockID = stock.stockID inner join stockType on stock.stockTypeID = stockType.stockTypeID inner join listings on stock.listingID = listings.listingID WHERE supply.listingID = $listing";
	$supplies_from = $db->query($sql);
	
	$i = 0;
	
	// Array to hold the listing's suppliers
	while ( $supply_from = $supplies_from->fetch() )
	{
		$supply_from_array[$i]['stockTypeName'] = $supply_from['stockTypeName'];
		$supply_from_array[$i]['listingName'] = $supply_from['listingName'];
		$supply_from_array[$i]['listingID'] = $supply_from['listingID'];
		$i++;
	}
	
	// Listing data
	$sql = "SELECT * FROM listings WHERE listingID = '$listing'";
	$result = $db->query($sql);
	$listing = $result->fetch();
	
	
	
?>
		
    </header>
    
    <div id="main" id="listing-body" role="main">
		
		<nav id="utility-nav">
		<?php
		
		if ( isset($_SESSION['search_type']) )
			echo '<a id="breadcrumb-nav" href="' . htmlspecialchars($_SERVER['HTTP_REFERER']) . '">«Back to my search</a>';
		
		if ( isset($_SESSION['search_type']) )
			echo '<a id="edit-listing-link" href="edit.php?listing=' . $_GET['view'] . '">Edit this listing</a>';
		
		?>
		</nav>
		<?php echo '<div id="latitude" class="s-hidden">' . $listing['listingLatitude'] . '</div><div id="longitude" class="s-hidden">' . $listing['listingLongitude'] . '</div>';?>
    	<div id="listing-map">
    	
    		
    	</div>

  		<h2 id="listing-title" class="tk-proxima-nova"><?php echo $listing['listingName']; ?></h2>
  		
    	<address id="listing-streetaddress" class="tk-proxima-nova"><?php echo $listing['listingStreetAddress']; ?></address>
    	
    	<div id="listing-meta">
		
		<?php
	
		if ( isset($cuisine_array) )
		{
			echo '<div id="listing-cuisines">';
			foreach ( $cuisine_array as $cuisine )
			{
				echo $cuisine['cuisineName'] . ', ';
			}
			echo '</div>';
		}
		
		if ( isset($stock_array) )
		{
			echo '<div id="listing-categories">';
			foreach ( $stock_array as $stock )
			{
				echo '<img src="/img/' . $stock['stockTypeName'] . '.png" alt="' . $stock['stockTypeName'] . ' height="29" width="29" class="listing-category-icon"><p class="tooltip">This purveyor carries ' . $stock['stockTypeName'] . '.</p>';
			}
			echo '</div>';
		}
		
		?>
			
			<div id="listing-rating">
				<?php
					
					$s = 5;
					
					for ( $i = 0; $i < $rating; $i++ )
					{
						echo '<img src="/img/star-active.png" alt="' . $i . '/5" height="24" width="24" class="s-active">';
						$s--;
					}
					
					while ( $s > 0 )
					{
						$i++;
						echo '<img src="/img/star.png" alt="' . $i . '/5" height="24" width="24">';
						$s--;
					}
					
				?>
			</div>
		</div>
    	
    	<div id="listing-description">
    		<h3 class="tk-proxima-nova">Description</h3>
    		<p id="listing-description"><?php echo $listing['listingDescription']; ?></p>
    	</div>
		
		<?php
		
		if ( isset($listing['listingWebsite']) && $listing['listingWebsite'] != '' )
		{		
			if ( ! preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $listing['listingWebsite']) )
			{
				$listing['listingWebsite'] = 'http://' . $listing['listingWebsite'];
			}
			
			echo '<div id="listing-website">';
			echo '<a href="' . $listing['listingWebsite'] . '">Listing Website</a>';
			echo '</div>';
		}
		?>
		
    	
    	
    	
    	<?php if ( isset($supply_to_array) ) : ?>
    	<div id="listing-supplies-to">
    		<h3 class="tk-proxima-nova">Supplies</h3>
    		<?php
    		foreach ( $supply_to_array as $supply )
    		{
    		echo '<p>' . $supply['stockTypeName'] . ' to <a href="?view=' . $supply['listingID'] . '">' . $supply['listingName'] . '</a></p>';
    		}
    		?>
    	</div>
    	<?php endif; ?>
    	
    	<?php if ( isset($supply_from_array) ) : ?>
    	<div id="listing-supplies-from">
    		<h3 class="tk-proxima-nova">Suppliers</h3>
    		<?php
    		foreach ( $supply_from_array as $supply )
    		{
    		echo '<p>' . $supply['stockTypeName'] . ' from <a href="?view=' . $supply['listingID'] . '">' . $supply['listingName'] . '</a></p>';
    		}
    		?>
    	</div>
    	<?php endif; ?>
    
	    <section id="listing-reviews">
	    	<header id="listing-reviews-header">
	    		<h3 class="tk-proxima-nova">Reviews</h3>
	    		<a class="listing-reviews-write" href="review.php?listing=<?php echo $listing['listingID']; ?>">Write A Review</a>
	    	</header>
	    	<ul>
	    		<?php while ( $review = $reviews->fetch() ) : ?>
	    		<li>
	    			<article class="listing-review">
	    				<h4 class="listing-review-title tk-proxima-nova"><?php echo $review['reviewTitle']; ?></h4>
	    				<time class="listing-review-date"><?php echo $review['reviewDate']; ?></time>
	    				<span class="listing-author">By: <?php echo $review['userName']; ?></span>
	    				<div class="listing-review-body"><?php echo $review['reviewBody']; ?></div>
	    			</article>
	    		</li>
	    		<?php endwhile; ?>
	    	</ul>
	    </section>
    
    </div>
    
    <?php require_once '../sidebar.php' ?>
    
    <script type="text/javascript"
	    src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDUeTVdxBjy02-6Nr__PNBq8MDHhh36PFE&sensor=false">
	</script>
    
<?php require_once '../footer.php'; ?>