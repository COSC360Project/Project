<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang = "en">
    <meta charset = "utf-8">
    <title>MyBlogPost - Comments Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header id="masthead">
        <?php include "header.php";?>
    <!--
        <h1>MyBlogPost</h1>
        <input type="text" placeholder="Search blog posts..">
        <button type="button">Login</button>
        <button type="button">Register</button>
        <button type="button">Create Post</button>
        <a href=""><img id="avatar" src=""/></a>
    -->
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

    <?php include "db_info/db_credentials.php"; ?>

    <div id = "createpost">
        <h2> Write your post below </h2>
        <form action = "displayposts.php" method = "post">
            <label for = "comment"> Post: </label><br>
            <textarea name = "comment" id = "comment" rows = "10" placeholder = "Enter your post"></textarea><br>
    
            <label for = "name"> Your name: </label><br>
            <input type = "text" id = "name" name = "name" placeholder = "Enter your name"><br>
    
            <label for ="email"> Your email: </label><br>
            <input type = "text" id = "email" name = "email" placeholder = "Enter your email"><br>
        
            <input type = "submit" value = "Submit">
            <input type = "submit" value = "Edit"><br>
        </form>
    </div>
</div>

<?php
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT postid, authorid, title, content, date, category FROM Blogpost";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<table><tbody>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>";
			$postid = $row["postid"];
			$postsql = "SELECT title FROM blogpost WHERE postid = ".$postid;
			$postresult = mysqli_query($connection, $postsql);
				if ($postresult) {
					$postrow = mysqli_fetch_assoc($postresult);
					echo $postrow["title"];
				}
			mysqli_free_result($postresult);
			echo "</td>";
			echo "<td>".$row["content"]."</td>";
			echo "<td>";
			$authorid = $row["authorid"];
			$authorsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
			$authorresult = mysqli_query($connection, $authorsql);
				if ($authorresult) {
					$authorrow = mysqli_fetch_assoc($authorresult);
					echo $authorrow["username"];
				}
			mysqli_free_result($authorresult);
			echo "</td>";
			
			echo "<td>".$row["date"]."</td>";
			echo "<td><input type=\"button\" value=\"View\"/><button class=\"deletebutton\" type=\"submit\" value=\"".$row["commentid"]."\" name=\"username\"/>Delete</button></td>";
			
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
<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>