<?php require_once('../private/initialize.php') ?>

<div id="navbar">
	<nav class="navbar navbar-expand-sm navbar-light sticky-top ">
  		<ul class="navbar-nav nav-fill w-100">
	  		<li v-for="(item,index) in barItems" class="nav-item">
      			<a class="nav-link text-dark" :href="barLinks[index]">{{item}}</a>
	    	</li>
  		</ul> 
	</nav>
</div>
<script>
	var vmBar = new Vue({
		el: '#navbar',
		data: {
			barItems: ['WORK','CATEGORY','ABOUT','CONTACT'],
			barLinks: ['index.php','category.php','about.php','contact.php']
		}
	});
</script>
