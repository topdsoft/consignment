<div class="categories index">
	<h2><?php __('Categories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>ID <?php //echo $this->Paginator->sort('id');?></th>
			<th><?php //echo $this->Paginator->sort('parent_id');?></th>
			<th><?php //echo $this->Paginator->sort('lft');?></th>
			<th><?php //echo $this->Paginator->sort('rght');?></th>
			<th>Name<?php //echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($categories as $id=>$category):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $id; ?>&nbsp;</td>
		<td>
			<?php //echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>
		</td>
		<td><?php //echo $category['Category']['lft']; ?>&nbsp;</td>
		<td><?php //echo $category['Category']['rght']; ?>&nbsp;</td>
		<td><?php echo $category; ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $id)); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $id)); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $id), null, sprintf(__('Are you sure you want to delete # %s?', true), $id)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>