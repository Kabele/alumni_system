<?php
function get_file_list($path){
	$files = array();
	if(!is_dir($path))	
	foreach($items as $item){
		$item_path = $path . DIRECTORY_SEPARATOR . $item;
		if(is_file($item_path)){
			$files[] = $item;
		}
	}
	return $files;
}

?>