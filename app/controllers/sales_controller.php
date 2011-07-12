<?php
class SalesController extends AppController {

	var $name = 'Sales';

	function index() {
		$this->Sale->recursive = 0;
		$this->Sale->order='created desc';
		if($this->Auth->user('role')==1) {
			//only show current user's sales to salesperson (manager and supervisor see all sales)
//			$this->Sale->conditions=;
			$this->set('sales', $this->paginate(null,array('Sale.user_id='.$this->Auth->user('id'))));
		} else $this->set('sales', $this->paginate());
		$this->set('role',$this->Auth->user('role'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Sale->recursive = 2;
		$this->set('sale', $this->Sale->read(null, $id));
		$this->set('role',$this->Auth->user('role'));
	}

	function receipt($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Sale->recursive = 2;
		$this->set('sale', $this->Sale->read(null, $id));
		$this->set('role',$this->Auth->user('role'));
		$this->layout='receipt';
	}

	function add($item_id = null) {
//		if (!empty($this->data)) {
		$this->Sale->create();
		$this->data['Sale']['user_id']=$this->Auth->user('id');
		$this->data['Sale']['status']='O';
		if ($this->Sale->save($this->data)) {
			//get sale id
			$so_id=$this->Sale->getInsertId();
			$this->Session->setFlash(__('Sale '.$so_id.' has been started', true));
			$this->redirect(array('controller'=>'details','action' => 'add',$so_id,$item_id));
		} else {
			$this->Session->setFlash(__('The sale could not be saved. Please, try again.', true));
		}
/*		}
		$users = $this->Sale->User->find('list');
		$this->set(compact('users'));//*/
	}

	function void($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sale', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sale->field('status','id='.$id.' and status="O"')) {
			//should be ok to void
			$this->data['Sale']['status']='V';
			if ($this->Sale->save($this->data)) {
				$this->Session->setFlash(__('The sale has been voided', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('The sale could not be voided.', true));
		$this->redirect(array('action' => 'index'));
	}

	function finish($id = void) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sale', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sale->field('status','id='.$id.' and status="O"')) {
			//loop for each item in sale
			$ok=true;
			$details=$this->Sale->Detail->find('all',array('conditions'=>'sale_id='.$id));
			foreach ($details as $detail) {
				//process each item in sale-first reduce inventory
				if($ok) $ok=ClassRegistry::init('Item')->adjustQty($detail['Detail']['item_id'],-$detail['Detail']['qty']);
				//now give consignee credit for the sale
				$amount=number_format($detail['Detail']['qty']*($detail['Item']['price']-($detail['Item']['price']*(ClassRegistry::init('Consignee')->field('default','id='.$detail['Item']['consignee_id'])/100))),2);
//echo $amount;
				if($ok) $ok=ClassRegistry::init('Transaction')->addSale($amount,$id,$detail['Item']['id'],$detail['Item']['consignee_id']);
			}//end foreach
//debug($details);exit;
			//should be ok to close
			$this->data['Sale']['status']='C';
			$this->data['Sale']['closed']= date("Y-m-d H:i:s");
			if ($ok && $this->Sale->save($this->data)) {
				$this->Session->setFlash(__('The sale has been completed', true));
				$this->redirect(array('action' => 'receipt',$id));
			}
		}
		$this->Session->setFlash(__('The sale could not be completed.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>