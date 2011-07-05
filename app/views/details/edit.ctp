<div class="details form">
<?php echo $this->Form->create('Detail');?>
	<fieldset>
		<legend><?php __('Edit Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sale_id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('qty');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Detail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Detail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>