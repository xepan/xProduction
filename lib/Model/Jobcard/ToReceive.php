<?php

namespace xProduction;

class Model_Jobcard_ToReceive extends Model_JobCard {
	
	function init(){
		parent::init();
		$this->addCondition('status','-');
	}
}	