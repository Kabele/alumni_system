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
<link href="main.css" type="text/css" rel="stylesheet" />
<link href="styles_images/main.css" type="text/css" rel="stylesheet" />
<title>RWU Alumni Network</title>
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

<div id="mainContent" class="mainContent">
    <p>Today</p><hr /> 
    
    <div id="pageTitle" class="pageTitle">Hello, <?php echo $firstname; ?> </div>
        
    <?php echo '<img src="/images/' . $alumniId . '.jpg" />'; ?>
        <p class="subTitle">Announcements</p>
		<div class="content">
        </div>

        <p class="subTitle">Current Weather Conditions</p>
            <div class="forecast" style="font-size:14px; font-weight:normal;">
            
                <?php
				/*
                  $json_string = file_get_contents("http://api.wunderground.com/api/60358aba42b6cfb3/geolookup/conditions/q/RI/Bristol.json");
                  $parsed_json = json_decode($json_string);
                  $city = $parsed_json->{'location'}->{'city'};
                  $state = $parsed_json->{'location'}->{'state'};
                  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
				  $wind = $parsed_json->{'current_observation'}->{'wind_mph'};
				  $visibility = $parsed_json->{'current_observation'}->{'visibility_mi'};
				  $dewPoint = $parsed_json->{'current_observation'}->{'dewpoint_f'};
				  $relHumidity = $parsed_json->{'current_observation'}->{'relative_humidity'};
				  echo "<div style='display:inline;'>
				  <img src='http://api.wunderground.com/api/60358aba42b6cfb3/animatedradar/q/RI/Bristol.gif?newmaps=1&timelabel=1&timelabel.y=10&num=5&delay=50&radius=4&noclutter=1'/>
				  </div>
                  <div class='forecast' style='padding-right:250px; float:right;'>
				  	<span style='font-size:14px; font-weight:bold;'>$city, $state</span></br></br>
				  	Temperature: $temp_f&deg;</br></br>
				 	Wind: $wind MPH</br></br>
				  	Visibility: $visibility miles</br></br>
				  	Dew Point: $dewPoint&deg;</br></br>
				  	Relative Humidity: $relHumidity
				  </div>";
                ?>
            </div>
            
        <p class="subTitle">Weather Forecast</p>
            <div class="forecast" style="font-size:14px; font-weight:normal;">
                <?php
                    $json = file_get_contents("http://api.wunderground.com/api/60358aba42b6cfb3/forecast/q/RI/Bristol.json");
                    $json = json_decode($json);
                
                    
            
                    foreach ($json->forecast->txt_forecast->forecastday as $day)
                    {
						echo "<div style='font-weight:bold;'>{$day->title}</br></div>"; 
                        echo "<img src='{$day->icon_url}'/>";
                        echo "<div>{$day->fcttext} </div>";
                        echo '</br>';
                    }
                    exit;
				*/	
                ?>
            
            </div>
	</div>

<footer>&copy; Roger Williams University 2013</footer>


</body>
</html>