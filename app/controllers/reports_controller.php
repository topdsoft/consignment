<?php
class ReportsController extends AppController {

	var $name = 'Reports';

	function beforeFilter() {
		parent::beforeFilter();
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
	} 

	function index() {
		$this->Report->recursive = 0;
		$this->set('reports', $this->paginate());
	}

	function add() {
		if (!empty($this->data)) {
//			debug($this->data);exit;
			$this->Report->create();
			if ($this->Report->save($this->data)) {
				$this->Session->setFlash(__('The report has been saved', true));
				$this->redirect(array('controller' => 'sales', 'action' => 'report',$this->Report->getInsertId()));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.', true));
			}
		}
		//get uid for current user
		$this->set('uid',$this->Auth->user('id'));
		//get list of users for user list filter
		$users = $this->Report->User->find('list');
		$users[0]='(ALL)';
		$this->data['Report']['userFilter']=0;
		$this->set(compact('users'));
		//get categories filter for filter display
		$categories = ClassRegistry::init('Category')->generatetreelist(null,null,null," - ");
		$categories[0]='(ALL)';
		$this->data['Report']['catFilter']=0;
		$this->set(compact('categories'));
		//get list of consignees for filter display
		$consignees = ClassRegistry::init('Consignee')->find('list',array('order'=>'lName'));
		$consignees[0]='(ALL)';
		$this->data['Report']['consigneeFilter']=0;
		$this->set(compact('consignees'));
		//default date filter to none
		$this->data['Report']['dateFilter']=0;
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid report', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Report->save($this->data)) {
				$this->Session->setFlash(__('The report has been saved', true));
				$this->redirect(array('controller' => 'sales', 'action' => 'report',$id));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Report->read(null, $id);
		}
		//get uid for current user
		$this->set('uid',$this->Auth->user('id'));
		//get list of users for user list filter
		$users = $this->Report->User->find('list');
		$users[0]='(ALL)';
//		$this->data['Report']['userFilter']=0;
		$this->set(compact('users'));
		//get categories filter for filter display
		$categories = ClassRegistry::init('Category')->generatetreelist(null,null,null," - ");
		$categories[0]='(ALL)';
//		$this->data['Report']['catFilter']=0;
		$this->set(compact('categories'));
		//get list of consignees for filter display
		$consignees = ClassRegistry::init('Consignee')->find('list',array('order'=>'lName'));
		$consignees[0]='(ALL)';
		$this->set(compact('consignees'));
		//default date filter to none
//		$this->data['Report']['dateFilter']=0;
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for report', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Report->delete($id)) {
			$this->Session->setFlash(__('Report deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Report was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>