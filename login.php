<?php
    session_start()
?>


<!DOCTYPE html>
<html>
    <?php

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["username"]) && isset($_POST["password"])){
                $username = $_POST["username"];
                $password = $_POST["password"];
            }
        }
        
        include "db_info/db_credentials.php";
        
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
        $error = mysqli_connect_error();
        
    
        if($error != null){
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        }
       
        
        else {
            $sql = "SELECT username, password FROM Userinfo WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($connection, $sql);
            
            if(!$result){
                die();
            }
            else {
                if(mysqli_num_rows($result) == 1){
                    $sql2 = "SELECT status, imageURL FROM Userinfo WHERE username = '$username' AND password = '$password' ";
                    $result2 = mysqli_query($connection, $sql2);

                     while ($row = mysqli_fetch_assoc($result2)){
                        $status = $row['status'];
                        $imageURL = $row['imageURL'];
                      }
                    //ADD SESSIONS IF NEEDED
                    $_SESSION["status"] = $status;
                    $_SESSION["imageURL"] = $imageURL;
                    $_SESSION["username"] = $username;
                    header("Location: home.php");
                    exit;
                }
                else {
                    $_SESSION["error"] = "Your username and/or password is invalid";

                    header("Location: signup.php");
                    exit;
                }
            }

            mysqli_free_result($result);
            mysqli_close($connection);
        }
    ?>
</html>