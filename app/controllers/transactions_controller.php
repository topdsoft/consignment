<?php
class TransactionsController extends AppController {

	var $name = 'Transactions';

	function index() {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		$this->Transaction->recursive = 0;
		$this->set('transactions', $this->paginate());
	}

	function receipt($id = null) {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid transaction', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('transaction', $this->Transaction->read(null, $id));
		$this->set('employee',$this->Auth->user('username'));
		$fields=array('Transaction.amount','Transaction.created','Transaction.id','Item.name');
		//get consignee_id
		$cid=$this->Transaction->field('consignee_id','id='.$id);
		$this->Transaction->recursive = 1;
		//now find the last time before this transaction where the consignee was paid in full
		$lastPIF=$this->Transaction->find('first',array('fields'=>$fields,'order'=>'Transaction.created desc','conditions'=>
			array('Transaction.consignee_id='.$cid,'Transaction.paidfull','Transaction.id!='.$id)));
		//get the id of the last paid in full transaction to use late to get all transactions after it
		if($lastPIF) $lastPIF=$lastPIF['Transaction']['id'];
		else $lastPIF=0;
//debug($lastPIF);exit;
		$this->set('transactions',$this->Transaction->find('all',array('fields'=>$fields,'order'=>'Transaction.created','conditions'=>
			array('Transaction.consignee_id='.$cid,'Transaction.id>'.$lastPIF))));
		$this->layout='receipt';
	}


	function payment($id = null) {
		//make a payment to consignee $id
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!empty($this->data)) {
			$this->Transaction->create();
			//check if paid in full
			if (number_format($this->data['Transaction']['amount'],2)==$this->Transaction->Consignee->field('balance','id='.$this->data['Transaction']['consignee_id'])) $this->data['Transaction']['paidfull']=true;
			//negate amount
			if ($this->data['Transaction']['amount']>0) $this->data['Transaction']['amount']*=-1;
			if ($this->Transaction->save($this->data)) {
				$this->Session->setFlash(__('The transaction has been saved', true));
				$this->redirect(array('action' => 'receipt',$this->Transaction->getInsertID()));
//				$this->redirect(array('controller' => 'consignees','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.', true));
			}
		}
		$this->set('consignee',$this->Transaction->Consignee->find('all',array('conditions'=>'Consignee.id='.$id)));
	}
}
?>