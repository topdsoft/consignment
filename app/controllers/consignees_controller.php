<?php
class ConsigneesController extends AppController {

	var $name = 'Consignees';

	function index() {
		$this->Consignee->recursive = 0;
		$this->set('consignees', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid consignee', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('consignee', $this->Consignee->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Consignee->create();
			if ($this->Consignee->save($this->data)) {
				$this->Session->setFlash(__('The consignee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The consignee could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid consignee', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Consignee->save($this->data)) {
				$this->Session->setFlash(__('The consignee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The consignee could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Consignee->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for consignee', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Consignee->delete($id)) {
			$this->Session->setFlash(__('Consignee deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Consignee was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>