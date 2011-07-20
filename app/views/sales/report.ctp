<div class="sales index">
	<h2><?php __($report['Reports']['name']);?></h2>
	<?php
		echo '<strong>Report Date:</strong>'.date('l F jS Y h:i:s A').'<br>';
		echo '<strong>User Filter:</strong>'.$users[$report['Reports']['userFilter']].'<br>';
		echo '<strong>Date Filter:</strong>'.$dateFilter.'<br>';
	?>
	<table cellpadding="0" cellspacing="0">
	<tr>
	<th>Sale ID</th>
	<th>Date</th>
	<th>User</th>
	<th>Total</th>
	<th>Tax</th>
	<th>Ext</th>
	</tr>
	<?php
	$i = 0;$etotal=0;$ttotal=0;$total=0;
	foreach ($sales as $sale):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sale['Sale']['id']; ?>&nbsp;</td>
		<td><?php echo $sale['Sale']['closed']; ?>&nbsp;</td>
		<td><?php echo $sale['User']['username']; ?>&nbsp;</td>
		<td><?php echo number_format($sale['Sale']['ext']-$sale['Sale']['tax'],2); $total+=($sale['Sale']['ext']-$sale['Sale']['tax']); ?>&nbsp;</td>
		<td><?php echo $sale['Sale']['tax']; $ttotal+=$sale['Sale']['tax']; ?>&nbsp;</td>
		<td><?php echo $sale['Sale']['ext']; $etotal+=$sale['Sale']['ext']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	<tr>
	<th></th> <th></th> <th></th> <th></th>  <th></th> <th></th>
	</tr>
	<tr>
	<th></th> <th>TOTAL</th> <th></th> <th><?php echo number_format($total,2);?></th>  <th><?php echo number_format($ttotal,2);?></th> <th><?php echo number_format($etotal,2);?></th>
	</tr>
	</table>
	<p>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php if($role>2) echo $this->Html->link(__('Edit Report', true), array('controller' => 'reports','action' => 'edit',$report['Reports']['id'])); ?> </li>
		<li><?php if($role>2) echo $this->Html->link(__('Sales Reports', true), array('controller' => 'reports','action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('action' => 'add')); ?></li>
		<li><?php if($role>2) echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>2) echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if($role>1) echo $this->Html->link(__('List Consignees', true), array('controller' => 'consignees', 'action' => 'index')); ?> </li>
		<li><?php if($role>1) echo $this->Html->link(__('New Consignee', true), array('controller' => 'consignees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Browse Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php if($role>2) echo $this->Html->link(__('Company Options', true), array('controller' => 'options', 'action' => 'edit',1)); ?> </li>
	</ul>
</div>