<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class CommonController extends Controller{
	//关闭防csrf攻击（在yii中post提交数据时yii框架会自动的进行防csrf攻击的认证 微信请求也是post方式 所以也会经过认证）
	public $enableCsrfValidation = false;

	//获取access_token的方法
	public function getAccessToken(){
		$appid="wxbbb429e525940871";
		$secret="e3e2f70a4edd48448ecf0496d356f669";
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		$cache = Yii::$app->cache;
		$access_token=$cache->get('access_token');
		if($access_token){
			return $access_token;
		}else{
			$result=$this->http_curl($url);
			$cache->set('access_token',$result['access_token'],7200);
			return $result['access_token'];
		}
		
	
	}
	//利用curl 发送请求的方法
	public function  http_curl($url,$type='get',$postData=''){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if ($type=='post'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        $result=curl_exec($ch);
        if (curl_errno($ch)){
            $error=curl_error($ch);
            curl_close($ch);
            return $error;
        }else{
            curl_close($ch);
            return json_decode($result,true);
        }
    }



}