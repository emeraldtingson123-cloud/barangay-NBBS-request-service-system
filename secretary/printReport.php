
<?php 

include_once '../connection.php';
session_start();

try{

  if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'secretary'){

    
    $sql_barangay_information = "SELECT * FROM `barangay_information`";
    $stmt_barangay_information = $con->prepare($sql_barangay_information) or die ($con->error);
    $stmt_barangay_information->execute();
    $result_barangay_information = $stmt_barangay_information->get_result();
    $row_barangay_information = $result_barangay_information->fetch_assoc();

    $whereClause = [];

    $table = '';
   
    if(isset($_REQUEST['status']) && $_REQUEST['status'] != ''){

     
       $whereClause[] = "status='".$_REQUEST['status']."'";

      } 

      if(isset($_REQUEST['single_parent']) && $_REQUEST['single_parent'] != ''){

     
        $whereClause[] = "single_parent='".$_REQUEST['single_parent']."'";
 
       } 
       
    if(isset($_REQUEST['voters']) && $_REQUEST['voters'] != ''){
      
      $whereClause[] = "voters='".$_REQUEST['voters']."'";
    }
       


    if(isset($_REQUEST['age']) && $_REQUEST['age'] != ''){
     
       $whereClause[] = "age='".$_REQUEST['age']."'";
    }
       

    if(isset($_REQUEST['pwd']) && $_REQUEST['pwd'] != ''){
      
      $whereClause[] = "pwd='".$_REQUEST['pwd']."'"; 
    }
      
     
    if(isset($_REQUEST['senior']) && $_REQUEST['senior'] != ''){
    
      $whereClause[] = "senior='".$_REQUEST['senior']."'";
    }
      
    
       $where = '';

      if(count($whereClause) > 0){
        $where .= ' AND '.implode(' AND ',$whereClause);
      }
      $order = 'ORDER BY last_name ASC';

      $sql_report = "SELECT residence_information.*, residence_status.* FROM residence_information 
        INNER JOIN residence_status ON residence_information.residence_id =  residence_status.residence_id WHERE archive = 'NO' ".$where.$order;
        $query_report = $con->query($sql_report) or die ($con->error);
        $count_report = $query_report->num_rows;
        $i = 1;
        $totalResident = number_format($count_report);



          while($row_report = $query_report->fetch_assoc()){

          


            $table .= '<tr>
                    <td style="border: 2px solid #000;">'.$i++.'</td>
                    <td style="border: 2px solid #000;">'.ucfirst($row_report['last_name']).' </td>
                    <td style="border: 2px solid #000;">'.ucfirst($row_report['first_name']).' </td>
                    <td style="border: 2px solid #000;">'.ucfirst($row_report['middle_name']).' </td>
                    <td style="border: 2px solid #000;">'.$row_report['age'].'</td>
                    <td style="border: 2px solid #000;">'.$row_report['pwd_info'].'</td>
                    <td style="border: 2px solid #000;">'.$row_report['single_parent'].'</td>
                    <td style="border: 2px solid #000;">'.$row_report['voters'].'</td>
                    <td style="border: 2px solid #000;">'.$row_report['status'].'</td>
                    <td style="border: 2px solid #000;">'.$row_report['senior'].'</td>
                </tr>';
            }

     





    
  
  }else{
   echo '<script>
          window.location.href = "../login.php";
        </script>';
  }

}catch(Exception $e){
  echo $e->getMessage();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

 
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

  <style>
      #barangay_logo{
      height: 150px;
      width:auto;
      max-width:500px;
    }
    #maynila{
      height: 150px;
      width:auto;
      max-width:500px;
    }
  </style>

</head>
<body class="hold-transition  sidebar-mini ">
 
<table width="80%" style="font-size:9pt;" class="table table-borderless">
          <tbody>
            <tr>
              <td class="text-center">
                <?php 
                
                if($row_barangay_information['image_path'] != '' || $row_barangay_information['image_path'] != null || !empty($row_barangay_information['image_path'])){
                    echo '<img alt="barangay_logo" src="'.$row_barangay_information['image_path'].'" class="img-circle"  id="barangay_logo">';
                }else{
                  echo '<img alt="barangay_logo" src="../assets/logo/blank.png" class="img-circle"  id="barangay_logo">';
                }
                
                ?>
                
              </td>
              <td class="text-center">
                <div style="font-size:10pt; font-weight: 800">
                  
                  <?= $row_barangay_information['barangay'].' '. $row_barangay_information['zone'].' '.$row_barangay_information['district'] ?><br>
                  <?= $row_barangay_information['address'];?>
                  <br>
                  Barangay Residence Report
              
                </div>
              </td>
              <td  class="text-center">
              <img alt="barangay_logo" src="../assets/logo/maynila.png" class="img-circle"  id="maynila">
               
                <br>
               
              </td>
            </tr>
          </tbody>
        </table>

                <div class="row">
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <b><label class="input-group-text bg-transparent" style="border: none; font-weight: 700;">VOTERS</label></b>
                      </div>
                      <input type="text" class="form-control" value="<?php if(isset($_REQUEST['voters'])) echo $_REQUEST['voters'] ?>"  style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                    </div>
                  </div>
                  
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent" style="border: none; font-weight: 700">AGE</span>
                      </div>
                          <input type="text" class="form-control" value="<?php if(isset($_REQUEST['age'])) echo $_REQUEST['age'] ?>" style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent" style="border: none; font-weight: 700">STATUS</span>
                      </div>
                      <input type="text" class="form-control" value="<?php if(isset($_REQUEST['status'])) echo $_REQUEST['status'] ?>" style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                    </div>
                  </div>
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent" style="border: none; font-weight: 700">PWD</span>
                      </div>
                      <input type="text" class="form-control" value="<?php if(isset($_REQUEST['pwd'])) echo $_REQUEST['pwd'] ?>" style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                    </div>
                  </div>
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent" style="border: none; font-weight: 700">SENIOR</span>
                      </div>
                      <input type="text" class="form-control" value="<?php if(isset($_REQUEST['senior'])) echo $_REQUEST['senior'] ?>" style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                    </div>
                  </div>
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent" style="border: none; font-weight: 700">SINGLE PARENT</span>
                      </div>
                      <input type="text" class="form-control" value="<?php if(isset($_REQUEST['single_parent'])) echo $_REQUEST['single_parent'] ?>" style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                    </div>
                  </div>
                  <div class="col-sm-4" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent" style="border: none; font-weight: 700">TOTAL</span>
                      </div>
                      <input type="text" class="form-control" value="<?= $totalResident ?>" style="border-top: none; border-right: none; border-left: none; border-bottom: 2px solid #000; "> 
                    </div>
                  </div>
                </div>

                  
                <table class="table table-sm " width="100%" style="border: 2px solid #000;">             
                  <thead >
                    <tr >
                    <th style="border: 2px solid #000;">No.</th>
                      <th style="border: 2px solid #000;">Last Name</th>
                      <th style="border: 2px solid #000;">First Name</th>
                      <th style="border: 2px solid #000;">Middle Name</th>
                      <th style="border: 2px solid #000;">Age</th>
                      <th style="border: 2px solid #000;">Pwd</th>
                      <th style="border: 2px solid #000;">Single Parent</th>
                      <th style="border: 2px solid #000;">Voters</th>
                      <th style="border: 2px solid #000;">Status</th>
                      <th style="border: 2px solid #000;">Senior</th>
                    </tr>
                  </thead>
                  <tbody style="border: 2px solid #000;">
                  <?= $table ?>
                  </tbody>
                </table>
 
 
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>


<script>
$(document).ready(function(){
  
   
    var printContents = $("body").html();
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;


     window.print();
     document.body.innerHTML = originalContents;
     setTimeout(function(){ 
             window.close();
  }, 5000);
  
})
</script>


</body>
</html>


              