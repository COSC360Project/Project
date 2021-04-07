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
            if (array_key_exists('category', $_POST)) {
                $sql = "SELECT * FROM blogpost ORDER BY category DESC";
            }
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

            if (isset($_POST['search'])) {
                $keyword = $_POST['search-keyword'];
                $sqlsearch = "SELECT * FROM blogpost WHERE title LIKE %$keyword% ORDER BY date DESC";
                $searchresult = mysqli_query($conn,$sqlsearch);
                if (mysqli_num_rows($searchresult)> 0) {
                    while ($searchrow = mysqli_fetch_assoc($searchresult)) {
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
        }
        // close connection
        $conn -> close();
?>