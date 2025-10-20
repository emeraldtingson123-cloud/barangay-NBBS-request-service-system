<?php 

include_once '../connection.php';


try{

  $user_id = $con->real_escape_string($_POST['user_id']);

  $purpose = $con->real_escape_string($_POST['purpose']);

  date_default_timezone_set('Asia/Manila');
  $date = new DateTime();
  $uniqid = uniqid(mt_rand().$date->format("mdYHisv").rand());
  $date_issued = '';
  $date_expire = '';
  $status = 'PENDING';
  $date_request = $date->format("m/d/Y");

  $sql_residency = "INSERT INTO `certificate_request`(`id`, `residence_id`,  `purpose`, `date_request`,`date_issued`, `date_expired`, `status`) VALUES (?,?,?,?,?,?,?)";
  $stmt = $con->prepare($sql_residency) or die ($con->error);
  $stmt->bind_param('sssssss',$uniqid,$user_id,$purpose,$date_request,$date_issued,$date_expire,$status);
  $stmt->execute();
  $stmt->close();

  $sql_user = "SELECT first_name, last_name FROM users WHERE id = ?";
  $stmt_user = $con->prepare($sql_user) or die ($con->error);
  $stmt_user->bind_param('s',$user_id);
  $stmt_user->execute();
  $result_user = $stmt_user->get_result();
  $row_user = $result_user->fetch_assoc();
  $first_name = $row_user['first_name'];
  $last_name = $row_user['last_name'];
  $status_activity_log = 'create';

  $date_activity = $now = date("j-n-Y g:i A"); 
  $message =  'RESIDENT - '.$user_id. ': '.$first_name.' '. $last_name .' | '. 'REQUEST CERTIFICATE - '.strtoupper($purpose);
  $sql_system_logs= "INSERT INTO activity_log (`message`, `date`,`status`) VALUES (?,?,?)";
  $query_system_logs = $con->prepare($sql_system_logs) or die ($con->error);
  $query_system_logs->bind_param('sss',$message,$date_activity,$status_activity_log);
  $query_system_logs->execute();
  $query_system_logs->close();






}catch(Exception $e){
  echo $e->getMessage();
}





?>