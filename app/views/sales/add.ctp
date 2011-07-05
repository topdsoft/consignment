<div class="sales form">
<?php echo $this->Form->create('Sale');?>
	<fieldset>
		<legend><?php __('Add Sale'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sales', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Details', true), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail', true), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>