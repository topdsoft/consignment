<div class="sales view">
<h2><?php  __('Sale');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sale['Sale']['created']; ?>
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
		<li><?php echo $this->Html->link(__('Edit Sale', true), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sale', true), array('action' => 'delete', $sale['Sale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Details', true), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail', true), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Details');?></h3>
	<?php if (!empty($sale['Detail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Sale Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sale['Detail'] as $detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $detail['id'];?></td>
			<td><?php echo $detail['sale_id'];?></td>
			<td><?php echo $detail['created'];?></td>
			<td><?php echo $detail['item_id'];?></td>
			<td><?php echo $detail['qty'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'details', 'action' => 'view', $detail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'details', 'action' => 'edit', $detail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'details', 'action' => 'delete', $detail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $detail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Detail', true), array('controller' => 'details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
