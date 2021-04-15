<?php
    session_start()
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>MyBlogPost - Home</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/searchposts.js"></script>
    </head>
    <body>
        <header id="masthead" name="top">
            <?php
                include 'header.php';
            ?>                
        </header>
        <div id="topsearch"> 
            <!-- <form method='post' action='displaysearchposts.php' id='searchform'>
                <input type="text" id="search-keyword" placeholder="Search blog posts.." required="required"/>
                <button type="submit" id="search" onclick="javascript: $.getScript('/js/searchposts.js' , function(){searchposts();});"><i class="fa fa-search"></i></button>
            </form>  -->
            <input type="text" id="search-keyword" placeholder="Search blog posts..."/>
            <button type="submit" id="search"><i class="fa fa-search"></i></button>
        </div>
        <div class="row">
            <div id="featured-posts-left">
                <!-- Generate posts from db -->
                <?php
                    include "displayposts.php";
                ?>
                <!--          
                <div class="post-entry">
                    <h2>POST TITLE &nbsp;by&nbsp; USERNAME</h2>
                    <h5>Date posted</h5>
                    <p>Lorem ipsum...</p>
                </div>
                -->
            </div>
            <div id="sidebar-right">
                <h3>Search By:</h3>
                <button type="button" 
                <form method='post' action='displayposts.php'>
                    <input type="submit" name="date" value="Date"/>
                    <input type="submit" name="category" value="Category"/>
                </form>
            </div>
        </div>
        <footer>
         <?php
                include 'footer.html';
         ?>
        </footer>
    </body>
</html>
    