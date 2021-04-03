<?php
		
	if (isset($_SESSION['authenticatedUser'])){
		$user = $_SESSION['authenticatedUser'];
		if (strcmp($user,"admin")){
			//Admin header
			echo "<h1>MyBlogPost</h1>";
			echo "<h2>Admin</h2>";
			echo "<table><tbody><tr>";
			echo "<td><a href=\"home.html\">Home</a></td>";
			echo "<td><a href=\"#\">My Posts</a></td>";
			echo "<td><a href=\"#\">New Post</a></td>";
			echo "<td><a href=\"#\">Administrator</a></td>";
			echo "<td><a href=\"#\">My Account</a></td>";
			echo "<td><a href=\"register.html\">Create Account</a></td>";
			echo "</tr></tbody></table>";
		}else if(strcmp($user,"user")){
			//User header
			echo "<h1>MyBlogPost</h1>";
			echo "<h2>User</h2>";
			echo "<table><tbody><tr>";
			echo "<td><a href=\"home.html\">Home</a></td>";
			echo "<td><a href=\"#\">My Posts</a></td>";
			echo "<td><a href=\"#\">New Post</a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\">My Account</a></td>";
			echo "<td><a href=\"register.html\">Create Account</a></td>";
			echo "</tr></tbody></table>";
		}else if(strcmp($user,"banned")){
			//banned user, unregistered user header
			echo "<h1>MyBlogPost</h1>";
			echo "<h2>banned</h2>";
			echo "<table><tbody><tr>";
			echo "<td><a href=\"home.html\">Home</a></td>";
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
		echo "<td><a href=\"home.html\">Home</a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"register.html\">Create Account</a></td>";
		echo "</tr></tbody></table>";
	}
?>