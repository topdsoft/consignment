<div class="reports form">
<?php echo $this->Form->create('Report');?>
	<fieldset>
		<legend><?php __('New Report'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('user_id',array('value'=>$uid,'type'=>'hidden'));
		echo $this->Form->input('userFilter',array('type'=>'select','options'=>$users,'label'=>'Filter by Salesperson'));
		echo $this->Form->input('catFilter',array('type'=>'select','options'=>$categories,'label'=>'Filter by Category'));
		echo $this->Form->input('consigneeFilter',array('type'=>'select','options'=>$consignees,'label'=>'Filter by Consignee'));
		//start new fieldset for date filter radio buttons
		echo '<fieldset><legend>Date Filtering</legend>';
		echo $form->input('dateFilter',array('type'=>'radio','options'=>array(0=>'None')));
		echo $form->input('dateFilter',array('type'=>'radio','options'=>array(1=>'Single Day')));
		echo $this->Form->input('dayFilter',array('label'=>'Show only this Day:'));
		echo $form->input('dateFilter',array('type'=>'radio','options'=>array(2=>'Date Range')));
		echo $this->Form->input('startFilter',array('label'=>'Starting Date:'));
		echo $this->Form->input('endFilter',array('label'=>'Ending Date:'));
		echo $form->input('dateFilter',array('type'=>'radio','options'=>array(3=>'Show only Current:')));
		echo $this->Form->input('currentFilter',array('type'=>'select','label'=>'','options'=>array(1=>'Week',2=>'Month',3=>'Year')));
		echo $form->input('dateFilter',array('type'=>'radio','options'=>array(4=>'Show only Last:')));
		echo $this->Form->input('pastFilter',array('type'=>'select','label'=>'','options'=>array(1=>'Week',2=>'Month',3=>'Year')));
		echo '</fieldset>';
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reports', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>