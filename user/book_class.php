<?php
	include 'includes/db.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
          case 'getAllBook' : getAllBook($conn);break;
          case 'addToCart' : addToCart($conn);break;
          case 'addToWish' : addToWish($conn);break;
    	}
    }

function getAllBook($conn)
{
    $current_user = $_SESSION['userID'];
    $sql = "SELECT
            book_id,
            book_title,
            book_published_date,
            book_mrp,
            book_quantity,
            author_name,
            book_image,
            cat_name,
            pub_name,
            if(book_wish_id  is null ,'' ,book_wish_id )AS wish_id,
          if(book_cart_id  is null ,'' ,book_cart_id )AS cart_id
        FROM
            book_table AS B
        LEFT JOIN book_cat AS C
        ON
            B.book_cat_id = C.cat_id
        LEFT JOIN author_table AS A
        ON
            B.book_authid = A.author_id
        LEFT JOIN pub_info AS P
        ON
            B.book_pubid = P.pub_id
        LEFT JOIN book_wish AS W
        ON
            B.book_id = W.bw_book_id AND W.bw_user_id = '$current_user'
        LEFT JOIN book_cart AS CA
        ON
            B.book_id = CA.bc_book_id AND CA.bc_user_id = '$current_user'";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $_SESSION['BookArr'] = $result;
    echo json_encode(array('ebook' => array('success' => true)));
}

function addToCart($conn)
{
    $current_user = $_SESSION['userID'];
    $book_id = $_POST['book_id'];

    $check_exist = "SELECT
                    bc_added_tym
                   FROM
                   ".CHART."
                   WHERE bc_book_id='$book_id' AND bc_user_id = '$current_user' ";
    $result_exist = mysqli_query($conn,$check_exist);
    $count = mysqli_num_rows($result_exist);              
    if($count>0)
    {
        $result = 0;
    }               
    else
    {
        $add_qry = "INSERT INTO
                    ".CHART."
                  SET
                    bc_book_id  = '$book_id',
                    bc_user_id  = '$current_user',
                    bc_added_tym  = now()";
        $result = mysqli_query($conn, $add_qry); 
    }
    echo json_encode(array('ebook' => array('inserted' => $result)));
}

function addToWish($conn)
{
    $current_user = $_SESSION['userID'];
    $book_id = $_POST['book_id'];

    $check_exist = "SELECT
                    bw_added_tym
                   FROM
                   ".WISHLIST."
                   WHERE bw_book_id='$book_id' AND bw_user_id = '$current_user' ";
    $result_exist = mysqli_query($conn,$check_exist);
    $count = mysqli_num_rows($result_exist);              
    if($count>0)
    {
        $result = 0;
    }               
    else
    {
        $add_qry = "INSERT INTO
                ".WISHLIST."
              SET
                bw_book_id  = '$book_id',
                bw_user_id  = '$current_user',
                bw_added_tym  = now()";
        $result = mysqli_query($conn, $add_qry);
    }
     
    
    echo json_encode(array('ebook' => array('inserted' => $result)));
}

?> 