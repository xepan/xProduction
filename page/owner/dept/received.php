<?php

class page_xProduction_page_owner_dept_received extends page_xProduction_page_owner_dept_base{
	
	function init(){
		parent::init();
		
		$received_jobcard_model=$this->add('xProduction/Model_Jobcard_Received');

		$crud=$this->add('CRUD',array('grid_class'=>'xProduction/Grid_JobCard'));
		$crud->setModel($received_jobcard_model);

		$p=$crud->addFrame('assign',array('label'=>'label','title'=>'title','descr'=>'descr'));
		if($p){
			$form = $p->add('Form');
			$form->addField('DropDown','employee')->setModel($this->department->employees());
			$form->addSubmit();
			if($form->isSubmitted()){
				$employee_selected = $this->add('xHR/Model_Employee')->load($form['employee']);
				$this->add('xProduction/Model_Jobcard_Received')
					->load($crud->id)
					->assignTo($employee_selected);
			}
		}

	}
}