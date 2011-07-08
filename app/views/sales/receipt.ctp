<table><tr>
<td><?php echo nl2br(ClassRegistry::init('Option')->field('address')) ?></td>
<td align="right"><?php
	echo '<strong>Sale ID:</strong><br>';
	echo '<strong>Sale Date:</strong><br>';
	echo '<strong>Employee:</strong>';
?></td>
<td><?php
	echo $sale['Sale']['id'].'<br>';
	echo $sale['Sale']['closed'].'<br>';
	echo $sale['User']['username'];
?></td>
</tr></table>
<br><br>
<h3><?php __('Sale Details');?></h3>
	<?php if (!empty($sale['Detail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Tax'); ?></th>
		<th><?php __('Ext'); ?></th>
	</tr>
	<?php
		$i = 0;$total=0;$tqty=0;
		foreach ($sale['Detail'] as $detail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $detail['Item']['name'];?></td>
			<td><?php echo $detail['qty'];$tqty+=$detail['qty'];?></td>
			<td><?php echo $detail['Item']['price'];?></td>
			<td><?php if($detail['Item']['taxable']) echo 'Y';?></td>
			<td><?php echo $detail['ext'];$total+=$detail['ext']?></td>
		</tr>
	<?php endforeach; ?>
	<tr><th></th><th></th><th></th><th></th><th></th></tr>
	<tr><th>Total</th><th><?php echo $tqty; ?></th><th></th><th></th><th><?php echo number_format($total,2); ?></th>
	</tr>
	</table>
<?php endif; ?>
</div>
<script type='text/javascript'>window.print(); window.location="<?php echo $html->url('/sales/')?>";</script>
