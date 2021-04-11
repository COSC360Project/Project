<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>MyBlogPost - Home</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body id="home-body">
        <header id="home-header">
            <h1>MyBlogPost</h1>
            <div class="topnav">
                <form id="searchbar" method="post" action="displayposts.php">
                    <input type="text" id="search-keyword" placeholder="Search blog posts.." required="required"/>
                    <button type="submit" id="search"><i class="fa fa-search"></i></button>
                </form>
                <?php
                    include 'homeheader.php';
                ?>
            </div>
        </header>
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
                <form method='post' action='displayposts.php'>
                    <input type="submit" name="date" value="Date"/>
                    <input type="submit" name="category" value="Category"/>
                </form>
            </div>
        </div>
        <footer id="home-footer">
            <p>Footer stuff</p>
        </footer>
    </body>
</html>
    