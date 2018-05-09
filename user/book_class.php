<?php
	include 'includes/db.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
          case 'getAllBook' : getAllBook($conn);break;
    	}
}

function getAllBook($conn)
{
  $sql = "SELECT
                book_id,
                book_title,
                book_published_date,
                book_mrp,
                book_quantity,
                author_name,
                cat_name,
                pub_name
            FROM
                ".BOOK." AS B
            LEFT JOIN ".BOOK_CAT." AS C ON B.book_cat_id = C.cat_id 
            LEFT JOIN ".AUTHOR." AS A ON B.book_authid = A.author_id 
            LEFT JOIN ".PUBLISHER." AS P ON B.book_pubid = P.pub_id";


    $result = mysqli_query($conn, $sql); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $_SESSION['featureArr'] = $result;
}
?> 