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
            // Define SQL to display post results
            $sqlDisplay = "SELECT * FROM blogpost ORDER BY date DESC";
			// Change SQL if sort-by category option is selected
			if (isset($_POST['category'])) {		// Old code: if (array_key_exists('category',$_POST)) 
                $sqlDisplay = "SELECT * FROM blogpost ORDER BY category DESC";
            }
            $displayResult = mysqli_query($conn, $sqlDisplay);
            
			// Display results       
            if (mysqli_num_rows($displayResult) > 0) {
                while ($row = mysqli_fetch_assoc($displayResult)) {
                    echo "<div class='post-entry'>";
                    echo "<h2>".$row['title']."&nbsp;by&nbsp;".$row['authorid']."</h2>";
                    echo "<h5>Date posted:&nbsp;".$row['date']."</h5>";
                    echo "<p>".$row['content']."</p>";
                    echo "</div>";
               }
            }
            else {
                    echo "<p>0 results returned.</p>";
            }
			
			// If user requests a search
            if (isset($_POST['search'])) {
                $keyword = $_POST['search-keyword'];
                $sqlSearch = "SELECT * FROM blogpost WHERE title LIKE %".$keyword."% ORDER BY date DESC";
                $searchresult = mysqli_query($conn,$sqlSearch);
                if (mysqli_num_rows($searchresult)> 0) {
                    while ($searchrow = mysqli_fetch_assoc($searchresult)) {
                        echo "<div class='post-entry'>";
                        echo "<h2>".$row['title']."&nbsp;by&nbsp;".$row['authorid']."</h2>";
                        echo "<h5>Date posted:&nbsp;".$row['date']."</h5>";
                        echo "<p>".$row['content']."</p>";
                        echo "</div>";
                    }
                }
            }
            else {
                    echo "<p>Search query '".$keyword."' returned 0 results.</p>";
            }
        }
        // close connection
        $conn -> close();
?>