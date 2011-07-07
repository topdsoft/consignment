<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Role'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['role']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('User\'s Sales');?></h3>
	<?php if (!empty($user['Sale'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Sale Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Qty Sold'); ?></th>
		<th><?php __('Total'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Closed'); ?></th>
	</tr>
	<?php
		$i = 0;$total=0;$tqty=0;//debug($user['Sale']);
		foreach ($user['Sale'] as $sale):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link(__($sale['id'], true), array('controller' => 'sales', 'action' => 'view', $sale['id']));;?></td>
			<td><?php echo $sale['status'];?></td>
			<td><?php if($sale['status']=='C') {echo $sale['qty'];$tqty+=$sale['qty'];}?></td>
			<td><?php if($sale['status']=='C') {echo $sale['ext'];$total+=$sale['ext'];}?></td>
			<td><?php echo $sale['created'];?></td>
			<td><?php echo $sale['closed'];?></td>
		</tr>
	<?php endforeach; ?>
	<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>
	<tr><th>Total</th><th></th><th><?php echo $tqty;?></th><th><?php echo number_format($total,2);?></th><th></th><th></th></tr>
	</table>
<?php endif; ?>

</div>
