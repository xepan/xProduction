<?php

class page_xProduction_page_owner_dept_forwarded extends page_xProduction_page_owner_dept_base{
	
	function init(){
		parent::init();

		//echo "all Order item depatment association jisme (department id self ki ho aur status - ho ) ya (pichla department agar hai to uska status forwarded ho) ";
		$forwarded_to_me=$this->add('xProduction/Model_Jobcard_ToReceive');
		$crud=$this->add('CRUD',array('allow_add'=>false,'allow_del'=>false,'allow_edit'=>false));
		$crud->setModel($forwarded_to_me);
				
		$crud->add('xHR/Controller_Acl');

	}
}