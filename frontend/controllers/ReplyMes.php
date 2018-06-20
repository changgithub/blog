<?php
namespace frontend\controllers;

class ReplyMes {

	//回复用户文本消息
	public function replyText($formuser,$touser,$text){
		error_log(2);
		$template="<xml><ToUserName><![CDATA[".$formuser."]]></ToUserName><FromUserName><![CDATA[".$touser."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$text."]]></Content></xml>";
		error_log($template);
		return $template;
	}

	//回复用户图文消息
	public function replyImgText($formuser,$touser,$imgtext){
		error_log(123);
		$count=count($imgtext);
		$template="<xml>
				<ToUserName><![CDATA[".$formuser."]]></ToUserName>
				<FromUserName><![CDATA[".$touser."]]></FromUserName>
				<CreateTime>".time()."</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount>".$count."</ArticleCount>
				<Articles>";
				foreach($imgtext as $val){
				 $template.="<item>
				<Title><![CDATA[".$val['title']."]]></Title>
				<Description><![CDATA[".$val['des']."]]></Description>
				<PicUrl><![CDATA[".$val['picurl']."]]></PicUrl>
				<Url><![CDATA[".$val['url']."]]></Url>
				</item>";
				}
				$template.="</Articles></xml>";
				error_log($template);
				return $template;
	}

}