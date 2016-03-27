<?php if (!defined('THINK_PATH')) exit();?><div class="margin10px">
		<table class="mytable" style="width:400px;">
			<tr>
				<td class="tdf">姓名：</td>
				<td><?php echo ($info['contact_name']); ?></td>
			</tr>
			<tr>
				<td class="tdf">身份证</td>
				<td><?php echo ($info['id_num']); ?></td>
			</tr>
			<tr>
				<td class="tdf">性别</td>
				<td><?php echo ($info['sex']); ?></td>
			</tr>
			<tr>
				<td class="tdf">电话</td>
				<td><?php echo ($info['tel']); ?></td>
			</tr>
			<tr>
				<td class="tdf">手机</td>
				<td><?php echo ($info['phone']); ?></td>
			</tr>
			<tr>
				<td class="tdf">QQ</td>
				<td><?php echo ($info['qq']); ?></td>
			</tr>
			<tr>
				<td class="tdf">邮箱</td>
				<td><?php echo ($info['email']); ?></td>
			</tr>
			<tr>
				<td class="tdf">地址</td>
				<td><?php echo ($info['address_info']); ?></td>
			</tr>
		</table>
</div>