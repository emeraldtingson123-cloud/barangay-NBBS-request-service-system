<?php 


include_once '../connection.php';

try{

  if(isset($_REQUEST['official_id'])){
    $official_id = $con->real_escape_string(trim($_REQUEST['official_id']));


    $sql = "SELECT official_end_information.*, official_end_status.* FROM official_end_information INNER JOIN official_end_status ON official_end_information.official_id = official_end_status.official_id WHERE official_end_information.official_id = ?";
    $stmt = $con->prepare($sql) or die ($con->error);
    $stmt->bind_param('s',$official_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    
    $official_id_end = $row['official_id'];
    $first_name = $row['first_name'];
    $middle_name = $row['middle_name'];
    $last_name = $row['last_name'];
    $suffix = $row['suffix'];
    $birth_date = $row['birth_date'];
    $birth_place = $row['birth_place'];
    $gender = $row['gender'];
    $age = $row['age'];
    $civil_status = $row['civil_status'];
    $religion = $row['religion'];
    $nationality = $row['nationality'];
    $municipality = $row['municipality'];
    $zip = $row['zip'];
    $barangay = $row['barangay'];
    $house_number = $row['house_number'];
    $street = $row['street'];
    $address = $row['address'];
    $email_address = $row['email_address'];
    $contact_number = $row['contact_number'];
    $fathers_name = $row['fathers_name'];
    $mothers_name = $row['mothers_name'];
    $guardian = $row['guardian'];
    $guardian_contact = $row['guardian_contact'];
    $image = $row['image'];
    $image_path = $row['image_path'];
    $position = $row['position'];
    $senior = $row['senior'];
    $term_from = $row['term_from'];
    $term_to = $row['term_to'];
    $pwd = $row['pwd'];
    $status = 'INACTIVE';
    $voters = $row['voters'];
    $pwd_info = $row['pwd_info'];
    $single_parent = $row['single_parent'];
    $date_undeleted = date("m/d/Y h:i A");



    $sql_position = "SELECT COUNT(position) AS total_position FROM official_status WHERE position = ?";
    $stmt_position = $con->prepare($sql_position) or die ($con->error);
    $stmt_position->bind_param('s',$position);
    $stmt_position->execute();
    $result_position = $stmt_position->get_result();
    $row_position = $result_position->fetch_assoc();

    $sql_check_position = "SELECT position_id, position_limit, position FROM position WHERE position_id = ?";
    $stmt_check_position = $con->prepare($sql_check_position) or die ($con->error);
    $stmt_check_position->bind_param('s',$position);
    $stmt_check_position->execute();
    $result_check_position = $stmt_check_position->get_result();
    $row_check_position = $result_check_position->fetch_assoc();
    $check_position = strtoupper($row_check_position['position']);

    if($row_position['total_position'] >= $row_check_position['position_limit']){
      exit('error');
    }





    $sql_insert = "INSERT INTO `official_information`
    (`official_id`,
     `first_name`, 
     `middle_name`, 
     `last_name`, 
     `gender`,
     `suffix`, 
     `birth_date`, 
     `birth_place`, 
     `age`, 
     `civil_status`, 
     `religion`, 
     `nationality`, 
     `municipality`, 
     `zip`, 
     `barangay`, 
     `house_number`, 
     `street`, 
     `address`, 
     `email_address`, 
     `contact_number`, 
     `fathers_name`, 
     `mothers_name`, 
     `guardian`, 
     `guardian_contact`, 
     `image`, 
     `image_path`
     ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt_insert = $con->prepare($sql_insert) or die ($con->error);
    $stmt_insert->bind_param('ssssssssssssssssssssssssss',
      $official_id_end,
      $first_name,
      $middle_name,
      $last_name,
      $gender,
      $suffix,
      $birth_date,
      $birth_place,
      $age,
      $civil_status,
      $religion,
      $nationality,
      $municipality,
      $zip,
      $barangay,
      $house_number,
      $street,
      $address,
      $email_address,
      $contact_number,
      $fathers_name,
      $mothers_name,
      $guardian,
      $guardian_contact,
      $image,
      $image_path
    );
    $stmt_insert->execute();
    $stmt_insert->close();


    $sql_official_end_status = "INSERT INTO `official_status` (`official_id`, `status`, `senior`,`voters`, `position`,`date_undeleted`, `term_from`, `term_to`, `pwd`,`pwd_info`,`single_parent`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt_official_end_status = $con->prepare($sql_official_end_status) or die ($con->error);
    $stmt_official_end_status->bind_param('sssssssssss',$official_id_end,$status,$senior,$voters,$position,$date_undeleted,$term_from,$term_to,$pwd,$pwd_info,$single_parent);
    $stmt_official_end_status->execute();
    $stmt_official_end_status->close();


    $sql_delete = "DELETE FROM official_end_information WHERE official_id = ?";
    $stmt_delete = $con->prepare($sql_delete) or die ($con->error);
    $stmt_delete->bind_param('s',$official_id_end);
    $stmt_delete->execute();
    $stmt_delete->close();


    $sql_delete_status = "DELETE FROM official_end_status WHERE official_id = ?";
    $stmt_delete_status = $con->prepare($sql_delete_status) or die ($con->error);
    $stmt_delete_status->bind_param('s',$official_id_end);
    $stmt_delete_status->execute();
    $stmt_delete_status->close();

    $date_activity = $now = date("j-n-Y g:i A");  
    $admin = strtoupper('ADMIN').':' .' '. 'UNDELETED OFFICIAL - '.' ' .$official_id.' | ' . $check_position .' - '.$first_name .' '. $last_name;
    $status_activity_log = 'delete';
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