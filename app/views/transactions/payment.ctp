<div class="transactions form">
<?php echo $this->Form->create('Transaction');?>
	<fieldset>
		<legend><?php __('Add Payment'); ?></legend>
	<?php
		echo '<strong>Consignee:</strong>'.$consignee[0]['Consignee']['fullname'];
		echo '<br>'.nl2br($consignee[0]['Consignee']['address']);
		echo '<br>'.$consignee[0]['Consignee']['phone'];
		echo '<br><strong>Current Balance:</strong> $'.$consignee[0]['Consignee']['balance'];
		echo $this->Form->input('amount',array('label'=>'Payment Amount'));
//		echo $this->Form->input('sale_id');
//debug ($consignee);
//		echo $this->Form->input('item_id');
		echo $this->Form->input('consignee_id',array('type'=>'hidden', 'value'=>$consignee[0]['Consignee']['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Transactions', true), array('action' => 'index'));?></li>
		<li><?php //echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Consignees', true), array('controller' => 'consignees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consignee', true), array('controller' => 'consignees', 'action' => 'add')); ?> </li>
	</ul>
</div>