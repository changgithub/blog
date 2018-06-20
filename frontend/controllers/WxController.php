<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Wxuser;

class WxController extends CommonController {
	
	//验证微信请求的方法
	public function sign($param){
		//接受参数
		$signature=$param["signature"];
		$timestamp=$param["timestamp"];
		$nonce=$param["nonce"];
		$token='yiiwx';
		//将参数（timestamp nonce token）加入数组 并进行字典序排序
		$tmpArr = array($timestamp, $nonce,$token);
		sort($tmpArr);//进行字典序排序
		$tmpStr = implode( $tmpArr );//将数组转化为字符串
		$tmpStr = sha1( $tmpStr );// 进行sha1加密
		//校验请求是否来自微信服务器（判断 加密之后的字符串是否等于 微信服务器传递过来的 $signature ）
		if( $signature==$tmpStr ){
			return  true;
		}else{
			return  false;
		}
	}
	
	//微信的每一次请求都会请求到这个方法（index）
	public function actionIndex(){
		$param=Yii::$app->request->get();
		if($this->sign($param)){
			if(isset($param['echostr'])){
				//微信认证请求
				return $param['echostr'];
			}else{
				//微信交互请求
				error_log(1234);
				//接收微信服务器发送（post方式）过来的原始数据包（xml格式）
				$postData=$GLOBALS['HTTP_RAW_POST_DATA'];
				error_log($postData);
				//将XML格式数据包转化为对象格式
				$objData=simplexml_load_string($postData);
				$touser=$objData->ToUserName;
				$formuser=$objData->FromUserName;
				$msgtype=$objData->MsgType;
				$event=$objData->Event;
				//判断是否是事件推送
				if(strtolower($msgtype)=='event'){
					//是否是关注事件
					if(strtolower($event)=='subscribe'){
						$replyMes=new ReplyMes();
						//给微信服务器推送消息 让微信服务器推送用户消息
						$info=$replyMes->replyText($formuser,$touser,'欢迎关注微信公众平台');
						return $info;
					}
				
				}



			}

			
		}

	}

	


	


}
