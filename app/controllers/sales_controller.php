<?php
class SalesController extends AppController {

	var $name = 'Sales';

	function index() {
		$this->Sale->recursive = 0;
		$this->set('sales', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sale', $this->Sale->read(null, $id));
	}

	function add() {
//		if (!empty($this->data)) {
		$this->Sale->create();
		$this->data['Sale']['user_id']=$this->Auth->user('id');
		$this->data['Sale']['status']='O';
		if ($this->Sale->save($this->data)) {
			//get sale id
			$so_id=$this->Sale->getInsertId();
			$this->Session->setFlash(__('Sale '.$so_id.' has been started', true));
			$this->redirect(array('controller'=>'details','action' => 'add',$so_id));
		} else {
			$this->Session->setFlash(__('The sale could not be saved. Please, try again.', true));
		}
/*		}
		$users = $this->Sale->User->find('list');
		$this->set(compact('users'));//*/
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sale->save($this->data)) {
				$this->Session->setFlash(__('The sale has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sale->read(null, $id);
		}
		$users = $this->Sale->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for sale', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sale->delete($id)) {
			$this->Session->setFlash(__('Sale deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sale was not deleted', true));
		$this->redirect(array('action' => 'index'));
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

}
?>