<?php require_once('../private/initialize.php'); ?>

<?php //Define Title 
	$page_title = 'Home'; ?>

<?php //Common header for all pages 
	include(SHARED_PATH . '/header.php'); ?>



<div id="pictures" class="container-fluid pb-5">
	<div class="row paddingbottom pb-4">

		<div v-show="loggedin" :class="genButton()">
			<a href="upload.php">
				<img class="w-100" src ="../img/add.jpg">
				<div class="overlay" id="addButton"></div>
			</a></div>

	    <div v-for="pic in genPic(picsPath)" :class="pic[0]" >
	    	<a :href="pic[2]">
	    		<img class="w-100" :src="pic[1]">
	    		<div class="overlay" ></div>
	    	</a>
	    </div>
    </div>
</div>

<script>

	var vmPic = new Vue({
		el: '#pictures',
		data: {
			
			picsPath: <?php echo (get_imgs_path()); ?>,
			windowWidth: window.innerWidth,
			loggedin:<?php echo check_cookie() ? 'true' : 'false'; ?>
		},
		mounted() {
		  window.addEventListener('resize', () => {
		    this.windowWidth = window.innerWidth;
		  })
		},
		methods: {
			genPic: function(pics){
				var arr=[];
				var grid = this.getGrid();
				
				for (var pic in pics) {
					var devClass = "col-sm-"+grid+" p-0";
					var src = "../img/artwork/thumbnail/" + pics[pic];
					var loc = "artwork.php?artwork_no="+pics[pic].split(".")[0];
				
					var value=[devClass,src,loc];

					arr.push(value);
				}
				return arr;
			},
			genButton: function(){
				var grid = this.getGrid();
				return "col-sm-"+grid+" p-0";
			},
			getGrid: function(){
				var grid;
				if (this.windowWidth>1200) {grid=2;}
				else if (this.windowWidth>800) {grid=3;}
				else {grid=4;}
				return grid;
			},
	

		}
	});
</script>
	

<?php //Common footer for all pages 
	include(SHARED_PATH . '/footer.php') ?>



