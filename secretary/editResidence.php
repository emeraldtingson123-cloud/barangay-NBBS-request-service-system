<?php 


include_once '../connection.php';
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'secretary'){
  
  $user_id = $_SESSION['user_id'];
  $sql_user = "SELECT * FROM `users` WHERE `id` = ? ";
  $stmt_user = $con->prepare($sql_user) or die ($con->error);
  $stmt_user->bind_param('s',$user_id);
  $stmt_user->execute();
  $result_user = $stmt_user->get_result();
  $row_user = $result_user->fetch_assoc();
  $first_name_user = $row_user['first_name'];
  $last_name_user = $row_user['last_name'];
  $user_type = $row_user['user_type'];
  $user_image = $row_user['image'];


 


}else{
 echo '<script>
        window.location.href = "../login.php";
      </script>';
}

try{
  if(isset($_POST['edit_pwd_info'])){
    $edit_pwd_info = $con->real_escape_string($_POST['edit_pwd_info']);
  }else{
    $edit_pwd_info = '';
  }
  $edit_single_parent = $con->real_escape_string($_POST['edit_single_parent']);

$edit_residence_id = $con->real_escape_string(trim($_POST['edit_residence_id']));
$edit_voters = $con->real_escape_string($_POST['edit_voters']);
$edit_pwd = $con->real_escape_string($_POST['edit_pwd']);
$edit_first_name = $con->real_escape_string($_POST['edit_first_name']);
$edit_middle_name = $con->real_escape_string($_POST['edit_middle_name']);
$edit_last_name = $con->real_escape_string($_POST['edit_last_name']);
$edit_suffix = $con->real_escape_string($_POST['edit_suffix']);
$edit_gender = $con->real_escape_string($_POST['edit_gender']);
$edit_civil_status = $con->real_escape_string($_POST['edit_civil_status']);
$edit_religion = $con->real_escape_string($_POST['edit_religion']);
$edit_nationality = $con->real_escape_string($_POST['edit_nationality']);
$edit_contact_number = $con->real_escape_string($_POST['edit_contact_number']);
$edit_email_address = $con->real_escape_string($_POST['edit_email_address']);
$edit_address = $con->real_escape_string($_POST['edit_address']);
$edit_birth_date = $con->real_escape_string($_POST['edit_birth_date']);
$edit_birth_place = $con->real_escape_string($_POST['edit_birth_place']);
$edit_municipality = $con->real_escape_string($_POST['edit_municipality']);
$edit_zip = $con->real_escape_string($_POST['edit_zip']);
$edit_barangay = $con->real_escape_string($_POST['edit_barangay']);
$edit_house_number = $con->real_escape_string($_POST['edit_house_number']);
$edit_street = $con->real_escape_string($_POST['edit_street']);
$edit_fathers_name = $con->real_escape_string($_POST['edit_fathers_name']);
$edit_mothers_name = $con->real_escape_string($_POST['edit_mothers_name']);
$edit_guardian = $con->real_escape_string($_POST['edit_guardian']);
$edit_guardian_contact = $con->real_escape_string($_POST['edit_guardian_contact']);
$edit_image = $con->real_escape_string($_FILES['edit_image_residence']['name']);


$sql_check_resident = "SELECT residence_information.*, residence_status.* FROM residence_information 
INNER JOIN residence_status ON residence_information.residence_id = residence_status.residence_id WHERE residence_information.residence_id = ?";
$stmt_check_resident = $con->prepare($sql_check_resident) or die ($con->error);
$stmt_check_resident->bind_param('s',$edit_residence_id);
$stmt_check_resident->execute();
$result_check_resident = $stmt_check_resident->get_result();
$row_check_resident = $result_check_resident->fetch_assoc();



$old_first_name = $row_check_resident['first_name'];
$old_middle_name = $row_check_resident['middle_name'];
$old_last_name = $row_check_resident['last_name'];
$old_voters = $row_check_resident['voters'];
$old_pwd = $row_check_resident['pwd'];
$old_birth_date = $row_check_resident['birth_date'];
$old_birth_place = $row_check_resident['birth_place'];
$old_suffix = $row_check_resident['suffix'];
$old_gender = $row_check_resident['gender'];
$old_civil_status = $row_check_resident['civil_status'];
$old_religion = $row_check_resident['religion'];
$old_nationality = $row_check_resident['nationality'];
$old_municipality = $row_check_resident['municipality'];
$old_zip = $row_check_resident['zip'];
$old_barangay = $row_check_resident['barangay'];
$old_house_number = $row_check_resident['house_number'];
$old_street = $row_check_resident['street'];
$old_address = $row_check_resident['address'];
$old_email_address = $row_check_resident['email_address'];
$old_contact_number = $row_check_resident['contact_number'];
$old_fathers_name = $row_check_resident['fathers_name'];
$old_mothers_name = $row_check_resident['mothers_name'];
$old_guardian = $row_check_resident['guardian'];
$old_pwd_info = $row_check_resident['pwd_info'];
$old_single_parent = $row_check_resident['single_parent'];
$old_guardian_contact = $row_check_resident['guardian_contact'];










if(isset($edit_image)){

  $sql_check_image = "SELECT `image`, `image_path` FROM `residence_information`  WHERE `residence_id` = ?";
  $stmt_check_image = $con->prepare($sql_check_image) or die ($con->error);
  $stmt_check_image->bind_param('s',$edit_residence_id);
  $stmt_check_image->execute();
  $result_check_image = $stmt_check_image->get_result();
  $row_check_image = $result_check_image->fetch_assoc();
  $image_path = $row_check_image['image_path'];

  $sql_check_image_user = "SELECT `image`, `image_path` FROM `users`  WHERE `id` = ?";
  $stmt_check_image_user = $con->prepare($sql_check_image_user) or die ($con->error);
  $stmt_check_image_user->bind_param('s',$edit_residence_id);
  $stmt_check_image_user->execute();
  $result_check_image_user = $stmt_check_image_user->get_result();
  $row_check_image_user = $result_check_image_user->fetch_assoc();
  $image_path_user = $row_check_image_user['image_path'];


  if($edit_image != '' || $edit_image != null || !empty($edit_image)){

    if($row_check_image['image'] != '' || $row_check_image['image'] != null || !empty($row_check_image['image'])){
      unlink($image_path);
    }

 


    $type = explode('.', $edit_image);
    $type = $type[count($type) - 1];
    $new_edit_image_name = uniqid(rand()) .'.'. $type;
    $new_edit_image_path = '../assets/dist/img/' . $new_edit_image_name;
    move_uploaded_file($_FILES['edit_image_residence']['tmp_name'], $new_edit_image_path);
    
  }else{
    $new_edit_image_name = $row_check_image['image'];
    $new_edit_image_path = $row_check_image['image_path'];
  }
}


$today = date("Y/m/d");
$age = date_diff(date_create($edit_birth_date), date_create($today));
$edit_age_date = $age->format("%y");

if($edit_age_date >= '60'){
  $senior = 'YES';
}else{
  $senior = 'NO';
}


$sql_edit_residence = "UPDATE `residence_information` SET 
`first_name`= ?,
`middle_name`= ?,
`last_name`= ?,
`age`= ?,
`suffix`= ?,
`gender`= ?,
`civil_status`= ?,
`religion`= ?,
`nationality`= ?,
`contact_number`= ?,
`email_address`= ?,
`address`= ?,
`birth_date`= ?,
`birth_place`= ?,
`municipality`= ?,
`zip`= ?,
`barangay`= ?,
`house_number`= ?,
`street`= ?,
`fathers_name`= ?,
`mothers_name`= ?,
`guardian`= ?,
`guardian_contact`= ?,
`image`= ?,
`image_path`= ? 
WHERE  `residence_id` = ? ";
$stmt_edit_residence = $con->prepare($sql_edit_residence) or die ($con->error);
$stmt_edit_residence->bind_param('ssssssssssssssssssssssssss',
    $edit_first_name,
    $edit_middle_name,
    $edit_last_name,
    $edit_age_date,
    $edit_suffix,
    $edit_gender,
    $edit_civil_status,
    $edit_religion,
    $edit_nationality,
    $edit_contact_number,
    $edit_email_address,
    $edit_address,
    $edit_birth_date,
    $edit_birth_place,
    $edit_municipality,
    $edit_zip,
    $edit_barangay,
    $edit_house_number,
    $edit_street,
    $edit_fathers_name,
    $edit_mothers_name,
    $edit_guardian,
    $edit_guardian_contact,
    $new_edit_image_name,
    $new_edit_image_path,
    $edit_residence_id
);

$stmt_edit_residence->execute();
$stmt_edit_residence->close();


$sql_edit_residence_status = "UPDATE `residence_status` SET `voters` = ?, `senior` = ?, `pwd` = ?, `pwd_info`= ? , `single_parent` = ? WHERE `residence_id` = ?";
$stmt_edit_residence_status = $con->prepare($sql_edit_residence_status) or die ($con->error);
$stmt_edit_residence_status->bind_param('ssssss',$edit_voters,$senior,$edit_pwd,$edit_pwd_info,$edit_single_parent,$edit_residence_id);
$stmt_edit_residence_status->execute();
$stmt_edit_residence_status->close();


$sql_edit_residence_users = "UPDATE `users` SET `first_name` = ?, `middle_name` = ?, `last_name` = ?, `contact_number` = ?, `image` = ?, `image_path`= ? WHERE `id` = ?";
$stmt_edit_residence_users = $con->prepare($sql_edit_residence_users) or die ($con->error);
$stmt_edit_residence_users->bind_param('sssssss',$edit_first_name,$edit_middle_name,$edit_last_name,$edit_contact_number,$new_edit_image_name,$new_edit_image_path,$edit_residence_id);
$stmt_edit_residence_users->execute();
$stmt_edit_residence_users->close();


if($_POST['edit_first_name_check'] == 'true' || $_POST['edit_first_name_check'] === TRUE){

  
  $date_activity = $now = date("j-n-Y g:i A");  
  $admin =  strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT FIRST NAME -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_first_name.' TO '. $edit_first_name;
  $status_activity_log = 'update';


  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_single_parent_check'] == 'true' || $_POST['edit_single_parent_check'] === TRUE){

  
  $date_activity = $now = date("j-n-Y g:i A");  
  $admin =  strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT SINGLE PARENT -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_single_parent.' TO '. $edit_single_parent;
  $status_activity_log = 'update';


  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_pwd_info_check'] == 'true' || $_POST['edit_pwd_info_check'] === TRUE){

  
  $date_activity = $now = date("j-n-Y g:i A");  
  $admin =  strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT PWD TYPE -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_pwd_info.' TO '. $edit_pwd_info;
  $status_activity_log = 'update';


  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_last_name_check'] == 'true' || $_POST['edit_last_name_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT LAST NAME -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_last_name.' TO '. $edit_last_name;
  $status_activity_log = 'update';


  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}







if($_POST['edit_voters_check'] == 'true' || $_POST['edit_voters_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT VOTERS -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_voters.' TO '. $edit_voters;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_pwd_check'] == 'true' || $_POST['edit_pwd_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT PWD -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_pwd.' TO '. $edit_pwd;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_birth_date_check'] == 'true' || $_POST['edit_birth_date_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT BIRTH DATE -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_birth_date.' TO '. $edit_birth_date;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_birth_place_check'] == 'true' || $_POST['edit_birth_place_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT BIRTH PLACE -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_birth_place.' TO '. $edit_birth_place;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_middle_name_check'] == 'true' || $_POST['edit_middle_name_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT MIDDLE NAME -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_middle_name.' TO '. $edit_middle_name;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_suffix_check'] == 'true' || $_POST['edit_suffix_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT SUFFIX -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_suffix.' TO '. $edit_suffix;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_gender_check'] == 'true' || $_POST['edit_gender_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT GENDER -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_gender.' TO '. $edit_gender;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_civil_status_check'] == 'true' || $_POST['edit_civil_status_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT CIVIL STATUS -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_civil_status.' TO '. $edit_civil_status;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_religion_check'] == 'true' || $_POST['edit_religion_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT  RELIGION -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_religion.' TO '. $edit_religion;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_nationality_check'] == 'true' || $_POST['edit_nationality_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT NATIONALITY -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_nationality.' TO '. $edit_nationality;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_municipality_check'] == 'true' || $_POST['edit_municipality_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT MUNICIPALITY -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_municipality.' TO '. $edit_municipality;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_zip_check'] == 'true' || $_POST['edit_zip_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT ZIP -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_zip.' TO '. $edit_zip;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_barangay_check'] == 'true' || $_POST['edit_barangay_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT BARANGAY -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_barangay.' TO '. $edit_barangay;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_house_number_check'] == 'true' || $_POST['edit_house_number_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT HOUSE NUMBER -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_house_number.' TO '. $edit_house_number;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_street_check'] == 'true' || $_POST['edit_street_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT STREET -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_street.' TO '. $edit_street;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_address_check'] == 'true' || $_POST['edit_address_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT ADDRESS -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_address.' TO '. $edit_address;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_email_address_check'] == 'true' || $_POST['edit_email_address_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT EMAIL ADDRESS -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_email_address.' TO '. $edit_email_address;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_contact_number_check'] == 'true' || $_POST['edit_contact_number_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT CONTACT NUMBER -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_contact_number.' TO '. $edit_contact_number;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_fathers_name_check'] == 'true' || $_POST['edit_fathers_name_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT FATHER NAME -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_fathers_name.' TO '. $edit_fathers_name;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}

if($_POST['edit_mothers_name_check'] == 'true' || $_POST['edit_mothers_name_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT MOTHER NAME -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_mothers_name.' TO '. $edit_mothers_name;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_guardian_check'] == 'true' || $_POST['edit_guardian_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT GUARDIAN -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_guardian.' TO '. $edit_guardian;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}


if($_POST['edit_guardian_contact_check'] == 'true' || $_POST['edit_guardian_contact_check'] === TRUE){


  $date_activity = $now = date("j-n-Y g:i A");  
  $admin = strtoupper('OFFICAL').': ' .$first_name_user.' '.$last_name_user. ' - ' .$user_id.' | '. 'UPDATED RESIDENT GUARDIAN CONTACT -'.' ' .$edit_residence_id.' |' .' '. ' FROM '.$old_guardian_contact.' TO '. $edit_guardian_contact;
  $status_activity_log = 'update';
  $sql_activity_log = "INSERT INTO activity_log (`message`,`date`,`status`)VALUES(?,?,?)";
  $stmt_activity_log = $con->prepare($sql_activity_log) or die ($con->error);
  $stmt_activity_log->bind_param('sss',$admin,$date_activity,$status_activity_log);
  $stmt_activity_log->execute();
  $stmt_activity_log->close();
  

}





}catch(Exception $e){
  echo $e->getMessage();
}





?>