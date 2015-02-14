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

		$this->addField('name')->caption('Job Number');
		$this->addField('status')->enum(array('-','received','approved','assigned','processing','processed','completed','forwarded'))->defaultValue('-');
		$this->add('dynamic_model/Controller_AutoCreator');

	}
}	