<div class="sales index">
	<h2><?php __($report['Reports']['name']);?></h2>
	<?php
		echo '<strong>Report Date:</strong>'.date('l F jS Y h:i:s A').'<br>';
		echo '<strong>User Filter:</strong>'.$users[$report['Reports']['userFilter']].'<br>';
		echo '<strong>Category Filter:</strong>'.$catName.'<br>';
		echo '<strong>Consignee Filter:</strong>'.$consigneeName.'<br>';
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
	$i = 0;$etotal=0;$ttotal=0;$total=0;$saleId=0;$arrayIndex=0;
	foreach ($sales as $sale):
		$class = null;
		if ($i % 2 == 0) {
			$class = ' class="altrow"';
		}
		//loop for each detail
		if ($saleId!=$sale['Sale']['id']) {
			//this is a new sale id (start new row)
			$i++;
			$saleId=$sale['Sale']['id'];
			$saleTaxTotal=$saleExtTotal=0;
			$saleArray=array();
			$saleTaxArray=array();
			$saleExtArray=array();
			echo "<tr$class>";
			echo "<td>$saleId</td>";
			echo "<td>".$sale['Sale']['closed'];
			$j=$arrayIndex;
			while($j<count($sales) && $sales[$j]['Sale']['id']==$saleId) {
				//loop for all the details of this sale
				if($viewDetails)echo "<br><small>{$sales[$j]['Detail']['qty']} {$itemNames[$sales[$j]['Detail']['item_id']]}</small>";
				//total up ext and tax
				$saleTaxTotal+=$sales[$j][0]['tax'];
				$saleExtTotal+=$sales[$j][0]['ext'];
				//add values to arrays
				$saleTaxArray[]=$sales[$j][0]['tax'];
				$saleExtArray[]=$sales[$j][0]['ext'];
				$saleArray[]=number_format($sales[$j][0]['ext']-$sales[$j][0]['tax'],2);
				$j++;
			}//end while
			echo '</td>';
			echo "<td>{$sale['Sale']['User']['username']}</td>";
			echo "<td>".number_format($saleExtTotal-$saleTaxTotal,2);
			$total+=number_format($saleExtTotal-$saleTaxTotal,2);
			if($viewDetails)foreach($saleArray as $x) echo "<br><small>$x</small>";
			echo '</td>';
			echo "<td>".number_format($saleTaxTotal,2);
			$ttotal+=$saleTaxTotal;
			if($viewDetails)foreach($saleTaxArray as $x) echo "<br><small>$x</small>";
			echo '</td>';
			echo "<td>".number_format($saleExtTotal,2);
			$etotal+=$saleExtTotal;
			if($viewDetails)foreach($saleExtArray as $x) echo "<br><small>$x</small>";
			echo '</td></tr>';
		}//endif
		$arrayIndex++;
	?>
<?php endforeach; ?>
	<tr>
	<th></th> <th></th> <th></th> <th></th>  <th></th> <th></th>
	</tr>
	<tr>
	<th></th> <th>TOTAL</th> <th></th> <th><?php echo number_format($total,2);?></th>  <th><?php echo number_format($ttotal,2);?></th> <th><?php echo number_format($etotal,2);?></th>
	</tr>
	</table>
	<p>
<?php //debug($sales); ?>

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