<?php
session_start();
require ('db_connect.php');

if(empty($_SESSION['first'])) 
    { 
        header("Location: view/login.php"); 
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
<link href="view/styles_images/main.css" type="text/css" rel="stylesheet" />
<link href="view/styles_images/output.css" type="text/css" rel="stylesheet" />
<title>Search By Name Results - Alumni Network</title>

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
    	<li><a href="view/alumni_home2.php">Today</a></li>
        <li><a href="view/alumni_personal.php">Personal</a></li>
        <li><a href="view/information.php">Information</a></li>
        <li><a href="view/directories.php">Directories</a></li>
        <li><a href="view/logout.php">Logout</a></li>
    </ul>
</div>



<br /><br />

<div class="pageContentTitle">Roger Williams University Alumni Network</div><br />
	<div class="pageContentSubTitle">Search By Name Results</div><br />
    
<div class="formContent">

<?php

global $db;

$action = $_POST['action'];

switch($action){

		case 'searchByEdu':
		
		$school = $_POST['school'];
		$program = $_POST['program'];
		$yog = $_POST['yog'];
		
		
break;

}

$sql = "SELECT * FROM alumni_education_info
		WHERE major = '$first' OR last = '$last'";
		
$getUser = $db->query($sql);

$getUser = $getUser->fetch();

$userID = $getUser['alumni_id'];


$sql = "SELECT * FROM alumni_employment_info
		WHERE alumni_id = '$userID'";
		
$alumniID = $db->query($sql);

$sql = "SELECT * FROM alumni_user_info
		 WHERE alumni_id = '$userID'";

$otherAlumniID = $db->query($sql);

$sql = "SELECT * FROM alumni_education_info
		WHERE alumni_id = '$userID'";
		
$thirdAlumniID = $db->query($sql);

echo "<table class='outputTable'>";
	
	foreach($otherAlumniID as $r){
	echo "<thead>";
		echo "<tr>";
			echo "<th>First Name</th>";
			echo "<th>Last Name</th>";
		echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
		echo "<tr>";
			
			echo "<td>";
				echo $r['first'];
			echo "</td>";

			echo "<td>";
				echo $r['last'];
			echo "</td>";
			
		echo "</tr>";
	echo "</tbody>";
	}

	foreach($alumniID as $r){
	echo "<thead>";
		echo "<tr>";
			echo "<th>Job Title</th>";
			echo "<th>Employer</th>";
			echo "<th>City</th>";
			echo "<th>Phone</th>";						
		echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
		echo "<tr>";
			
			echo "<td>";
				echo $r['job_title'];
			echo "</td>";

			echo "<td>";
				echo $r['employer'];
			echo "</td>";
			
			echo "<td>";
				echo $r['city'];
			echo "</td>";
			
			echo "<td>";
				echo $r['phone'];
			echo "</td>";
		echo "</tr>";
	echo "</tbody>";
	}
	foreach($thirdAlumniID as $r){
	echo "<thead>";
	echo "<tr>";
		echo "<th>Major</th>";
		echo "<th>Double Major</th>";
		echo "<th>Minor</th>";
		echo "<th>Core</th>";	
		echo "<th>Year</td>";					
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
			echo "<td>";
				echo $r['major'];
			echo "</td>";
			
			echo "<td>";
				echo $r['doubleMajor'];
			echo "</td>";	
			
			echo "<td>";
				echo $r['minor'];
			echo "</td>";

			echo "<td>";
				echo $r['core'];
			echo "</td>";	
			
			echo "<td>";
				echo $r['year'];
			echo "</td>";																
		echo "</tr>";
	echo "</tbody>";
	}
	exit;		
?>


<footer>&copy; Roger Williams University 2013</footer>
</div>

</body>
</html>