<?php
	include 'includes/db.php';
  include 'includes/function.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
        case 'getUserList' : getUserList($conn);break;
        case 'getUserLog' :  getUserLog($conn);break;
        case 'activateUser' :  activateUser($conn);break;
        case 'deactivateUser' :  deactivateUser($conn);break;
        case 'createUser' : createUser($conn);break;
    	}
  }

function getUserList($conn)
{
  $flag = $_POST['flag'];
  $offset = $_POST['offset'];
  $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";
  $sql ="
        SELECT
          user_id,
          user_name,
          if(`user_fname` is null ,'N/A',`user_fname`) AS `user_fname`,
          if(`user_lname` is null ,'N/A',`user_lname`) AS `user_lname`,  
          user_isactive,
          user_admin_flag AS admin_flag
        FROM
          ".LOGIN_TABLE."
        WHERE 
          user_isactive = '$flag'".$limit;
  $result = mysqli_query($conn, $sql);
  $rowcount=mysqli_num_rows($result);     
  $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
  
  echo json_encode(array('ebook' => array('user_info' => $result,'usersCountList'=>$rowcount)));

}

function getUserLog($conn)
{
  $user_id = $_POST['user_id'];

  $sql = "SELECT 
             user_log_id,
             user_id,
             modified_time,
             log_data,
             concat(user_fname,' ', user_lname) as userName
          FROM 
          ".USER_LOG." AS L
          LEFT JOIN ".LOGIN_TABLE." AS U ON U.user_id = L.modified_by 
          WHERE L.luser_id ='$user_id'
          ORDER BY user_log_id desc";
  $result = mysqli_query($conn, $sql);
  $result = mysqli_fetch_all($result,MYSQLI_ASSOC);

  echo json_encode(array('ebook' => array('logList' => $result)));        
}

function deactivateUser($conn)
{
  $user_id = $_POST['user_id'];

  $sql = "UPDATE
        ".LOGIN_TABLE."
        SET 
          user_isactive = 0
        WHERE 
          user_id = ".$user_id."";
  $result = mysqli_query($conn, $sql);

  $modified_user_id = $_SESSION['userID'];
  $log_data = '{"userStatus":{"Activate":"Deactivate"}}';

  $add_qry = "INSERT INTO
                ".USER_LOG."
              SET
                modified_by = '$modified_user_id',
                luser_id = '$user_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry);              

  echo json_encode(array('ebook' => array('deactivate' => $result,'log_update'=>$result_log)));                  
}

function activateUser($conn)
{
  $user_id = $_POST['user_id'];

   $sql = "UPDATE
        ".LOGIN_TABLE."
        SET 
          user_isactive = 1
        WHERE 
          user_id = ".$user_id."";
  $result = mysqli_query($conn, $sql);
  $log_data = '{"userStatus":{"Deactivate":"Activate"}}';
  
  $modified_user_id = $_SESSION['userID'];
  $add_qry = "INSERT INTO
                ".USER_LOG."
              SET
                modified_by = '$modified_user_id',
                luser_id = '$user_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry); 

  echo json_encode(array('ebook' => array('activate' => $result,'log_update'=>$result_log)));               
}

function createUser($conn)
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $emailId = $_POST['emailId'];
  $admin_flag = $_POST['admin_flag'];

  $sql_session = "SELECT
            concat(user_fname,' ', user_lname) as userName,
            user_name
            FROM
            ".LOGIN_TABLE."
            WHERE 
            user_id = ".$_SESSION['userID']."";

  $result = mysqli_query($conn, $sql_session); 
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $flname = $row['userName'];
  $uname = $row['user_name'];
  $value = mt_rand();
  $u_password = md5($value);

   $check_exist = "SELECT
                      user_name
                    FROM
                    ".LOGIN_TABLE."
                    WHERE
                    user_name = '$emailId'";
    $result_exist = mysqli_query($conn,$check_exist);
    $count = mysqli_num_rows($result_exist);              
    if($count>0)
    {
      $result_insert = 0;
    }
    else
    {
      $sql_insert = "INSERT INTO 
                  ".LOGIN_TABLE." 
                  SET
                  user_fname = '$fname',
                  user_lname = '$lname', 
                  user_name = '$emailId', 
                  user_password = '$u_password', 
                  user_isactive = '1', 
                  user_admin_flag = '$admin_flag'";
      $result_insert = mysqli_query($conn,$sql_insert);              
    }

    if($result_insert == true || $result_insert !=0)
    {
        $mailContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>BOOK - User Registration</title>
            </head>
            <body>
              <div style="width:100%;background:#F2F2F2;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#404D5E;overflow:hidden;line-height:18px;">
              <div style="width:570px;margin:15px 15px;background:#fff;padding:15px;border:solid 1px #EDEDED;overflow:hidden;">
              <div style="overflow:hidden;border-bottom:solid 1px #E0E0E0;padding-bottom:15px;margin-bottom:15px;">
              <div style="width:50%;float:left;overflow:hidden;">
                <img src="https://i.pinimg.com/originals/c4/fc/3d/c4fc3d8aaf399bdfcd7eb9c8deb319dd.jpg" width="50" height="50" />
              </div>
              <div style="width:50%;float:left;overflow:hidden;"></div>
              </div>
            <div style="overflow:hidden;">                
              <p style="font-size:14px;">Dear Reader,</p>
              <p style="font-size:14px;">
              This email is to confirm that a new user has been created. If you have any queries please contact me, your administrator,
                <b style="color:#03A1FF;">'.$flname.' ('. $uname.')</b>
              </p>
              <p style="font-size:14px;"><strong>Username :</strong> '.$emailId.'</p>
              <p style="font-size:14px;"><strong>Password :</strong> '.$value.'</p>
              <p style="font-size:14px;margin:0;">Thank You for your business.</p>
              <br>
              <p style="font-size:14px;margin:0;">Thank You</p>
              <br>
              <br>
              <p style="color:#828282;margin:0;"><i><br>This notification was automatically generated. Please do not reply to this mail.</i></p>
            </div>
          </div>
        </div>
      </div>              
    </body>
  </html>';
    
    $email_send_result =  sendEmail($emailId, MAIL_FROM_ADDRESS, MAIL_FROM_NAME, 'User Registration', $mailContent);
    }

    if($email_send_result == 0)
    {   
      echo json_encode(array('valid' => $result_insert, 'mail_sent' => 0));
    }
    else
    {
      echo json_encode(array('valid' => $result_insert, 'mail_sent' => 1));
    }
}


?>	