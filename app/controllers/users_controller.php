<?php
class UsersController extends AppController {

	var $name = 'Users';

	function beforeFilter() {
		parent::beforeFilter();
		$q=$this->User->query('select * from users');
		//check if this is the first user added, if so allow add without auth
		if(!$q) $this->Auth->allow('add');
	} 
	
	function index() {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		$roles=array(1=>'Salesperson',2=>'Supervisor',3=>'Manager');
		$this->set(compact('roles'));
	}

	function view($id = null) {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		$q=$this->User->query('select * from users');
		if ($q && $this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if($q) $this->set('firstUser',false);
		else $this->set('firstUser',true);
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				if (!$this->Auth->user('id')) $this->Auth->login($this->data);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$roles=array(1=>'Salesperson',2=>'Supervisor',3=>'Manager');
		$this->set(compact('roles'));
	}

	function edit($id = null) {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			$this->data['User']['password']='';
		}
		$roles=array(1=>'Salesperson',2=>'Supervisor',3=>'Manager');
		$this->set(compact('roles'));
	}

	function delete($id = null) {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function login(){
	$q=$this->User->query('select * from users');
	//check if this is the first user added, if so redirect to add user
	if(!$q) $this->redirect(array('action' => 'add'));
	}
	
	function logout(){
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}
}
?>