<?php
	include 'includes/db.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
          case 'getUserDetails' : getUserDetails($conn);break;
          case 'getStateList' : getStateList($conn);break;
          case 'updateUser' : updateUser($conn);break;
          case 'changePassword' : changePassword($conn);break;
          case 'other' : 
    	}
}
 
function getUserDetails($conn)
    {

        $getCountryList = "
                        SELECT
                            id,
                            name,
                            sortname,
                            phonecode
                        FROM
                          ".COUNTRY."";
        $countResult = mysqli_query($conn, $getCountryList);
        $countryList = mysqli_fetch_all($countResult,MYSQLI_ASSOC);

        $user_id = $_POST['user_id'];
        $getUserDetails = "
            SELECT
             A.user_id AS u_id, 
             A.user_admin_flag AS admin_flag,
             A.user_name AS uname,
             A.user_mobile AS contact,
             A.user_fname AS fname,
             A.user_lname AS lname,
             A.first_tym_flag AS first_tym_flag,
             B.street1 AS street1,
             B.street2 AS street2,
             B.astate_id AS state_id,
             B.acontry_id AS country_id,
             B.region AS region,
             B.zip AS pincode,
             B.city AS city
            FROM 
              ".LOGIN_TABLE." AS A 
            LEFT JOIN
              ".ADDRESS." AS B ON B.auser_id = A.user_id  
            WHERE 
              user_id = ".$user_id."";
       
        $userResult = mysqli_query($conn, $getUserDetails);
        $userDetails = mysqli_fetch_array($userResult,MYSQLI_ASSOC);                  

        echo json_encode(array('ebook' => array('user_info' => $userDetails,'country_info'=>$countryList)));
}

function getStateList($conn)
    {
        $c_code = $_POST['c_code'];
        $getStateList = "
                    SELECT
                        id,
                        name
                    FROM
                        ".STATE."
                    WHERE 
                        country_id =".$c_code."";

        $stateResult = mysqli_query($conn, $getStateList);
        $stateResult = mysqli_fetch_all($stateResult,MYSQLI_ASSOC);

         echo json_encode(array('ebook' => array('state_info' => $stateResult)));  
    }

function updateUser($conn)
  {
      $user_id = $_POST['user_id'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $street1 = $_POST['street1'];
      $street2 = $_POST['street2'];
      $region = $_POST['region'];
      $city = $_POST['city'];
      $country = $_POST['country'];
      $state = $_POST['state'];
      $zip = $_POST['zip'];
      $contact = $_POST['contact'];
      $logData = $_POST['logData'];

      $update_sql = "
                    UPDATE
                    ".LOGIN_TABLE."
                    SET 
                      user_fname = '$fname',
                      user_lname = '$lname',
                      user_mobile = '$contact',
                      first_tym_flag = '2'
                    WHERE
                      user_id = ".$user_id."";
      $updateResult = mysqli_query($conn, $update_sql);
      $_SESSION['first_tym_flag'] = 2;
      $check_adress_exist = "
                          SELECT
                          acontry_id
                          FROM
                          ".ADDRESS."
                          WHERE
                            auser_id = ".$user_id."";
      $result = mysqli_query($conn,$check_adress_exist);
      $count = mysqli_num_rows($result);

      if($count>1)
      {
        $add_sql = "
                    UPDATE
                    ".ADDRESS."
                    SET
                      street1 = '$street1',
                      street2 = '$street2',
                      astate_id = '$state',
                      acontry_id = '$country',
                      region = '$region',
                      zip = '$zip',
                      city = '$city'
                    WHERE
                      auser_id = ".$user_id.""; 
      }                      
      else
      {
        $add_sql = "
                    INSERT INTO
                    ".ADDRESS."
                    SET
                      street1 = '$street1',
                      street2 = '$street2',
                      astate_id = '$state',
                      acontry_id = '$country',
                      region = '$region',
                      zip = '$zip',
                      city = '$city',
                      auser_id = '$user_id'";  
      
      }
      $updateResult1 = mysqli_query($conn, $add_sql);

      if($logData != "" && $logData != null && $logData != undefined)
      {
      $modified_by = $_SESSION['userID'];  
      $update_sql2 = "
                    INSERT INTO 
                  ".USER_LOG." 
                SET 
                  modified_time = now(),  
                  modified_by = '$modified_by', 
                  log_data = '$logData'
                  luser_id ='$user_id'";  
      $updateResult2 = mysqli_query($conn, $update_sql2); 
      }
      echo json_encode(array('ebook' => array('updated' => 1,'user_update'=>$updateResult,'add_update'=>$updateResult1,'log_updated'=>$updateResult2)));                
  }    

function changePassword($conn)
{
  $user_id = $_POST['user_id'];
  $pass = $_POST['pass'];

  $pass = md5($pass);

  $update_sql = "UPDATE
              ".LOGIN_TABLE."
              SET
              user_password = '$pass',
              first_tym_flag = 1
              WHERE user_id = '$user_id'";
  $updateResult = mysqli_query($conn, $update_sql);
  echo json_encode(array('ebook' => array('updated' => 1,'user_update'=>$updateResult)));          
}


?>