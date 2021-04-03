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
<h1>Manage Comments</h1>
</article>
</div>

<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>
