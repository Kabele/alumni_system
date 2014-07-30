<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

$path = getcwd();
$items = scandir($path);
$files = array();
foreach ($items as $item){
	$item_path = $path . DIRECTORY_SEPARATOR . $item;
	if(is_file($item_path)){
		$files[] = $item;
	}
}
echo "<h1>Files in $path</h1>";
echo "<ul>";
foreach ($files as $file){
	echo "<li>" . $file . "</li>";	
}
echo "</ul>";


/*$text = file_get_contents('mikeD/message.txt');
$text = htmlspecialchars($text);
echo '<div>' . $text . '<div>';

$text = "This is line1. \nThis is line 2. \n";
file_put_contents('mikeD/message.txt', $text);
*/
$name = file('message.txt');
foreach($name as $name){
	echo '<div>' . $name . '</div>';
}

?>


</body>
</html>