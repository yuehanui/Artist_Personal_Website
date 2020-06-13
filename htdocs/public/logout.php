<?php require_once('../private/initialize.php'); ?>

<?php //Define Title 
	$page_title = 'Logining in'; ?>


<?php //Common header for all pages 
	include(SHARED_PATH . '/header.php'); ?>

<div class="text-center">
<?php 
	unset_session_cookie();
	echo ("Logging out..");
	redirect_in_time('index.php',1);
?>
</div>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>