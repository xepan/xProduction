<?php
namespace xProduction;

class Model_Department extends \Model_Table{
	public $table="xhr_departments";
	function init(){
		parent::init();
		$this->hasOne('Branch','branch_id');
		$this->hasOne('xProduction/Department','previous_department_id');
		
		$this->addField('name')->Caption('Department');
		$this->addField('proceed_after_previous_department')->type('boolean');
		$this->addField('internal_approved')->type('boolean');
		$this->addField('acl_approved')->type('boolean');
		$this->addField('jobcard_assign_required')->type('boolean');
		$this->addField('production_department')->type('boolean');
		$this->addField('is_active')->type('boolean')->defaultValue(true);
		
		$this->hasMany('xProduction/Department','previous_department_id',null);
		$this->hasMany('xHR/Post','department_id');
		$this->hasMany('xHR/Employee','department_id');
		$this->hasMany('xHR/HolidayBlock','department_id');
		$this->hasMany('xShop/ItemDepartmentAssociation','department_id');
		
		$this->addHook('beforeSave',$this);
		$this->addHook('beforeDelete',$this);

		// $this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){}
	function beforeDelete(){}

	function createAssociationWithItem($item_id){
		if(!$this->loaded() and $item_id > 0)
			throw new \Exception("Department Model Must be Loaded");

		$asso_model = $this->add('xShop/Model_ItemDepartmentAssociation');
		$asso_model->addCondition('department_id', $this['id']);
		$asso_model->addCondition('item_id', $item_id);
		$asso_model->tryLoadAny();
		
		$asso_model['is_active'] = true;
		$asso_model->save();

	}

}