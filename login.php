<?php

include_once('config.php');

/*
ADAPTED FROM: http://edrackham.com/php/php-login-script-tutorial/
*/


//reset errors and success messages
$errors = array();
$success = array();

//login attempt
if (isset($_POST['loginSubmit']) && $_POST['loginSubmit'] == 'true') {
	//grab user inputs
	$loginUsername = trim($_POST['username']);
	$loginPassword = trim($_POST['password']);
	
	//check username formatting
	if (!preg_match('/^[A-Za-z0-9_]+$/', $loginUsername)) {
		$errors['loginUsername'] = 'Your  username is invalid.';
		}
	
	//check password length
	if (strlen($loginPassword) < 6 || strlen($loginPassword) > 20) {
		$errors['loginPassword'] = 'Password must be between 6-12 characters';
		}
		
	if (!$errors) {
		//try find the username/password combo
		$query = "SELECT * FROM users WHERE username='" . $loginUsername . "' AND password= MD5('" . $loginPassword . "') LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		
		//correct username/password exists
		if (mysql_num_rows($result) == 1) {
			$user = mysql_fetch_assoc($result);
			//update session_id
			$query = "UPDATE users SET session_id='" . session_id() . "' WHERE id='" . $user['id'] . "' LIMIT 1";
			mysql_query($query) or die(mysql_error());
			//redirect to index
			header('Location: index.php');
			exit;
		} else {
			$errors['login'] = "No user was found with the details provided.";
			}
		}
	}
	
//register attempt
if(isset($_POST['registerSubmit']) && $_POST['registerSubmit']=='true') {
	//grab user inputs
	$registerUsername = trim($_POST['username']);
	$registerPassword = trim($_POST['password']);
	$registerEmail = trim($_POST['email']);
	
	//check email
	if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $registerEmail)) {
		$errors['registerEmail'] = 'Your email address is invalid.';
		}
	
	if (strlen($registerPassword) < 6 || strlen($registerPassword > 20)) {
		$errors['registerPassword'] = 'Your password must be between 6-12 characters';
		}
	
	//check for existing email
	$query = "SELECT * FROM users WHERE email='" . mysql_real_escape_string($registerEmail) . "' LIMIT 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) == 1) {
		$errors['registerEmail'] == 'Email address already in use.';
	}
	
	//check for existing username
	$query = "SELECT * FROM users WHERE username='" . mysql_real_escape_string($registerUsername) . "' LIMIT 1";
	$result = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($result) == 1) {
		$errors['registerUsername'] == 'Username address already in use.';
	}
	
	if (!$errors) {
		$query = "INSERT INTO users (username, password, email) values ('" . mysql_real_escape_string($registerUsername) 
					. "',MD5('" . mysql_real_escape_string($registerPassword) . "'),'" . mysql_real_escape_string($registerEmail) . "')";
		
		if (mysql_query($query))  {
			$success['register'] = 'Thank you for registering. You can now log in.';
			} else {
				$errors['register'] = 'There was a problem, check your details and try again ' . mysql_real_escape_string($registerUsername) . ' ' . mysql_real_escape_string($registerPassword) . ' ' . mysql_real_escape_string($registerEmail); 
			}
		}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit It - Log in/Register</title>
<link rel="stylesheet" type="text/css" href="styleSheet.css"/>
</head>
        	<div class="logCol">
			<div class="story">
			<h1>Log in</h1>
			<form name="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<?php if(isset($errors['login'])) print '<div class="invalid">' . $errors['login']. '</div>'; ?>
			Username: 	<input type="text" name="username" />
			<?php if(isset($errors['loginUsername'])) print '<div class="invalid">' . $errors['loginUsername'] . '</div>'; ?></br>
			Password:<input type="password" name="password" />
			<?php if(isset($errors['loginPassword'])) print '<div class="invalid">' . $errors['loginPassword'] . '</div>'; ?><br/></br>
			<input type="hidden" name="loginSubmit" id="loginSubmit" value="true" />
			<input type="submit" value="Log in"  />
			</form>
			<br/>
				</div>
			</div>
				
				
			<div class="registerCol">
				<div class="story">
					<h1>Register</h1>
					<form name="registerForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<?php if(isset($success['register'])) print '<div class="valid">' . $success['register'] . '</div>'; ?>
					<?php if(isset($errors['register'])) print '<div class="invalid">' . $errors['register'] . '</div>'; ?>
					Username: <input type="text" name="username" value=""/>
					<?php if(isset($errors['registerUsername'])) print '<div class="invalid">' . $errors['registerUsername'] . '</div>'; ?></br>
					Email: 	<input type="text" name="email" value=""/>		
					<?php if(isset($errors['registerEmail'])) print '<div class="invalid">' . $errors['registerEmail'] . '</div>'; ?></br>
					Password:<input type="password" name="password" value="" />		
					<?php if(isset($errors['registerPassword'])) print '<div class="invalid">' . $errors['registerPassword'] . '</div>'; ?><br/></br>
					<input type="hidden" name="registerSubmit" id="registerSubmit" value="true" />
					<input type="submit" value="Register" />
					</form><br/>
				</div>
			</div>
			
				<div class="footerLine"></div>
				
      
        	
        </div><!-- END Content-->
        <div class="footerLine"></div>
        
        
		

	</div><!-- END wrapper -->

</body>
</html>