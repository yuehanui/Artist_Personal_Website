<!-- This file contains the common header for all pages-->
	<footer class="footer  text-center">

		<span>All content copyright Pillow 2020 | </span> 
		<span><?php 

			if (check_cookie()){
				echo ('<a class="text-dark" href="logout.php">Logout</a>');
			} else {
				echo ('<a class="text-dark" href="login.php">Login</a>');
			}?>	
			</span>
		</footer>
 	</body>
 </html>
