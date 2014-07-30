<?php
session_start();

require 'db_connect.php';
require 'model/account_functions.php';


$action = $_POST['action'];

switch ($action){
	case 'login':
		$username = $_POST['username'];
		$password = $_POST['password'];
		$submit = $_POST['submit'];

	/*	
		if(isset($_SESSION['username'])){
   			 echo "Users is already logged in";
		}
		
		if(!isset($_POST['username'], $_POST['password'])){
   			 echo "Please enter a valid username and password";
		}
		elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4){
    		echo "Incorrect Length for Username";
		}
		elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4){
   			echo "Incorrect Length for Password";
		}
		elseif (ctype_alnum($_POST['username']) != true){
   			echo "Username must be alpha numeric";
		}
		elseif (ctype_alnum($_POST['password']) != true){
	        echo "Password must be alpha numeric";
		}
		else{
			$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		}
	*/	
	
		$loginSuccess = check_login($username, $password);
		
		$firstName = $loginSuccess['first'];
		$lastName = $loginSuccess['last'];
		$username = $loginSuccess['username'];
		$alumniId = $loginSuccess['alumni_id'];

 				
		if(isset($loginSuccess['first'])){  
		   $_SESSION['first'] = $firstName;  
		   $_SESSION['last'] = $lastName;
		   $_SESSION['username'] = $username;
		   $_SESSION['alumni_id'] = $alumniId;
	    
		   header("Location: view/alumni_home2.php"); 
        } 
        else{ 
            echo "Login Failed";
        } 
		

break;

	case 'register':
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$email = $_POST['emailAddress'];
		$fName = $_POST['first'];
		$lName = $_POST['last'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$phone = $_POST['phone'];
		$submit = $_POST['register'];
		
			$registrationSuccess = add_user($user, $pass, $email, $fName, $lName, $address, $city, $state, $zip, $phone);
			
			if($registrationSuccess){
				header("Location: view/login.php");
			}
			else{
				echo $registrationSuccess;
			}
break;
	
	case 'changePassword':
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$newPass = $_POST['newPassword'];
		
		$changePassword = change_password($user, $pass, $newPass);
				
		if($changePassword){
			header("Location: view/alumni_personal.php");
		}
		else{
			echo "Change Password Failed<br>";
			echo "<a href='view/alumni_personal.php'>Back</a>";
		}

break;

	case 'changeUsername':
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$newUser = $_POST['newUsername'];
		
		$changeUsername = change_username($user, $pass, $newUser);
		
		if($changeUsername){
			echo "New username is $newUser";
			header("Location: view/alumni_personal.php");
		}
		else{
			echo "Change Username Failed<br>";
			echo "<a href='view/alumni_personal.php'>Back</a>";
		}
break;


	case 'updateAccount':
		$id = $_POST['alumni_id'];
		$first = $_POST['first'];
		$last = $_POST['last'];
		$email = $_POST['email_address'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$phone = $_POST['phone'];
		$job_title = $_POST['job_title'];
		$employer = $_POST['employer'];
		$address2 = $_POST['address2'];
		$city2 = $_POST['city2'];
		$state2 = $_POST['state2'];
		$zip2 = $_POST['zip2'];
		$phone2 = $_POST['phone2'];
		$major = $_POST['programMajor'];
		$minor = $_POST['programMinor'];
		$core = $_POST['programCore'];
		$year = $_POST['year'];
		
		$first = ucwords($first);
		$last = ucwords($last);
		$address = ucwords($address);
		$city = ucwords($city);
		$state = ucwords($state);
		$job_title = ucwords($job_title);
		$employer = ucwords($employer);
		$address2 = ucwords($address2);
		$city2 = ucwords($city2);
		$state2 = ucwords($state2);
		$programMajor = ucwords($programMajor);
		$programMinor = ucwords($programMinor);
		$programCore = ucwords($programCore);					
				
		$updatePersonal = update_personal($id, $first, $last, $email, $address, $city, $state, $zip, $phone);
				
		$updateCareer = update_career($id, $job_title, $employer, $address2, $city2, $state2, $zip2, $phone2);
				
		$updateEducation = update_education($id, $major, $minor, $core, $year);
		
		if($updateCareer || $updateEducation || $updatePersonal >= 1){
			header("Location: view/alumni_personal.php");
		}
		else{
			echo "Error updating profile";
		}
		
				
break;


		case 'directorySearch':
		
		$first = $_POST['first'];
		$last = $_POST['last'];
		
		include 'searchOutput.php';
		
break;
			
		case 'upload':
			$alumni_id = $_POST['alumni_id'];
			$tmp_name = $_FILES['file1']['tmp_name'];
			$path = getcwd() . DIRECTORY_SEPARATOR . 'images';
			$name = $path . DIRECTORY_SEPARATOR . $_FILES['file1']['name'];
			$success = move_uploaded_file($tmp_name, $name);
			$newName = $path . DIRECTORY_SEPARATOR . $alumni_id . ".jpg";
			if($success){
				if(file_exists($name)){
					$rename = rename($name, $newName);
				}
				else{
					$renameError = "Unable to rename file";
				}
				$uploadSuccessMessage = "$name . ' has been uploaded'";
				$css = "<link href='alumni/view/styles_images/main.css' type='text/css' rel='stylesheet' />";
				include 'view/includeUploadFile.php';
			}
			else{
				"unable to move image";
			}
			
			
			break;

		case 'forgotPassword':
		
		    mail('afitzhugh002@g.rwu.edu', 'test email', 'this is a test');

			$email = $_POST['emailAddress'];
			$username = $_POST['username'];
			$first = $_POST['first'];
			$last = $_POST['last'];
		
			$sql = "SELECT * FROM alumni_user_info
					WHERE first = '$first' AND last = '$last'";
			$result = $db->query($sql);
	
			$row = $result->fetch();
				
			$password = $row['password'];
		
			echo $email;
			
			$to = $email;
			$subject = $username . "Account Information";
			$txt = 'Username: ' . $username . '<br>Password: ' . $password;
			$headers = "From: webmaster@rwualumninetwork.com";
			
			$mail = mail($to,$subject,$txt,$headers);
			
			if($mail){
				include 'view/login.php';
				
				echo "Login Information Sent to " . $email;
			}
			else{
				echo "Login information not sent";
			}
			
	break;
		
	
}

?>
