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
    
    </header>

    
</div>

<div id="main">
    <article id="left-sidebar">
	<h2>Browse Content by:</h2>
<?php
	include "rightsidebar.php";
?>
    </article>
    <article id="left-center">
    <h1>Create New Post</h1>
	<div id = "createpost">
        <h2> Write your post below: </h2>
        <form action = "viewnewpost.php" method = "post">
			<label>Title: </label>
			<input type="text" name="title" size="50"/><br>
            <label for = "comment">Post: </label><br>
            <textarea name = "comment" id = "comment" rows = "10" cols="50" placeholder = "Enter your post"></textarea><br>
    
			<label>Category: </label>
			<div id="cat">
			<select id="categoryselect" name="category">
			<?php
			include "db_info/db_credentials.php";

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
						echo "<option>".$row["category"]."</option>";
					}
				}else{
					printf("Error: %s\n", mysqli_error($connection));
					exit();
				}

			}
			mysqli_close($connection);
			?>
			</select></div><input type="button" value="+" id="categorybutton"/><br>
        
            <input type = "submit" value = "Submit" class="button">
        </form>
    </div>
	
	<script type="text/javascript">
	var catbutton = document.getElementById("categorybutton");
	catbutton.addEventListener('click', function(){
		var select = document.getElementById("categoryselect");
		document.getElementById("cat").innerHTML = "<input type=\"text\" name=\"category\"/>";
		catbutton.remove();
	});

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