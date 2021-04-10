<?php
		
	if (isset($_SESSION["status"])){
		$status = $_SESSION["status"];
		if ($status == 1){
			//Admin header
			echo "<h1>MyBlogPost</h1>";
			echo "<h2>Admin</h2>";
			echo "<table><tbody><tr>";
			echo "<td><a href=\"home.php\">Home</a></td>";
			echo "<td><a href=\"#\">My Posts</a></td>";
			echo "<td><a href=\"#\">New Post</a></td>";
			echo "<td><a href=\"adminsite.php\">Administrator</a></td>";
			echo "<td><a href=\"userinfo.php\">My Account</a></td>";
			echo "<td><a href=\"register.html\">Create Account</a></td>";
			echo "</tr></tbody></table>";
		}else if($status == 0){
			//User header
			echo "<h1>MyBlogPost</h1>";
			echo "<h2>User</h2>";
			echo "<table><tbody><tr>";
			echo "<td><a href=\"home.php\">Home</a></td>";
			echo "<td><a href=\"#\">My Posts</a></td>";
			echo "<td><a href=\"#\">New Post</a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"userinfo.php\">My Account</a></td>";
			echo "<td><a href=\"register.html\">Create Account</a></td>";
			echo "</tr></tbody></table>";
		}else if($status == -1){
			//banned user, unregistered user header
			echo "<h1>MyBlogPost</h1>";
			echo "<h2>banned</h2>";
			echo "<table><tbody><tr>";
			echo "<td><a href=\"home.php\">Home</a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"register.html\">Create Account</a></td>";
			echo "</tr></tbody></table>";
		}
	}else{
		echo "<h1>MyBlogPost</h1>";
		echo "<h2>Not signed in</h2>";
		echo "<table><tbody><tr>";
		echo "<td><a href=\"home.php\">Home</a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"register.html\">Create Account</a></td>";
		echo "</tr></tbody></table>";
	}
?>