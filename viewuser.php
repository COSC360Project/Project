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
		<tr><td><a href="adminsite.php">Manage Site</a></td></tr>
		<tr><td><a href="adminusers.php">Manage Users</a></td></tr>
		<tr><td><a href="adminposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="admincomments.php">Manage Comments</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>View User</h1>
<?php

include "db_info/db_credentials.php";
$username = $_GET["username"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM userinfo WHERE username='".$username."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if ($row["status"] == 1){
			$status = "Administrator";
		}else if($row["status"]== 0){
			$status = "User";
		}else{
			$status = "Banned";
		}
		echo "<img class=\"resize\" src='".$row["imageURL"]."'/>";
		echo "<table id = \"userinfo\"><tbody>";
		echo "<tr><td>Author ID:</td><td>".$row["authorid"]."</td><td></td></tr>";
		echo "<tr><td>Username:</td><td id=\"name\">".$row["username"]."</td><td></td></tr>";
		echo "<tr><td>First Name:</td><td>".$row["firstname"]."</td><td></td></tr>";
		echo "<tr><td>Last Name:</td><td>".$row["lastname"]."</td><td></td></tr>";
		echo "<tr><td>Email:</td><td>".$row["email"]."</td><td></td></tr>";
		echo "<tr><td>Country:</td><td>".$row["country"]."</td><td></td></tr>";
		echo "<tr><td>Member Since:</td><td>".$row["joindate"]."</td><td></td></tr>";
		echo "<tr><td>Status:</td><td id=\"userstatus\">".$status."</td><td id=\"changebutton\" ><input type=\"button\" value=\"Update\" id=\"userbutton\"/></td></tr>";
		echo "</tbody></table>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
mysqli_close($connection);
?>
<script type="text/javascript">
	var statusbutton = document.getElementById("userbutton");
	statusbutton.addEventListener('click', function(){
		var username = document.getElementById("name").innerHTML;
		var oldstatus = document.getElementById("userstatus").innerHTML;
		if(oldstatus.localeCompare("Administrator") == 0){
			document.getElementById("userstatus").innerHTML = "<select onchange=\"setstatus(this.value)\" name=\"status\"><option value=\"1\" selected>Administrator</option><option value=\"0\">User</option><option value=\"-1\">Banned</option></select>";
		}else if(oldstatus.localeCompare("User") == 0){
			document.getElementById("userstatus").innerHTML = "<select onchange=\"setstatus(this.value)\" name=\"status\"><option value=\"1\">Administrator</option><option value=\"0\" selected>User</option><option value=\"-1\">Banned</option></select>";
		}else if(oldstatus.localeCompare("Banned") == 0){
			document.getElementById("userstatus").innerHTML = "<select onchange=\"setstatus(this.value)\" name=\"status\"><option value=\"1\">Administrator</option><option value=\"0\">User</option><option value=\"-1\" selected>Banned</option></select>";
		}
		statusbutton.remove();
		document.getElementById("changebutton").innerHTML = "<input type=\"button\" value=\"Submit\" id=\"userbutton\"/>";
		
	});
	
	function setstatus(newstatus){
		var submitbutton = document.getElementById("changebutton");
		submitbutton.addEventListener('click', function(){
			var username = document.getElementById("name").innerHTML;
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "changestatus.php", false);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("username="+username+"&status="+newstatus);
			location.reload();
		});
		
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
