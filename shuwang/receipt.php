<?php
require_once('protocol.php');

class Receipt
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
}
?>
