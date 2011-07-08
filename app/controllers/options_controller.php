<?php
class OptionsController extends AppController {

	var $name = 'Options';


	function edit($id = null) {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'sales','action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid option', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Option->save($this->data)) {
				$this->Session->setFlash(__('The option has been saved', true));
				$this->redirect(array('controller' => 'sales','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Option->read(null, $id);
		}
	}

}
?>