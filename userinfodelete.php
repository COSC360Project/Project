<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>MyBlogPost</title>
   <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header id="masthead">
<?php
	//Display header based on if user is logged in, and their status
	include "header.php";
?>
</header>

<div id="main">
<article id="right-sidebar">
<table>
	<tbody>
		<tr><td><a href="userinfo.php">User Profile</a></td></tr>
		<tr><td><a href="userinfoedit.php">Edit User Information</a></td></tr>
		<tr><td><a href="userinfomanageposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="userinfodelete.php">Delete User</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>Delete User</h1>
<?php

include "db_info/db_credentials.php";
$username = $_SESSION["username"];
echo "<style> p {text-align:center; padding:0.5em;} </style>";
echo "<p>Are you sure you want to delete your account? This action cannot be undone.</p>";
echo "<p><button class=\"deletebutton\" type=\"submit\" value=\"".$username."\" name=\"username\"/>Delete</button></p>";

?>
<script type="text/javascript">
	var deletebutton = document.getElementsByClassName("deletebutton");
	for (var i = 0; i < deletebutton.length; i++){
		deletebutton[i].addEventListener('click', function(){
		if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
			var username = this.value;
			deleteuser(username);
		}
	});
	}
	function deleteuser(username){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "deleteuser.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("username="+username);
		location.reload();

		
		
	}

</script>
</article>
</div>

<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>