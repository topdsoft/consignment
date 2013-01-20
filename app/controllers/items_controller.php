<?php
class ItemsController extends AppController {

	var $name = 'Items';

	function index($cat_id = null, $showq0 = false ) {
		$this->Item->recursive = 0;
		if ($cat_id) {
			//filter only items from this category or children of it
			$allChildren=$this->Item->Category->children($cat_id);
			$lst=array();
			//add parent category
			$lst[]=$cat_id;
			//add all children
			foreach ($allChildren as $child) $lst[]=$child['Category']['id'];
			if ($showq0)$this->set('items', $this->paginate('Item', array('Item.category_id' => $lst) ));
			else $this->set('items', $this->paginate('Item', array('Item.qty>0 and Item.category_id' => $lst) ));
			$this->set('cat',$this->Item->Category->find('first',array('conditions'=>'Category.id='.$cat_id)));
		} else {
			//no category filter set
			if ($showq0)$this->set('items', $this->paginate('Item'));
			else $this->set('items', $this->paginate('Item', array('Item.qty>0')));
			$this->set('children',$this->Item->Category->find('all',array('conditions'=>array('OR'=>array('Category.parent_id=0','Category.parent_id is NULL')))));
		}//endif
		$this->set('role',$this->Auth->user('role'));
		$this->set('showq0',$showq0);
		$this->set('cat_id',$cat_id);
		if ($this->Item->find('first',array('conditions'=>'printBC'))) $this->set('barcodes',true);
		else $this->set('barcodes',false);
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
			$this->set('children',$this->Item->Category->find('all',
				array('conditions'=>array('Category.parent_id'=>0))));
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
			if ($this->data['Item']['printBC']) {
				//generate barcode
				$this->data['Item']['scancode']=ClassRegistry::init('Option')->field('lastBc')+1;
				//update counter
				$this->Item->query('update options set lastBC=\''.$this->data['Item']['scancode'].'\'');
			}//endif
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				if ($this->data['Item']['addmore']) $this->redirect(array('action' => 'add', $this->data['Item']['consignee_id']));
				else $this->redirect(array('action' => 'index'));
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
	
	function printBC() {
		//output qued barcodes
		$this->Item->recursive = 0;
		$this->set('items',$this->Item->find('all',array('conditions'=>'printBC','fields'=>array('Item.scancode','Item.qty','Item.price','Item.name'))));
		//now clear print flags
		$this->Item->query('update items set printBC=0 where printBC=1');
		$this->layout='receipt';
		//cleanup directory from last time around
		$mask='img/bc*.png';
		array_map("unlink",glob($mask));
	}
	
	function donePrint() {
		//called after printing to clear print flags
	}
	
}
?>