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
	<div class="regPageSubTitle">Alumni Registration Form</div><br />

<div class="existingUser"><a href="login.php">Already a Member?</a>  |  <a href="forgotPassForm.php">Forgot Password</a></div> 

<div id="formContent" class="formContent">

<form action="../index.php" method="post" class="mainForm">
    <fieldset>
    	<input type="hidden" name="action" value="register" />
            <legend class="regTitle">Personal Information</legend>
                <ol>  
                    <li><label for="first">First Name:</label> <input name="first" id="first" /></li>
                    <li><label for="last">Last Name:</label> <input name="last" id="last" /></li>
                    <li><label for="address">Address:</label> <input name="address" id="address" /></li>
                    <li><label for="city">City:</label> <input name="city" id="city" /></li>
                    <li><label for="state">State:</label>
                    <select name="state"  id="state" ></li>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select><br />
                   <li> <label for="zip">Zip Code:</label> <input name="zip" id="zip" /></li>
                    <li><label for="phone">Phone Number:</label> <input name="phone" id="phone" /></li>
                </ol>
     </fieldset>

    <fieldset>
    	<legend class="regTitle">Account Information</legend>
        <ol>
            <li><label for="user">Username:</label> <input name="username" id="user" /></li>
            <li><label for="pass">Password:</label>&nbsp; <input type="password" name="password" id="pass" /></li>
            <li><label for="retypepass">Re-type Password:</label> <input type="password" name="retypePassword" id="retypepass" /></li>
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
        <input class="register" type="submit" name="register" value="Register" />
</form> 
  
</div>

<footer>&copy;Roger Williams University - 2013</footer>


</body>
</html>