<?php
	include 'includes/db.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
        	case 'getUserDetails' : getUserDetails($conn);break;
        	case 'other' : 
    	}
}
 function getUserDetails($conn)
	{

		$user_id = $_POST['user_id'];
	    $sql = "
            SELECT
             user_id AS u_id, 
             user_admin_flag AS admin_flag,
             user_name AS uname
            FROM 
              ".LOGIN_TABLE." 
            WHERE 
              user_id = ".$user_id."";
       
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		echo json_encode(array('ebook' => array('user_info' => $row)));
}

?>