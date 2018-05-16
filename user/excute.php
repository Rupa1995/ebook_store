<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", 1);// 1 = Display Error
ini_set('memory_limit', '-1');

require __DIR__  . '/vendor/autoload.php';
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential('AaSwVdIdC8JVs-1OsTIEjkRaftQepN0gpqxABD5gSOS45HTy_cYVbPrVaoCLVywrlWKto1AIP73nG3KN','ENEyK4A24zk_pWzhB7jnqn8uX-VQfETUvdpv52SfO4mA-6O1-YhZsT5DU6RD293rh42FTOhUi7AIpNmb')
    );

use PayPal\Api\Payment;
use PayPal\Api\Invoice;

if (isset($_GET['success']) && $_GET['success'] == 'true') {

    $paymentId = $_GET['paymentId'];
    $price = $_GET['amount'];
    //$payment = new \PayPal\Api\Payment();
    $payment = Payment::get($paymentId, $apiContext);
    $execution = new \PayPal\Api\PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);
    $transaction = new \PayPal\Api\Transaction();
    $amount = new \PayPal\Api\Amount();
    $details = new \PayPal\Api\Details();

    $amount->setCurrency('INR');
    $amount->setTotal($price);
    $transaction->setAmount($amount);
    $execution->addTransaction($transaction);

    try 
    {
        $result = $payment->execute($execution, $apiContext);
        try 
        {
            $payment->get($paymentId, $apiContext);
        } 
        catch (Exception $ex) {
            echo $ex;    
            exit(1);
        }
    } 
    catch (Exception $ex) 
    {
         echo $ex;       
        exit(1);
    } 
    $final_payment = json_decode($payment,true);
    $_SESSION['paymentArr'] = $final_payment;
    header("location: payment_success.php");
    //return $payment;
} 
else 
{
    header("location: payment_cancel.php");
    //echo "NOT success";    
    //exit;
}