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
    <script src="js/sortposts.js"></script>
</head>
<body>
    <header id="masthead" name="top">
    <?php
        include "header.php";
    ?>
    </header>
    <div id="topsearch">
        <input type="text" id="search-keyword" placeholder="Search blog posts here..."/>
        <button type="button" id="search-btn"><i class="fa fa-search"></i></button>
    </div>
    <div class="row">
        <div id="featured-posts-left">
        <?php
            include "displaydefaultposts.php";
        ?>
        </div>
        <div id="sidebar-right">
            <h3>Search by:</h3>
            <form id="sort-posts-by" method="get" action="displaysortedposts.php">
                <input type="submit" name="date" value="Date"/>
                <input type="submit" name="category" value="Category"/>
            </form>
        </div>
    </div>
    <footer>
    <?php
        include "footer.html";
    ?>
    </footer>
</body>
</html>