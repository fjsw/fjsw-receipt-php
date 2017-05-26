<?php
require_once('receipt/receiptpay.php');
header("Content-Type:text/html;charset=utf-8");

$config = array(
	"appid" => $_POST["appid"],
	"appsecret" => $_POST["appsecret"],
	"urlapis" => $_POST["urlapis"]
);
// 发起授权码支付
$receiptpay = new ReceiptPay($config);
$result = $receiptpay->payAuthcode(
	$_POST["merchid"], $_POST["amount"], $_POST["authcode"], 
	$_POST["shopid"], $_POST["userid"], $_POST["devid"], 
	$_POST["orderid"], $_POST["orderinfo"], $_POST["attach"]
);
//
//var_dump($result);
$httpcode = $result['httpcode'];
if ($httpcode >=200 && $httpcode <=299) {
	echo "提交支付成功";
} else {
	echo "提交支付失败,".$result['body'];
}
