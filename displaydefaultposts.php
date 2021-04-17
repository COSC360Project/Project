<?php

include "db_info/db_credentials.php";

// Create connection
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$db);
$error = mysqli_connect_error();

$allresults = array();

if ($error!=null) {
    $errmsg = "<p>Unable to connect to database.</p>";
    exit($errmsg);
}
else {
    // Error messages
    $noresult_error = "<p>0 results returned.</p>";

    // Display function
    function displayresults($row, $count) {
        echo "<div class='post-entry'>";
        echo "<table><tr><th><h2>".$row['title']."&nbsp;by&nbsp;".$row['username']."</h2></th></tr>";
        echo "<tr><td>Date posted:&nbsp;".$row['date']."</td></tr>";
        echo "<tr><td>".$row['content']."</td></tr>";
        echo "<tr><table><tr><td>".$count." Comments</td><td style='text-align:center'><form method=\"get\" action=\"viewpost.php\"><button class=\"viewbutton\" type=\"submit\" formmethod=\"get\" value=\"".$row["postid"]."\" name=\"postid\"/>View</button></td><td style='text-align:right'>Category:&nbsp;".$row['category']."</td></tr></table></tr>";
        echo "</table></div>";           
    }

    // Default display
    $sqlDisplay = "SELECT postid,title,U.username,date,category,content FROM blogpost B JOIN userinfo U ON B.authorid = U.authorid ORDER BY date DESC";

    // Obtain results
    $displayResult = mysqli_query($conn,$sqlDisplay);
    
    // Display results
    if (mysqli_num_rows($displayResult) > 0) {
        while ($row = mysqli_fetch_assoc($displayResult)) {
			//print_r($row);
			$allresults[] = $row;
             //displayresults($row);                   
        }
    }
    else {
        echo $noresult_error;
    }
}   
// close connection
mysqli_close($conn);

for ($i=0;$i<count($allresults);$i++){
	$postid = $allresults[$i]["postid"];
	
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
	$error = mysqli_connect_error();
	if($error != null){
		$output = "<p>Unable to connect to database!</p>";
		exit($output);
	}else{
		$sql = "SELECT COUNT(*) FROM comment WHERE postid = ".$postid;
		$result = mysqli_query($connection, $sql);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$count = $row["COUNT(*)"];
		}else{
			printf("Error: %s\n", mysqli_error($connection));
			exit();
		}
	}
	mysqli_close($connection);
	displayresults($allresults[$i], $count);
}
?>