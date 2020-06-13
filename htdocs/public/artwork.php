<?php require_once('../private/initialize.php'); ?>



<?php //Define Title 
	$page_title = $_GET["artwork_no"]; ?>

<?php //header for artwork
	include(SHARED_PATH . '/header.php'); ?>


<div id="artwork" class="container-fluid ">
	
	<div class="container pb-4">
		<img :src="path"  id="showImage"> 
	</div>

</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue-router"></script>
<script>
	var router = new VueRouter({
 	   mode: 'history',
    	routes: []
	});

	var vmArt = new Vue({
		router,
		el: '#artwork',
		data: {
			path: <?php echo ('"../img/artwork/'.$_GET['artwork_no'].'.png"') ?>
	
		},
		mounted:function() {
	        //this.gettPath(this.$route.query.artwork_no)
	      
	    },
		methods: {
			getPath: function(value) {
				axios.get('getPath.php?artwork_no='+value)
				.then(function (response) {
					vmArt.path = "../img/artwork/" + response.data;
				})
				.catch(function (error) {
					console.log(error);
				})
			}
		
			
			
		}
	});
</script>

<?php //Common footer for all pages 
	include(SHARED_PATH . '/footer.php') ?>



