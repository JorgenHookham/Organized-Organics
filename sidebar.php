<?php require_once 'includes/db.php'; 
require_once 'includes/MySQL.php';?>
<aside id="sidebar">

	<?php
		
		if ( ! isset($_SESSION['logged_in_user']) )
		{
		
	?>
	<div id="login">
		<p class="login-instruction">Login or <a href="/user/register.php">Register</a></p>
		<form action="/user/process_login.php" method="post">
		<input type="text" size="16" name="username" id="username" placeholder="Username">
		<input type="password" size="16" name="password" id="password" placeholder="Password">
		<input type="hidden" name="from_page" value="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>">
		<input type="submit" value="Log in">
		</form>
		<p class="login-forgot"><a href="/user/forgot.php">Forgot your password?</a></p>
	</div>
	<?php
	
	} else
	{
	
	?>
	<p><?php
	
	if(!isset($_GET['message'])) {
	
	  
$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
$sql = 'SELECT * FROM users WHERE userName = "' .  $_SESSION['logged_in_user'] . '"';
	 $resultset = mysql_query($sql) or die(mysql_error());
	//fetch the result set (array) with the fetch array function.
		while ($data = mysql_fetch_array($resultset, MYSQL_ASSOC)) {
		echo '<p class="message">Hi, ' . $data['userName']  . ".</p>";
		}
}


?></p>
	<nav id="user-controls">
	
		<ul>
			<li><a href="/listing/add.php">Create A Listing</a></li>
			<li><a href="/user/edit.php">Edit My Profile</a></li>
			<li><a href="/user/logout.php?from_page=<?php echo $_SERVER['PHP_SELF'] . '!Q' . $_SERVER['QUERY_STRING']; ?>">Logout</a></li>
		</ul>
	</nav>
	
	<?php
	}
	
	@display_messages($message, $system_messages);
		
	?>

</aside>