<div class="items index">
	<h2><?php __('Browse Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php //echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('category_id');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('desc');?></th>
			<th class="actions"><?php __('');?></th>
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
			<?php echo $this->Html->link($item['Category']['name'], array('controller' => 'items', 'action' => 'lookup', $so_id,$item['Category']['id'])); ?>
		</td>
		<td><?php echo $item['Item']['price']; ?>&nbsp;</td>
		<td><?php echo nl2br($item['Item']['desc']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Select', true), array('controller' => 'details','action' => 'add',$so_id, $item['Item']['id'])); ?>
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
		if ($cat['ParentCategory']['name']) echo $this->Html->link($cat['ParentCategory']['name'],array('action'=>'lookup',$so_id,$cat['ParentCategory']['id']));
		else echo $this->Html->link('Top Level',array('action' => 'lookup',$so_id));
		echo '</td><td><strong>';
		echo $cat['Category']['name'];
		echo '</strong></td><td>';
		//loop for all children
		foreach ($cat['ChildCategory'] as $child) echo $this->Html->link($child['name'],array('action'=>'lookup',$so_id,$child['id'])).'<br>';
		echo '</td></table>';
	} else {
		//no category is set so show the top level categories
		foreach ($children as $child) echo $this->Html->link($child['Category']['name'],array('action'=>'lookup',$so_id,$child['Category']['id'])).'<br>';
	}//endif
	?></fieldset>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Return to Sale', true), array('controller' => 'details','action' => 'add',$so_id)); ?></li>
	</ul>
</div>