<?php
class Consignee extends AppModel {
	var $name = 'Consignee';
	var $virtualFields = array (
		'fullname' => 'CONCAT (fName, " ", lName)',
		'items' => '(select count(*) from items where items.consignee_id=Consignee.id and items.qty>0)',
		'qty' => '(select sum(qty) from items where items.consignee_id=Consignee.id)',
		'total' => '(select sum(qty*price) from items where items.consignee_id=Consignee.id)',
		'balance' => '(select sum(amount) from transactions where transactions.consignee_id=Consignee.id)'
	);
	var $displayField = 'fullname';
	var $validate = array(
		'fName' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You need to enter a name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lName' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You need to enter a name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'default' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'You need to enter the Consignee\'s default fee here.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'consignee_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Transaction' => array(
			'className' => 'Transaction',
			'foreignKey' => 'consignee_id',
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