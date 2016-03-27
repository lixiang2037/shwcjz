<?php if (!defined('THINK_PATH')) exit();?><div class="margin10px">
		<table class="mytable" style="width:400px;">
			<tr>
				<td class="tdf">用户名：</td>
				<td style="width:300px;"><?php echo ($info['user_name']); ?></td>
			</tr>
			
			<tr>
				<td class="tdf">真实姓名：</td>
				<td><?php echo ($info['real_name']); ?></td>
			</tr>
			<tr>
				<td class="tdf">邮箱</td>
				<td><?php echo ($info['bind_email']); ?></td>
			</tr>
			<tr>
				<td class="tdf">生日</td>
				<td><?php echo ($info['byear']); ?>年<?php echo ($info['bmonth']); ?>月<?php echo ($info['bday']); ?>日</td>
			</tr>
			<tr>
				<td class="tdf">状态</td>
				<td><?php if($info['status'] == '1'): ?>正常<?php else: ?>冻结<?php endif; ?></td>
			</tr>
			<tr>
				<td class="tdf">手机</td>
				<td><?php echo ($info['bind_mobile']); ?></td>
			</tr>
			<tr>
				<td class="tdf">所在地</td>
				<td><?php echo ($province_city); ?></td>
			</tr>
		</table>
</div>