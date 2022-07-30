<?php
//$file = fopen("backend-cemetery.csv","r");
$name=basename($_FILES['fileToUpload']['name']);
$name1=explode('.',$name);
$target_path = "uploads/";
    $target_location = $target_path . basename($_FILES['fileToUpload']['name']);
if($name1[count($name1)-1]=='csv')
{if (file_exists($target_location)) {
   // header("location:index.php?status=success&code=126");
  
    unlink($target_location);
} 
    
   
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_location);
    $uploadedStatus = 1;
    if (($handle = fopen($target_location, 'r')) === false) {
        die('Error opening file');
    }
    
    $head = fgetcsv($handle, 1024, ',');
    $complete = array();
    $current_data = file_get_contents('backend-cemetery.json');
            $array_data = json_decode($current_data, true);
            
            
            //echo $array_data[0]['id'];
    while ($row = fgetcsv($handle, 1024, ',')) 
    {
            $complete = array_combine($head, $row);
            
            $id=$complete['id'];
       
        $key=array_search($id, array_column($array_data, 'id'));
        
        if(!empty($key) || $key===0)
        { 
        unset($complete);
        
        }
        else{
           
           
                $array_data[]  = $complete;
            
        }
}
//echo var_dump($array_data);
    
   
        //echo $complete['id'];
    fclose($handle);
   
    usort($array_data, function($a, $b) {
        return $a['id'] <=> $b['id'];
    });
    
           
            $final_data = json_encode($array_data);
          
            if(file_put_contents('backend-cemetery.json', $final_data))
            { if($final_data==$current_data){
                header("location:index.php?status=warning&code=127");
            }else{
                    header("location:index.php?status=success&code=125");
            }
               
            }
 }
        



?>