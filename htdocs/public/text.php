<?php require_once('../private/initialize.php') ?>
<div id="app">
  {{ message }}
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>


	var vm = new Vue({
		el: '#app',
		data: {
			message: 'Hello Vue!'
		}
	});
</script>