<div class="items index">
	<h2><?php __('Browse Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php //echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('category_id');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php //echo $this->Paginator->sort('desc');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('consignee_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php //echo $item['Item']['id']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($item['Category']['name'], array('controller' => 'items', 'action' => 'index', $item['Category']['id'])); ?>
		</td>
		<td><?php echo $item['Item']['price']; ?>&nbsp;</td>
		<td><?php //echo $item['Item']['desc']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['qty']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['created']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($item['Consignee']['fullname'], array('controller' => 'consignees', 'action' => 'view', $item['Consignee']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Item']['id'])); ?>
			<?php if ($role>1)echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php if ($role==3)echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?>
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
	<fieldset><legend>Browse By Category:</legend>
	<?php
	//show options for browsing by category
	if (isset($cat)) {
		//a category is set
		echo '<table><td>';
		//show parent
		if ($cat['ParentCategory']['name']) echo $this->Html->link($cat['ParentCategory']['name'],array('action'=>'index',$cat['ParentCategory']['id']));
		else echo $this->Html->link('Top Level',array('action' => 'index'));
		echo '</td><td><strong>';
		echo $cat['Category']['name'];
		echo '</strong></td><td>';
		//loop for all children
		foreach ($cat['ChildCategory'] as $child) echo $this->Html->link($child['name'],array('action'=>'index',$child['id'])).'<br>';
		echo '</td></table>';
	} else {
		//no category is set so show the top level categories
		foreach ($children as $child) echo $this->Html->link($child['Category']['name'],array('action'=>'index',$child['Category']['id'])).'<br>';
	}//endif
	?></fieldset>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Browse Items', true), array('action' => 'index')); ?></li>
		<li><?php if ($role>1)echo $this->Html->link(__('New Item', true), array('action' => 'add')); ?></li>
		<li><?php if ($role>1 && $barcodes)echo $this->Html->link(__('Print Barcodes', true), array('action' => 'printBC')); ?></li>
		<li><?php if ($role>2)echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php if ($role>2)echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php if ($role>1)echo $this->Html->link(__('List Consignees', true), array('controller' => 'consignees', 'action' => 'index')); ?> </li>
		<li><?php if ($role>1)echo $this->Html->link(__('New Consignee', true), array('controller' => 'consignees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Start Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php if ($role>2)echo $this->Html->link(__('Company Details', true), array('controller' => 'options', 'action' => 'edit',1)); ?> </li>
		<li><?php //echo $this->Html->link(__('New Detail', true), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>