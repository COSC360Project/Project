<?php
session_start();
include "db_info/db_credentials.php";
$postid = $_POST["postid"];
$commentidArray = $_POST["commentidArray"];
//print_r($_SESSION["commentidArray"]);
$sessionarray=$_SESSION["commentidArray"];


$commentidArray = explode(",",$commentidArray);

//$commentidArray = json_decode($commentidArray);
//print_r($commentidArray);

//$commentidArray = explode(",",$commentidArray);

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM comment WHERE postid='".$postid."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$notfound = true;
		$newcommentid = "";
		while(($row = mysqli_fetch_assoc($result)) && $notfound){
			$commentid = $row["commentid"];
			$found = false;
			for ($i = 0; $i < count($commentidArray); $i++){
				//echo $commentid." ";
				//echo $commentidArray[$i];
				//echo "<br>";
				//echo gettype($commentid);
				//echo "<br>";
				//echo gettype($commentidArray[$i]);
				if (strcmp($commentid,$commentidArray[$i]) == 0){
					//echo "found gurl";
					//$notfound = false;
					//break;
					$found = true;
					break;
				}
			}
			for ($i = 0; $i < count($sessionarray); $i++){
				//echo $commentid." ";
				//echo $commentidArray[$i];
				//echo "<br>";
				//echo gettype($commentid);
				//echo "<br>";
				//echo gettype($commentidArray[$i]);
				if (strcmp($commentid,$sessionarray[$i]) == 0){
					//echo "found gurl";
					//$notfound = false;
					//break;
					$found = true;
					break;
				}
			}

			if (!$found){
				$authorid = $row["authorid"];
				$content = $row["content"];
				$date = $row["date"];
				$authsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
				$authresult = mysqli_query($connection, $authsql);
				if ($authresult) {
					$authrow = mysqli_fetch_assoc($authresult);
					$username = $authrow["username"];
				}
						
				
				echo "1,,".$username.",,".$date.",,".$content.",,".$commentid;
				$_SESSION["commentidArray"][] = $commentid;
				$notfound = false;
			}else{
				echo "";
			}
		}			
			
		
		
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
mysqli_close($connection);
?>