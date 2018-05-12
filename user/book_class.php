<?php
	include 'includes/db.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
          case 'addToCart' : addToCart($conn);break;
          case 'addToWish' : addToWish($conn);break;
          case 'getCartDetails' : getCartDetails($conn);break;
          case 'getWishlist' : getWishlist($conn);break;
          case 'removeEntry' : removeEntry($conn);break;
          case 'moveEntry' : moveEntry($conn);break;
    	}
    }

function addToCart($conn)
{
    $current_user = $_SESSION['userID'];
    $book_id = $_POST['book_id'];

    $check_exist = "SELECT
                    bc_added_tym
                   FROM
                   ".CART."
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
                    ".CART."
                  SET
                    bc_book_id  = '$book_id',
                    bc_user_id  = '$current_user',
                    bc_added_tym  = now()";

        $result = mysqli_query($conn, $add_qry); 

        $update_visit ="UPDATE 
                        ".BOOK." 
                       SET 
                        book_visitor= book_visitor+5; 
                       WHERE 
                       book_id = '$book_id'";

        $result_up = mysqli_query($conn, $update_visit);                        
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

        $update_visit ="UPDATE 
                        ".BOOK." 
                       SET 
                        book_visitor= book_visitor+2; 
                       WHERE 
                       book_id = '$book_id'";

        $result_up = mysqli_query($conn, $update_visit);
    }
     
    
    echo json_encode(array('ebook' => array('inserted' => $result)));
}

function getCartDetails($conn)
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
            if(book_cart_id  is null ,'' ,book_cart_id )AS cart_id
        FROM
            ".BOOK." AS B
        LEFT JOIN ".BOOK_CAT." AS C
        ON
            B.book_cat_id = C.cat_id
        LEFT JOIN ".AUTHOR." AS A
        ON
            B.book_authid = A.author_id
        LEFT JOIN ".PUBLISHER." AS P
        ON
            B.book_pubid = P.pub_id
        LEFT JOIN ".CART." AS CA
        ON
            B.book_id = CA.bc_book_id WHERE CA.bc_user_id = '$current_user' ORDER BY book_visitor DESC";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC); 

    echo json_encode(array('ebook' => array('cartinfo' => $result)));               
}

function getWishlist($conn)
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
            if(book_wish_id  is null ,'' ,book_wish_id )AS wish_id
        FROM
            ".BOOK." AS B
        LEFT JOIN ".BOOK_CAT." AS C
        ON
            B.book_cat_id = C.cat_id
        LEFT JOIN ".AUTHOR." AS A
        ON
            B.book_authid = A.author_id
        LEFT JOIN ".PUBLISHER." AS P
        ON
            B.book_pubid = P.pub_id
        LEFT JOIN ".WISHLIST." AS W
        ON
            B.book_id = W.bw_book_id WHERE W.bw_user_id = '$current_user' ORDER BY book_visitor DESC";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC); 

    echo json_encode(array('ebook' => array('wishlistinfo' => $result)));                      
}

function removeEntry($conn)
{
  $running_id= $_POST['running_id'];
  $type_val = $_POST['type_val'];

  if($type_val == 1)
  {
    $d_sql = "DELETE 
              FROM 
              ".CART." 
              WHERE 
              book_cart_id = $running_id;";

  }
  else
  {
    $d_sql = "DELETE 
              FROM 
              ".WISHLIST."
              WHERE 
              book_wish_id = $running_id;";
  }

  $result = mysqli_query($conn, $d_sql);
  echo json_encode(array('ebook' => array('removeEntry' => $result)));                      
}

function moveEntry($conn)
{
  $running_id= $_POST['running_id'];
  $current_user = $_SESSION['userID'];
  $type_val = $_POST['type_val'];

  if($type_val == 1)
  {
    $get = "SELECT 
            book_wish_id,
            bw_book_id,
            bw_user_id
            FROM
            ".WISHLIST."
            WHERE book_wish_id = $running_id";

    $result = mysqli_query($conn, $get);

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $bw_book_id = $row['bw_book_id'];
    $bw_user_id = $row['bw_user_id'];
    $book_wish_id = $row['book_wish_id'];
           
    $sql = "INSERT INTO
            ".CART."
            SET
            bc_book_id = '$bw_book_id',
            bc_user_id = '$bw_user_id',
            bc_added_tym = now()";

    $result_sql = mysqli_query($conn, $sql);

    $d_sql = "DELETE 
              FROM 
              ".WISHLIST."
              WHERE 
              book_wish_id = $book_wish_id";
  }
  else
  {
      $get = "SELECT 
            book_cart_id,
            bc_book_id,
            bc_user_id
            FROM
            ".CART."
            WHERE book_cart_id = $running_id";
   
    $result = mysqli_query($conn, $get);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    $bc_book_id = $row['bc_book_id'];
    $bc_user_id = $row['bc_user_id'];
    $book_cart_id = $row['book_cart_id'];
           
    $sql = "INSERT INTO
            ".WISHLIST."
            SET
            bw_book_id = '$bc_book_id',
            bw_user_id = '$bc_user_id',
            bw_added_tym = now()";
   
    $result_sql = mysqli_query($conn, $sql);        

    $d_sql = "DELETE 
              FROM 
              ".CART." 
              WHERE 
              book_cart_id = $book_cart_id";
  }

  $fresult = mysqli_query($conn, $d_sql);
  echo json_encode(array('ebook' => array('moveEntry' => $fresult)));

}

?> 