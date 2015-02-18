<?php

namespace xProduction;

class Model_JobCard extends \SQL_Model{
	public $table ="xproduction_jobcard";

	function init(){
		parent::init();
		// hasOne OrderItemDepartment Association id
		$this->hasOne('xShop/OrderDetails','orderitem_id');
		$this->hasOne('xHR/Department','department_id');
		$this->hasOne('xShop/OrderItemDepartmentalStatus','orderitem_departmental_status_id');

		$this->hasOne('xHR/Employee','created_by_id')->defaultValue($this->api->current_employee->id)->system(true);
		
		$this->addField('name')->caption('Job Number');
		$this->addField('status')->enum(array('-','received','approved','assigned','processing','processed','completed','forwarded'))->defaultValue('-');

		$this->hasMany('xProduction/JobCardEmployeeAssociation','jobcard_id');

		$this->add('Controller_Validator');
		$this->is(array(
							'name|to_trim|required',
							)
					);
		$this->add('dynamic_model/Controller_AutoCreator');

	}

	function assignTo($employee){
		// create log/communication 
		$temp=$this->add('xProduction/Model_JobCardEmployeeAssociation');
		$temp->addCondition('jobcard_id',$this->id);
		$temp->addCondition('employee_id',$employee->id);
		$temp->tryLoadAny();
		$temp->save();

		$this['status']='assigned';
		$this->saveAs('xProduction/Model_JobCard');
		// throw $this->exception('To Do');
	}

	function getAssociatedEmployees(){
		$associate_employees= $this->ref('xProduction/JobCardEmployeeAssociation')->_dsql()->del('fields')->field('employee_id')->getAll();
		return iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($associate_employees)),false);
	}

	function removeAllEmployees(){
		$this->ref('xProduction/JobCardEmployeeAssociation')->deleteAll();
		$this['status']='received';
		$this->save();
	}

	function start_processing(){
		
	}
}	