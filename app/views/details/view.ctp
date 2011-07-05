<div class="details view">
<h2><?php  __('Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $detail['Detail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sale'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($detail['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $detail['Sale']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $detail['Detail']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($detail['Item']['name'], array('controller' => 'items', 'action' => 'view', $detail['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $detail['Detail']['qty']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Detail', true), array('action' => 'edit', $detail['Detail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Detail', true), array('action' => 'delete', $detail['Detail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $detail['Detail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
