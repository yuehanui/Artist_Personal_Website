<?php require_once('../private/initialize.php'); ?>

<!-- Define Title -->
<?php $page_title = 'Login'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php'); ?>

<?php //check if user has already loged in
	if (check_cookie()){
		redirect_to('index.php');
	}
?>

<div id="loginForm" class="container pt-5  ">
	<div class="row" >
		<div class="col-sm-4" ></div>
	    <div class="col-sm-4 border border-light rounded-lg">
	    	<h3 class='text-center pt-5 text-secondary'>Login</h3>

	    	<form action="logging-in.php" method="POST" class="px-5 py-3">
	    		<div class="form-group">
			      	<input type="text" class="form-control" id="username" placeholder="Username" name="username" maxlength="20" required>
			    </div>
			    <br>
			    <div class="form-group">
			   		<input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd" maxlength="20" required>
		    	</div>
		    	<br>
		    	<div class="text-center pb-3">
		    		<button type="submit" class="btn btn-primary">Login</button>
				</div>
	    	</form>
	   	</div>
   		<div class="col-sm-4"></div>
   	</div>
</div>

<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>