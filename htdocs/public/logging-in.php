<?php require_once('../private/initialize.php'); ?>

<?php //Define Title 
	$page_title = 'Loggining in'; ?>


<?php //Common header for all pages 
	include(SHARED_PATH . '/header.php'); ?>

<div class="text-center pt-5">
<?php //request must be POST, preventing direct access via url
	if(!request_is_post()) {
		redirect_to("index.php");
	}
	$username = $_POST['username'];
	$pswd = $_POST['pswd'];

	$db = db_connect();
	$pswd_query = "SELECT PASSWORD_HASH FROM artist WHERE USERNAME='".db_escape($db,$username). "'";

	$pswd_result = mysqli_query($db, $pswd_query);
	db_disconnect($db);
	if (mysqli_num_rows($pswd_result)>0){
		$pswdhash = mysqli_fetch_row($pswd_result)[0];
		if (password_verify($pswd, $pswdhash)){
			$token = randomString(60);
			set_cookie($username, $token);
			set_session($username,$token);
			echo ("Loging in...");
			redirect_in_time("index.php", 1);

		} else {
			echo("Username not found or password doesn't match");
			redirect_in_time("login.php", 2);
		}

	} else {
		echo("Username not found or password doesn't match");
		redirect_in_time("login.php", 2);
	}
	exit();

?>

</div>

<?php //Common footer for all pages 
	include(SHARED_PATH . '/footer.php') ?>