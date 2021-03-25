<?php
include 'db_connection.php';
$conn = OpenCon();

function ExecuteQuery($sql){
	$success = false;
	$conn = OpenCon();
	if ($conn->query($sql) === TRUE){
		$success = true;
		return $success;
	}else{
		return $success;
  }
}

// Opens db file and reads in db information
// If modifying dbdata.txt, make sure there are no empty lines!
$file = fopen("dbdata.txt","r");
$sqlsuccess = true;
while(!feof($file)){
	$sql = fgets($file);
	$result = ExecuteQuery($sql);
	if ($result == 0){
		$sqlsuccess = false;
	}
	//echo $sql. "    ".$result. "</br>";
}

if ($sqlsuccess){
	echo "Database Restored Successfully!";
}else{
	echo "Error Restoring Database!";
}

fclose($file);
CloseCon($conn);
?>