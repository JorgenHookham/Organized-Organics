<?php require_once '../header.php';
require_once '../includes/db.php'; 
require_once '../includes/MySQL.php'; 
require_once '../includes/EmailAddressValidator.php';

$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);


$validator = new EmailAddressValidator();
$all_valid = $email_valid = $pw_valid = true;
	
function pw_error($validfield) {
		if (!$validfield) {
			echo '<span class="error">Please enter matching passwords.</span><br>';
		}
	}
	
	
function username_error($validfield) {
		if (!$validfield) {
			echo '<br><span class="error">Please enter a username.</span><br>';
		}
	}
	
	
function email_error($validfield) {
		if (!$validfield) {
			echo '<span class="error">Please enter a valid email address.</span><br>';
		}
	}
	
if (isset($_POST['submit'])) {
	$valid = true;
	
	$email = mysql_real_escape_string(trim($_POST['email']));
	$password = mysql_real_escape_string(trim($_POST['password']));
	$password2 = mysql_real_escape_string(trim($_POST['newpassword']));
	
	if($_POST['password'] == '' || $_POST['password'] != $_POST['newpassword']) {
			$all_valid = $pw_valid = false;
		} 
		
		
		if (!$validator->check_email_address($_POST['email'])) {
	$all_valid = $email_valid = false;
	

}}


 ?>
</header>
    <div id="main" role="main">
	
	<h1>Forgot your password?</h1>
	<p>
	Please enter your email and a new password. 
	</p>
	<form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="forgot-password">
	<label for="email">What is your Email?</label>
	<br>
	<?php email_error($email_valid); ?>
	<input type="email" name="email" id="email" value="<?php if (isset($_POST['submit'])) {echo $_POST['email'];}?>">
	
	<br>
	<label for="password">Please enter a new password.</label>
	<br>
	<?php pw_error($pw_valid); ?>
	<input type="password" name="password" id="password" value="<?php if (isset($_POST['submit'])) echo $_POST['password'];?>">
	<br>
	<label for="newpassword">Please confirm your new password.</label>
	<br>
	<?php pw_error($pw_valid); ?>
	
	<input type="password" name="newpassword" value="<?php if (isset($_POST['submit'])) echo $_POST['newpassword'];?>">
	<br>
	<input type="submit" value="Reset Your Password"  id="submit" name="submit">
	</form>
	
   
    <?php
  

    
 if (isset($_POST['submit']) && $all_valid) {
	 $email = $_POST['email'];
	 $password = sha1($password);
     $sql = 'SELECT * FROM users WHERE userEmail = "' .  $email . '"';
	 $resultset = mysql_query($sql) or die(mysql_error());
	//fetch the result set (array) with the fetch array function.
		while ($data = mysql_fetch_array($resultset, MYSQL_ASSOC)) {
			$good_email = $data['userEmail'];
   	 		echo '<p>Thank you, ' . $data['userName'] . '. Your Password has been updated.</p>'; 
    	}
    	
    	if (!isset($good_email)) {
    	echo '<p class="error">Sorry, but we can\'t find that email. Please enter a valid email address.</p>';
    	}
    	
    $pwsql = "UPDATE users SET userPassword = '" . $password . "' where userEmail = '" . $email . "'";
	$updateresult = $db->query($pwsql);
    	
    	
}

    
    
    
    ?>
     </div>
      <?php require_once '../sidebar.php' ?>
<?php require_once '../footer.php'; ?>