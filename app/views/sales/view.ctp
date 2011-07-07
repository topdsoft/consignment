<div class="sales view">
<h2><?php  __('Sale');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Started'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['closed']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($sale['User']['username'], array('controller' => 'users', 'action' => 'view', $sale['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Sale', true), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
		<li><?php //echo $this->Html->link(__('Delete Sale', true), array('action' => 'delete', $sale['Sale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('action' => 'add')); ?> </li>
		<li><?php if($role>2)echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>2)echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Details', true), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Detail', true), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Sale Details');?></h3>
	<?php if (!empty($sale['Detail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Tax'); ?></th>
		<th><?php __('Ext'); ?></th>
	</tr>
	<?php
		$i = 0;$total=0;$tqty=0;
		foreach ($sale['Detail'] as $detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $detail['Item']['name'];?></td>
			<td><?php echo $detail['qty'];$tqty+=$detail['qty'];?></td>
			<td><?php echo $detail['Item']['price'];?></td>
			<td><?php if($detail['Item']['taxable']) echo 'Y';?></td>
			<td><?php echo $detail['ext'];$total+=$detail['ext']?></td>
		</tr>
	<?php endforeach; ?>
	<tr><th></th><th></th><th></th><th></th><th></th></tr>
	<tr><th>Total</th><th><?php echo $tqty; ?></th><th></th><th></th><th><?php echo number_format($total,2); ?></th>
	</tr>
	</table>
<?php endif; ?>

</div>
