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

	function add($so_id = null, $item_id = null) {
$TAX=0.07;
		if (!empty($this->data)) {
			$this->Detail->create();
			$so_id=$this->data['Detail']['sale_id'];
			$ok=false;
			if ($this->data['Detail']['item_id']) {
				//user has made selection
				$ok=true;
			} else {
				//check incomming scancode
				if (strlen($this->data['Detail']['scancode'])<4) {
					//strlength < 4 assume qty
					$this->data['Detail']['qty']=$this->data['Detail']['scancode'];
					$this->data['Detail']['scancode']='';
				} else {
					//assume scancode
					$item_id=$this->Detail->Item->field('id','scancode='.$this->data['Detail']['scancode']);
					if ($item_id) {
						//found ok
						$ok=true;
						$this->data['Detail']['item_id']=$item_id;
					} else {
						//not found
						$this->data['Detail']['scancode']='';
						$this->Session->setFlash(__('The scancode entered could not be found. Please, try again.', true));
					}
				}//endif
			}//end if for scancode vs selection
			if ($ok) {
				//calc ext
				$itmPrice=$this->Detail->Item->field('price','id='.$this->data['Detail']['item_id']);
				$itmTaxable=$this->Detail->Item->field('taxable','id='.$this->data['Detail']['item_id']);
				$this->data['Detail']['ext']=$itmPrice*(($TAX*$itmTaxable)+1)*$this->data['Detail']['qty'];
				if ($this->Detail->save($this->data)) {
//					$this->Session->setFlash(__('The detail has been saved', true));
					$this->redirect(array('action' => 'add', $so_id));
				} else {
					$this->Session->setFlash(__('The item could not be added. Please, try again.', true));
				}
			}//endif ok for saving
		}
		//validate so_id
		if(!$so_id) $this->redirect(array('controller' => 'sales','action' => 'index'));
		$soStatus=$this->Detail->Sale->field('status','id='.$so_id);
		if ($soStatus=='C') {
			//so closed
			$this->Session->setFlash(__('This Sale is listed as CLOSED', true));
			$this->redirect(array('controller' => 'sales','action' => 'index'));
		}//endif
		if ($soStatus=='V') {
			//so closed
			$this->Session->setFlash(__('This Sale is listed as VOIDED', true));
			$this->redirect(array('controller' => 'sales','action' => 'index'));
		}//endif
		if($this->Detail->Sale->field('user_id','id='.$so_id)!=$this->Auth->user('id')) {
			//not your so
			$this->Session->setFlash(__('This Sale was started by a different user', true));
			$this->redirect(array('controller' => 'sales','action' => 'index'));
		}//endif
		//check incomming item from find screen
		if ($item_id) {
			$item_name=$this->Detail->Item->field('name',"id=$item_id and qty>0");
			if ($item_name) {
				//pass item info to view
				$this->set('item_id',$item_id);
				$this->set('item_name',$item_name);
			}//endif item ok
		}//endif for item id set
		$this->set('so_id',$so_id);
		$this->set('tax',$TAX);
		if (empty($this->data)) $this->data['Detail']['qty']=1;
		$this->set('saledata',$this->Detail->find('all',array('conditions' => 'sale_id='.$so_id)));
//$this->Detail->Transaction->addPayment(250.23,1);
//ClassRegistry::init('Transaction')->addPayment(250.23,1);
//$this->Detail->Item->adjustQty(3,5);
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

	function delete($id = null, $so_id=null) {
		if (!$id || !$so_id) {
			$this->Session->setFlash(__('Invalid id for detail', true));
			$this->redirect(array('controller' => 'sales','action'=>'index'));
		}
		if ($this->Detail->delete($id)) {
			$this->Session->setFlash(__('Item deleted', true));
			$this->redirect(array('action'=>'add', $so_id));
		}
		$this->Session->setFlash(__('Item was not deleted', true));
		$this->redirect(array('action' => 'add', $so_id));
	}
}
?>