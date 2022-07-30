<?php
require('config.php');
include('includes/mynav.php');

session_start();


$message1 = array("123"=>"Record Deleted Succesfully",
 "124"=>"Record Updated Successfully",
 "125"=>"Record Added Successfully",
 "126"=>"File Exists",
 "127"=>"No Record Added"
);
if (isset($_GET['status'])) {
    if (
        $_SERVER["REQUEST_METHOD"]
        == "GET"
    ) {
        $param = ["success", "warning", "danger", "primary", "light"];
        if (
            in_array($_GET['status'], $param)
            && array_key_exists($_GET['code'], $message1)
        ) {
            // show alert
            $code = $_GET['code'];
            echo "<div class = 'alert alert-$_GET[status]' role = 'alert'>
            $message1[$code]
            </div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="http://localhost/Json/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   
    <title>Document</title>
    <style>
        table.table-fit {
    width: auto !important;
    table-layout: auto !important;
}
table.table-fit thead th, table.table-fit tfoot th {
    width: auto !important;
}
table.table-fit tbody td, table.table-fit tfoot td {
    width: auto !important;
}
.scroll {
    max-height: 400px;
    overflow-y: auto;
}
th {
  cursor: pointer;
}
.table-sortable > thead > tr > th {
    cursor: pointer;
    position: relative;
}


    </style>
</head>
<body>

<div class="modal fade" id="viewModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style=" max-width: 900px;
    ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Plot Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <div id="googleMap" style="width:100%;height:400px;"></div>
          </div>
          <div class="col-md-4 scroll">
          <ol class="list-group list-group-numbered">
     
     <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='viewid' >
         
       </div>
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='viewuniqueid'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='fPrice'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szRow'>
        
       
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szPlot'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szLot'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szCentroidLatitude'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szCentroidLongtitude'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szCentroidNorthing'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szCentroidEasting'>
        
      
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szNECornerLatitude'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szNECornerLongitude'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szNWCornerLatitude'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szSECornerLatitude'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szSECornerLongitude'>
       
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szSWCornerLatitude'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='szSWCornerLongitude'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='boundaryPlot'>
        
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='cornerPlot'>
         
       <li class="list-group-item d-flex justify-content-between align-items-start">
       <div class="ms-2 me-auto" id='PriceWithTax'>
   </ol>
        </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </div>
      </div>
    </div>
    </div>
    </div>
  </div>
</div>
<!-- Bulk add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import csv</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="csv.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload" required>
  <button type='submit'  class="btn btn-primary" name="upload"><i class="bi bi-box-arrow-in-down"></i> Import csv</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- bulkdeleteModal -->
<div class="modal fade" id="bulkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="action.php?" method="post">
      <input type="hidden" name="id" id="bulkid" class="form-control"  /><br />
        <label for="" id="bulky">Are you sure you want to delete?</label>
      </div>
      <div class="modal-footer">
      <button type='submit' class='btn btn-danger' name='bulkdelete'><i class="bi bi-trash text-light"></i> Delete</button>
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</form>
      </div>
    </div>
  </div>
</div>
<div class="container my-4"> 
<div class="table-responsive">
<div class="table-container">
<button type="button"  style="float:right; margin:5px" class="add btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" >
<i class="bi bi-box-arrow-in-down"></i> Import csv 
</button>

<button type="button" onclick="ischeck()" style="float:right; margin:5px" class="bulk btn btn-danger"  data-bs-toggle="modal" data-bs-target="#bulkModal" >
<i class="bi bi-trash text-light"></i> Bulk Delete 
</button>
<input type="text" id="myInput" onkeyup="mySearch()" placeholder="Search table" title="Type">

<?php 

 if (isset($message))
 {
      echo $message;
?>

<table class="table table-sm" id="myTable">
  <thead class="table-light">
    <tr>
    <th  ><input type="checkbox" id="allcheck"  onclick="myFunction()"></th>
      <th scope="col" onclick="sortTable(1)" >ID</th>
      <th scope="col" onclick="sortTable(2)">price</th>
      <th scope="col" onclick="sortTable(3)">row</th>
      <th scope="col" onclick="sortTable(4)" >plot</th>
      <th scope="col" >lot</th>
      <th scope="col">latitude</th>
      <th scope="col">longitude</th>
      <th scope="col">boundary plot</th>
      <th scope="col"onclick="sortTable(9)">corner plot</th>
      <th scope="col"onclick="sortTable(10)">Price with tax</th>
      <th scope="col" >Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php foreach ($plots as $plot) { ?>
				<tr>
        <td><input type="checkbox" class="checkbox" data-id="<?php echo $plot->id; ?>"/></td>
					<td> <?= $plot->id; ?> </td>
					<td> <?= $plot->fPrice; ?> </td>
					<td> <?= $plot->szRow; ?> </td>
          <td> <?= $plot->szPlot; ?> </td>
          <td> <?= $plot->szLot; ?> </td>
          <td> <?= $plot->szCentroidLatitude; ?> </td>
          <td> <?= $plot->szCentroidLongtitude; ?> </td>
          <td> <?= $plot->boundaryPlot; ?> </td>
          <td> <?= $plot->cornerPlot; ?> </td>
          <td> <?= $plot->PriceWithTax; ?> </td>
          <td>
              <button type="button"  onclick="onDelete(<?php echo $plot->id; ?>)" class="delete btn btn-danger" data-id="<?php echo $plot->id; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" >
              <i class="bi bi-trash text-light"></i> Delete</button>
              <button type="button" onclick="onView(<?php echo $plot->id; ?>)" class="view btn btn-primary" data-id="<?php echo $plot->id; ?>" data-bs-toggle="modal" data-bs-target="#viewModal" >
             <i class="bi bi-eye"></i> View</button>
              <button type="button" onclick="onUpdate(<?php echo $plot->id; ?>)" class="edit btn btn-warning" data-id="<?php echo $plot->id; ?>" data-bs-toggle="modal" data-bs-target="#editModal" >
              <i class="bi bi-arrow-repeat"></i> Update</button>
          </td>
			</tr>
	<?php }
			 }
			 else
				{echo $message;}
	?>
   
  </tbody>
</table>
</div>
</div>
</div>

<script>
  //Search Filter
    function mySearch() {
     
        
  var input, filter, table, tr, td,td1,td2,td3, i, txtValue,value;
  value = document.getElementById("myselect");
 
   
    input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  //console.log(filter);
  for (i = 0; i < tr.length; i++) {
    //gets value of id from each table row
    
   td = tr[i].getElementsByTagName("td")[1];
   td1 = tr[i].getElementsByTagName("td")[2];
   td2 = tr[i].getElementsByTagName("td")[3];
   td3 = tr[i].getElementsByTagName("td")[4];
   console.log(tr[1].getElementsByTagName("td")[i].innerText);
    //if(tr[0].getElementsByTagName("th")[i].innerText=='ID')
    
    if (td) {
      
      if ( (td.innerHTML.toUpperCase().indexOf(filter) > -1) 
      || (td1.innerHTML.toUpperCase().indexOf(filter) > -1)
      || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) 
      || (td3.innerHTML.toUpperCase().indexOf(filter) > -1)  ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }     
  
  
  }
  

}

//marks all check if header checkbox is true
  function myFunction(){
      allcheck=document.getElementById('allcheck');
      mycheck=document.getElementsByClassName('checkbox');
      console.log(allcheck.checked);
      for(let i=0; i < mycheck.length; i++) {
        if(allcheck.checked==false){
          mycheck[i].checked=false;
        }else{
          mycheck[i].checked=true;
        }
     }
    }
    //collect all check box values 
 function ischeck(){
  
  check=document.getElementsByClassName('checkbox');
  butbulk = document.getElementsByClassName('bulk');
  let mychecks=[];
  let   bulkid=[];
  for(let i=0; i < check.length; i++) {
    
    
     if(check[i].checked==true){
      mychecks.push(check[i].checked);
      bulkid.push(check[i].getAttribute('data-id'));
      
     }
  }
  
    document.getElementById("bulkid").value=bulkid;
    console.log(document.getElementById("bulkid").value);
  console.log("mycheck",mychecks);
  console.log(bulkid);

 }
//sort table in asc or dsc
 function sortTable(n) {
  var table, rows, switching, i, x, y,a,b,c, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
//       if(n=='2')
//       {
//         c=x.innerHTML;
//         c=c.substr(2);
// console.log(c);

//       }
      if(!isNaN(x.innerHTML))
      {
        
      if (dir == "asc") {
       if (Number(x.innerHTML) > Number(y.innerHTML)) {
         //if so, mark as a switch and break the loop:
         shouldSwitch= true;
         break;
       }
     } else if (dir == "desc") {
       if (Number(x.innerHTML) < Number(y.innerHTML)) {
         //if so, mark as a switch and break the loop:
         shouldSwitch = true;
         break;
       }
     }
      }
      else{
     
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
       
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
//view data in modal
//expects one parameter as id from table
// get data from backend-cememter.json
   function onView(n){


  fetch('backend-cemetery.json', {cache: "reload"})
   .then(response => {
       return response.json();
   })
   .then(jsondata => {
     
       plots = jsondata;
    
     
       var i = plots.findIndex(p => p.id == n);
     

       
        document.getElementById("viewid").innerHTML="<h6>ID</h6>"+ plots[i]['id'];
        document.getElementById("viewuniqueid").innerHTML="<h6>szPlotIdUniqueKey</h6>"+ plots[i]['szPlotIdUniqueKey'];
        document.getElementById("fPrice").innerHTML="<h6>fPrice</h6>"+ plots[i]['fPrice'];
        document.getElementById("szRow").innerHTML="<h6>szRow</h6>"+ plots[i]['szRow'];
        document.getElementById("szPlot").innerHTML="<h6>szPlot</h6>"+ plots[i]['szPlot'];
        document.getElementById("szLot").innerHTML="<h6>szLot</h6>"+ plots[i]['szLot'];
        document.getElementById("szCentroidLatitude").innerHTML="<h6>szCentroidLatitude</h6>"+ plots[i]['szCentroidLatitude'];
        document.getElementById("szCentroidLongtitude").innerHTML="<h6>szCentroidLongtitude</h6>"+ plots[i]['szCentroidLongtitude'];
        document.getElementById("szCentroidNorthing").innerHTML="<h6>szCentroidNorthing</h6>"+ plots[i]['szCentroidNorthing'];
        document.getElementById("szCentroidEasting").innerHTML="<h6>szNECornerLatitude</h6>"+ plots[i]['szNECornerLatitude'];
        document.getElementById("szNECornerLatitude").innerHTML="<h6>szNECornerLongitude</h6>"+ plots[i]['szNECornerLongitude'];
        document.getElementById("szNECornerLongitude").innerHTML="<h6>szNWCornerLatitude</h6>"+ plots[i]['szNWCornerLatitude'];
        document.getElementById("szNWCornerLatitude").innerHTML="<h6>szNWCornerLongitude</h6>"+ plots[i]['szNWCornerLongitude'];
        document.getElementById("szSECornerLatitude").innerHTML="<h6>szSECornerLatitude</h6>"+ plots[i]['szSECornerLatitude'];
        document.getElementById("szSECornerLongitude").innerHTML="<h6>szSECornerLongitude</h6>"+ plots[i]['szSECornerLongitude'];
        document.getElementById("szSWCornerLatitude").innerHTML="<h6>szSWCornerLatitude</h6>"+ plots[i]['szSWCornerLatitude'];
        document.getElementById("szSWCornerLongitude").innerHTML="<h6>szSWCornerLongitude</h6>"+ plots[i]['szSWCornerLongitude'];
        document.getElementById("boundaryPlot").innerHTML="<h6>boundaryPlot</h6>"+ plots[i]['boundaryPlot'];
        document.getElementById("cornerPlot").innerHTML="<h6>cornerPlot</h6>"+ plots[i]['cornerPlot'];
        document.getElementById("PriceWithTax").innerHTML="<h6>PriceWithTax</h6>"+ plots[i]['PriceWithTax'];
        document.getElementById("szCentroidLatitude").value=plots[i]['szCentroidLatitude'];
        document.getElementById("szCentroidLongtitude").value=plots[i]['szCentroidLongtitude'];
  
       var lat= document.getElementById("szCentroidLatitude").value;
       var long=document.getElementById("szCentroidLongtitude").value;
       myMap(lat,long); 
   })
   .catch(function () {
       this.dataError = true;
   })
     
      }
  
//map function
        function myMap(lat,long) {
      if(!lat){
          lat=20;
          long=30;
      }
     
        
            var mapProp = {
                center: new google.maps.LatLng(lat, long),
                zoom: 15,
                
            };
           
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            
        }
        
    </script>




  <!-- update Modal -->


<div class="modal fade" id="editModal" style="max-width=500px" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style=" max-width: 1000px;
    ">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="action.php?" method="post">
      <div class="row justify-content-md-center">
 
 <div class="col-4"  >
 <h4 
 >Set Plot Details</h4>
      <input type="hidden" name="id" id="idEdit" class="form-control"  />
        <label for="idfPrice">fPrice</label>
        <input type="text" name="fPrice" id="idfPrice" class="form-control"  placeholder="Enter fPrice"/><br />
	     <label>Row</label>
         <input type="text" name="szRow" id="idszRow"  class="form-control" /><br />
         <label>Plot</label>
         <input type="text" name="szPlot" id="idszPlot"  class="form-control" /><br />
         <label>Lot</label>
         <input type="text" name="szLot" id="idszLot"  class="form-control" /><br />
         <label>Boundry Plot</label>
         <input type="text" name="boundaryPlot" id="idboundaryPlot" class="form-control"  /><br />
         <label>Corner Plot</label>
         <input type="text" name="cornerPlot" id="idcornerPlot" class="form-control" /><br />
         <label>Price with tax</label>
         <input type="text" name="PriceWithTax" id="idPriceWithTax" class="form-control" />
      </div>
      <div class="col">
    <h4 
    >Set Plot Coordinates</h4>
    <div class="row">
   
    <div class="col-6">
    
         <label>Latitude</label>
         <input type="text" name="szCentroidLatitude" id="idszCentroidLatitude"  class="form-control" /><br />
         <label>Longitude</label>
         <input type="text" name="szCentroidLongtitude" id="idszCentroidLongtitude"  class="form-control" /><br />
         <label>CentroidNorthing</label>
         <input type="text" name="szCentroidNorthing" id="idszCentroidNorthing"  class="form-control" /><br />
         <label>CentroidEasting</label>
         <input type="text" name="szCentroidEasting" id="idszCentroidEasting"  class="form-control" /><br />
         <label>NECornerLatitude</label>
         <input type="text" name="szNECornerLatitude" id="idszNECornerLatitude"  class="form-control" /><br />
         <label>NECornerLongitude</label>
         <input type="text" name="szNECornerLongitude" id="idszNECornerLongitude"  class="form-control" />
         </div>
         <div class="col-6">
         <label>NWCornerLatitude</label>
         <input type="text" name="szNWCornerLatitude" id="idszNWCornerLatitude"  class="form-control" /><br />
         <label>NWCornerLongitude</label>
         <input type="text" name="szNWCornerLongitude" id="idszNWCornerLongitude"  class="form-control" /><br />
         <label>SECornerLatitude</label>
         <input type="text" name="szSECornerLatitude" id="idszSECornerLatitude"  class="form-control"  /><br />
         <label>SECornerLongitude</label>
         <input type="text" name="szSECornerLongitude" id="idszSECornerLongitude"  class="form-control" /><br />
         <label>SWCornerLatitude</label>
         <input type="text" name="szSWCornerLatitude" id="idszSWCornerLatitude"  class="form-control" /><br />
         <label>SWCornerLongitude</label>
         <input type="text" name="szSWCornerLongitude" id="idszSWCornerLongitude"  class="form-control" />
         </div>
         </div>       
    </div>
    </div>
     </div>
      <div class="modal-footer">
      <button type='submit' class='btn btn-warning' name='update-json'><i class="bi bi-arrow-repeat"></i> Update</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
      </form>
    </div>
  </div>
</div>
 <!-- delete -->
 <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Plot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="action.php?" method="post">
      <input type="hidden" name="id" id="iddelete" class="form-control"  /><br />
        <label for="">Are you sure you want to delete?</label>
        <div class="modal-footer">
        <button type='submit' class='btn btn-danger' name='deleteid'><i class="bi bi-trash text-light"></i> Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
      </div>    
     </form>
        </div>
      
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsJRm4ErL6mEk6C9BfCQ4UseL5SYH98jY&callback=myMap"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script>
  //update function in modal
function onUpdate(n)
{
// get data from backend-cememter.json
  fetch('backend-cemetery.json', {cache: "reload"})
   .then(response => {
       return response.json();
   })
   .then(json => {
     
       plots = json;
    
      
       console.log(plots);
       
       var i = plots.findIndex(p => p.id == n);
     
console.log(i);

        console.log("json",plots[i]);
        document.getElementById("idEdit").value=plots[i]['id'];
        document.getElementById("idfPrice").value=plots[i]['fPrice'];
        document.getElementById("idszRow").value=plots[i]['szRow'];
        document.getElementById("idszPlot").value=plots[i]['szPlot'];
        document.getElementById("idszLot").value=plots[i]['szLot'];
        document.getElementById("idszCentroidLatitude").value=plots[i]['szCentroidLatitude'];
        document.getElementById("idszCentroidLongtitude").value=plots[i]['szCentroidLongtitude'];
        document.getElementById("idszCentroidNorthing").value=plots[i]['szCentroidNorthing'];
        document.getElementById("idszCentroidEasting").value=plots[i]['szCentroidEasting'];
        document.getElementById("idszNECornerLatitude").value=plots[i]['szNECornerLatitude'];
        document.getElementById("idszNECornerLongitude").value=plots[i]['szNECornerLongitude'];
        document.getElementById("idszNWCornerLatitude").value=plots[i]['szNWCornerLatitude'];
        document.getElementById("idszNWCornerLongitude").value=plots[i]['szNWCornerLongitude'];
        document.getElementById("idszSECornerLatitude").value=plots[i]['szSECornerLatitude'];
        document.getElementById("idszSECornerLongitude").value=plots[i]['szSECornerLongitude'];
        document.getElementById("idszSWCornerLatitude").value=plots[i]['szSWCornerLatitude'];
        document.getElementById("idszSWCornerLongitude").value=plots[i]['szSWCornerLongitude'];
        document.getElementById("idboundaryPlot").value=plots[i]['boundaryPlot'];
        document.getElementById("idcornerPlot").value=plots[i]['cornerPlot'];
        document.getElementById("idPriceWithTax").value=plots[i]['PriceWithTax'];
        
      // console.log(plots[1]['id']);
       
   })
   .catch(function () {
       this.dataError = true;
   })
      
   

        // parse data

        // find item by id

        // put data in input fields
      }



  //delete function
  function onDelete(n){
console.log(n);
  fetch('backend-cemetery.json', {cache: "reload"})
   .then(response => {
       return response.json();
   })
   .then(json => {
     
       plots = json;
    
      
       console.log(plots);
       
       var i = plots.findIndex(p => p.id == n);
     
console.log("i",i);

     
       
       
        console.log("json",plots[i]);
        console.log("json",plots[i]['id']);
        document.getElementById("iddelete").value=plots[i]['id'];
        
      // console.log(plots[1]['id']);
       
   })
   .catch(function () {
       this.dataError = true;
   })
  }
//   function onDelete(id){ 
//           // fetch json
//           fetch("backend-cemetery.json")
// .then(response => {
//    return response.json();
// })
//  .then(jsondata => {

//   plots=jsondata
//   var i = plots.findIndex(p => p.id == id);
//         console.log("index",i);
//         console.log("this is id",plots[i]['id']);
//  } );

        // find index by id

         
      //document.getElementById("id").value=//value

        // put data in input fields
      

  //delete function
//   butdel = document.getElementsByClassName('delete');
// for(let i=0; i < butdel.length; i++) {
    
// butdel[i].addEventListener('click', function (e) {
// let   delid = butdel[i].getAttribute('data-id');
// console.log("butdel id",delid);
// // get data from backend-cememter.json
//   fetch('backend-cemetery.json', {cache: "reload"})
//    .then(response => {
//        return response.json();
//    })
//    .then(json => {
     
//        plots = json;
    
      
//        console.log(plots);
//        console.log(delid);
//        var i = plots.findIndex(p => p.id == delid);
     
// console.log(i);

     
       
       
//         console.log("json",plots[i]);
//         console.log("json",plots[i]['id']);
//         document.getElementById("iddelete").value=plots[i]['id'];
        
//       // console.log(plots[1]['id']);
       
//    })
//    .catch(function () {
//        this.dataError = true;
//    })
     
//       })
//   }
  //view
 
 
 
</script>
</body>
</html>