<?php
		
	if (isset($_SESSION["status"])){
		$status = $_SESSION["status"];
		if ($status == 1){
			//Admin header
			echo "<h1>MyBlogPost</h1>";
			echo "<article id=\"right-icon\"><img class=\"thumbnail\" src='".$_SESSION["imageurl"]."'/></article>";
			echo "<table id=\"box\"><tbody><tr>";
			echo "<td><a href=\"home.php\">Home</a></td>";
			echo "<td><a href=\"#\">My Posts</a></td>";
			echo "<td><a href=\"#\">New Post</a></td>";
			echo "<td><a href=\"adminsite.php\">Administrator</a></td>";
			echo "<td><a href=\"userinfo.php\">My Account</a></td>";
			echo "<td><a href=\"logout.php\">Logout</a></td>";
			echo "</tr></tbody></table>";
		}else if($status == 0){
			//User header
			echo "<h1>MyBlogPost</h1>";
			echo "<article id=\"right-icon\"><img class=\"thumbnail\" src='".$_SESSION["imageurl"]."'/></article>";
			echo "<table id=\"box\"><tbody><tr>";
			echo "<td><a href=\"home.php\">Home</a></td>";
			echo "<td><a href=\"#\">My Posts</a></td>";
			echo "<td><a href=\"#\">New Post</a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"userinfo.php\">My Account</a></td>";
			echo "<td><a href=\"logout.php\">Logout</a></td>";
			echo "</tr></tbody></table>";
		}else if($status == -1){
			//banned user, unregistered user header
			echo "<h1>MyBlogPost</h1>";
			echo "<article id=\"right-icon\"><img class=\"thumbnail\" src='images/blank.png'/></article>";
			echo "<table id=\"box\"><tbody><tr>";
			echo "<td><a href=\"home.php\">Home</a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"#\"></a></td>";
			echo "<td><a href=\"signup.php\">Login/Register</a></td>";
			echo "</tr></tbody></table>";
		}
	}else{
		echo "<h1>MyBlogPost</h1>";
		echo "<article id=\"right-icon\"><img class=\"thumbnail\" src='images/blank.png'/></article>";
		echo "<table id=\"box\"><tbody><tr>";
		echo "<td><a href=\"home.php\">Home</a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"#\"></a></td>";
		echo "<td><a href=\"signup.html\">Login/Register</a></td>";
		echo "</tr></tbody></table>";
	}
?>