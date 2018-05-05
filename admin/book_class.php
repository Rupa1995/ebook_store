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
    	}
    }

function getBookList($conn)
{
    $flag = $_POST['flag'];
    $offset = $_POST['offset'];
    $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";

    if($flag==0)
    {
        $cond = 'book_quantity == 0';
    }
    else
    {
        $cond = 'book_quantity != 0';
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
    $sql = "SELECT
                cat_id,
                cat_name
            FROM
                ".BOOK_CAT."";

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
                ".AUTHOR."";

    $result_auth = mysqli_query($conn, $sql_auth);
    $result_auth = mysqli_fetch_all($result_auth,MYSQLI_ASSOC);            

    $sql_pub = "SELECT
                pub_id,
                pub_name
                FROM
                ".PUBLISHER."";

    $result_pub = mysqli_query($conn, $sql_pub);
    $result_pub = mysqli_fetch_all($result_pub,MYSQLI_ASSOC);            

    $sql_cat= "SELECT
                cat_id,
                cat_name
                FROM
                ".BOOK_CAT."";

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


    $sql_insert = "INSERT INTO 
                  ".BOOK." 
                  SET
                  book_title = '$book_title',
                  book_pubid = '$book_pub', 
                  book_authid = '$book_auth', 
                  book_cat_id  = '$book_cat', 
                  book_published_date = '$book_pub_date', 
                  book_mrp  = '$book_price',
                  book_quantity  = '$book_quant'";

    $result_insert = mysqli_query($conn,$sql_insert); 

    echo json_encode(array('ebook' => array('inserted' => $result_insert)));
}

function getBookDetails($conn)
{
    $sql_auth = "SELECT
                author_id,
                author_name
                FROM
                ".AUTHOR."";

    $result_auth = mysqli_query($conn, $sql_auth);
    $result_auth = mysqli_fetch_all($result_auth,MYSQLI_ASSOC);            

    $sql_pub = "SELECT
                pub_id,
                pub_name
                FROM
                ".PUBLISHER."";

    $result_pub = mysqli_query($conn, $sql_pub);
    $result_pub = mysqli_fetch_all($result_pub,MYSQLI_ASSOC);            

    $sql_cat= "SELECT
                cat_id,
                cat_name
                FROM
                ".BOOK_CAT."";

    $result_cat = mysqli_query($conn, $sql_cat);
    $result_cat = mysqli_fetch_all($result_cat,MYSQLI_ASSOC); 

    $book_id = $_POST['book_id'];
    $sql = "SELECT
                book_id,
                book_title,
                book_published_date,
                book_mrp,
                book_quantity,
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
                book_id = ".$book_id."";

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
        $sql = "INSERT INTO
                ".PUBLISHER."
                SET
                pub_name = '$create_val'";
    }
    elseif ($type_val == 2) 
    {
        $sql = "INSERT INTO
                ".AUTHOR."
                SET
                author_name = '$create_val'";
    }
    else
    {
        $sql = "INSERT INTO
                ".BOOK_CAT."
                SET
                cat_name = '$create_val'";
    }

    $result_insert = mysqli_query($conn, $sql);
    echo json_encode(array('ebook' => array('updated' => $result_insert)));
}

?>  