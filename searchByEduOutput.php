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

<div class="main">
<?php

global $db;

$action = $_POST['action'];

switch($action){

		case 'eduSearch':
		
		$major = $_POST['major'];
		$minor = $_POST['minor'];
		$core = $_POST['core'];
		$year = $_POST['year'];


	break;
}

$sql = "SELECT *
		FROM alumni_user_info
			INNER JOIN alumni_education_info
				ON alumni_user_info.alumni_id = alumni_education_info.alumni_id
				WHERE major = '$major' OR minor = '$minor' OR core = '$core' OR year = '$year'";
$result = $db->query($sql);


foreach($result as $r){	
echo "<div class='main'>";
echo "<div class='image'>";
	echo '<img src="/images/' . $r['alumni_id'] . '.jpg" />';
echo "</div>";

echo "<div class='table'>";		
	echo "<table class='eduTable'>";		
		echo "<tr>";
				echo "<td>First Name</td>";
				echo "<td>" . $r['first'] . "<br /></td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>Last Name</td>";							
				echo "<td>" . $r['last'] . "<br /></td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>Zip Code</td>";							
				echo "<td>" . $r['zip_code'] . "<br /></td>";
			echo "</tr>";

			echo "<tr>";	
				echo "<td>Major</td>";						
				echo "<td>" . $r['major'] . "<br /></td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>Minor</td>";			
				echo "<td>" . $r['minor'] . "<br /></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td>Core Concentration</td>";							
				echo "<td>" . $r['core'] . "<br /></td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td>Graduation Year</td>";							
				echo "<td>" . $r['year'] . "<br /></td>";
			echo "</tr>";

echo "</table>";
echo "</div>";
echo "</div>";

echo "<hr>";
echo "<br /><br /><br />";
}

?>
<form action="view/employEduSearch.php">
	<input type="submit" value="Back"/>
</form>
</div>

</div>

<footer style="bottom:5px;">&copy; Roger Williams University 2013</footer>
</div>

</body>
</html>