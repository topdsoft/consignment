<div class="consignees form">
<?php echo $this->Form->create('Consignee');?>
	<fieldset>
		<legend><?php __('Edit Consignee'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fName');
		echo $this->Form->input('lName');
		echo $this->Form->input('address');
		echo $this->Form->input('email');
		echo $this->Form->input('default');
		echo $this->Form->input('phone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Consignee.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Consignee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Consignees', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>