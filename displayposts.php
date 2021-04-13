<?php
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
        $noresult_error = "<p>0 results returned.</p>";

        // Display function
        function displayresults($row) {
            echo "<div class='post-entry'>";
            echo "<h2>".$row['title']."&nbsp;by&nbsp;".$row['authorid']."</h2>";
            echo "<h5>Date posted:&nbsp;".$row['date']."</h5>";
            echo "<p>".$row['content']."</p>";
            echo "</div>";           
        }

        // Default display
        $sqlDisplay = "SELECT * FROM blogpost ORDER BY date DESC";

        // If sort-by-category is set, change sql. 
        // Old code: if (array_key_exists('category',$_POST))
        if (isset($_POST['category'])) {
            // Validate method
            if ($_SESSION['REQUEST_METHOD']=='POST') {
                $sqlDisplay = "SELECT * FROM blogpost ORDER BY date DESC";    
            }            
            else echo $request_error;
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

        // If user requests a search
        $keyword = $_POST['search-keyword'].value;
        $searchBtn = $_POST['search'];           
        if (isset($searchBtn) && !empty($keyword)) {
            // Validate request
            if ($_SESSION['REQUEST_METHOD'] == 'POST') {
                $sqlSearch = "SELECT * FROM blogpots WHERE title LIKE %".$keyword."% ORDER BY date DESC";
                $searchResult = mysqli_query($conn,$sqlSearch);
                if (mysqli_num_rows($searchResult) > 0) {
                    while ($row = mysqli_fetch_assoc($searchResult)) {
                        displayresults($row);                      
                    }
                }
                else {
                    echo "Search query:'".$keyword."' returned 0 results.";
                }
            } 
            else echo $request_error;       
        }
    }   
    // close connection
    mysqli_close($conn);
?>