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
<title>Password Update - Alumni Network</title>
</head>

<body>

<div id="header" class="header">RWU Alumni Network</div>
<div id="topSearch" class="topSearch">
	<form method="POST" action="today.php" >
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
	<div class="pageContentSubTitle">Alumni Directory Search</div><br />
    
<div class="formContent">

<form action="../searchOutput.php" method="post" class="mainForm">
	<fieldset>
		<legend>Advanced Search</legend>
		<ol>
        	<input type="hidden" name="action" value="directorySearch" />
			<li><label for="first">First Name <em>*</em></label> <input id="first" name="first" /></li>
			<li><label for="last">Last Name<em>*</em></label> <input id="last" name="last" /></li>
			<li><label for="association">Association </label> 
            	<select id="association" name="association"/>
                	<option value="alumni" >Alumni</option>
                    <option value="parent">Parent</option>
                    <option value="friend">Friend</option>
                 </select>
            </li>

			<li><label for="classYear">Year of Graduation</label> <input type="text" id="classYear" name="classYear"/></li>

		</ol>
	</fieldset>
		<p><input type="button" value="Back"  onClick="parent.location='directories.php'" /> &nbsp;<input type="submit" value="Search" name="submit" /></p>
</form>
<footer>&copy; Roger Williams University 2013</footer>


</body>
</html>