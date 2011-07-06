<div class="consignees index">
	<h2><?php __('Consignees');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('lName');?></th>
			<th><?php echo $this->Paginator->sort('fName');?></th>
			<th><?php echo $this->Paginator->sort('items');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('total');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;//debug($consignees);
	foreach ($consignees as $consignee):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $consignee['Consignee']['id']; ?>&nbsp;</td>
		<td><?php echo $consignee['Consignee']['lName']; ?>&nbsp;</td>
		<td><?php echo $consignee['Consignee']['fName']; ?>&nbsp;</td>
		<td><?php echo $consignee['Consignee']['items']; ?>&nbsp;</td>
		<td><?php echo $consignee['Consignee']['qty']; ?>&nbsp;</td>
		<td><?php echo $consignee['Consignee']['total']; ?>&nbsp;</td>
		<td><?php echo $consignee['Consignee']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Add Item', true), array('controller' => 'items', 'action' => 'add', $consignee['Consignee']['id'])); ?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $consignee['Consignee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $consignee['Consignee']['id'])); ?>
			<?php if($role>2)echo $this->Html->link(__('Delete', true), array('action' => 'delete', $consignee['Consignee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $consignee['Consignee']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Consignee', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>