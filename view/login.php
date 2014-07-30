<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - Alumni Network</title>
<link href="styles_images/main.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div id="header" class="header">RWU Alumni Network</div>
<div id="topSearch" class="topSearch">
</div>
<br /><br />

<div id="loginContent" class="loginContent">

<form  action="../index.php" method="post">
	<input type="hidden" name="action" value="login" />
	<label>Username: <input type="text" name="username" /></label><br />
    <label>Password:&nbsp; <input type="password" name="password" /></label><br /><br />
    <input style="text-align:center;" type="submit" name="submit" value="Login">
</form> 

<div class="existingUser"><a href="alumni_register.php">Register</a>  |  <a href="forgotPassForm.php">Forgot Password</a></div>   

</div>

<footer>&copy; Roger Williams University - 2013</footer>

</body>
</html>