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
        include "db_info/db_credentials.php";

        // Create connection
        $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
        $error = mysqli_connect_error();

        if ($error!=null) {
            $errmsg = "<p>Unable to connect to database.</p>";
            exit($errmsg);
        }
        else {
            // Error messages
            $noresult_error = "<p>0 results returned.</p>";

            // Display function
            function displayresults($row) {
                echo "<div class='post-entry'>";
                echo "<table><tr><th><h2>".$row['title']."&nbsp;by&nbsp;".$row['username']."</h2></th></tr>";
                echo "<tr><td>Date posted:&nbsp;".$row['date']."</td></tr>";
                echo "<tr><td>".$row['content']."</td></tr>";
                echo "<tr><td style='text-align:right'>Category:&nbsp;".$row['category']."</td></tr>";
                echo "</table></div>";           
            }

            // Default display (sort by date)
            $sqlDisplay = "SELECT title,U.username,date,category,content FROM blogpost B JOIN userinfo U ON B.authorid = U.authorid ORDER BY date DESC";

            // If category is set, change sql. 
            if (isset($_GET['category'])) {
                    $sqlDisplay = "SELECT title,U.username,date,category,content FROM blogpost B JOIN userinfo U ON B.authorid = U.authorid ORDER BY category DESC";    
            }

            // Obtain results
            $displayResult = mysqli_query($conn,$sqlDisplay);
            
            // Display results
            if (mysqli_num_rows($displayResult) > 0) {
                while ($row = mysqli_fetch_assoc($displayResult)) {
                    displayresults($row);                   
                }
            }
            else {
                echo $noresult_error;
            }
        }   
        // close connection
        mysqli_close($conn);
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
