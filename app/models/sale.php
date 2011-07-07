<?php
class Sale extends AppModel {
	var $name = 'Sale';
	var $virtualFields = array (
		'numItems' => '(select count(*) from details where details.sale_id=Sale.id)',
		'qty' => '(select sum(qty) from details where details.sale_id=Sale.id)',
		'ext' => '(select sum(ext) from details where details.sale_id=Sale.id)'
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Detail' => array(
			'className' => 'Detail',
			'foreignKey' => 'sale_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>