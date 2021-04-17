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
    <script type="text/javascript">        
        function loadPosts(str) {
            var postsHere = $('#featured-posts-left');
            getContent = str;

            $.post('displaysearchedposts.php', {input: getContent}, function(data) {
                postsHere.html(data);
            });            
        }

        var keyword = $('#search-keyword').value();
        document.onload = function() {
            $('#search-btn').addEventListener('click', loadPosts(keyword));
        }
    </script>
</head>
<body>
    <header id="masthead" name="top">
    <?php
        include "header.php";
    ?>
    </header>
	
	<article id="left-sidebar">
	<h2>Browse Content by:</h2>
	<form id="sort-posts-by" method="get" action="displaysortedposts.php">
                <input type="submit" name="date" value="Date"/>
                <input type="submit" name="category" value="Category"/>
    </form>
	<?php
	include "rightsidebar.php";
	?>
    </article>
	
	<div id="searchbar">
	<div id="topsearch">

    <form method='get' action="displaysearchedposts.php">
        <input type="text" name="search-keyword" id="search-keyword" placeholder="Search blog posts here..."/>
        <button type="submit" id="search-btn"><i class="fa fa-search"></i></button>
    </form>
    </div>
	</div>
	
	<div id="main">
	<article id="homeleft-center">
	<h1>Search Results</h1>
    <div class="row">
        <div id="featured-posts-left">
<?php

    include 'db_info/db_credentials.php';

$allresults = array();
    // create connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
    $error = mysqli_connect_error();

    if ($error != null) {
        $errmsg = "<p>Unable to connect to database.</p>";
        exit($errmsg);
    }
    else {
        // Error messages
        $isset_error = "<p>Search box must be filled.</p>";

        // Display function
    function displayresults($row, $count) {
        echo "<div class='post-entry'>";
        echo "<table><tr><th><h2>".$row['title']."&nbsp;by&nbsp;".$row['username']."</h2></th></tr>";
        echo "<tr><td>Date posted:&nbsp;".$row['date']."</td></tr>";
        echo "<tr><td>".$row['content']."</td></tr>";
        echo "<tr><table><tr><td>".$count." Comments</td><td style='text-align:center'><form method=\"get\" action=\"viewpost.php\"><button class=\"viewbutton\" type=\"submit\" formmethod=\"get\" value=\"".$row["postid"]."\" name=\"postid\"/>View</button></td><td style='text-align:right'>Category:&nbsp;".$row['category']."</td></tr></table></tr>";
        echo "</table></div>";           
    }

        $keyword = $_GET['search-keyword'];
        if (isset($keyword) && !empty($keyword)) {
            $sqlSearch = "SELECT postid,title,U.username,date,category,content FROM blogpost B JOIN userinfo U ON B.authorid = U.authorid WHERE title LIKE '%$keyword%' ORDER BY date DESC";
            $searchResult = mysqli_query($conn,$sqlSearch);
           
            if (mysqli_num_rows($searchResult) > 0) {
                while ($row = mysqli_fetch_assoc($searchResult)) {
					$allresults[] = $row;
                    //displayresults($row);           
                }
            }
            else echo "Search query:'".$keyword."' returned 0 results.";
                    
        }
        else {
            echo $isset_error;
        }
    }
	
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
        </div>
    </div>
	</article>
	</div>
    <footer>
    <?php
        include "footer.html";
    ?>
    </footer>
</body>
</html>