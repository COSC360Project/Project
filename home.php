<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>MyBlogPost - Home</title>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body id="home-body">
        <header id="home-header">
            <h1>MyBlogPost</h1>
            <div class="topnav">
                <input type="text" style="float:left;" placeholder="Search blog posts..">
                <?php
                    include 'homeheader.php';
                ?>
            </div>
        </header>
        <div class="row">
            <div id="featured-posts-left">
                <!-- Generate posts from db -->
                <?php
                    include 'db_info/db_credentials.php';
                    
                    // create connection
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
                    $error = mysqli_connect_error();
                    if ($error != null) {
                        $errmsg = "<p>Database connection failed</p>";
                        exit($errmsg);
                    }
                    else {
                        // get post results from db
                        $sql = "SELECT * FROM blogpost ORDER BY date DESC";
                        $result = mysqli_query($conn, $sql);
                    
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='post-entry'>";
                                echo "<h2>".$row['title']."&nbsp;by&nbsp;".$row['authorid']."</h2>";
                                echo "<h5>Date posted:&nbsp;".$row['date']."</h5>";
                                echo "<p>".$content."</p>";
                                echo "</div>";
                            }
                        }
                        else {
                            echo "<p>0 results returned.</p>";
                            exit();
                        }
                    }
                   // close connection
                    $conn -> close();
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
                <form method="post">

                </form method='post'>
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
    