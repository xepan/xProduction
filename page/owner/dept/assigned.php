<?php

class page_xProduction_page_owner_dept_assigned extends page_xProduction_page_owner_dept_base{
	
	function init(){
		parent::init();
		
		
		$crud=$this->add('CRUD',array('grid_class'=>'xShop/Grid_Quotation'));
		$crud->setModel('xShop/Quotation_Assigned');
		

		$crud->add('xHR/Controller_Acl');


	}
}