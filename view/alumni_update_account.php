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
<title>Update Profile - Alumni Network</title>
<link href="styles_images/main.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<script>
			$(document).ready(function() {
				$("#schoolMajor").change(function() {
					var schoolOrCollege = $(this).val();
					var nameValuePair = 'school='+ schoolOrCollege; //needs to be a name/value pair
					
					$.ajax({
						type: "post",
						url: "../searchByJob.php",
						data: nameValuePair,
						cache: false,
						success: function(x) {
							$("#programMajor").html(x);
						}
					});
				});
				
				$("#schoolMinor").change(function() {
					var schoolOrCollege = $(this).val();
					var nameValuePair = 'school='+ schoolOrCollege; //needs to be a name/value pair
					
					$.ajax({
						type: "post",
						url: "../searchByJob.php",
						data: nameValuePair,
						cache: false,
						success: function(x) {
							$("#programMinor").html(x);
						}
					});
				});
				
				$("#schoolCore").change(function() {
					var schoolOrCollege = $(this).val();
					var nameValuePair = 'school='+ schoolOrCollege; //needs to be a name/value pair
					
					$.ajax({
						type: "post",
						url: "../searchByJob.php",
						data: nameValuePair,
						cache: false,
						success: function(x) {
							$("#programCore").html(x);
						}
					});
				});				
			});
		</script>
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
         <input type="submit" value="search" name="submit" />
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
	<div class="pageContentSubTitle">Alumni Profile Update Form</div><br />

<div id="formContent" class="formContent">

<form action="../index.php" method="post" class="mainForm">
	<input type="hidden" name="action" value="updateAccount" />
	<p>Please complete the update form below. Mandatory fields marked <em>*</em></p>
	<fieldset>
		<legend>Personal Inforation</legend>
		<ol>
       		<li><label for="alumniID">Alumni ID <em>*</em></label> <input name="alumni_id" id="alumniID" value="<?php echo $alumniId;?>" /></li>        	
       		<li><label for="first">First Name <em>*</em></label> <input name="first" id="first" value="<?php echo $firstname;?>" /></li>
			<li><label for="last">Last Name <em>*</em></label> <input name="last" id="last" value="<?php echo $lastname;?>" /></li>
			<li><label for="email">Email Address <em>*</em></label> <input name="email_address" id="email" /></li>
		</ol>
    </fieldset>
    
	<fieldset>
		<legend>Home/Permanent Address Information</legend>
		<ol>
			<li><label for="address">Address <em>*</em></label> <input name="address" id="address" /></li>
			<li><label for="city">City</label> <input name="city" id="city" /></li>
			<li><label for="state">State <em>*</em></label> <input name="state" id="state" /></li>
			<li><label for="zip">Zip Code <em>*</em></label> <input name="zip" id="zip" /></li>
            <li><label for="phone">Phone <em>*</em></label> <input name="phone" id="phone" /></li>
			<li>
				<fieldset>
					<legend>Home Phone and Address Privacy? <em>*</em></legend>
					<label><input type="radio" name="homeAddressPrivacy" value="yes" /> Yes</label>
					<label><input type="radio" name="homeAddressPrivacy" value="no" /> No</label>
				</fieldset>
			</li>
		</ol>
	</fieldset>
    
    <fieldset>
    	<legend>Job Information</legend>
        <ol>
        	<li><label for="jobTitle">Job Title <em>*</em></label> <input name="job_title" id="jobTitle" /></li>
            <li><label for="employer">Employer <em>*</em></label> <input name="employer" id="employer" /></li>
        </ol>
     </fieldset>
    
	<fieldset>
		<legend>Business Mailing Information</legend>
		<ol>
			<li><label for="address2">Address <em>*</em></label> <input name="address2" id="address2" /></li>
			<li><label for="city2">City <em>*</em></label> <input name="city2" id="city2" /></li>
			<li><label for="state2">State <em>*</em></label> <input name="state2" id="state2" /></li>
			<li><label for="zip2">Zip Code <em>*</em></label> <input name="zip2" id="zip2" /></li>
            <li><label for="phone2">Phone <em>*</em></label> <input name="phone2" id="phone2" /></li>
			<li>
				<fieldset>
					<legend>Business Phone and Address Privacy? <em>*</em></legend>
					<label><input type="radio" name="busAddressPrivacy" value="yes" /> Yes</label>
					<label><input type="radio" name="busAddressPrivacy" value="no "/> No</label>
				</fieldset>
			</li>
		</ol>
	</fieldset>
    
    <fieldset>
		<legend>Degree Information</legend>
		<ol>
            <li><label for="schoolMajor">School (major) <em>*</em></label> 
            	<select id="schoolMajor" name="schoolMajor" />
                	<option value="SchoolOfBusiness">School of Business</option>
                	<option value="CollegeOfArtsAndSciences">College of Arts & Sciences</option>
                    <option value="SchoolOfArchitecture">School of Architecture</option>
                    <option value="SchoolOfEngineering">School of Engineering</option>
                    <option value="SchoolOfJusticeStudies">School of Justice Studies</option>
                    <option value="SchoolOfEducation">School of Education</option>
                </select>
                    
            </li>
            
            <li><label for="programMajor">Program (Major) <em>*</em></label>
            	<select id="programMajor" name="programMajor">
               	    
                </select>
            </li><br />
            
            <li><label for="schoolMinor">School (Minor) <em>*</em></label> 
            	<select id="schoolMinor" name="schoolMinor" />
                	<option value="SchoolOfBusiness">School of Business</option>
                	<option value="CollegeOfArtsAndSciences">College of Arts & Sciences</option>
                    <option value="SchoolOfArchitecture">School of Architecture</option>
                    <option value="SchoolOfEngineering">School of Engineering</option>
                    <option value="SchoolOfJusticeStudies">School of Justice Studies</option>
                    <option value="SchoolOfEducation">School of Education</option>
                </select>
                    
            </li>
            
            <li><label for="programMinor">Program (Minor) <em>*</em></label>
            	<select id="programMinor" name="programMinor">
               	    
                </select>
            </li><br />
            
            <li><label for="schoolCore">School (Core) <em>*</em></label> 
            	<select id="schoolCore" name="schoolCore" />
                	<option value="SchoolOfBusiness">School of Business</option>
                	<option value="CollegeOfArtsAndSciences">College of Arts & Sciences</option>
                    <option value="SchoolOfArchitecture">School of Architecture</option>
                    <option value="SchoolOfEngineering">School of Engineering</option>
                    <option value="SchoolOfJusticeStudies">School of Justice Studies</option>
                    <option value="SchoolOfEducation">School of Education</option>
                </select>
                    
            </li>
            
            <li><label for="programCore">Program (Core) <em>*</em></label>
            	<select id="programCore" name="programCore">
               	    
                </select>
            </li><br />            

            <li><label for="year">Graduation Year <em>*</em></label> <input name="year" id="year" /></li><br />

        </ol>
     </fieldset>
     
    
		<p><input type="button" value="Back"  onClick="parent.location='alumni_personal.php'" /> &nbsp;<input type="submit" value="Submit" name="submit" /></p>
</form>

  
</div>

<footer>&copy;Roger Williams University - 2013</footer>

</body>
</html>