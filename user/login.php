<?php 
	
	session_start();
	
	if ( isset($_SESSION['logged_in_user']) )
	{
		$qs = ( isset($_SERVER['QUERY_STRING']) ) ? '?' . $_SERVER['QUERY_STRING'] : '';
		header('Location: /user/index.php' . $qs); exit;
	}
	
	require_once '../header.php';
	
?>

  <div id="container">
    <header>

    </header>
    <div id="main" role="main">
		<div id="login">
			<form action="/user/process_login.php" method="post">
			<input class="user-login-input" type="text" size="16" name="username" id="username" placeholder="Username"><br>
			<input class="user-login-input" type="password" size="16" name="password" id="password" placeholder="Password"><br>
			<input type="hidden" name="from_page" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
			<input class="user-login-submit" type="submit" value="Log in">
			</form>
			<p class="register">Or, <a href="/user/register.php">register an account.</a></p>
		</div>
		<?php @display_messages($message, $system_messages); ?>
    </div>
    
<?php require_once '../footer.php'; ?>