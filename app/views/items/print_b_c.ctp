<?php

require_once('plugins/barcode.php');

$bc=new BarcodeHelper;

$bc->setType('C128');
$bc->setCode('100001');
$bc->setSize(100,150);
$bc->setColors('#000000','#ffffff');
$bc->setText('AUTO');
//$bc->showBarcodeImage();

// Generates image file on server             
$bc->writeBarcodeFile('img/bc.png'); 

// Display image 
//echo $html->image('bc.png'); 

//debug($items);

$i=0;
echo '<table><tr>';
foreach ($items as $item) {
	//loop printing all codes
	$bc->setCode($item['Item']['scancode']);
	$bc->writeBarcodeFile('img/bc'.$item['Item']['scancode'].'.png'); 
	for($j=0;$j<$item['Item']['qty'];$j++) {
		//loop for each qty to print
		echo '<td>';
		echo $html->image('bc'.$item['Item']['scancode'].'.png');
		echo '<br>'.$item['Item']['name'];
		echo '&nbsp;&nbsp;&nbsp;$'.$item['Item']['price'];
		echo '&nbsp;&nbsp;&nbsp;('.($j+1).'/'.$item['Item']['qty'];
		echo ')<td>';
		$i++;
		if ($i%3==0) echo '</tr><tr>';
	}//end for j
//	unlink('img/bc'.$item['Item']['scancode'].'.png');
}//end foreach
echo '</tr></table>';

?>
<script type='text/javascript'>
	var ok = window.print(); 
	window.location="<?php echo $html->url('/items/')?>";
</script> 
