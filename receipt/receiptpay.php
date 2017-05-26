<?php
require_once('protocol.php');

class ReceiptPay
{
	private $appid = "";
	private $protocol = null;
	
	public function __construct($config) {
		$this->appid = $config['appid'];
		$this->protocol = new GatewayProtocol($config);
	}
	
	public function payAuthcode($merchid, $amount, $authcode, 
	$shopid, $userid, $devid, $orderid, $orderinfo, $attach) {
		$params = array(
			'method' => 'receipt.scan.authcode',
			'merchid' => $merchid,
			'shopid' => $shopid,
			'userid' => $userid,
			'devid' => $devid,
			'amount' => $amount,
			'outTradeNo' => $orderid,
			'authcode' => $authcode,
			'orderinfo' => $orderinfo,
			'attach' => $attach
		);
		//
		return $this->protocol->callMethod($params);
	}
	
	public function payWxJsapi($merchid, $amount, $subAppId, $subOpenId, 
	$orderId, $orderInfo, $redirectUrl, $remark, $attach) {
		$params = array(
			'method' => 'receipt.scan.jsapi',
			'merchid' => $merchid,
			'tradeType' => 2,
			'amount' => $amount,
			'outTradeNo' => $orderId,
			'orderInfo' => $orderInfo,
			'subAppId' => $subAppId,
			'subOpenId' => $subOpenId,
			'redirectUrl' => $redirectUrl,
			'remark' => $remark,
			'attach' => $attach
		);
		//
		return $this->protocol->callMethod($params);
	}
	
	public function payAliJsapi($merchid, $amount, $userId, 
	$orderId, $orderInfo, $redirectUrl, $remark, $attach) {
		$params = array(
			'method' => 'receipt.scan.jsapi',
			'merchid' => $merchid,
			'tradeType' => 1,
			'amount' => $amount,
			'outTradeNo' => $orderId,
			'orderInfo' => $orderInfo,
			'userId' => $userId,
			'redirectUrl' => $redirectUrl,
			'remark' => $remark,
			'attach' => $attach
		);
		//
		return $this->protocol->callMethod($params);
	}
}
?>
