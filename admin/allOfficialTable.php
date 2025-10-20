<?php 

include_once '../connection.php';


try{


  $position = $con->real_escape_string($_REQUEST['position']);

  $whereClause = [];

  if(!empty($position))
    $whereClause[] = "official_status.position='".$position."'";

    $where = '';

    if(count($whereClause) > 0)
    $where .= ' WHERE ' .implode(' AND ', $whereClause);







  
  $sql = "SELECT  official_status.position, official_status.voters, official_status.status, official_status.pwd_info,official_status.single_parent, official_information.official_id, official_information.first_name, official_information.middle_name, official_information.last_name, official_information.first_name,
  image, official_information.image_path, position.color, position.position as official_position FROM official_status
  INNER JOIN official_information ON official_status.official_id = official_information.official_id
  INNER JOIN position ON official_status.position = position.position_id" .$where;
  if($_REQUEST['search']['value']){
    $sql .= " AND (first_name LIKE '%" . $_REQUEST['search']['value']. "%' ";
    $sql .= " OR last_name LIKE '%" . $_REQUEST['search']['value']. "%' ";
    $sql .= " OR official_information.official_id LIKE '%" . $_REQUEST['search']['value']. "%' ";
    $sql .= " OR status LIKE '%" . $_REQUEST['search']['value']. "%' )";
   
  }

  $stmt = $con->prepare($sql) or die ($con->error);
  $stmt->execute();
  $stmt->get_result();
  $totalData = $stmt->num_rows;




  if(isset($_REQUEST['order'])){
    $sql .= ' ORDER BY '.
    $_REQUEST['order']['0']['column'].
    ' '.
    $_REQUEST['order']['0']['dir'].
    ' ';
  }else{
    $sql .= ' ORDER BY position ASC ';
  }

  if($_REQUEST['length'] != -1){
    $sql .= ' LIMIT '.
    $_REQUEST['start'].
    ' ,'.
    $_REQUEST['length'].
    ' ';
  }

  $stmt = $con->prepare($sql) or die ($con->error);
  $stmt->execute();
  
  $result = $stmt->get_result();
  $data = [];


  while($row = $result->fetch_assoc()){
    if($row['image'] != '' || $row['image'] != null || !empty($row['image'])){
      $image = '<span style="cursor: pointer;" class="pop"><img src="'.$row['image_path'].'" alt="residence_image" class="img-circle" width="40"></span>';
    }else{
      $image = '<span style="cursor: pointer;" class="pop"><img src="../assets/dist/img/blank_image.png" alt="residence_image" class="img-circle"  width="40"></span>';
    }


    if($row['voters'] == 'YES'){
      $voters = '<span class="badge badge-success text-md">'.$row['voters'].'</span>';
    }else{
      $voters = '<span class="badge badge-danger text-md">'.$row['voters'].'</span>';
    }
  
  
    if($row['middle_name'] != ''){
      $middle_name = ucfirst($row['middle_name'])[0].'.';
    }else{
      $middle_name = '';
    }
    if($row['single_parent'] == 'YES'){
      $single_parent = '<span class="badge badge-info text-md ">'.$row['single_parent'].'</span>';
    }else{
      $single_parent = '<span class="badge badge-warning text-md ">'.$row['single_parent'].'</span>';
    }


    if($row['status'] == 'ACTIVE'){
      $status = '<label class="switch">
                      <input type="checkbox" class="editStatus" data-status="ACTIVE"  id="'.$row['official_id'].'"  checked>
                    <div class="slider round">
                      <span class="on ">ACTIVE</span>
                      <span class="off ">INACTIVE</span>
                    </div>
                </label>';
  }else{
      $status = '<label class="switch">
                      <input type="checkbox" class="editStatus" id="'.$row['official_id'].'" data-status="INACTIVE">
                    <div class="slider round">
                      <span class="off ">INACTIVE</span>
                      <span class="on ">ACTIVE</span>
                    </div>
                </label> ';
  }
  
    $subdata = [];
    $subdata[] = $image;
    $subdata[] = '<span class="badge" style="background-color: '.$row['color'].'">'.$row['official_position'].'</span>';
    $subdata[] = $row['official_id'];
    $subdata[] =  ucfirst($row['first_name']).' '. $middle_name .' '. ucfirst($row['last_name']); 
  
    $subdata[] = $row['pwd_info'];
    $subdata[] = $single_parent;
    $subdata[] = $voters;
    $subdata[] = $status;
    $subdata[] = '<a href="viewOfficial.php?request='.$row['official_id'].'" style="cursor: pointer;  color: yellow;  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" class="fa fa-user-edit text-lg px-3 "></a>
    <i style="cursor: pointer;  color: red;  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;" class="fa fa-times text-lg px-2 deleteOfficial" id="'.$row['official_id'].'"></i>';
    $data[] = $subdata;
  }


  $json_data = [
    'draw' => intval($_REQUEST['draw']),
    'recordsTotal' => intval($totalData),
    'recordsFiltered' => intval($totalData),
    'data' => $data,
    'total' => number_format($totalData),
  ];

  echo json_encode($json_data);


}catch(Exception $e){
  echo $e->getMessage();
}




?>