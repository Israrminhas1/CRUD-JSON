<?php
require('config.php');
include('includes/mynav.php');
session_start();
if(isset($_POST['add']))
{
    if(file_exists('backend-cemetery.json'))
    {$current_data = file_get_contents('backend-cemetery.json');
        $array_data = json_decode($current_data, true);
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$uniqueID= substr(str_shuffle($permitted_chars), 0, 10);
$a= end($array_data)['id'] +1;
echo $a;
        $extra = array(
            'id'               =>     $a,
                 'szPlotIdUniqueKey'          =>     $uniqueID,
                 'fPrice'          =>     $_POST["fPrice"],
                 'szRow'     =>     $_POST["szRow"],
                 'szPlot'     =>     $_POST["szPlot"],
                 'szLot'     =>     $_POST["szLot"],
                 'szCentroidLatitude'     =>     $_POST["szCentroidLatitude"],
                 'szCentroidLongtitude'     =>     $_POST["szCentroidLongtitude"],
                 'szCentroidNorthing'     =>     $_POST["szCentroidNorthing"],
                 'szCentroidEasting'     =>     $_POST["szCentroidEasting"],
                 'szNECornerLatitude'     =>     $_POST["szNECornerLatitude"],
                 'szNECornerLongitude'     =>     $_POST["szNECornerLongitude"],
                 'szNWCornerLatitude'     =>     $_POST["szNWCornerLatitude"],
                 'szNWCornerLongitude'     =>     $_POST["szNWCornerLongitude"],
                 'szSECornerLatitude'     =>     $_POST["szSECornerLatitude"],
                 'szSECornerLongitude'     =>     $_POST["szSECornerLongitude"],
                 'szSWCornerLatitude'     =>     $_POST["szSWCornerLatitude"],
                 'szSWCornerLongitude'     =>     $_POST["szSWCornerLongitude"],
                 'boundaryPlot'     =>     $_POST["boundaryPlot"],
                 'cornerPlot'     =>     $_POST["cornerPlot"],
                 'PriceWithTax'     =>     $_POST["PriceWithTax"]

        );
        $array_data[] = $extra;
        $final_data = json_encode($array_data);
         //$final_data=fileWriteAppend();
         if(file_put_contents('backend-cemetery.json', $final_data))
         {
            header("location:index.php?status=success&code=125");
         }
    }
    else
    {
         echo "file doesnt exists";
    
    }


}

if(isset($_POST['bulkdelete'])){
    if(empty($_POST['id'])){ 
        header("location:index.php");
    }
    else {
        $id = explode(',', $_POST['id']);
    
 
   
        $data = file_get_contents('backend-cemetery.json');
        $json_arr = json_decode($data,true);
        $length= count($id);
     
      for($i=0;$i<$length;$i++){
         $key=array_search($id[$i], array_column($json_arr, 'id'));
        
         unset($json_arr[$key]);
         $json_arr=array_values($json_arr);
        
        
      }
     
     
     
     // $out = array_values($json_arr);
     
     $finaldata = json_encode($json_arr);
     
     
     
     file_put_contents('backend-cemetery.json', $finaldata);
     header("location:index.php?status=danger&code=123");
    }
    

    
}
if(isset($_POST['deleteid']))
{ $id=$_POST['id'];
   echo $id;
   echo " iam here";
    // read json file
$data = file_get_contents('backend-cemetery.json');

// decode json to associative array

$json_arr = json_decode($data,true);

$key=array_search($id, array_column($json_arr, 'id'));
echo $key;


unset ($json_arr[$key]);


$out = array_values($json_arr);

$finaldata = json_encode($out);



file_put_contents('backend-cemetery.json', $finaldata);
header("location:index.php?status=danger&code=123");


}
#update json

if(isset($_POST['update-json'])){
    
$id=$_POST['id'];
echo $id;
$data = file_get_contents('backend-cemetery.json');

$json_arr = json_decode($data, true);
$key=array_search($id, array_column($json_arr, 'id'));

    
        
    $json_arr[$key]['fPrice'] = $_POST["fPrice"];
    $json_arr[$key]['szRow'] = $_POST["szRow"];
    $json_arr[$key]['szPlot'] = $_POST["szPlot"];
    $json_arr[$key]['szLot'] = $_POST["szLot"];
    $json_arr[$key]['szCentroidLatitude'] = $_POST["szCentroidLatitude"];
    $json_arr[$key]['szCentroidLongtitude'] = $_POST["szCentroidLongtitude"];
    $json_arr[$key]['szCentroidNorthing'] = $_POST["szCentroidNorthing"];
    $json_arr[$key]['szCentroidEasting'] = $_POST["szCentroidEasting"];
    $json_arr[$key]['szNECornerLatitude'] = $_POST["szNECornerLatitude"];
    $json_arr[$key]['szNECornerLongitude'] = $_POST["szNECornerLongitude"];
    $json_arr[$key]['szNWCornerLatitude'] = $_POST["szNWCornerLatitude"];
    $json_arr[$key]['szNWCornerLongitude'] = $_POST["szNWCornerLongitude"];
    $json_arr[$key]['szSECornerLatitude'] =  $_POST["szSECornerLatitude"];
    $json_arr[$key]['szSECornerLongitud'] = $_POST["szSECornerLongitude"];
    $json_arr[$key]['szSWCornerLatitude'] = $_POST["szSWCornerLatitude"];
    $json_arr[$key]['szSWCornerLongitude'] = $_POST["szSWCornerLongitude"];
    $json_arr[$key]['boundaryPlot'] =  $_POST["boundaryPlot"];
    $json_arr[$key]['cornerPlot'] = $_POST["cornerPlot"];
    $json_arr[$key]['PriceWithTax'] = $_POST["PriceWithTax"];
        // encode array to json and save to file
file_put_contents('backend-cemetery.json', json_encode($json_arr));
header("location:index.php?status=success&code=124");
    
}


  
?>