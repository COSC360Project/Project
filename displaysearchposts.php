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
        $request_error = "<p>Bad request error.</p>";

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
?>