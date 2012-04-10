<?php

require_once '../header.php';

( isset($_SESSION['logged_in_user']) || header('Location: login.php?message=+login_required') );

require_once '../includes/MySQL.php';
require_once '../includes/db.php';
$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);

$sql = "select userName, userEmail from users where userID = '" . $_SESSION['logged_in_user_id'] . "'";
$result = $db->query($sql);

while ( $row = $result->fetch() )
{
	$userName = $row['userName'];
	$userEmail = $row['userEmail'];
}

?>
    </header>
    <div id="main" role="main">
		<h2>Edit Your Profile</h2>
		<form method="post" action="process_edit.php">
			<label for="userEmail">Email<br><input type="email" name="userEmail" id="userEmail" value="<?php echo $userEmail; ?>"></label><br><br>
			<label for="userName">Username<br><input type="text" name="userName" id="userName" value="<?php echo $userName; ?>"></label><br><br>
			<label for="userPassword">Password<br><input type="password" name="userPassword" id="userPassword"></label><br><br>
			<label for="passwordRepeat">Repeat Password<br><input type="password" name="passwordRepeat" id="passwordRepeat"></label><br><br>
			<input type="submit" value="Update">
		</form>
		<?php @display_messages($message, $system_messages); ?>
    </div>
<?php require_once '../sidebar.php'; ?>    
<?php require_once '../footer.php'; ?>