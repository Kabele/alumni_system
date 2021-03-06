<?php
if(!isset($_SESSION)){
session_start();
}
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
<?php echo $css; ?>
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
    	<li><a href="alumni/view/alumni_home2.php">Today</a></li>
        <li><a href="alumni/view/alumni_personal.php">Personal</a></li>
        <li><a href="alumni/view/information.php">Information</a></li>
        <li><a href="alumni/view/directories.php">Directories</a></li>
        <li><a href="alumni/view/logout.php">Logout</a></li>
    </ul>
</div>



<br /><br />

<div class="pageContentTitle">Roger Williams University Alumni Network</div><br />
	<div class="pageContentSubTitle">File Upload Form</div><br />
    
<div class="formContent">

     <form enctype="multipart/form-data" action="../index.php" class="mainForm" method="post">
     <fieldset>
     	<input type="hidden" name="action" value="upload" />
        <input type="hidden" name="alumni_id" value="<?php echo $alumniId; ?>"
     	<legend>Upload Photos and Documents</legend>
        <ol>
        	<li><label for="fileUpload">Upload Files </label> <input type="file" name="file1" id="fileUpload" /></li>
        </ol>
        <li><?php echo $uploadSuccessMessage; ?></li>
        
        <p><input type="button" value="Back"  onClick="parent.location='view/alumni_personal.php'" /> &nbsp;<input type="submit" value="Upload File" name="upload" /></p>
        
     </fieldset>
     </form>

      
<footer>&copy; Roger Williams University 2013</footer>


</body>
</html>
