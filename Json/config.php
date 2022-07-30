<?php
// $message = array("123"=>"Record Deleted Succesfully",
// "124"=>"Data Updated",
 
// );

if(file_exists('backend-cemetery.json'))
{
	$filename = 'backend-cemetery.json';
	$data = file_get_contents($filename); //data read from json file
	
	$plots = json_decode($data);  //decode a data

	 $message = "<h3 class='text-success'>JSON file data</h3>";
}else{
	 $message = "<h3 class='text-danger'>JSON file Not found</h3>";
}
?>