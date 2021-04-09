<?php
    if (isset($_SESSION['status'])) {
        $status = $_SESSION['status'];
        // For regular users
        if ($status == 0) {
            echo "<a href='createpostpage.html'><button type='button'>Create Post</button></a>";
            echo "<a href='userinfo.php'>";
            // Need to change this to get user's image 
            echo "<img id='avatar' src='images/default-avatar-icon.png'/>";
            echo "</a>";
        }        
        // For admin
        else if ($status == 1) {
            echo "<a href='createpostpage.html'><button type='button'>Create Post</button></a>";
            echo "<a href='userinfo.php'>";
            /*** NEED TO CHANGE THIS TO DISPLAY USER'S IMAGE ***/
            echo "<img id='avatar' src='images/default-avatar-icon.png'/>";
            echo "</a>";

            echo "<a href='adminsite.php'>";
            echo "<button type='button'>Admin Page</button>";
            echo "</a>";
        }
        // For unregistered users / users not logged in 
        else {
            echo "<a href='register.html'><button type='button'>Login / Register</button></a>";
        }
    }
?>    
