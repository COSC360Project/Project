<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>MyBlogPost</title>
   <link rel="stylesheet" href="css/style.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<header id="masthead">
<?php
	//Display header based on if user is logged in, and their status
	include "header.php";
?>
</header>

<div id="main">
<article id="right-sidebar">
<table>
	<tbody>
		<tr><td><a href="userinfo.php">User Profile</a></td></tr>
		<tr><td><a href="userinfoedit.php">Edit User Information</a></td></tr>
		<tr><td><a href="changepassword.php">Change Password</a></td></tr>
		<tr><td><a href="userinfomanageposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="userinfodelete.php">Delete User</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>Change Password</h1>

<?php
	if(isset($_SESSION["message"])){
		echo $_SESSION["message"];
		unset($_SESSION["message"]);
	}
?>

<form method="post" action="changepassword_rd.php" id="mainForm" >

  Old Password:<br>
  <input type="password" name="oldpassword" id="oldpassword" class="required">
  <br><br>
  New Password:<br>
  <input type="password" name="newpassword" id="password" class="required">
  <br>
  Re-enter New Password:<br>
  <input type="password" name="newpassword-check" id="password-check" class="required">
  <br><br>
  <input type="submit" value="Update Password">
</form>

<script type="text/javascript">

function isBlank(inputField)
{
    if (inputField.value=="")
    {
	     return true;
    }
    return false;
}

function makeRed(inputDiv){
	inputDiv.style.borderColor="#AA0000";
}

function makeClean(inputDiv){
	inputDiv.style.borderColor="#FFFFFF";
}

function checkPasswordMatch(e){
	var pass = document.getElementById("password");
	var passcheck = document.getElementById("password-check");

	if (pass.value == passcheck.value){
		makeClean(pass);
		makeClean(passcheck);
	}else{
		makeRed(pass);
		makeRed(passcheck);
		alert("Passwords do not match!");
		e.preventDefault();
	}
}

window.onload = function()
{
    var mainForm = document.getElementById("mainForm");
    var requiredInputs = document.querySelectorAll(".required");

    mainForm.onsubmit = function(e)
    {
	     var requiredInputs = document.querySelectorAll(".required");
       var err = false;

	     for (var i=0; i < requiredInputs.length; i++)
       {
	        if( isBlank(requiredInputs[i]))
          {
		          err |= true;
		          makeRed(requiredInputs[i]);
	        }
	        else
          {
		          makeClean(requiredInputs[i]);
	        }
	    }
      if (err == true)
      {
        e.preventDefault();
      }
      else
      {
        console.log('checking match');
        checkPasswordMatch(e);
      }
    }
}


</script>
</article>
</div>

<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>