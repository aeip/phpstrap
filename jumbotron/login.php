<?php
include 'core/init.php';
logged_in_redirect();
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = '<br><div class="alert alert-danger"><strong>You</strong> need to enter a username and password</div>';
	} else if (user_exists($username) === false) {
		$errors[] = '<br><div class="alert alert-danger"><strong>We</strong> can\'t find that username. Have you registered?</div>';
	} else if (user_active($username) === false) {
		$errors[] = '<br><div class="alert alert-danger"><strong>You</strong> haven\'t activated your account!</div>';
	} else {
		
		if (strlen($password) > 32) {
			$errors[] = '<br><div class="alert alert-danger"><strong>Password</strong> too long</div>';
		}
		
		$login = login($username, $password);
		if ($login === false) {
			$errors[] = '<br><div class="alert alert-danger"><strong>That</strong> username/password combination is incorrect</div>';
		} else {
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}
	}
} else {
	$errors[] = 'No data received';
}
include 'includes/overall/header.php';
if (empty($errors) === false) {
?>
	<h2>We tried to log you in, but...</h2>
<?php
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>