<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>MyBlogPost</title>
   <link rel="stylesheet" href="css/style.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<tr><td><a href="changepassword.php">Change Password</a></td></tr>
		<tr><td><a href="userinfomanageposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="userinfodelete.php">Delete User</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>Manage Posts</h1>
<?php

include "db_info/db_credentials.php";
$username = $_SESSION["username"];
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT authorid FROM userinfo WHERE username='".$username."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$authorid = $row["authorid"];
	}
	mysqli_free_result($result);
	
	$sql = "SELECT * FROM blogpost WHERE authorid='".$authorid."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<table><tbody>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>".$row["title"]."</td>";
			echo "<td>";
			$postid = $row["postid"];
			$commentsql = "SELECT COUNT(*) FROM comment WHERE postid = ".$postid;
			$commentresult = mysqli_query($connection, $commentsql);
				if ($commentresult) {
					$commentrow = mysqli_fetch_assoc($commentresult);
					echo $commentrow["COUNT(*)"]." Comments";
				}
			mysqli_free_result($commentresult);
			echo "</td>";
			echo "<td>".$row["date"]."</td>";
			echo "<td>".$row["category"]."</td>";
			echo "<td><input type=\"button\" value=\"View\"/><button class=\"deletebutton\" type=\"submit\" value=\"".$row["postid"]."\" name=\"username\"/>Delete</button></td>";
			
			echo "</tr>";
		}
		echo "</tbody></table>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
mysqli_close($connection);
?>
<script type="text/javascript">
	var deletebutton = document.getElementsByClassName("deletebutton");
	for (var i = 0; i < deletebutton.length; i++){
		deletebutton[i].addEventListener('click', function(){
		if (confirm("Are you sure you want to delete this Post? This action cannot be undone.")) {
			var postid = this.value;
			deletePost(postid);
		}
	});
	}
	function deletePost(postid){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "deletepost.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("postid="+postid);
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