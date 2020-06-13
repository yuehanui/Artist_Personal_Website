<?php require_once('../private/function.php'); ?>

<?php 
	$db = db_connect();
	$query = "SELECT artwork_path FROM artwork WHERE artwork_id=" . db_escape($db, $_GET['artwork_no']);
	$result = mysqli_query($db, $query);
	if (mysqli_num_rows($result)>0){
		$path = mysqli_fetch_row($result)[0];
		$response= $path;
		echo json_encode($path);
	} else {
		exit('Error 6');
	}
	exit;
?>