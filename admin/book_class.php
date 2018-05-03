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
      
    	}
    }

function getBookList($conn)
{
    //$flag = $_POST['flag'];

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
                book_table AS B
            LEFT JOIN book_cat ON B.book_cat_id = book_cat.cat_id
            LEFT JOIN author_table ON B.book_authid = author_table.author_id
            LEFT JOIN pub_info ON B.book_pubid = pub_info.pub_id
            WHERE
                book_quantity != 0";

    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    foreach($result as $row) {
    echo $row['book_title'];
    }
    echo json_encode(array('ebook' => array('book_info' => $result,'bookCountList'=>$rowcount)));        
}    

?>  