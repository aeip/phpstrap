<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if (empty($_POST) === false) {
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = '<br><div class="alert alert-danger"><strong>All</strong> fields are required.</div>';
			break 1;
		}
	}
	
	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
			$errors[] = '<br><div class="alert alert-danger"><strong>Sorry,</strong> the username \'' . $_POST['username'] . '\' is already taken.</div>';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = '<br><div class="alert alert-danger"><strong>Your</strong> username must not contain any spaces.</div>';
		}
		if (strlen($_POST['password']) < 6) {
			$errors[] = '<br><div class="alert alert-danger"><strong>Your</strong> password must be at least 6 characters.</div>';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = '<br><div class="alert alert-danger"><strong>Your</strong> passwords do not match.</div>';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = '<br><div class="alert alert-danger"><strong>A</strong> valid email address is required.</div>';
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = '<br><div class="alert alert-danger"><strong>All</strong> the email \'' . $_POST['email'] . '\' is already in use.</div>';
		}
	}
}

?>
<br>

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo 'You\'ve been registered successfully! Please check your email to activate your account.';
} else {
	if (empty($_POST) === false && empty($errors) === true) {
		$register_data = array(
			'username' 		=> $_POST['username'],
			'password' 		=> $_POST['password'],
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email' 		=> $_POST['email'],
			'email_code'	=> md5($_POST['username'] + microtime())
		);
		
		register_user($register_data);
		header('Location: register.php?success');
		exit();
		
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
?>


    <div class="container">
    <form class="form-signin" accept-charset="UTF-8" action="" method="post">
    <legend class="form-signin-heading">Register</legend>
    <input class="form-control" name="first_name" placeholder="First Name" type="text">
    <br>
    <input class="form-control" name="last_name" placeholder="Last Name" type="text">
    <br>
    <input class="form-control" name="email" placeholder="Email" type="text">
    <br>
    <input class="form-control" name="username" placeholder="Username" type="text">
    <br>
    <input class="form-control" name="password" placeholder="Password" type="password">
    <input class="form-control" name="password_again" placeholder="Password Again" type="password">
    <br>
    <label><input type="checkbox" name="terms" checked="checked" onclick="return false;"> I agree with the <a href="#">Terms and Conditions</a>.</label>
    <button id="firstbtn" class="btn btn-primary" type="submit">Sign up</button>
    </form>
    </div>



<?php 
}
include 'includes/overall/footer.php'; ?>