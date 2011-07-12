<div class="details form">
<?php echo $this->Form->create('Detail');?>
	<fieldset>
		<legend><?php __('Add Item to Sale#'.$so_id); ?></legend>
	<?php
		if (isset($item_name)) {
			echo "<strong>Item Selected:</strong>$item_name<br>";
			echo $this->Form->input('item_id',array('type'=>'hidden','value'=>$item_id));
		}//endif
		echo $this->Form->input('sale_id',array('type'=>'hidden','value'=>$so_id));
		echo $this->Form->input('qty',array('id'=>'qty'));
		if(!isset($item_name)) echo $this->Form->input('scancode',array('id'=>'sc'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php
	if(isset($item_name)) echo "<script type='text/javascript'>document.getElementById('qty').focus();</script>";
	else echo "<script type='text/javascript'>document.getElementById('sc').focus();</script>";
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Item Lookup', true), array('controller' => 'items', 'action' => 'lookup',$so_id));?></li>
		<li><?php if ($saledata) echo $this->Html->link(__('Finish Sale', true), array('controller' => 'sales', 'action' => 'finish',$so_id)); ?> </li>
		<li><?php echo $this->Html->link(__('Void Sale', true), array('controller' => 'sales', 'action' => 'void',$so_id), null, sprintf(__('Are you sure you want to VOID sale # %s?', true), $so_id)); ?> </li>
		<li><?php //echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
<?php
	if ($saledata) {
		//there is data for sale show it
		echo '<h3>Current items on sale ticket</h3>';
		echo '<table cellpadding = "0" cellspacing = "0"><tr>';
		echo '<th>Item</th><th>Qty</th><th>Price Each</th><th>Tax Each</th><th>Ext</th><th class="actions"></th></tr>';
		$i = 0;
		$total = 0;
		foreach ($saledata as $detail) {
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			echo "<tr $class>";
			echo "<td>{$detail['Item']['name']}</td>";
			echo "<td>{$detail['Detail']['qty']}</td>";
			echo "<td>{$detail['Item']['price']}</td>";
			echo "<td>".number_format($detail['Item']['price']*$tax*$detail['Item']['taxable'],2)."</td>";
			$total+=$detail['Detail']['ext'];
			echo "<td>{$detail['Detail']['ext']}</td>";
			echo '<td class="actions">'.$this->Html->link('Delete',array('action'=>'delete',$detail['Detail']['id'],$so_id)).'</td>';
			echo '</tr>';
		}//end foreach
		echo '</table>';
		echo '<br><br><h2><strong>Total:</strong>'.number_format($total,2).'</h2>';
	}//endif saledata

//debug($saledata);
?>
</div>