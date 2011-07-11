<div class="options form">
<?php echo $this->Form->create('Option');?>
	<fieldset>
		<legend><?php __('Edit Company Data'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Company Name'));
		echo $this->Form->input('address',array('label'=>'Address-Phone-Web-etc.. (optional)'));
		echo $this->Form->input('tax',array('label'=>'Tax Rate'));
		echo $this->Form->input('default',array('label'=>'Default Consignment Rate (0-99.99)'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Consignees', true), array('controller' => 'consignees','action' => 'index'));?></li>
	</ul>
</div>