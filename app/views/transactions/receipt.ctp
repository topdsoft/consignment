<table><tr>
<td><?php echo nl2br(ClassRegistry::init('Option')->field('address')) ?></td>
<td align="right"><?php
	echo '<strong>Payment Date:</strong><br>';
	echo '<strong>Employee:</strong><br>';
	echo '<strong>Consignee:</strong>';
?></td>
<td><?php
	echo $transaction['Transaction']['created'].'<br>';
	echo $employee.'<br>';
	echo $transaction['Consignee']['fullname'].'<br>';
	echo nl2br($transaction['Consignee']['address']).'<br>';
	echo $transaction['Consignee']['phone'].'<br>';
	echo $transaction['Consignee']['email'].'<br>';
?></td>
</tr></table>
<br><br>
<h3><?php __('Payment Details');?></h3>
	<?php if (!empty($transactions)):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Date'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Amount'); ?></th>
	</tr>
	<?php
		$i = 0;$total=0;$tqty=0;//debug($transactions);
		foreach ($transactions as $t):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $t['Transaction']['created'];?></td>
			<td><?php if($t['Item']['name'])echo $t['Item']['name'];else echo'(PAYMENT)';?></td>
			<td><?php echo $t['Transaction']['amount'];$total+=$t['Transaction']['amount']; ?></td>
		</tr>
	<?php endforeach; ?>
	<tr><th></th><th></th><th></th></tr>
	<tr><th>Balance</th><th></th><th><?php echo number_format($total,2); ?></th>
	</tr>
	</table>
<?php endif; ?>
</div>
<script type='text/javascript'>window.print(); window.location="<?php echo $html->url('/consignees/')?>";</script> 
