<?php
    session_start();
    include 'db_info/db_credentials.php';
                    
    // create connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
    $error = mysqli_connect_error();

    if ($error!=null) {
        $errmsg = "<p>Unable to connect to database.</p>";
        exit($errmsg);
    }
    else {
        // Error messages
        $request_error = "<p>Bad method.</p>";
        $isset_error = "<p>Not all required parameters have been set.</p>";

        // // Display function
        // function displayresults($row) {
        //     echo "<div class='post-entry'>";
        //     echo "<table><tr><th><h2>".$row['title']."&nbsp;by&nbsp;".$row['username']."</h2></th></tr>";
        //     echo "<tr><td>Date posted:&nbsp;".$row['date']."</td></tr>";
        //     echo "<tr><td>".$row['content']."</td></tr>";
        //     echo "<tr><td style='text-align:right'>Category:&nbsp;".$row['category']."</td></tr>";
        //     echo "</table></div>";           
        // }

        $keyword = $searchBtn = "";
        // Validate request method 
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $keyword = $_POST['search-keyword'].value;
            $searchBtn = $_POST['search'];
            
            // Ensure all parameters are set
            if (isset($searchBtn) && isset($keyword)) {
                // Do nothing
            }
            else {
                echo $isset_error;
            }
            
            // Find post(s) using keyword
            $sqlSearch = "SELECT * FROM blogpots WHERE title LIKE %".$keyword."% ORDER BY date DESC";
            $searchResult = mysqli_query($conn,$sqlSearch);
            // if (mysqli_num_rows($searchResult) > 0) {
            //     echo "<h3>Search results:</h3>";
            //     while ($row = mysqli_fetch_assoc($searchResult)) {
            //         displayresults($row);           
            //     }
            // }
            // else {
            //     echo "Search query:'".$keyword."' returned 0 results.";
            // }
            $searchedPosts = mysqli_fetch_all($searchResult, MYSQLI_ASSOC);
            echo json_encode($searchedPosts);
        // }
        // else echo $request_error;       
    }
