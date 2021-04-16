<!DOCTYPE html>
<html>
<h3>Date:</h3>

<p>
<?php
include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT date FROM blogpost ORDER BY date ASC";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$showyear = "0000";
		$showmonth = "00";
		while($row = mysqli_fetch_assoc($result)){
			
			$date = $row["date"];
			$date = explode("-", $date);
			$year = $date[0];
			$month = $date[1];
			
			if(strcmp($showyear,$year) != 0){
				echo "<a href=searchresults.php?date=".$year.">".$year."</a><br>";
				$showyear = $year;
			}
			
			if (strcmp($showmonth,$month) != 0){
				$strmonth = "";
				switch ($month){
					case "01":
						$strmonth = "January";
						break;
					case "02":
						$strmonth = "February";
						break;
					case "03":
						$strmonth = "March";
						break;
					case "04":
						$strmonth = "April";
						break;
					case "05":
						$strmonth = "May";
						break;
					case "06":
						$strmonth = "June";
						break;
					case "07":
						$strmonth = "July";
						break;
					case "08":
						$strmonth = "August";
						break;
					case "09":
						$strmonth = "September";
						break;
					case "10":
						$strmonth = "October";
						break;
					case "11":
						$strmonth = "November";
						break;
					case "12":
						$strmonth = "December";
						break;
				}
				
				if($strmonth != ""){
					$ym = $year."-".$month;
					echo "<a class=\"ym\" href=searchresults.php?date=".$ym.">".$strmonth." ".$year."</a><br>";
				}
				$showmonth = $month;
			}
		}
		
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
}
mysqli_close($connection);
?>
</p>
<h3>Category:</h3>
<p>
<?php
include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT DISTINCT category FROM blogpost";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		while($row = mysqli_fetch_assoc($result)){
			$cat = $row["category"];
			echo "<a href=searchresults.php?category=".$cat.">".$cat."</a><br>";
		}
		
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
}
mysqli_close($connection);
?>
</p>
</html>