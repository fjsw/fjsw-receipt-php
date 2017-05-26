<?php
require_once('receipt/receiptpay.php');
header("Content-Type:text/html;charset=utf-8");

$config = array(
	"appid" => $_POST["appid"],
	"appsecret" => $_POST["appsecret"],
	"urlapis" => $_POST["urlapis"]
);
// 发起公众号/服务窗支付
$receiptpay = new ReceiptPay($config);
if (!empty($_POST["subAppId"])) {
	$result = $receiptpay->payWxJsapi(
		$_POST["merchid"], $_POST["amount"], $_POST["subAppId"], 
		$_POST["subOpenId"], $_POST["orderId"], $_POST["orderInfo"], 
		$_POST["redirectUrl"], $_POST["remark"], $_POST["attach"]
	);
} else {
	$result = $receiptpay->payAliJsapi(
		$_POST["merchid"], $_POST["amount"], $_POST["userId"], 
		$_POST["orderId"], $_POST["orderInfo"], 
		$_POST["redirectUrl"], $_POST["remark"], $_POST["attach"]
	);
}
//var_dump($result);
$httpcode = $result['httpcode'];
if ($httpcode >=200 && $httpcode <=299) {
} else {
	echo "提交支付失败,".$result['body'];
	exit;
}
//
$body = json_decode($result["body"], true);
if (!empty($_POST["subAppId"])) {
	$wxjsapiStr = $body["response"]["wxjsapiStr"];
	echo "获得微信公众号支付参数:\n";
	echo json_encode(json_decode($wxjsapiStr, true), JSON_PRETTY_PRINT);
} else {
	$channelNo = $body["response"]["channelNo"];
	echo "获得支付宝服务窗支付渠道号:\n";
	echo $channelNo;
}
