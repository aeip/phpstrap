<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';
?>

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<br><div class="alert alert-success"><strong>Thanks!</strong> We've emailed you.</div>
<?php
} else {
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
				exit();
			} else {
				echo '<br><div class="alert alert-danger"><strong>Oops!</strong> We couldn\'t find that email address!</div>';
			}
		}
	?>
		
<div class="container">

      <form class="form-signin" action="" method="post">
        <h3 class="form-signin-heading">Please enter your email address:</h3>
        <input type="text" name="email" class="form-control" placeholder="Email address" autofocus>
<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Recover</button>
      </form>

    </div>
		
	<?php
	} else {
		header('Location: index.php');
		exit();
	}
}
?>

<?php include 'includes/overall/footer.php'; ?>