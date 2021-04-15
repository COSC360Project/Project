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
            echo "<table><tr><th><h2>".$row['title']."&nbsp;by&nbsp;".$row['username']."</h2></th></tr>";
            echo "<tr><td>Date posted:&nbsp;".$row['date']."</td></tr>";
            echo "<tr><td>".$row['content']."</td></tr>";
            echo "<tr><td style='text-align:right'>Category:&nbsp;".$row['category']."</td></tr>";
            echo "</table></div>";           
        }

        // Default display
        $sqlDisplay = "SELECT title,username,date,category,content FROM blogpost B INNER JOIN userinfo U ON B.authorid = U.authorid ORDER BY date DESC";

        // If sort-by-category is set, change sql. 
        // Old code: if (array_key_exists('category',$_POST))
        if (isset($_POST['category'])) {
            // Validate method
            if ($_SESSION['REQUEST_METHOD']=='POST') {
                $sqlDisplay = "SELECT * FROM blogpost ORDER BY category DESC";    
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
    }   
    // close connection
    mysqli_close($conn);
?>