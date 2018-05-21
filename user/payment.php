<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", 1);// 1 = Display Error
ini_set('memory_limit', '-1');

include 'includes/db.php';


function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = ENCRYPT_KEY;
    $secret_iv = 'pustakalaya';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
}

require __DIR__  . '/vendor/autoload.php';
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential('AaSwVdIdC8JVs-1OsTIEjkRaftQepN0gpqxABD5gSOS45HTy_cYVbPrVaoCLVywrlWKto1AIP73nG3KN','ENEyK4A24zk_pWzhB7jnqn8uX-VQfETUvdpv52SfO4mA-6O1-YhZsT5DU6RD293rh42FTOhUi7AIpNmb')
    );

$price = $_GET['amt'];
$encrypted_msg = $_GET['data_val'];
$decrypted_msg = my_simple_crypt($encrypted_msg,'d');

$splitData = explode("|||", $decrypted_msg);
$final_array = array_filter($splitData);

$name = [];
$prc = [];
$id = [];
$sum = 0;

for($i=0;$i<count($final_array);$i++)
{
    $temp = explode("^", $final_array[$i]);    
    array_push($id,$temp[0]);
    array_push($name,$temp[1]);
    array_push($prc,$temp[2]);
    $sum = $sum + $temp[2];
}

$list=[];
for($i=0;$i<count($final_array);$i++){
    
    $item = new \PayPal\Api\Item();
    $item->setName($name[$i])
            ->setCurrency('INR')
            ->setQuantity(1)
            ->setSku($id[$i])
            ->setPrice($prc[$i]);
    
    array_push($list,$item);
}

$details = new \PayPal\Api\Details(); 
$tax = round((TAXPER*$sum)/100,2);
$dis = round((DISCOUNTPER*$sum)/100,2);
$sip = $tax - $dis;

$details->setShipping($sip) 
        ->setTax(0) 
        ->setSubtotal($sum);

$itemList = new \PayPal\Api\ItemList(); 
$itemList->setItems($list);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');
$amount = new \PayPal\Api\Amount();
$amount->setTotal($price);
$amount->setCurrency('INR')
       ->setDetails($details);
$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)
            ->setItemList($itemList);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://library.com/user/excute.php?success=true&amount=$price")
              ->setCancelUrl("http://library.com/user/excute.php?success=false");
$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    //echo $payment;
    //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
   
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}
$approvalUrl = $payment->getApprovalLink();
header('Location: ' . $approvalUrl);