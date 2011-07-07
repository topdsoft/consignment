<?php
class TransactionsController extends AppController {

	var $name = 'Transactions';

	function index() {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		$this->Transaction->recursive = 0;
		$this->set('transactions', $this->paginate());
	}

	function payment($id = null) {
		//make a payment to consignee $id
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!empty($this->data)) {
			$this->Transaction->create();
			//negate amount
			if ($this->data['Transaction']['amount']>0) $this->data['Transaction']['amount']*=-1;
			if ($this->Transaction->save($this->data)) {
				$this->Session->setFlash(__('The transaction has been saved', true));
				$this->redirect(array('controller' => 'consignees','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.', true));
			}
		}
		$this->set('consignee',$this->Transaction->Consignee->find('all',array('conditions'=>'Consignee.id='.$id)));
	}
}
?>