<?php

class GridFieldPaginatorWithShowAll extends GridFieldPaginator {

	protected $itemClass = 'GridFieldPaginatorWithShowAll_Row';

	protected $affectGlobally = true;

	public function getTemplateData($gridField){
		$data = parent::getTemplateData($gridField);

		//Inject Requirements
		Requirements::css('paginatorwithshowall/css/GridFieldPaginatorWithShowAll.css');
		Requirements::javascript('paginatorwithshowall/javascript/GridFieldPaginatorWithShowAll.js');

		if(is_a($data, "ArrayData")){
			$showAllMode = $showAllMode =$this->getShowAllMode();
			if($showAllMode) $checked = ' checked="checked"';
			else $checked = '';

			$data->setField("ID", $gridField->ID());
			$data->setField("Checked", $checked);
			return $data;
		}else{
			return;
		}
	}

	/**
	 * Manipulate the datalist as needed by this grid modifier.
	 * @param GridField $gridField Grid Field Reference
	 * @param SS_List $dataList Data List to adjust
	 * @return DataList Modified Data List
	 */
	public function getManipulatedData(GridField $gridField, SS_List $dataList) {
		$this->setShowAllMode($gridField);

		$dataList = parent::getManipulatedData($gridField, $dataList);		
		$showAllMode =$this->getShowAllMode();

		if($showAllMode){
			$dataList->limit(999, 0); 
			$component = $gridField->getConfig()->getComponentByType('GridFieldPaginatorWithShowAll');
			$component->setItemsPerPage(1+$dataList->count());
		}

		return $dataList;
	}

	protected function setShowAllMode(GridField $gridField){
		$state =$gridField->State->GridFieldShowAll;
		if($this->getAffectGlobally()){
			$sessionMode = Session::get("GridField.PaginatorWithShowAll.Mode");
			if(isset($sessionMode)){
				if(is_bool($state->showAllMode)) {
					if($sessionMode != $state->showAllMode){
						Session::set("GridField.PaginatorWithShowAll.Mode",$state->showAllMode);
					}
				}
			}
		}else{
			/*if(!is_bool($state->showAllMode)) {
				$state->showAllMode = false;
			}*/
		}
	}

	protected function getShowAllMode(){
		if($this->getAffectGlobally()){
			$sessionMode = Session::get("GridField.PaginatorWithShowAll.Mode");
			return isset($sessionMode) && $sessionMode;
		}
	}

	public function setAffectGlobally($bool) {
		$this->affectGlobally = $bool;
		return $this;
	}

	public function getAffectGlobally() {
		return $this->affectGlobally;
	}

}