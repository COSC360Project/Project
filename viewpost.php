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
    <article id="left-sidebar">
<?php
	include "rightsidebar.php";
?>
    </article>
    <article id="left-center">
    <h1>View Post</h1>
<?php

include "db_info/db_credentials.php";
$postid = $_GET["postid"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM blogpost WHERE postid='".$postid."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$authorid = $row["authorid"];
		$title = $row["title"];
		$content = $row["content"];
		$category = $row["category"];
		$date = $row["date"];
		$authsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
		$authresult = mysqli_query($connection, $authsql);
		if ($authresult) {
			$authrow = mysqli_fetch_assoc($authresult);
			$username = $authrow["username"];
		}
		mysqli_free_result($authresult);
		
		echo "<div id=\"post\"><h2 id=\"titleedit\">".$title."</h2>";
		echo "<p>Written by: ".$username." on ".$date."</p>";
		echo "<p id=\"contentedit\">".$content."</p>";
		echo "<p id=\"categoryedit\">Category: ".$category."</p>";
		
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
	
	if (isset($_SESSION["status"]) && isset($_SESSION["username"])){
		if (($_SESSION["status"] == 1) || (strcmp($_SESSION["username"],$username) == 0)){
			echo "<button type=\"button\" value=\"editpost\" id=\"editbutton\"/>Edit</button><button id=\"deletebutton\" type=\"submit\" value=\"".$postid."\" name=\"post\"/>Delete</button></div>";
		}
	}

}
mysqli_close($connection);
?>
<div id="commentsection">
<h2>Comments: </h2>
<div id="comments">
<?php

include "db_info/db_credentials.php";
$postid = $_GET["postid"];

$commentidArray = array();

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM comment WHERE postid='".$postid."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		while($row = mysqli_fetch_assoc($result)){
			$commentid = $row["commentid"];
			$commentidArray[] = $commentid;
			$authorid = $row["authorid"];
			$content = $row["content"];
			$date = $row["date"];
			$authsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
			$authresult = mysqli_query($connection, $authsql);
			if ($authresult) {
				$authrow = mysqli_fetch_assoc($authresult);
				$username = $authrow["username"];
			}
			mysqli_free_result($authresult);

			echo "<div class=\"com\"><p>Written by: ".$username." on ".$date."</p>";
			echo "<p>".$content."</p></div>";
		}
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
mysqli_close($connection);
?>
</div>
<?php
if(isset($_SESSION["username"]) && $_SESSION["status"] != -1){
	echo "<h2>Write a Comment: </h2>";
	echo "<textarea id=\"comment\" placeholder=\"Leave a comment\"></textarea>";
	echo "<button type=\"button\" value=\"commentcontent\" id=\"submitbutton\"/>Submit</button>";
	echo "</div>";
}
?>
<?php

include "db_info/db_credentials.php";
$catArray = array();
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
	$output = "<p>Unable to connect to database!</p>";
	exit($output);
}else{
	$sql = "SELECT DISTINCT category FROM blogpost";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		while($row = mysqli_fetch_assoc($result)){
			$catArray[]=$row["category"];
		}
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
}
mysqli_close($connection);
?>

<script type="text/javascript">
	var postid = "<?php echo $postid ?>";
	var commentbutton = document.getElementById("submitbutton");
	commentbutton.addEventListener('click', function(){
		var comment = document.getElementById("comment").value;
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "addcomment.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("content="+comment+"&postid="+postid);
		location.reload();
		
	});
	
	var deletebutton = document.getElementById("deletebutton");
	deletebutton.addEventListener('click', function(){
		if (confirm("Are you sure you want to delete this Post? This action cannot be undone.")) {
			var postid = this.value;
			deletePost(postid);
		}
	});
		
	function deletePost(postid){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "deletepost.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("postid="+postid);
		window.location.href = "home.php";
	}
	
		var catArray = <?php echo json_encode($catArray); ?>;
		var editbutton = document.getElementById("editbutton");
		editbutton.addEventListener('click', function(){
			var oldtitle = document.getElementById("titleedit").innerHTML;
			document.getElementById("titleedit").innerHTML = "<input type=\"text\" name=\"title\" value='"+oldtitle+"' size=\"50\"/><br>";
			var oldtext = document.getElementById("contentedit").innerHTML;
			document.getElementById("contentedit").innerHTML = "<textarea name = \"comment\" id = \"comment\" rows = \"10\" cols=\"50\" >'"+oldtext+"'</textarea><br>";
			var oldcat = document.getElementById("categoryedit").innerHTML;
			oldcat = oldcat.split(": ");
			var oldCat = oldcat[1];
			document.getElementById("categoryedit").innerHTML = "Category: ";
			
			var newelement = document.createElement("select");
			newelement.setAttribute("id","categoryselect");
			for(i = 0; i < catArray.length; i++){
				if(oldCat.localeCompare(catArray[i]) == 0){
					var node = document.createElement("option");
					node.selected = true;
					var text = document.createTextNode(catArray[i]);
					node.appendChild(text);
					newelement.appendChild(node);
				}else{
					var node = document.createElement("option");
					var text = document.createTextNode(catArray[i]);
					node.appendChild(text);
					newelement.appendChild(node);
				}
			}
			
			var element = document.getElementById("categoryedit");
			element.appendChild(newelement);
			editbutton.remove();
			var deletebutton = document.getElementById("deletebutton");
			deletebutton.remove();
			var newbutton = document.createElement("input");
			newbutton.setAttribute("type","button");
			newbutton.setAttribute("id","submitbutton");
			newbutton.setAttribute("value","Submit");
			element.after(newbutton);
			
			var submitbutton = document.getElementById("submitbutton");
			submitbutton.addEventListener('click', function(){
				var newtitle = document.getElementsByTagName("input");
				newtitle = newtitle[0].value;
				var newcontent = document.getElementsByTagName("textarea");
				newcontent = newcontent[0].value;
				var newcat = document.getElementsByTagName("select");
				newcat = newcat[0].value;

				if(newtitle == "" || newcontent =="" || newcat ==""){
					alert("Please fill in all fields.");
				}else{
					var xhttp = new XMLHttpRequest();
					xhttp.open("POST", "editpost.php", false);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send("postid="+postid+"&title="+newtitle+"&content="+newcontent+"&category="+newcat);
					location.reload();
				}
		
			});
			
	});
	
	var commentidArray = <?php echo json_encode($commentidArray); ?>;
	var var1 = setInterval(timer, 10000);
	function timer(){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "refreshcomments.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("postid="+postid+"&commentidArray="+commentidArray);
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
