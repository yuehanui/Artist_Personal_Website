<?php
	//start session
	session_start();
	// Define variables for common directory
	define("PRIVATE_PATH",dirname(__FILE__));
	define("PROJECT_PATH",dirname(PRIVATE_PATH));
	define("PUBLIC_PATH",PROJECT_PATH. '/public');
	define("SHARED_PATH", PRIVATE_PATH. '/shared');
	define("IMAGE_PATH", PROJECT_PATH. '/img');

	require_once('function.php');
?>


<!-- Bootstrap CSS-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Vue.js -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


<style>
@font-face{
  font-family: 'GothamLight';
  src: url("../private/shared/fonts/Gotham-Light.otf") format("opentype");
}
@font-face{
  font-family: Buffalo;
  src: url("../private/shared/fonts/BuffaloScript-Regular.otf") format("truetype")
}
@font-face{
  font-family: Cramaten;
  src: url("../private/shared/fonts/cramaten.ttf") format("truetype")
}
html {
  position: relative;
  min-height: 100%;
}
.footer {
  position: absolute;
  bottom: -20;
  width: 100%;
  /* Set the fixed height of the footer here */

}
#showImage {

  height: 70%;
  width: auto;
  display: block;

  margin-left: auto;
  margin-right: auto;

}


#logo{font-family: Buffalo;}
#navbar{ font-family: GothamLight;}

/* overlay effect */
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: 0.4s;
  background-color:#222222;
}

.overlay:hover{
  opacity: 0.7;
}

#addButton {
  background-color: #CBCBCB;
  transition: none;
  opacity: 0.1;
}
#addButton:hover {
  background-color: #000000;
  opacity: 0.1;
}

</style>