<div class="transactions index">
	<h2><?php __('Transactions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php //echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('sale_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('consignee_id');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($transactions as $transaction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php //echo $transaction['Transaction']['id']; ?>&nbsp;</td>
		<td><?php echo $transaction['Transaction']['created']; ?>&nbsp;</td>
		<td><?php echo $transaction['Transaction']['amount']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($transaction['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $transaction['Sale']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($transaction['Item']['name'], array('controller' => 'items', 'action' => 'view', $transaction['Item']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($transaction['Consignee']['fullname'], array('controller' => 'consignees', 'action' => 'view', $transaction['Consignee']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Transaction', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Consignees', true), array('controller' => 'consignees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consignee', true), array('controller' => 'consignees', 'action' => 'add')); ?> </li>
	</ul>
</div>