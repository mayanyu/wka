<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------

namespace Appapi\Controller;
use Common\Controller\HomebaseController; 
/**
 * 支付回调
 */
class PayController extends HomebaseController {
	
	private $wxDate = null;
	//支付宝 回调
	public function notify_ali() {

		require_once("./alipay/alipay_app/alipay.config.php");
		require_once("./alipay/alipay_app/lib/alipay_core.function.php");
		require_once("./alipay/alipay_app/lib/alipay_rsa.function.php");
		require_once("./alipay/alipay_app/lib/alipay_notify.class.php");

		//计算得出通知验证结果
		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		$this->logali("ali_data:".json_encode($_POST));
		if($verify_result) {//验证成功
			//商户订单号
			$out_trade_no = $_POST['out_trade_no'];
			//支付宝交易号
			$trade_no = $_POST['trade_no'];
			//交易状态
			$trade_status = $_POST['trade_status'];
			
			//交易金额
			$total_fee = $_POST['total_fee'];
			
			if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
					
				//注意：
				//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
				//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的

				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		
			}else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
					
				//注意：
				//付款完成后，支付宝系统发送该交易状态通知
				//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的

				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
	
				$orderinfo=M("users_charge")->where("orderno='{$out_trade_no}' and money='{$total_fee}' and status='0' and type='1'")->find();	
				$this->logali("orderinfo:".json_encode($orderinfo));	
				if($orderinfo){
					/* 更新会员虚拟币 */
					$coin=$orderinfo['coin']+$orderinfo['coin_give'];
					M("users")->where("id='{$orderinfo['touid']}'")->setInc("coin",$coin);
					/* 更新 订单状态 */
					M("users_charge")->where("id='{$orderinfo['id']}'")->save(array("status"=>1,"trade_no"=>$trade_no));


					//*****************代理渠道分成功能START*******************
					$uid=$orderinfo['touid'];//用户ID
					//根据用户ID获取用户的渠道ID和代理ID
					$upper=M("users")->where("id={$uid}")->getField("upper");
					$second_upper=M("users")->where("id={$uid}")->getField("second_upper");
					//获取代理的分成比例
					$secondUpperIncomePercent=M("users")->where("id={$second_upper}")->getField("income_percent");
					//获取渠道的分成比例
					$upperIncomePercent=M("users")->where("id={$upper}")->getField("income_percent");

					//如果代理设定了分成比例大于0，小于100
					if($secondUpperIncomePercent>0&&$secondUpperIncomePercent<=100){
						//获取充值用户的昵称
						$userLogin=M("users")->where("id={$uid}")->getField("user_nicename");

						$second_upperMoney=$total_fee*$secondUpperIncomePercent/100;//代理获得的分成金额

						//从代理获得的金额分成中计算渠道获得的分成
						$upperMoney=round($second_upperMoney*$upperIncomePercent/100,2);//渠道获得的分成金额[小数点后保留2位，四舍五入]

						//判断收益表中是否有代理的数据
						$second_upperIncome=M("users_incomes")->where("uid={$second_upper}")->find();

						if($second_upperIncome){//有数据存在

							//更新用户数据
							$now=time();
							$rs=M("users_incomes")->execute("update  __PREFIX__users_incomes set total_income=total_income+{$second_upperMoney},unsettled=unsettled+{$second_upperMoney},last_settle_time={$now} where uid={$second_upper}");
							

						}else{//插入一条数据
							$data=array(
								'uid'=>$second_upper,
								'total_income'=>$second_upperMoney,
								'unsettled'=>$second_upperMoney,
								'last_settle_time'=>time(),
							);

							$rs=M("users_incomes")->add($data);
						}

						//向用户收益详情表里加入代理数据
						if($rs!==false){
							$data1=array(
								'uid'=>$second_upper,
								'senduid'=>$uid,
								'senduser'=>$userLogin,
								'type'=>1,
								'percent'=>$secondUpperIncomePercent,
								'charge_money'=>$total_fee,
								'money'=>$second_upperMoney,
								'addtime'=>time()
							);

							M("users_income_lists")->add($data1);
						}

						$data=array();
						$data1=array();

						//判断收益表中是否有渠道的数据
						$upperIncome=M("users_incomes")->where("uid={$upper}")->find();

						if($upperIncome){//有数据存在

							//更新用户数据
							$now=time();
							$rs=M("users_incomes")->execute("update  __PREFIX__users_incomes set total_income=total_income+{$upperMoney},unsettled=unsettled+{$upperMoney},last_settle_time={$now} where uid={$upper}");

						}else{//插入一条数据

							$data=array(
								'uid'=>$upper,
								'total_income'=>$upperMoney,
								'unsettled'=>$upperMoney,
								'last_settle_time'=>time(),
							);

							$rs=M("users_incomes")->add($data);

						}

						//向用户收益详情表里加入渠道数据
						if($rs!==false){
							$data1=array(
								'uid'=>$upper,
								'senduid'=>$uid,
								'senduser'=>$userLogin,
								'type'=>1,
								'percent'=>$upperIncomePercent,
								'charge_money'=>$total_fee,
								'money'=>$upperMoney,
								'addtime'=>time()
							);

							M("users_income_lists")->add($data1);
						}



					}

					//*****************代理渠道分成功能END*******************


					$this->logali("成功");	
					echo "success";		//请不要修改或删除
					exit;
				}else{
					$this->logali("orderno:".$out_trade_no.' 订单信息不存在');		
				}											
			}
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

			echo "fail";		//请不要修改或删除
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}else {
			$this->logali("验证失败");		
			//验证失败
			echo "fail";

			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}			
		
	}
	/* 支付宝支付 */
	
	/* 微信支付start */		
	public function notify_wx(){
		$config=getConfigPri();

		//$xmlInfo = $GLOBALS['HTTP_RAW_POST_DATA'];

		$xmlInfo=file_get_contents("php://input"); 

		//解析xml
		$arrayInfo = $this -> xmlToArray($xmlInfo);
		$this -> wxDate = $arrayInfo;
		//$this -> logwx("wx_data:".json_encode($arrayInfo));//log打印保存
		if($arrayInfo['return_code'] == "SUCCESS"){
			if($return_msg != null){
				echo $this -> returnInfo("FAIL","签名失败");
				$this -> logwx("签名失败:".$sign);//log打印保存
				exit;
			}else{
				$wxSign = $arrayInfo['sign'];
				unset($arrayInfo['sign']);
				$arrayInfo['appid']  =  $config['wx_appid'];
				$arrayInfo['mch_id'] =  $config['wx_mchid'];
				$key =  $config['wx_key'];
				ksort($arrayInfo);//按照字典排序参数数组
				$sign = $this -> sign($arrayInfo,$key);//生成签名
				$this -> logwx("数据打印测试签名signmy:".$sign.":::微信sign:".$wxSign);//log打印保存
				if($this -> checkSign($wxSign,$sign)){
					echo $this -> returnInfo("SUCCESS","OK");
					$this -> logwx("签名验证结果成功:".$sign);//log打印保存
					$this -> orderServer();//订单处理业务逻辑
					exit;
				}else{
					echo $this -> returnInfo("FAIL","签名失败");
					$this -> logwx("签名验证结果失败:本地加密：".$sign.'：：：：：三方加密'.$wxSign);//log打印保存
					exit;
				}
			}
		}else{
			echo $this -> returnInfo("FAIL","签名失败");
			$this -> logwx($arrayInfo['return_code']);//log打印保存
			exit;
		}			
	}
	
	private function returnInfo($type,$msg){
		if($type == "SUCCESS"){
			return $returnXml = "<xml><return_code><![CDATA[{$type}]]></return_code></xml>";
		}else{
			return $returnXml = "<xml><return_code><![CDATA[{$type}]]></return_code><return_msg><![CDATA[{$msg}]]></return_msg></xml>";
		}
	}		
	
	//签名验证
	private function checkSign($sign1,$sign2){
		return trim($sign1) == trim($sign2);
	}
	/* 订单查询加值业务处理
	 * @param orderNum 订单号	   
	 */
	private function orderServer(){
		$info = $this -> wxDate;
		$this->logwx("info:".json_encode($info));
		$orderinfo=M("users_charge")->where("orderno='{$info['out_trade_no']}' and status='0' and type='2'")->find();
		//$this->logwx("sql:".M()->getLastSql());
		$this->logwx("orderinfo:".json_encode($orderinfo));
		if($orderinfo){
			/* 更新会员虚拟币 */
			$coin=$orderinfo['coin']+$orderinfo['coin_give'];
			M("users")->where("id='{$orderinfo['touid']}'")->setInc("coin",$coin);
			/* 更新 订单状态 */
			M("users_charge")->where("id='{$orderinfo['id']}'")->save(array("status"=>1,"trade_no"=>$info['transaction_id']));

			//*****************代理渠道分成功能START*******************
			$uid=$orderinfo['touid'];//用户ID
			$total_fee=$orderinfo['money'];//充值金額
			//根据用户ID获取用户的渠道ID和代理ID
			$upper=M("users")->where("id={$uid}")->getField("upper");
			$second_upper=M("users")->where("id={$uid}")->getField("second_upper");
			//获取代理的分成比例
			$secondUpperIncomePercent=M("users")->where("id={$second_upper}")->getField("income_percent");
			//获取渠道的分成比例
			$upperIncomePercent=M("users")->where("id={$upper}")->getField("income_percent");

			//如果代理设定了分成比例大于0，小于100
			if($secondUpperIncomePercent>0&&$secondUpperIncomePercent<=100){
				//获取充值用户的昵称
				$userLogin=M("users")->where("id={$uid}")->getField("user_nicename");

				$second_upperMoney=$total_fee*$secondUpperIncomePercent/100;//代理获得的分成金额

				//从代理获得的金额分成中计算渠道获得的分成
				$upperMoney=round($second_upperMoney*$upperIncomePercent/100,2);//渠道获得的分成金额[小数点后保留2位，四舍五入]

				//判断收益表中是否有代理的数据
				$second_upperIncome=M("users_incomes")->where("uid={$second_upper}")->find();

				if($second_upperIncome){//有数据存在

					//更新用户数据
					$now=time();
					$rs=M("users_incomes")->execute("update  __PREFIX__users_incomes set total_income=total_income+{$second_upperMoney},unsettled=unsettled+{$second_upperMoney},last_settle_time={$now} where uid={$second_upper}");
					

				}else{//插入一条数据
					$data=array(
						'uid'=>$second_upper,
						'total_income'=>$second_upperMoney,
						'unsettled'=>$second_upperMoney,
						'last_settle_time'=>time(),
					);

					$rs=M("users_incomes")->add($data);
				}

				//向用户收益详情表里加入代理数据
				if($rs!==false){
					$data1=array(
						'uid'=>$second_upper,
						'senduid'=>$uid,
						'senduser'=>$userLogin,
						'type'=>1,
						'percent'=>$secondUpperIncomePercent,
						'charge_money'=>$total_fee,
						'money'=>$second_upperMoney,
						'addtime'=>time()
					);

					M("users_income_lists")->add($data1);
				}

				$data=array();
				$data1=array();

				//判断收益表中是否有渠道的数据
				$upperIncome=M("users_incomes")->where("uid={$upper}")->find();

				if($upperIncome){//有数据存在

					//更新用户数据
					$now=time();
					$rs=M("users_incomes")->execute("update  __PREFIX__users_incomes set total_income=total_income+{$upperMoney},unsettled=unsettled+{$upperMoney},last_settle_time={$now} where uid={$upper}");

				}else{//插入一条数据

					$data=array(
						'uid'=>$upper,
						'total_income'=>$upperMoney,
						'unsettled'=>$upperMoney,
						'last_settle_time'=>time(),
					);

					$rs=M("users_incomes")->add($data);

				}

				//向用户收益详情表里加入渠道数据
				if($rs!==false){
					$data1=array(
						'uid'=>$upper,
						'senduid'=>$uid,
						'senduser'=>$userLogin,
						'type'=>1,
						'percent'=>$upperIncomePercent,
						'charge_money'=>$total_fee,
						'money'=>$upperMoney,
						'addtime'=>time()
					);

					M("users_income_lists")->add($data1);
				}



			}

			//*****************代理渠道分成功能END*******************



		}else{
			$this->logwx("orderno:".$out_trade_no.' 订单信息不存在');		
			return false;
		}		

	}		
	/**
	* sign拼装获取
	*/
	private function sign($param,$key){
		
		$sign = "";
		foreach($param as $k => $v){
			$sign .= $k."=".$v."&";
		}
	
		$sign .= "key=".$key;
		$sign = strtoupper(md5($sign));
		return $sign;
	
	}
	/**
	* xml转为数组
	*/
	private function xmlToArray($xmlStr){
		$msg = array(); 
		$postStr = $xmlStr; 
		$msg = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
		return $msg;
	}
	
	/* 微信支付end */

	/* 苹果支付start */
	
	public function notify_ios(){
		$content=file_get_contents("php://input"); 

        $this->logios("content:".json_encode($content));    

		$data = json_decode($content,true);    
		$receipt = $data["receipt-data"];     
		$isSandbox = $data["sandbox"];
		$out_trade_no = $data["out_trade_no"];
		$info = $this->getReceiptData($receipt, $isSandbox);   
		
		$this->logios("info:".json_encode($info));
		
		$iforderinfo=M("users_charge")->where("trade_no='{$info['transaction_id']}' and type='3'")->find();

		if($iforderinfo){
			//echo '{"status":"fail","info":"非法提交-001"}';exit;
		}

		//判断订单是否存在
		$orderinfo=M("users_charge")->where("orderno='{$out_trade_no}' and status='0' and type='3'")->find();
		if($orderinfo){
			/* 更新会员虚拟币 */
			$coin=$orderinfo['coin']+$orderinfo['coin_give'];
			M("users")->where("id='{$orderinfo['touid']}'")->setInc("coin",$coin);
			/* 更新 订单状态 */
			M("users_charge")->where("id='{$orderinfo['id']}'")->save(array("status"=>1,"trade_no"=>$info['transaction_id']));

			//*****************代理渠道分成功能START*******************
			$uid=$orderinfo['touid'];//用户ID
			$total_fee=$orderinfo['money'];//充值金額
			//根据用户ID获取用户的渠道ID和代理ID
			$upper=M("users")->where("id={$uid}")->getField("upper");
			$second_upper=M("users")->where("id={$uid}")->getField("second_upper");
			//获取代理的分成比例
			$secondUpperIncomePercent=M("users")->where("id={$second_upper}")->getField("income_percent");
			//获取渠道的分成比例
			$upperIncomePercent=M("users")->where("id={$upper}")->getField("income_percent");

			//如果代理设定了分成比例大于0，小于100
			if($secondUpperIncomePercent>0&&$secondUpperIncomePercent<=100){
				//获取充值用户的昵称
				$userLogin=M("users")->where("id={$uid}")->getField("user_nicename");

				$second_upperMoney=$total_fee*$secondUpperIncomePercent/100;//代理获得的分成金额

				//从代理获得的金额分成中计算渠道获得的分成
				$upperMoney=round($second_upperMoney*$upperIncomePercent/100,2);//渠道获得的分成金额[小数点后保留2位，四舍五入]

				//判断收益表中是否有代理的数据
				$second_upperIncome=M("users_incomes")->where("uid={$second_upper}")->find();

				if($second_upperIncome){//有数据存在

					//更新用户数据
					$now=time();
					$rs=M("users_incomes")->execute("update  __PREFIX__users_incomes set total_income=total_income+{$second_upperMoney},unsettled=unsettled+{$second_upperMoney},last_settle_time={$now} where uid={$second_upper}");
					

				}else{//插入一条数据
					$data=array(
						'uid'=>$second_upper,
						'total_income'=>$second_upperMoney,
						'unsettled'=>$second_upperMoney,
						'last_settle_time'=>time(),
					);

					$rs=M("users_incomes")->add($data);
				}

				//向用户收益详情表里加入代理数据
				if($rs!==false){
					$data1=array(
						'uid'=>$second_upper,
						'senduid'=>$uid,
						'senduser'=>$userLogin,
						'type'=>1,
						'percent'=>$secondUpperIncomePercent,
						'charge_money'=>$total_fee,
						'money'=>$second_upperMoney,
						'addtime'=>time()
					);

					M("users_income_lists")->add($data1);
				}

				$data=array();
				$data1=array();

				//判断收益表中是否有渠道的数据
				$upperIncome=M("users_incomes")->where("uid={$upper}")->find();

				if($upperIncome){//有数据存在

					//更新用户数据
					$now=time();
					$rs=M("users_incomes")->execute("update  __PREFIX__users_incomes set total_income=total_income+{$upperMoney},unsettled=unsettled+{$upperMoney},last_settle_time={$now} where uid={$upper}");

				}else{//插入一条数据

					$data=array(
						'uid'=>$upper,
						'total_income'=>$upperMoney,
						'unsettled'=>$upperMoney,
						'last_settle_time'=>time(),
					);

					$rs=M("users_incomes")->add($data);

				}

				//向用户收益详情表里加入渠道数据
				if($rs!==false){
					$data1=array(
						'uid'=>$upper,
						'senduid'=>$uid,
						'senduser'=>$userLogin,
						'type'=>1,
						'percent'=>$upperIncomePercent,
						'charge_money'=>$total_fee,
						'money'=>$upperMoney,
						'addtime'=>time()
					);

					M("users_income_lists")->add($data1);
				}



			}

			//*****************代理渠道分成功能END*******************



		}else{
			$this->logios("orderno:".$out_trade_no.' 订单信息不存在');
			echo '{"status":"fail","info":"订单信息不存在-003"}'; 		
			exit();
		}
		echo '{"status":"success","info":"充值支付成功"}';
		exit;
	}		
	public function getReceiptData($receipt, $isSandbox){ 
		$config=getConfigPri();
		if ($isSandbox == $config['ios_sandbox']) {   
			//沙盒
			$endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';
		}else {  
			//生产
			$endpoint = 'https://buy.itunes.apple.com/verifyReceipt'; 
		}   

		$postData = json_encode(   
				array('receipt-data' => $receipt)   
		);   

		$ch = curl_init($endpoint);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//关闭安全验证
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  	//关闭安全验证
		curl_setopt($ch, CURLOPT_POST, true);   
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);   

		$response = curl_exec($ch);   
		$errno    = curl_errno($ch);   
		$errmsg   = curl_error($ch);   
		curl_close($ch);   

		if($errno != 0) {   
			echo '{"status":"fail","info":"服务器出错，请联系管理员"}';
			exit;
		}   
		$data = json_decode($response,1);   

		if (!is_array($data)) {   
			echo '{"status":"fail","info":"验证失败,如有疑问请联系管理"}';
			exit;
		}   

		if (!isset($data['status']) || $data['status'] != 0) {   
			echo '{"status":"fail","info":"验证失败,如有疑问请联系管理"}';
			exit;
		}   

		return array(     
			'product_id'     =>  $data['receipt']['in_app'][0]['product_id'],   
			'transaction_id' =>  $data['receipt']['in_app'][0]['transaction_id'],   
		);  
	}   
		
	/* 苹果支付end */	
			
	/* 打印log */
	public function logali($msg){
		//file_put_contents('./logali.txt',date('y-m-d h:i:s').'  msg:'.$msg."\r\n",FILE_APPEND);
	}		
	/* 打印log */
	public function logwx($msg){
		//file_put_contents('./logwx.txt',date('y-m-d h:i:s').'  msg:'.$msg."\r\n",FILE_APPEND);
	}			
	/* 打印log */
	public function logios($msg){
		//file_put_contents('./logios.txt',date('y-m-d h:i:s').'  msg:'.$msg."\r\n",FILE_APPEND);
	}					

}


