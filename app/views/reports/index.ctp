<div class="reports index">
	<h2><?php __('Reports');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Report Name','name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('Last Run','modified');?></th>
			<th><?php echo $this->Paginator->sort('By','user_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($reports as $report):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $report['Report']['name']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['created']; ?>&nbsp;</td>
		<td><?php echo $report['Report']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($report['User']['username'], array('controller' => 'users', 'action' => 'view', $report['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller'=>'sales','action' => 'report', $report['Report']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $report['Report']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $report['Report']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $report['Report']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Report', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Browse Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Company Options', true), array('controller' => 'options', 'action' => 'edit',1)); ?> </li>
	</ul>
</div>