<?php
function add_user($username, $password, $email, $fName, $lName, $address, $city, $state, $zip, $phone ) {
	global $db;
	$sql = "INSERT INTO alumni_user_info 
			(username, password, email_address, first, last, address, city, state, zip_code, phone)
			VALUES
			('$username', '$password', '$email', '$fName', '$lName', '$address', '$city', '$state', '$zip', '$phone')";
	
	$success = $db->exec($sql);	
	
	$alumniID = $db->lastInsertID();
	
	$addEduRec = "INSERT INTO alumni_education_info
						   (alumni_id, major, minor, core, year)
						   VALUES
						   ('$alumniID', '', '', '', '')";
	$addEduRedSuccess = $db->exec($addEduRec);
	
	$addEmployRec = "INSERT INTO alumni_employment_info
					 (alumni_id, job_title, employer, address, city, state, zip, phone)
					 VALUES
					 ('$alumniID', '', '', '', '', '', '', '')";
	$addEmployRecSuccess = $db->exec($addEmployRec);
	
	if($success){
		$success_message = "<p>$success user was added.</p>";
		return $success_message;
	}
	else{
		$error_message = $db->error;
		return $error_message;
	}
	

}


function check_login($username, $password){
	
	global $db;	

		$sql = "SELECT * FROM alumni_user_info
				WHERE username = '$username' AND password = '$password'";	
					
		$sth = $db->query($sql);	

		$row = $sth->fetch();
				
		return $row;
}


function change_password($user, $pass, $newPass){
	global $db;
	$sql = "UPDATE alumni_user_info
		    SET password = '$newPass'
			WHERE username = '$user' AND password = '$pass'";
				
	$success = $db->exec($sql);	
		
	if($success){
		$success_message = "<p>Password for $user was changed</p>";
		return $success_message;
	}
	else{
		$error_message = $db->error;
		return $error_message;
	}		
}

function change_username($user, $pass, $newUser){
	global $db;
	$sql = "UPDATE alumni_user_info
		    SET username = '$newUser'
			WHERE username = '$user' AND password = '$pass'";	
		
	try{	
	$success = $db->exec($sql);
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		display_db_error($error_message);
	}		
}

function update_personal($id, $first, $last, $email, $address, $city, $state, $zip, $phone){
	global $db;
	
	$sql = "UPDATE alumni_user_info
			SET first = '$first',  last = '$last', email_address = '$email', address = '$address', city = '$city', state = '$state', zip_code = '$zip', phone = '$phone'
			WHERE
			alumni_id = '$id'";	

	$success = $db->exec($sql);
	
	return $success;

}



function update_career($id, $job_title, $employer, $address2, $city2, $state2, $zip2, $phone2){
	global $db;
	$sql = "UPDATE alumni_employment_info
			SET job_title = '$job_title', employer = '$employer', address = '$address2', city = '$city2', state = '$state2', zip = '$zip2', phone = '$phone2'
			WHERE alumni_id = '$id'";

	$success = $db->exec($sql);
	
	return $success;
	
	

}

function update_education($id, $major, $minor, $core, $year){
	global $db;
	$sql = "UPDATE alumni_education_info
			SET major = '$major', minor = '$minor', core = '$core', year = '$year'
			WHERE alumni_id = '$id'";
			
	$success = $db->exec($sql);
	
	return $success;
}



?>