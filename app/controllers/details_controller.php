<?php
class DetailsController extends AppController {

	var $name = 'Details';

	function index() {
		$this->Detail->recursive = 0;
		$this->set('details', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('detail', $this->Detail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Detail->create();
			if ($this->Detail->save($this->data)) {
				$this->Session->setFlash(__('The detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The detail could not be saved. Please, try again.', true));
			}
		}
		$sales = $this->Detail->Sale->find('list');
		$items = $this->Detail->Item->find('list');
		$this->set(compact('sales', 'items'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Detail->save($this->data)) {
				$this->Session->setFlash(__('The detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Detail->read(null, $id);
		}
		$sales = $this->Detail->Sale->find('list');
		$items = $this->Detail->Item->find('list');
		$this->set(compact('sales', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Detail->delete($id)) {
			$this->Session->setFlash(__('Detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>