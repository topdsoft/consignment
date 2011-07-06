<?php
class ItemsController extends AppController {

	var $name = 'Items';

	function index($cat_id = null) {
		$this->Item->recursive = 0;
		if ($cat_id) {
			//filter only items from this category or children of it
			$allChildren=$this->Item->Category->children($cat_id);
			$lst=array();
			//add parent category
			$lst[]=$cat_id;
			//add all children
			foreach ($allChildren as $child) $lst[]=$child['Category']['id'];
			$this->set('items', $this->paginate('Item', array('Item.qty>0 and Item.category_id' => $lst) ));
			$this->set('cat',$this->Item->Category->find('first',array('conditions'=>'Category.id='.$cat_id)));
		} else {
			//no category filter set
			$this->set('items', $this->paginate('Item', array('Item.qty>0')));
			$this->set('children',$this->Item->Category->find('all',array('conditions'=>'Category.parent_id=0')));
		}//endif
		$this->set('role',$this->Auth->user('role'));
	}

	function lookup($id = null,$cat_id = null) {
		//function to look up item and then return to sale details and add item
		if (!$id) $this->redirect(array('controller' => 'items','action' => 'index'));
		$this->Item->recursive = 0;
		if ($cat_id) {
			//filter only items from this category or children of it
			$allChildren=$this->Item->Category->children($cat_id);
			$lst=array();
			//add parent category
			$lst[]=$cat_id;
			//add all children
			foreach ($allChildren as $child) $lst[]=$child['Category']['id'];
			$this->set('items', $this->paginate('Item', array('Item.qty>0 and Item.category_id' => $lst) ));
			$this->set('cat',$this->Item->Category->find('first',array('conditions'=>'Category.id='.$cat_id)));
		} else {
			//no category filter set
			$this->set('items', $this->paginate('Item', array('Item.qty>0')));
			$this->set('children',$this->Item->Category->find('all',array('conditions'=>'Category.parent_id=0')));
		}//endif
		$this->set('so_id',$id);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('item', $this->Item->read(null, $id));
		$this->set('role',$this->Auth->user('role'));
	}

	function add($cons_id = null) {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!empty($this->data)) {
			$this->Item->create();
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		$categories = $this->Item->Category->generatetreelist(null,null,null," - ");
//		$categories = $this->Item->Category->find('list');
		$consignees = $this->Item->Consignee->find('list');
		$this->set(compact('categories', 'consignees'));
		if ($cons_id) $this->set('cons_id',$cons_id);
		$this->set('role',$this->Auth->user('role'));
	}

	function edit($id = null) {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Item->read(null, $id);
		}
		$categories = $this->Item->Category->find('list');
		$consignees = $this->Item->Consignee->find('list');
		$this->set(compact('categories', 'consignees'));
		$this->set('role',$this->Auth->user('role'));
	}

	function scancode($id = null) {
		if ($this->Auth->user('role')==1) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Item->read(null, $id);
		}
		$this->set('role',$this->Auth->user('role'));
	}

	function delete($id = null) {
		if ($this->Auth->user('role')!=3) $this->redirect(array('controller' => 'items','action' => 'index'));
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Item->delete($id)) {
			$this->Session->setFlash(__('Item deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Item was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>