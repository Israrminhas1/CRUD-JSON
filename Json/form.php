<?php
require('config.php');
include('includes/mynav.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Json/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="card">
<h3 style="text-align: center;" >Plot Details</h3>
<br>
     <form action="action.php" method="post">
  <div class="row justify-content-md-center">
 
    <div class="col-4"  >
    <h4 
    >Set Plot Details</h4>
    <label>Price</label>
         <input type="text" name="fPrice" class="form-control" />
	     <label>Row</label>
         <input type="text" name="szRow" class="form-control" /><br />
         <label>Plot</label>
         <input type="text" name="szPlot" class="form-control" /><br />
         <label>Lot</label>
         <input type="text" name="szLot" class="form-control" /><br />
         <label>Boundry Plot</label>
         <input type="text" name="boundaryPlot" class="form-control" /><br />
         <label>Corner Plot</label>
         <input type="text" name="cornerPlot" class="form-control" /><br />
         <label>Price with tax</label>
         <input type="text" name="PriceWithTax" class="form-control" /><br />
        
    </div>
    <div class="col">
    <h4 
    >Set Plot Coordinates</h4>
    <div class="row">
   
    <div class="col-4">
    
    <label>Latitude</label>
         <input type="text" name="szCentroidLatitude" class="form-control" /><br />
         <label>Longitude</label>
         <input type="text" name="szCentroidLongtitude" class="form-control" /><br />
         <label>CentroidNorthing</label>
         <input type="text" name="szCentroidNorthing" class="form-control" /><br />
         <label>CentroidEasting</label>
         <input type="text" name="szCentroidEasting" class="form-control" /><br />
         <label>NECornerLatitude</label>
         <input type="text" name="szNECornerLatitude" class="form-control" /><br />
    <label>NECornerLongitude</label>
         <input type="text" name="szNECornerLongitude" class="form-control" /><br />
         </div>
         <div class="col-4">
         <label>NWCornerLatitude</label>
         <input type="text" name="szNWCornerLatitude" class="form-control" /><br />
         <label>NWCornerLongitude</label>
         <input type="text" name="szNWCornerLongitude" class="form-control" /><br />
         <label>SECornerLatitude</label>
         <input type="text" name="szSECornerLatitude" class="form-control" /><br />
         <label>SECornerLongitude</label>
         <input type="text" name="szSECornerLongitude" class="form-control" /><br />
         <label>SWCornerLatitude</label>
         <input type="text" name="szSWCornerLatitude" class="form-control" /><br />
         <label>SWCornerLongitude</label>
         <input type="text" name="szSWCornerLongitude" class="form-control" /><br />
        
         
       
         </div>
         </div>
         
    </div>
    <div class="row justify-content-md-center">
        <div class="col-4"><button style="padding: 8px 40px 8px 40px" type='submit' class='btn btn-primary' name='add'>Add</button></div>
    </div>
    
  </div>
  </form>
  </div>
</div>


</body>
</html>