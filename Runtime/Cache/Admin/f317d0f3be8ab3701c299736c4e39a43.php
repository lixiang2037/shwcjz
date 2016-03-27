<?php if (!defined('THINK_PATH')) exit();?><div class="margin10px">
		<table class="mytable" style="width:450px;">
			<tr>
				<td class="tdf">收件人</td>
				<td><input type="text" value="<?php echo ($info['to_user_name']); ?>"   disabled='disabled'/></td>
			</tr>
			<tr>
				<td class="tdf">标题</td>
				<td><input type="text" value="<?php echo ($info['title']); ?>"  readonly disabled='disabled'/></td>
			</tr>
			<tr>
				<td class="tdf">信息内容：</td>
				<td><textarea  style=" width:280px; height:80px;" readonly disabled='disabled'><?php echo ($info['content']); ?></textarea></td>
			</tr>
		</table>
</div>