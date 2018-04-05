<?php 
	include 'db.php';

   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username_login']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password_login']); 
      
      $sql = "SELECT uname FROM register WHERE uname = '$myusername' and passwrd = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
       
         $_SESSION['login_user'] = $myusername;
         if($myusername == 'admin@gmail.com'){
         	header("location: /admin/home.php");
         }
         else{
         		header("location: index.php");
     		}
      }
      else {
         $error = "Your Login Name or Password is invalid";
         echo $error;
      }
   }
?> 
