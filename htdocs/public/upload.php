<?php require_once('../private/initialize.php'); ?>

<?php //Define Title 
	$page_title = 'Upload'; ?>


<?php //Common header for all pages 
	include(SHARED_PATH . '/header.php'); ?>

<div class="text-center">
<?php //only avaiable for logged in user

	if (!check_cookie()){
		redirect_to('index.php');
	}

	// processing files
	if(request_is_post()) {
		
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if (($_FILES["file"]["type"] != "image/jpeg")
		&& ($_FILES["file"]["type"] != "image/jpg")
		&& ($_FILES["file"]["type"] != "image/png")
		|| ($check == false)){
			echo "file format error";
			//redirect_in_time('upload.php',1);
		}
		// Check file size
		if ($_FILES["file"]["size"] > 52428800 ) {
		  echo "Maximum file size 50MB";
		  redirect_in_time('upload.php',2);
		}

		//connect to the databse
		$db = db_connect();
	
		$target_dir = "../img/artwork/";
		$artwork_name = $_POST["artwork_name"];
		$artwork_des = $_POST["artwork_des"];
		$artwork_id = next_artwork_id($db);
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$target_file = $artwork_id . "." . $ext;
		$target_path = $target_dir . $target_file;

		//save the file
		move_uploaded_file($_FILES["file"]["tmp_name"],$target_path) or exit("error 1");
		save_thumbnail($target_path, $target_file, $ext);

		//insert file to the databse
		insert_artwork($db, $artwork_id, $artwork_name,$artwork_des, $target_file,1001);
		//close the connection
		db_disconnect($db);
		echo ("Successfully uploaded");
		redirect_in_time('index.php',1);
	}
?>
</div>

<div id="upload" class="container-fluid pt-5">
	<div class="row" >
		<div class="col-sm-4" ></div>
	    <div class="col-sm-4 border border-light rounded-lg">
	    	<h3 class='text-center pt-5 text-secondary'>Upload</h3>

	    	<form @submit="onSubmit" method="POST" class="px-5 py-3" enctype="multipart/form-data">

	    		<div class="form-group">
			   		<input type="text" class="form-control" id="artwork_name" placeholder="Work name" name="artwork_name" maxlength="50">
		    	</div>

		    	<div class="form-group">
			   		<textarea class="form-control" id="artwork_des" placeholder="Description" name="artwork_des" rows="3"></textarea>
		    	</div>

	    		  <div class="form-group">
				    <input type="file" ref="file"class="form-control-file" id="file" name="file">
				  </div>

		    	<div class="text-center pb-3">
		    		<button type="submit" class="btn btn-primary ">Post</button>
				</div>
	    	</form>
	   	</div>
   		<div class="col-sm-4"></div>
   	</div>
</div>
<script>
var vmUpload = new Vue({
  el: '#upload',
  methods: {
    onSubmit(e) {
      const file = this.$refs.file.files[0];
      
      if (!file) {
        e.preventDefault();
        alert('No file chosen');
        return;
      }
      
      if (file.size > 52428800) {
        e.preventDefault();
        alert('File too big (> 50MB)');
        return;
      }
    },
  },
});
</script>

<?php //Common footer for all pages --> 
	include(SHARED_PATH . '/footer.php') ?>