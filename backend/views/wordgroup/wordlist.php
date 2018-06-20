<?php

?>
<table border=1>
<tr>
	<td>id</td>
	<td>平民词</td>
	<td>卧底词</td>
	<td>操作</td>
</tr>
<tbody id='list'>
<?php foreach($data['word'] as $val){ ?>
<tr>
	<td><?=$val['id']?></td>
	<td><?=$val['civilian']?></td>
	<td><?=$val['dinting']?></td>
	<td><a href="">删除</a>|<a href="">修改</a></td>
</tr>
<?php } ?>
</tbody>
</table>
<div id='page'>
<?=$data['page']?>
</div>
<script src='./assets/3eca730f/jquery.js'></script>
<script>
$(document).on('click','#page a',function(event){
	//禁用a标签跳转行为
	event.preventDefault();
	//获取a标签中的href属性
	var url=$(this).attr('href');
	$.ajax({
		url:url,
		dataType:'json',
		success:function(data){
			//替换分页链接
			$('#page').html(data.page);
			//替换数据
			$('#list').empty();
			$.each(data.word,function(k,v){
			 var tr=$('<tr></tr>');
			 tr.append("<td>"+v.id+"</td><td>"+v.civilian+"</td><td>"+v.dinting+"</td><td><a href=''>删除</a>|<a href=''>修改</a></td>");
			 $('#list').append(tr);
			})
		}
		
	
	})


})

</script>