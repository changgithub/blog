<?php
namespace frontend\controllers;

use frontend\models\Wxuser;
use Yii;

class SendUserMesController extends CommonController{

	//��ȡ����ע�����ŵ��û��б� ���������ݿ�
	public function actionGetUserList(){
		$token=$this->getAccessToken();
		$url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=";
		$result=$this->http_curl($url);
		$openid=$result['data']['openid'];//��ȡ�û���openid
		//print_r($openid);
		//������ȡ�û���Ϣ
		$url="https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=$token";
		$arrData=[];//����һ��������
		foreach($openid as $k => $val){
			$arrData['user_list'][$k]['openid']=$val;
			$arrData['user_list'][$k]['lang']='zh_CN';
		}
		$jsonData=json_encode($arrData);
		$userInfo=$this->http_curl($url,'post',$jsonData);
		//print_r($userInfo);die;
		
		foreach($userInfo['user_info_list'] as $k => $val){
			$Wxuser=new Wxuser();
			$Wxuser->openid=$val['openid'];
			$Wxuser->nickname=$val['nickname'];
			$Wxuser->sex=$val['sex'];
			$Wxuser->headimgurl=$val['headimgurl'];
			$Wxuser->subscribe_time=$val['subscribe_time'];
			$Wxuser->save();
		}
	
	}

	//չʾ�û���Ϣ�б�
	public function actionShowUserList(){
		
		$userInfo=Wxuser::find()->asArray()->all();
		return $this->render('userlist',['userinfo'=>$userInfo]);
		
	}

	public function actionSendMes(){
		$token=$this->getAccessToken();
		$arrData['touser'] = (new \yii\db\Query())
		->select("openid")
		->from('wxuser')
		->column();
		$arrData['msgtype']='text';
		$arrData['text']['content']=Yii::$app->request->get('text','');
		$jsonData=json_encode($arrData);
		$url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
		$result=$this->http_curl($url,'post',$jsonData);
		if($result['errcode']==0){
			return json_encode(1);
		}
		return json_encode($result['errmsg']);
	}




}