<?php
    include 'includes/db.php';
    include 'includes/function.php';
	session_start();
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
            case 'getBookList' : getBookList($conn);break;
            case 'getBookCatList' : getBookCatList($conn);break;
            case 'increaseQuan': increaseQuan($conn);break;
            case 'getBookLog': getBookLog($conn);break;
            case 'getBookDetailsList': getBookDetailsList($conn);break;
            case 'getBookDetails': getBookDetails($conn);break;
            case 'addBook': addBook($conn);break;
            case 'editBook': editBook($conn);break;
            case 'createAttributes': createAttributes($conn);break;
            case 'editAttributes' : editAttributes($conn);break;
            case 'getBookCatLog' : getBookCatLog($conn);break;
            case 'activateBookCat' : activateBookCat($conn);break;
            case 'deactivateBookCat' : deactivateBookCat($conn);break;
            case 'getAuthorList' : getAuthorList($conn);break;
            case 'getAuthorLog' : getAuthorLog($conn);break;
            case 'activateAuthor' : activateAuthor($conn);break;
            case 'deactivateAuthor' : deactivateAuthor($conn);break;
            case 'getPublisherList' : getPublisherList($conn);break;
            case 'getPublisherLog' : getPublisherLog($conn);break;
            case 'activatePublisher' : activatePublisher($conn);break;
            case 'deactivatePublisher' : deactivatePublisher($conn);break;
            case 'getOrderList' : getOrderList($conn);break;
            case 'getOrder': getOrder($conn); break;
    	}
    }

function getBookList($conn)
{
    $flag = $_POST['flag'];
    $offset = $_POST['offset'];
    $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";

    if($flag==0)
    {
        $cond = 'book_quantity == 0 AND cat_isactive = 1 AND author_isactive = 1 AND pub_isactive = 1';
    }
    else
    {
        $cond = 'book_quantity != 0 AND cat_isactive = 1 AND author_isactive = 1 AND pub_isactive = 1';
    }
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
            LEFT JOIN ".PUBLISHER." AS P ON B.book_pubid = P.pub_id 
            WHERE
                ".$cond." ".$limit;

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    echo json_encode(array('ebook' => array('book_info' => $result,'bookCountList'=>$rowcount)));        
}

function getBookCatList($conn)
{
    $flag = $_POST['flag'];
    $offset = $_POST['offset'];
    $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";

    $sql = "SELECT
                cat_id,
                cat_name,
                cat_isactive
            FROM
                ".BOOK_CAT."
            WHERE cat_isactive = ".$flag." ".$limit;

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    echo json_encode(array('ebook' => array('book_cat' => $result,'bookcatCountList'=>$rowcount)));            
}

function increaseQuan($conn)
{
    $quant = $_POST['new_quan'];
    $book_id = $_POST['book_id'];
    $log_data = $_POST['logData'];

    $sql = "UPDATE
            ".BOOK."
            SET
            book_quantity = '$quant'
            WHERE
            book_id = ".$book_id."";
    $result = mysqli_query($conn, $sql);

    $modified_user_id = $_SESSION['userID'];
    $add_qry = "INSERT INTO
                ".BOOK_LOG."
              SET
                modified_by = '$modified_user_id',
                bt_book_id  = '$book_id',
                modified_time = now(),
                log_data = '$log_data'";
    $result_log = mysqli_query($conn, $add_qry); 
    
    echo json_encode(array('ebook' => array('quant_chaned' => $result,'log_update'=>$result_log)));        
}  

function getBookLog($conn)
{
  $book_id = $_POST['book_id'];

  $sql = "SELECT 
             bt_log_id,
             bt_book_id,
             modified_time,
             log_data,
             concat(user_fname,' ', user_lname) as userName
          FROM 
          ".BOOK_LOG." AS L
          LEFT JOIN ".LOGIN_TABLE." AS U ON U.user_id = L.modified_by 
          WHERE L.bt_book_id ='$book_id'
          ORDER BY bt_log_id desc";

  $result = mysqli_query($conn, $sql);
  $result = mysqli_fetch_all($result,MYSQLI_ASSOC);

  echo json_encode(array('ebook' => array('logList' => $result)));        
}

function getBookDetailsList($conn)
{
    $sql_auth = "SELECT
                author_id,
                author_name
                FROM
                ".AUTHOR."
                WHERE author_isactive = 1";

    $result_auth = mysqli_query($conn, $sql_auth);
    $result_auth = mysqli_fetch_all($result_auth,MYSQLI_ASSOC);            

    $sql_pub = "SELECT
                pub_id,
                pub_name
                FROM
                ".PUBLISHER."
                WHERE pub_isactive = 1";

    $result_pub = mysqli_query($conn, $sql_pub);
    $result_pub = mysqli_fetch_all($result_pub,MYSQLI_ASSOC);            

    $sql_cat= "SELECT
                cat_id,
                cat_name
                FROM
                ".BOOK_CAT."
                WHERE cat_isactive = 1";

    $result_cat = mysqli_query($conn, $sql_cat);
    $result_cat = mysqli_fetch_all($result_cat,MYSQLI_ASSOC);            


    echo json_encode(array('ebook' => array('auth' => $result_auth,'pub' => $result_pub,'cat' => $result_cat)));        
}

function addBook($conn)
{
    $book_title = $_POST['book_title'];
    $book_price = $_POST['book_price'];
    $book_quant = $_POST['book_quant'];
    $book_auth = $_POST['book_auth'];
    $book_cat = $_POST['book_cat'];
    $book_pub = $_POST['book_pub'];
    $book_pub_date = $_POST['book_pub_date'];

    $target_dir = "../images/book_img/";
    $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) 
    {
      $uploaded = 1;
    } 
    else 
    {
      $uploaded = 0;
      $target_file = "Error";  
    }

    $sql_insert = "INSERT INTO 
                  ".BOOK." 
                  SET
                  book_title = '$book_title',
                  book_pubid = '$book_pub', 
                  book_authid = '$book_auth', 
                  book_cat_id  = '$book_cat', 
                  book_published_date = '$book_pub_date', 
                  book_mrp  = '$book_price',
                  book_quantity  = '$book_quant',
                  book_image = '$target_file'";

    $result_insert = mysqli_query($conn,$sql_insert); 

    echo json_encode(array('ebook' => array('inserted' => $result_insert)));
}

function getBookDetails($conn)
{
    $sql_auth = "SELECT
                author_id,
                author_name
                FROM
                ".AUTHOR."
                WHERE author_isactive = 1";

    $result_auth = mysqli_query($conn, $sql_auth);
    $result_auth = mysqli_fetch_all($result_auth,MYSQLI_ASSOC);            

    $sql_pub = "SELECT
                pub_id,
                pub_name
                FROM
                ".PUBLISHER."
                WHERE pub_isactive = 1";

    $result_pub = mysqli_query($conn, $sql_pub);
    $result_pub = mysqli_fetch_all($result_pub,MYSQLI_ASSOC);            

    $sql_cat= "SELECT
                cat_id,
                cat_name
                FROM
                ".BOOK_CAT."
                WHERE cat_isactive = 1";

    $result_cat = mysqli_query($conn, $sql_cat);
    $result_cat = mysqli_fetch_all($result_cat,MYSQLI_ASSOC); 

    $book_id = $_POST['book_id'];
    $sql = "SELECT
                book_id,
                book_title,
                book_published_date,
                book_mrp,
                book_quantity,
                book_image,
                author_id,
                author_name,
                cat_id,
                cat_name,
                pub_id,
                pub_name
            FROM
                ".BOOK." AS B
            LEFT JOIN ".BOOK_CAT." AS C ON B.book_cat_id = C.cat_id 
            LEFT JOIN ".AUTHOR." AS A ON B.book_authid = A.author_id 
            LEFT JOIN ".PUBLISHER." AS P ON B.book_pubid = P.pub_id 
            WHERE
                book_id = ".$book_id." AND cat_isactive = 1 AND author_isactive = 1 AND pub_isactive = 1";

    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);


    echo json_encode(array('ebook' => array('auth' => $result_auth,'pub' => $result_pub,'cat' => $result_cat,'book_info' => $result)));
}

function editBook($conn)
{
    $ebook_id = $_POST['ebook_id'];
    $ebook_title = $_POST['ebook_title'];
    $ebook_price = $_POST['ebook_price'];
    $ebook_quant = $_POST['ebook_quant'];
    $ebook_auth = $_POST['ebook_auth'];
    $ebook_cat = $_POST['ebook_cat'];
    $ebook_pub = $_POST['ebook_pub'];
    $ebook_pub_date = $_POST['ebook_pub_date'];
    $log_data = $_POST['logData'];
    
    $sql_update = "UPDATE
                    ".BOOK."
                  SET
                  book_title = '$ebook_title',
                  book_pubid = '$ebook_pub', 
                  book_authid = '$ebook_auth', 
                  book_cat_id  = '$ebook_cat', 
                  book_published_date = '$ebook_pub_date', 
                  book_mrp  = '$ebook_price',
                  book_quantity  = '$ebook_quant'
                  WHERE
                  book_id = ".$ebook_id."";

    $result_update = mysqli_query($conn,$sql_update); 
    
    $modified_user_id = $_SESSION['userID'];
    $add_qry = "INSERT INTO
                ".BOOK_LOG."
              SET
                modified_by = '$modified_user_id',
                bt_book_id  = '$ebook_id',
                modified_time = now(),
                log_data = '$log_data'";
    $result_log = mysqli_query($conn, $add_qry); 

    echo json_encode(array('ebook' => array('updated' => $result_update,'log_update'=>$result_log)));              
}

function createAttributes($conn)
{
    $type_val = $_POST['type_val'];
    $create_val = $_POST['name_type'];

    if($type_val == 1)
    {
        $check_exits = "SELECT 
                          pub_id 
                        FROM
                        ".PUBLISHER."
                        WHERE 
                        pub_name = '$create_val'";

        $sql = "INSERT INTO
                ".PUBLISHER."
                SET
                pub_name = '$create_val'";
    }
    elseif ($type_val == 2) 
    {
        $check_exits = "SELECT 
                          author_id 
                        FROM
                        ".AUTHOR."
                        WHERE 
                        author_name = '$create_val'";

        $sql = "INSERT INTO
                ".AUTHOR."
                SET
                author_name = '$create_val'";
    }
    else
    {
        $check_exits = "SELECT 
                          book_cat_id 
                        FROM
                        ".BOOK_CAT."
                        WHERE 
                        cat_name = '$create_val'";

        $sql = "INSERT INTO
                ".BOOK_CAT."
                SET
                cat_name = '$create_val'";
    }
    $result_exist = mysqli_query($conn,$check_exits);
    $count = mysqli_num_rows($result_exist);              
    if($count>0)
    {
      $result_insert = 0;
    }
    else
    {
      $result_insert = mysqli_query($conn, $sql);  
    }
    
    echo json_encode(array('ebook' => array('updated' => $result_insert)));
}


function editAttributes($conn)
{
    $type_val = $_POST['type_val'];
    $edit_value = $_POST['name_type'];
    $running_id = $_POST['running_id'];
    $log_data = $_POST['log_data'];
    $modified_user_id = $_SESSION['userID'];

    if($type_val == 1)
    {
        $sql = "UPDATE
                ".PUBLISHER."
                SET
                pub_name = '$edit_value'
                WHERE pub_id = ".$running_id."";

        $sql_log = "INSERT INTO
                    ".PUB_LOG."
                    SET
                    pt_pub_id = '$running_id',
                    modified_by  = '$modified_user_id',
                    modified_time = now(),
                    log_data = '$log_data'";
    }
    elseif ($type_val == 2) 
    {
        $sql = "UPDATE
                ".AUTHOR."
                SET
                author_name = '$edit_value'
                WHERE author_id = ".$running_id."";

        $sql_log = "INSERT INTO
                    ".AUTHOR_LOG."
                    SET
                    at_author_id = '$running_id',
                    modified_by  = '$modified_user_id',
                    modified_time = now(),
                    log_data = '$log_data'";        
    }
    else
    {
        $sql = "UPDATE
                ".BOOK_CAT."
                SET
                cat_name = '$edit_value'
                WHERE cat_id = ".$running_id."";

        $sql_log = "INSERT INTO
                    ".CAT_LOG."
                    SET
                    bc_cat_id = '$running_id',
                    modified_by  = '$modified_user_id',
                    modified_time = now(),
                    log_data = '$log_data'";        

    }

    $result_insert = mysqli_query($conn, $sql);
    $result_log_insert = mysqli_query($conn, $sql_log);
    echo json_encode(array('ebook' => array('updated' => $result_insert,'log_update'=>$result_log_insert)));
}

function getBookCatLog($conn)
{

    $cat_id = $_POST['cat_id'];

    $sql = "SELECT 
             bc_log_id,
             bc_cat_id,
             modified_time,
             log_data,
             concat(user_fname,' ', user_lname) as userName
          FROM 
          ".CAT_LOG." AS L
          LEFT JOIN ".LOGIN_TABLE." AS U ON U.user_id = L.modified_by 
          WHERE L.bc_cat_id ='$cat_id'
          ORDER BY bc_log_id desc";

  $result = mysqli_query($conn, $sql);
  $result = mysqli_fetch_all($result,MYSQLI_ASSOC);

  echo json_encode(array('ebook' => array('logList' => $result))); 
}

function deactivateBookCat($conn)
{
  $cat_id = $_POST['cat_id'];

  $sql = "UPDATE
        ".BOOK_CAT."
        SET 
          cat_isactive = 0
        WHERE 
          cat_id = ".$cat_id."";
  $result = mysqli_query($conn, $sql);

  $modified_user_id = $_SESSION['userID'];
  $log_data = '{"catStatus":{"Activate":"Deactivate"}}';

  $add_qry = "INSERT INTO
                ".CAT_LOG."
              SET
                modified_by = '$modified_user_id',
                bc_cat_id = '$cat_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry);              

  echo json_encode(array('ebook' => array('deactivate' => $result,'log_update'=>$result_log)));                  
}

function activateBookCat($conn)
{
  $cat_id = $_POST['cat_id'];

   $sql = "UPDATE
        ".BOOK_CAT."
        SET 
          cat_isactive = 1
        WHERE 
          cat_id = ".$cat_id."";
  $result = mysqli_query($conn, $sql);
  $log_data = '{"catStatus":{"Deactivate":"Activate"}}';
  
  $modified_user_id = $_SESSION['userID'];
  $add_qry = "INSERT INTO
                ".CAT_LOG."
              SET
                modified_by = '$modified_user_id',
                bc_cat_id = '$cat_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry); 

  echo json_encode(array('ebook' => array('activate' => $result,'log_update'=>$result_log)));               
}

function getAuthorList($conn)
{
    $flag = $_POST['flag'];
    $offset = $_POST['offset'];
    $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";

    $sql = "SELECT
                author_id,
                author_name,
                author_isactive
            FROM
                ".AUTHOR."
            WHERE author_isactive = ".$flag." ".$limit;

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    echo json_encode(array('ebook' => array('author' => $result,'authorCountList'=>$rowcount)));          
}

function getAuthorLog($conn)
{

    $author_id = $_POST['author_id'];

    $sql = "SELECT 
             at_log_id,
             at_author_id,
             modified_time,
             log_data,
             concat(user_fname,' ', user_lname) as userName
          FROM 
          ".AUTHOR_LOG." AS L
          LEFT JOIN ".LOGIN_TABLE." AS U ON U.user_id = L.modified_by 
          WHERE L.at_author_id ='$author_id'
          ORDER BY at_log_id desc";

  $result = mysqli_query($conn, $sql);
  $result = mysqli_fetch_all($result,MYSQLI_ASSOC);

  echo json_encode(array('ebook' => array('logList' => $result))); 
}

function deactivateAuthor($conn)
{
  $author_id = $_POST['author_id'];

  $sql = "UPDATE
        ".AUTHOR."
        SET 
          author_isactive = 0
        WHERE 
          author_id = ".$author_id."";
  $result = mysqli_query($conn, $sql);

  $modified_user_id = $_SESSION['userID'];
  $log_data = '{"catStatus":{"Activate":"Deactivate"}}';

  $add_qry = "INSERT INTO
                ".AUTHOR_LOG."
              SET
                modified_by = '$modified_user_id',
                at_author_id = '$author_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry);              

  echo json_encode(array('ebook' => array('deactivate' => $result,'log_update'=>$result_log)));                  
}

function activateAuthor($conn)
{
  $author_id = $_POST['author_id'];

   $sql = "UPDATE
        ".AUTHOR."
        SET 
          author_isactive = 1
        WHERE 
          author_id = ".$author_id."";
  $result = mysqli_query($conn, $sql);
  $log_data = '{"catStatus":{"Deactivate":"Activate"}}';
  
  $modified_user_id = $_SESSION['userID'];
  $add_qry = "INSERT INTO
                ".AUTHOR_LOG."
              SET
                modified_by = '$modified_user_id',
                at_author_id = '$author_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry); 

  echo json_encode(array('ebook' => array('activate' => $result,'log_update'=>$result_log)));               
}

function getPublisherList($conn)
{
    $flag = $_POST['flag'];
    $offset = $_POST['offset'];
    $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";

    $sql = "SELECT
                pub_id,
                pub_name,
                pub_isactive
            FROM
                ".PUBLISHER."
            WHERE pub_isactive = ".$flag." ".$limit;

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    echo json_encode(array('ebook' => array('publisher' => $result,'pubCountList'=>$rowcount)));          
}

function getPublisherLog($conn)
{

    $pub_id = $_POST['pub_id'];

    $sql = "SELECT 
             pt_log_id,
             pt_pub_id,
             modified_time,
             log_data,
             concat(user_fname,' ', user_lname) as userName
          FROM 
          ".PUB_LOG." AS L
          LEFT JOIN ".LOGIN_TABLE." AS U ON U.user_id = L.modified_by 
          WHERE L.pt_pub_id ='$pub_id'
          ORDER BY pt_log_id desc";

  $result = mysqli_query($conn, $sql);
  $result = mysqli_fetch_all($result,MYSQLI_ASSOC);

  echo json_encode(array('ebook' => array('logList' => $result))); 
}

function deactivatePublisher($conn)
{
  $pub_id = $_POST['pub_id'];

  $sql = "UPDATE
        ".PUBLISHER."
        SET 
          pub_isactive = 0
        WHERE 
          pub_id = ".$pub_id."";
  $result = mysqli_query($conn, $sql);

  $modified_user_id = $_SESSION['userID'];
  $log_data = '{"catStatus":{"Activate":"Deactivate"}}';

  $add_qry = "INSERT INTO
                ".PUB_LOG."
              SET
                modified_by = '$modified_user_id',
                pt_pub_id = '$pub_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry);              

  echo json_encode(array('ebook' => array('deactivate' => $result,'log_update'=>$result_log)));                  
}

function activatePublisher($conn)
{
  $pub_id = $_POST['pub_id'];

   $sql = "UPDATE
        ".PUBLISHER."
        SET 
          pub_isactive = 1
        WHERE 
          pub_id = ".$pub_id."";
  $result = mysqli_query($conn, $sql);
  $log_data = '{"catStatus":{"Deactivate":"Activate"}}';
  
  $modified_user_id = $_SESSION['userID'];
  $add_qry = "INSERT INTO
                ".PUB_LOG."
              SET
                modified_by = '$modified_user_id',
                pt_pub_id = '$pub_id',
                modified_time = now(),
                log_data = '$log_data'";
  $result_log = mysqli_query($conn, $add_qry); 

  echo json_encode(array('ebook' => array('activate' => $result,'log_update'=>$result_log)));               
}

function getOrderList($conn)
{
    $flag = $_POST['flag'];
    $offset = $_POST['offset'];
    $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";

    $sql = "SELECT 
                order_id,
                payment_id,
                order_time,
                order_by,
                oder_amt,
                order_name,
                concat(user_fname,' ', user_lname) as userName
            FROM 
                order_table 
            LEFT JOIN
                user_table ON order_by = user_id
            ORDER BY `order_table`.`order_time` DESC".$limit;


    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    echo json_encode(array('ebook' => array('order' => $result,'orderCountList'=>$rowcount)));        
}

function getOrder($conn)
{
    $order_id = $_POST['order_id'];
   
    $sql = "SELECT
                address_id,
                aorder_id,
                street1,
                street2,
                astate_id,
                acontry_id,
                region,
                city,
                zip,
                item_name,
                item_price,
                order_name,
                oder_amt,
                states.name AS state_name,
                countries.name AS country_name
            FROM
                address
            LEFT JOIN
                item_table ON aorder_id = item_order_id
            LEFT JOIN
                order_table ON aorder_id = order_id    
            LEFT JOIN
                states ON astate_id = states.id
            LEFT JOIN
                countries ON acontry_id = countries.id        
            WHERE
                item_order_id = ".$order_id." AND auser_id = 0";


    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    echo json_encode(array('ebook' => array('orderDetails' => $result)));        
}

?>  