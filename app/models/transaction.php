<?php
class Transaction extends AppModel {
	var $name = 'Transaction';
	
	var $validate = array(
		'amount' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'You need to enter the Consignee\'s payment here.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Consignee' => array(
			'className' => 'Consignee',
			'foreignKey' => 'consignee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function addSale ($amount, $sale_id, $item_id, $consignee_id) {
		//amount should be positive
		$this->create();
		$this->data['amount']=$amount;
		$this->data['sale_id']=$sale_id;
		$this->data['item_id']=$item_id;
		$this->data['consignee_id']=$consignee_id;
		return $this->save($this->data);
	}

	function addPayment ($amount, $consignee_id) {
		//$amount should be positive
		$this->create();
		$this->data['amount']=$amount*-1;
		$this->data['consignee_id']=$consignee_id;
		return $this->save($this->data);
	}

}
?>