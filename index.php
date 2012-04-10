<?php

require_once 'header.php';  
require_once 'includes/db.php';
require_once 'includes/MySQL.php';

if ( ! isset($_GET['search_type']) ){ ?><div id="tag-line" class="tk-proxima-nova">A place to find purveyors of <strong>organic foods</strong> in and around Vancouver, BC. <a href="user/register.php"><strong>Register</strong></a> to start contributing.</div><?php } ?>

</header>
    <div id="main" <?php if ( ! isset($_GET['search_type']) ) echo 'class="s-home" '; ?>role="main">
		
		<form action="index.php" id="search_form">
		<h3 id="search" class="tk-proxima-nova">I am looking for a 
		<select name="search_type" class="search-select">
		<option value="restaurant" <?php if ( isset($_GET['search_type']) && $_GET['search_type'] == 'restaurant' ) echo 'selected'; ?>>Restaurant</option>
		<option value="market" <?php if ( isset($_GET['search_type']) && $_GET['search_type'] == 'market' ) echo 'selected'; ?>>Market</option>
		<option value="farm" <?php if ( isset($_GET['search_type']) && $_GET['search_type'] == 'farm' ) echo 'selected'; ?>>Farm</option>
		</select>
		near
		<select name="search_city" class="search-select">
		<?php
		$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
		$sql = "SELECT * FROM cities ORDER BY cityName";
		$result = $db->query($sql);
				
		while($row = $result->fetch()) {
		
			if ($row['cityName'] == 'Vancouver' && ! isset($_GET['search_city']) )
			{
				echo '<option value="' . $row['cityID'] . '" selected>' . $row['cityName'] . '</option>';
			}
			
			else
			{
				$selected = ( $_GET['search_city'] == $row['cityID'] ) ? ' selected' : '';
				echo '<option value="' . $row['cityID'] . '"' . $selected . '>' . $row['cityName'] . '</option>';
			}
		}
		echo '</select>';
		?>
		<input type="submit" name="submit_go" id="submit_go" value="Go" class="search-submit">
		</h3>
		</form>
		
	<?php 
		
		if (isset($_GET['search_type'])) {
			$_SESSION['search_type'] = $_GET['search_type'];
			$_SESSION['search_city'] = $_GET['search_city'];
			$search_type = $_GET['search_type'];
			$search_city = $_GET['search_city'];
			
			// Listing data
			$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
			$sql = "SELECT listingID, listingName, listingStreetAddress, cityID, listingDescription FROM listings WHERE listingType = '$search_type' AND cityID = '$search_city'";
			$result = $db->query($sql);
			
			if ($result->size() >= 1) {
				while($row = $result->fetch()) {
					
					// Calculate listing's average rating
					
					echo '<div class="listing-result">';
					echo '<h2 class="listing-result-title tk-proxima-nova"><a class="listing-result-title-link" href="listing/?view=' . $row['listingID'] . '">' . $row['listingName'] . '</a></h2>';
					//echo '<div class="listing-result-stock-icons">stock icons</div>';
					echo '<address class="listing-result-address">' . $row['listingStreetAddress'] . '</address>';
					//echo "<div class=\"listing-result-rating\">$rating/5 Stars</div>";
					echo '<div class="listing-result-description">' . $row['listingDescription'] . '</div>';
					echo '</div>';
				}
			} else {
				echo "Sorry, no results were found.  Please try another search.";
			}
		
		}
	
	?>
		
		
		
    </div>
    
  <?php require_once 'sidebar.php' ?>
    
<?php require_once 'footer.php'; ?>