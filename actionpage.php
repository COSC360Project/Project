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
<?php 
$_SESSION['comment'] = $_POST['comment'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
echo "Thank you for your comment! "


?>

<div id="main">
<article id="left-sidebar">
	<h2>Browse Content by:</h2>
	<p>Date:</p>
	<p>Category:</p>
</article>
<article id="left-center">
<h1>Manage Posts</h1>
</article>
</div>

<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>