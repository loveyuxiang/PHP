<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title></title>
	<style>
		#box{
			width:100%;
			/*background:green;*/
		}
		#box1{
			width:800px;
			margin:auto;
			/*background:red;*/
		}
		textarea{
			resize: none;
		}
		#liuyan textarea{
			width:678px;
			height:110px;
		}
		#liuyan input{
			width:678px;
		}
	</style>
	<script src="/shizhan/Public/js/jquery-1.8.3.js"></script>
</head>

<body>
	<div id="box">
		<div id="box1">
			<table width="800" id="tab">
				<tr>
					<td colspan="6">
						<center><h1>留言板</h1></center>
					</td>
				</tr>
				<tr>
					<td width="5%">id</td>
					<td width="10%">留言标题</td>
					<td width="10%">留言人</td>
					<td width="10%">ip地址</td>
					<td width="10%">添加时间</td>
					<td width="50%">留言内容</td>
					<td width="5%">操作</td>
				</tr>
				<?php if(is_array($data)): foreach($data as $k=>$sj): ?><tr>
						<td id="sid"><?php echo ($sj["id"]); ?></td>
						<td><?php echo ($sj["title"]); ?></td>
						<td><?php echo ($sj["author"]); ?></td>
						<td><?php echo ($sj["ip"]); ?></td>
						<td><?php echo ($sj["addtime"]); ?></td>
						<td><textarea disabled><?php echo ($sj["content"]); ?></textarea></td>
						<td><input type="button" onclick="del(this)" value="删除"></td>
					</tr><?php endforeach; endif; ?>
			</table>
			<table border="1" width="800" id="liuyan">
				<tr>
					<td colspan="3" width="15%">
						留言标题
					</td>
					<td colspan="3">
						<input type="text" name="title">
					</td>
				</tr>
				<tr>
					<td colspan="3">
						留言人
					</td>
					<td colspan="3">
						<input type="text" name="author">
						<input type="hidden" name="ip" value="192.168.0.5">
						<input type="hidden" name="addtime" value="4444444">
					</td>
				</tr>
				<tr>
					<td colspan="3">
						留言内容
					</td>
					<td colspan="3">
						<textarea name="content"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						提交
					</td>
					<td colspan="3">
						<input type="button" id="btn" value="发表">
					</td>
				</tr>
			</table>
		</box1>
	</div>
</body>
	<script>
		var btn = $('#btn');
		btn.click(function(){
			var title = $("input[name='title']").val();
			var author = $("input[name='author']").val();
			var ip = $("input[name='ip']").val();
			var addtime = $("input[name='addtime']").val();
			var content = $("textarea[name='content']").val();
			$.post("/shizhan/index.php/Liuyan/add", { 'title':title , 'author':author , 'ip':ip , 'addtime':addtime , 'content':content},
				function(data){
					
					if(0 == data){
						alert('请填完所有需要填的栏目');
					}else{
						arr = (eval('('+data+')'));
						console.log(arr);
						var newRow = null;
						$.each(arr,function(idx,item){
							newRow = '<tr><td id="sid">'+item.id+'</td><td>'+item.title+'</td><td>'+item.author+'</td><td>'+item.ip+'</td><td>'+item.addtime+'</td><td>'+item.content+'</td><td><input type="button" onclick="del(this)" value="删除"></td></tr>';
						   //输出
						   $('#tab').append(newRow);
						})
						
					}
					
				}
			);
		});
		function del(obj){
			// console.log(obj);
			var delid = $(obj).parent().siblings("#sid").html();
			// console.log($(obj));
			// alert(delid);
			$.post("/shizhan/index.php/Liuyan/del", {'sid':delid},
				function(data){
					//删除失败会返回0，sid没传过去，也返回0
					if(0 == data){
						alert('删除失败');
					}else{
						alert('删除成功');	
						$(obj).parent().parent().remove();
					}
				}
			);
		}
	</script>
</html>