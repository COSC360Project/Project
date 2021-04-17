<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>MyBlogPost - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script type="text/javascript">        
        function loadPosts(str) {
            var postsHere = $('#featured-posts-left');
            getContent = str;

            $.post('displaysearchedposts.php', {input: getContent}, function(data) {
                postsHere.html(data);
            });            
        }

        var keyword = $('#search-keyword').value();
        document.onload = function() {
            $('#search-btn').addEventListener('click', loadPosts(keyword));
        }
    </script>
</head>


<body>
    <header id="masthead" name="top">
    <?php
        include "header.php";
    ?>
    </header>
	
    
	
	<article id="left-sidebar">
	<h2>Browse Content by:</h2>
	<form id="sort-posts-by" method="get" action="displaysortedposts.php">
                <input type="submit" name="date" value="Date"/>
                <input type="submit" name="category" value="Category"/>
    </form>
	<?php
	include "rightsidebar.php";
	?>
    </article>
	
	<div id="searchbar">
	<div id="topsearch">

    <form method='get' action="displaysearchedposts.php">
        <input type="text" name="search-keyword" id="search-keyword" placeholder="Search blog posts here..."/>
        <button type="submit" id="search-btn"><i class="fa fa-search"></i></button>
    </form>
    </div>
	</div>
	
	<div id="main">
	<article id="homeleft-center">
	
    <div class="row">
        <div id="featured-posts-left">
        <?php
            include "displaydefaultposts.php";
        ?>
        </div>
    </div>
	</article>
	</div>
	
	
    <footer>
    <?php
        include "footer.html";
    ?>
    </footer>
</body>
</html>