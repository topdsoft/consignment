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

	function report($report_id = null) {
		if (!$report_id) {
			$this->Session->setFlash(__('Invalid report', true));
			$this->redirect(array('controller'=>'reports','action' => 'index'));
		}
		if ($this->Auth->user('role')!=3) $this->redirect(array('action' => 'index'));
		//get report data
		$report=ClassRegistry::init('Reports')->read(null, $report_id);
		$this->set('report', $report);
		//get sales data
		$this->Sale->recursive = 0;
		$conditions=array('status="C"');
		//user filter
		if($report['Reports']['userFilter']>0) $conditions[]='user_id='.$report['Reports']['userFilter'];
		//date filters
		if($report['Reports']['dateFilter']==0) $dateFilter='(ALL)';
		if($report['Reports']['dateFilter']==1) {
			//single day filter
			$conditions[]="date(closed)='{$report['Reports']['dayFilter']}'";
			$dateFilter=$report['Reports']['dayFilter'];
		}//endif for single day
		if($report['Reports']['dateFilter']==2) {
			//date range filter
			$conditions[]="date(closed)>='{$report['Reports']['startFilter']}'";
			$conditions[]="date(closed)<='{$report['Reports']['endFilter']}'";
			$dateFilter=$report['Reports']['startFilter'].' to '.$report['Reports']['endFilter'];
		}//endif for single day
		if($report['Reports']['dateFilter']==3) {
			//current week/month/year
			if ($report['Reports']['currentFilter']==1) {
				//current week
				$conditions[]="week(closed)=week(now())";
				$conditions[]="year(closed)=year(now())";
				$dateFilter='Current Week '.date('W');
			} else if ($report['Reports']['currentFilter']==2) {
				//current month
				$conditions[]="month(closed)=month(now())";
				$conditions[]="year(closed)=year(now())";
				$dateFilter='Current Month '.date('F');
			} else {
				//current year
				$conditions[]="year(closed)=year(now())";
				$dateFilter='Current Year '.date('Y');
			}//endif
		}//endif for single day
		if($report['Reports']['dateFilter']==4) {
			//last week/month/year
			if ($report['Reports']['pastFilter']==1) {
				//last week
				$conditions[]="week(closed)=week(now()-interval 1 week)";
				$conditions[]="year(closed)=year(now()-interval 1 week)";
				$dateFilter='Last Week';
			} else if ($report['Reports']['pastFilter']==2) {
				//last month
				$conditions[]="month(closed)=month(now()-interval 1 month)";
				$conditions[]="year(closed)=year(now()-interval 1 month)";
				$dateFilter='Last Month';
			} else {
				//last year
				$conditions[]="year(closed)=year(now()-interval 1 year)";
				$dateFilter='Last Year';
			}//endif
		}//endif for single day
		$this->layout='receipt';

		//get dales data
		$sales=$this->Sale->find('all',array('conditions'=>$conditions));
		$this->set('sales',$sales);

		$this->set('role',$this->Auth->user('role'));
		$users=$this->Sale->User->find('list');
		$users[0]='(ALL)';
		$this->set(compact('users'));
		$this->set('dateFilter',$dateFilter);
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