<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register - Alumni Network</title>
<link href="styles_images/main.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div id="header" class="header">RWU Alumni Network</div>
<div id="topSearch" class="topSearch">
</div>
<br /><br />
<div class="regPageTitle">Roger Williams University Alumni Network</div><br />
	<div class="regPageSubTitle">Alumni Password Recovery Form</div><br />

<div class="existingUser"><a href="login.php">Already a Member?</a>  |  <a href="../alumni_register.php">Register</a></div> 

<div id="formContent" class="formContent">

<form action="../index.php" method="post" class="mainForm">
    <input type="hidden" name="action" value="forgotPassword" />
    <fieldset>
    	<legend class="regTitle">Account Information</legend>
        <ol>
            <li><label for="first">First Name:</label>&nbsp; <input type="text" name="first" id="first" /></li>
            <li><label for="last">Last Name:</label>&nbsp; <input type="text" name="last" id="last" /></li>            
            <li><label for="user">Username:</label> <input name="username" id="user" /></li>            
            <li><label for="email">E-mail Address:</label> <input name="emailAddress" id="email" /></li>
        </ol>
    </fieldset>
    
   
<!--    <fieldset>
    	<legend class="regTitle">Education Information</legend>
    	<label>Major: <input type="text" name="major" /></label><br />
        <label>Minor: <input type="text" name="minor" /></label><br />
        <label>Year of Graduation: <input type="text" name="yog" /></label><br />
    </fieldset>
    
    <fieldset>
    	<legend class="regTitle">Employer Information</legend>
    	<label>Employer: <input type="text" name="employer" /></label><br />
        <label>Title: <input type="text" name="title" /></label><br />
        <label>Address of Employer: <input type="text" name="employAddress" /></label><br />
        <label>City: <input type="text" name="employCity" /></label><br />
        <label>State: <input type="text" name="employState" /></label><br />
        <label>Zip Code: <input type="text" name="employZip" /></label><br />
        <label>Phone Number: <input type="text" name="employPhone" /></label><br />
    </fieldset>
     <br />-->
        <input class="register" type="submit" name="register" value="Send My Info" />
</form> 
  
</div>

<footer>&copy;Roger Williams University - 2013</footer>


</body>
</html>