<?php
	
	$system_messages = array
	(
		// Logging in:
		'incorrect_password' => 'Sorry, that password was incorrect! If you have forgotten your password, you can <a href="/user/forgot.php">reset it here.</a>',
		'incorrect_username' => 'Hmm, that user name doesn\'t exist in our system. If you can\'t remember your user name you can <a href="/user/forgot.php">have it sent to your email address.</a> If you don\'t have a user name yet then you need to <a href="/user/register.php">register!</a>',
		'empty_username' => 'You need to input your user name!',
		'empty_password' => 'Woops, make sure you enter your password!',
		'login_success' => 'Hey, welcome back ' . @$_SESSION['logged_in_user'] .'!',
		
		// Logging out:
		'logout_success' => 'You\'re logged out&mdash;see ya\' next time!',
		
		// Registering/updating profile:
		'invalid_email' => 'Please enter a valid email.',
		'invalid_username' => 'Please enter a different username.',
		'invalid_password' => 'Please enter a different password.',
		'password_mismatch' => 'Those passwords do not match. They need to match!',
		'username_taken' => 'Aw man, someone already has that username, don\'t you hate that!',
		'registration_success' => 'Hey, welcome aboard! You just need to login here now.',
		'edit_success' => 'Profile updated.',
		
		// Adding/editing a listing:
		'login_required' => 'You must login to do that.',
		'empty_listingname' => 'Every listing needs a name!',
		'empty_listingtype' => 'Every listing needs a type!',
		'empty_listingcity' => 'Every listing needs a city!',
		'listing_add_success' => 'Your listing as been added!',
		'listing_edit_success' => 'Listing updated.'
	);
	
?>