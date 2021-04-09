<!DOCTYPE html>
<html>
    <?php
       

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if( isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["country"]) ) {
                
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $country = $_POST["country"];



              
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
            $sql = "SELECT username FROM Userinfo WHERE username = '$username' ";
            $sql2 = "SELECT email FROM Userinfo WHERE email = '$email' ";
            $result = mysqli_query($connection, $sql);
            $result2 = mysqli_query($connection, $sql2);



            if(!$result || !$result2){
                echo "<p>Query Fail</p>";
                die();
            }
            else {

                if(mysqli_num_rows($result) >= 1 || mysqli_num_rows($result2) >= 1){
                    header("Location: register.html");
                    exit;
                }

                else {
                    date_default_timezone_set('Canada/Vancouver');
                    $joindate = date("Y-m-d");
                   // md5($password);

                    $sql3 = "INSERT INTO Userinfo(username,password,firstname,lastname,email,country,joindate) VALUES ('$username','$password','$firstname','$lastname','$email','$country','$joindate')";
                    
                    $insert= mysqli_query($connection, $sql3);

                    
                    if(!$insert){
                        die();

                    }
                    else {

                        $_SESSION["username"] = $username;
                        header("Location: home.html");
                        exit;
                    }

                }
                
            }

            mysqli_free_result($result);
            mysqli_free_result($result2);
            mysqli_close($connection);
        }


        
    ?>
</html>