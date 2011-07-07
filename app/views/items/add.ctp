<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('category_id');
		echo $this->Form->input('price');
		echo $this->Form->input('taxable');
		echo $this->Form->input('desc');
		echo $this->Form->input('qty');
		if (isset($cons_id)) echo $this->Form->input('consignee_id',array('type'=>'hidden','value'=>$cons_id));
		else echo $this->Form->input('consignee_id');
	?>
	</fieldset>
	<?php echo $this->Form->input('addmore',array('type'=>'checkbox','label'=>'Add Another Item For This Consignee'));?>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Consignees', true), array('controller' => 'consignees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consignee', true), array('controller' => 'consignees', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Details', true), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Detail', true), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>