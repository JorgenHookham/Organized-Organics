<?php require_once '../header.php'; ?>
    </header>
    <div id="main" role="main">
    	<h2>Register an Account</h2>
		<form method="post" action="process_registration.php">
			<label for="userEmail">Enter your email address: <br><input type="email" name="userEmail" id="userEmail"></label><br><br>
			<label for="userName">Choose a username:<br> <input type="text" name="userName" id="userName"></label><br><br>
			<label for="userPassword">Choose a password: <br><input type="password" name="userPassword" id="userPassword"></label><br><br>
			<label for="passwordRepeat">Repeat the password: <br><input type="password" name="passwordRepeat" id="passwordRepeat"></label><br><br>
			<input type="submit" value="Register">
		</form>
		<?php @display_messages($message, $system_messages); ?>
    </div>
    
<?php require_once '../footer.php'; ?>