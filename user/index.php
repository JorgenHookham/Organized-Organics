<?php
	
	session_start();
	
	if ( ! isset($_SESSION['logged_in_user']) )
	{
		header('Location: /user/login.php'); exit;
	}
	
	require_once '../header.php';
?>

  <div id="container">
    <header>
		<h2>User Page</h2>
    </header>
    <div id="main" role="main">
<?php

@display_messages($message, $messages_array);
	
?>
    </div>
    
    <?php require_once '../sidebar.php' ?>
    
<?php require_once '../footer.php'; ?>