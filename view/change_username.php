<?php
session_start();
require ('db_connect.php');


    if(empty($_SESSION['first'])) 
    { 
        header("Location: login.php"); 
    }
	else{ 
		$firstname = $_SESSION['first'];
		$lastname = $_SESSION['last'];
		$username = $_SESSION['username'];
		$alumniId = $_SESSION['alumni_id'];
		}
		

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_images/main.css" type="text/css" rel="stylesheet" />
<title>Username Update - Alumni Network</title>
</head>

<body>

<div id="header" class="header">RWU Alumni Network</div>
<div id="topSearch" class="topSearch">
	<form method="POST" action="../index.php" >
    	<label>Search for: <input type="text" name="search"  /></label>
        <label>in <select name="siteSearch">
        		 	 <option value="alumni_dir">Alumni Directory</option>
                     <option value="site_search">RWU Site Search</option>
                     <option value="form_doc">Forms and Documents</option>
                 </select></label>
         <input class="register" type="submit" value="search" name="submit" />
	</form>
</div>

<div class="topMenu">
	<ul class="menuItem">
    	<li><a href="alumni_home2.php">Today</a></li>
        <li><a href="alumni_personal.php">Personal</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="directories.php">Directories</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>



<br /><br />

<div class="pageContentTitle">Roger Williams University Alumni Network</div><br />
	<div class="pageContentSubTitle">Username Update Form</div><br />
    
<div class="formContent">

<form action="../index.php" method="post" class="mainForm">
	<p>Please complete the username update form below. Mandatory fields marked <em>*</em></p>
	<fieldset>
		<legend>Change Username</legend>
		<ol>
        	<input type="hidden" name="action" value="changeUsername" />
			<li><label for="username">Username <em>*</em></label> <input id="username" name="username" value="<?php echo $username; ?>" /></li>
			<li><label for="newUsername">New Username <em>*</em></label> <input id="newUsername" name="newUsername" /></li>
			<li><label for="password">Password <em>*</em></label> <input id="password" name="password"/></li>
			<li><label for="confirmPassword">Retype Password <em>*</em></label> <input id="confirmPassword" name="newPasswordConfirm"/></li>
			<li>
				<fieldset>
					<legend>Are you a student or an alumni? <em>*</em></legend>
					<label><input type="radio" name="alumniOrStudent" value="alumni"/> Alumni</label>
					<label><input type="radio" name="alumniOrStudent" value="student" /> Student</label>
				</fieldset>
			</li>
		</ol>
	</fieldset>
		<p><input type="button" value="Back" onClick="parent.location='alumni_personal.php'" /> &nbsp;<input type="submit" value="Submit" name="submit" /></p>
</form>
<footer>&copy; Roger Williams University 2013</footer>


</body>
</html>