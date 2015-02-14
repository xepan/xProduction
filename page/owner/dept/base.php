<?php

class page_xProduction_page_owner_dept_base extends page_xProduction_page_owner_main{
	public $department;
	function init(){
		parent::init();

		if(!$this->api->stickyGET('department_id'))
			throw $this->exception("Department ID must be specified");

		$this->department = $this->add('xHR/Model_Department')->load($_GET['department_id']);
			

	}
}