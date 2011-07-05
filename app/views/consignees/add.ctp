<div class="consignees form">
<?php echo $this->Form->create('Consignee');?>
	<fieldset>
		<legend><?php __('Add Consignee'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Consignees', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>