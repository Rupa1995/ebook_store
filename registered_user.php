<?php
  include 'includes/db.php';
  session_start();
  $u_name = $_POST['uname'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $u_password = $_POST['pwd'];
  $u_password_md5 = md5($u_password);
  $check_exist = "SELECT
                    user_name
                  FROM
                  ".LOGIN_TABLE."
                  WHERE
                  user_name = '$u_name'";
  $result_exist = mysqli_query($conn,$check_exist);
  $count = mysqli_num_rows($result_exist);              
  if($count>0)
  {
    $result = 0;
  }
  else
  {
    $sql_insert = "INSERT INTO 
                ".LOGIN_TABLE." 
                SET 
                user_name = '$u_name', 
                user_password = '$u_password_md5', 
                user_isactive = '1',
                first_tym_flag = '1',
                user_admin_flag = '0',
                user_lname = '$lname', 
                user_fname = '$fname'";           
    
    $result = mysqli_query($conn,$sql_insert);  
    $_SESSION['login_user'] = $u_name;
    $_SESSION['first_tym_flag'] = 1;
    $_SESSION['userID'] = mysqli_insert_id($conn);
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
                <b style="color:#03A1FF;">pustakalaya.ebook@gmail.com</b>
              </p>
              <p style="font-size:14px;"><strong>Username :</strong> '.$u_name.'</p>
              <p style="font-size:14px;"><strong>Password :</strong> '.$u_password.'</p>
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
    
    $email_send_result =  sendEmail($u_name, MAIL_FROM_ADDRESS, MAIL_FROM_NAME, 'User Registration', $mailContent);
    }
    
  echo json_encode(array('ebook' => array('inserted' => $result,'userName' => $u_name, 'pass' => $u_password)));
  
?>
