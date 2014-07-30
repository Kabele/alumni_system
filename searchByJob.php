<?php
require 'db_connect.php';

		$schoolOfStudies = $_POST['school'];
		
		$sql = "SELECT programOfStudy FROM school_programofstudies WHERE schoolOfStudy = '$schoolOfStudies' ORDER BY programOfStudy";
		
		$result = $db->query($sql);
		
		$school = $result->fetchAll();

		foreach ($school as $r){
			$job = $r['programOfStudy'];

			echo '<option value="'.$job.'">'.$job.'</option>';
		}


?>