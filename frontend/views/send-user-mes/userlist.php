
<table border=1>
<tr>
<th>id</th>
<th>openid</th>
<th>昵称</th>
<th>头像</th>
<th>性别</th>
<th>关注时间</th>
<th>操作</th>	
</tr>
<?php foreach($userinfo as $val){ ?>
<tr>
	<td><?=$val['id']?></td>
	<td><?=$val['openid']?></td>
	<td><?=$val['nickname']?></td>
	<td><img src="<?=$val['headimgurl']?>" width='50px' height="50px"></td>
	<td><?=$val['sex']?></td>
	<td><?=date('Y-m-d H:i:s',$val['id'])?></td>
	<td><a href='?r=wx/sendmes&openid=<?=$val['openid']?>'>发消息</a></td>
</tr>
<?php } ?>
</table>

<div>
群发消息：
<input type="text" placeholder='请输入消息内容' id='mes'>
<button>发送</button>
</div>

<script src='./assets/3eca730f/jquery.js'></script>
<script>
$('button').click(function(){
//获取文本框中的内容
var text=$('#mes').val();

$.ajax({

	url:'?r=send-user-mes/send-mes',
	data:{'text':text},
	dataType:'json',
	success:function(res){
		if(res){
			alert('发送成功');
		}else{
			alert('发送失败');
		}
	}

})


})

</script>