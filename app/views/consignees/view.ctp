<div class="consignees view">
<h2><?php  __('Consignee');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('FName'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['fName']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('LName'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['lName']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo nl2br($consignee['Consignee']['address']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Consignment<br>Fee'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['default']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty in Store'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owed Blance'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consignee['Consignee']['balance']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Consignee', true), array('action' => 'edit', $consignee['Consignee']['id'])); ?> </li>
		<li><?php if($role>2)echo $this->Html->link(__('Delete Consignee', true), array('action' => 'delete', $consignee['Consignee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $consignee['Consignee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Consignees', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consignee', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add',$consignee['Consignee']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Items');?></h3>
	<?php if (!empty($consignee['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Category'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($consignee['Item'] as $item):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['Category']['name'];?></td>
			<td><?php echo $item['price'];?></td>
			<td><?php echo $item['desc'];?></td>
			<td><?php echo $item['qty'];?></td>
			<td><?php echo $item['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php if($role>2)echo $this->Html->link(__('Delete', true), array('controller' => 'items', 'action' => 'delete', $item['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<h3><?php __('Related Transactions');?></h3>
	<?php if (!empty($consignee['Transaction'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Date'); ?></th>
		<th><?php __('Sale ID'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Amount'); ?></th>
	</tr>
	<?php
		$i = 0;$total=0;//debug($consignee);
		foreach ($consignee['Transaction'] as $transaction):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $transaction['created'];?></td>
			<td><?php echo $this->Html->link($transaction['sale_id'], array('controller'=>'sales','action'=>'view',$transaction['sale_id']));?></td>
			<td><?php if($transaction['Item'])echo $transaction['Item']['name']; else echo '(Payment)'?></td>
			<td><?php echo $transaction['amount'];$total+=$transaction['amount']?></td>
		</tr>
	<?php endforeach; ?>
	<tr><th></th><th></th><th></th><th></th></tr>
	<tr><th>Total</th><th></th><th></th><th><?php echo number_format($total,2); ?></th></tr>
	</table>
<?php endif; ?>

</div>
