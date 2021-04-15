<?php
session_start();
?>
<!DOCTYPE html>
<html>

<?php

include "db_info/db_credentials.php";
$username = $_SESSION["username"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(($_POST["oldpassword"] != "") && ($_POST["newpassword"] != "")){
			$oldpassword = $_POST["oldpassword"];
			$newpassword = $_POST["newpassword"];
			$sql = "SELECT username,password FROM userinfo WHERE username='".$username."'";
			$result = mysqli_query($connection, $sql);
			if ($result) {
				$row = mysqli_fetch_assoc($result);
				if ((strcmp($row["username"],$username) ==0) && (strcmp($row["password"],md5($oldpassword)) ==0)){
					$insertSQL = "UPDATE userinfo SET password = '".md5($newpassword)."' WHERE username = '".$username."'";
					$insertResult = mysqli_query($connection, $insertSQL);
					if ($insertResult){
						$_SESSION["message"] = "<p>User's password has been updated</p>";
						header("Location: changepassword.php");
					}else{
						$_SESSION["message"] =  "<p>Error! Password not updated</p>";
						header("Location: changepassword.php");
					}	
				}else{
					$_SESSION["message"] =  "<p>The existing password is invalid!</p>";
					header("Location: changepassword.php");
				}	
			}else{
				printf("Error: %s\n", mysqli_error($connection));
				exit();
			}
		}else{
			echo "Error! Fields not set!";
		}
	}else{
		echo "Error! Bad GET request!";
	}
}
mysqli_close($connection);
 
?>
</html>