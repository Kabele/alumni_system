<?php
	$userName = $_POST['frmUserName'];
	$tmpName = $_FILES['frmFileName']['tmp_name'];
	$path = getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
	
	
	$newName = $path . $userName . ".jpg";
	echo $newName;
	echo $tmpName;
	
	
	if(file_exists($newName)){
		echo "Already stored";
	}
	else{
		$success = move_uploaded_file($tmpName, $newName);
		if($success) echo "Nicely done";
	}
	var_dump($success);
?>



