<?php

class GridFieldPaginatorWithShowAllTest extends SapphireTest{
	/** @var ArrayList */
	protected $list;
	
	/** @var GridField */
	protected $gridField1, $gridField2;
	
	/** @var Form */
	protected $form;
	
	/** @var string */
	public static $fixture_file = 'GridFieldPaginatorWithShowAllTest.yml';
	protected $extraDataObjects = array('GridFieldPaginator_ShowAll_Item');

	public function setUp() {
		parent::setUp();
		$this->list = GridFieldPaginator_ShowAll_Item::get();
		$config = GridFieldConfig::create()->addComponents(
			new GridFieldDataColumns(), new GridFieldPaginatorWithShowAll(2)
		);
		$this->gridField1 = new GridField('testfield1', 'testfield1', $this->list, $config);
		$this->gridField2 = new GridField('testfield2', 'testfield2', $this->list, $config);
		$this->form = new Form(new Controller(), 'mockform', new FieldList(array($this->gridField1, $this->gridField2)), new FieldList());
	}

	public function testTurnOnShowAllMode() {
		Session::clear('GridField.PaginatorWithShowAll.Mode');
		$fieldHolder1 = $this->gridField1->FieldHolder();
		$content1 = new CSSContentParser($fieldHolder1);
		$this->assertEquals(2, count($content1->getBySelector('tr.ss-gridfield-item')));
		$this->gridField1->State->GridFieldShowAll->showAllMode = true;
		
		/*$stateID = 'testGridStateWithShowAllTurnedOn';
		Session::set($stateID, array('grid'=>'', 'actionName'=>'setShowAllMode', 
			'args'=>array(
				'GridFieldShowAll'=>array('showAllMode'=>true),
				'GridFieldPaginator'=> array('currentPage1'=>1)
			)
		));
		$request = new SS_HTTPRequest('POST', 'url', array(), array('action_gridFieldAlterAction?StateID='.$stateID=>true));
		$this->gridField1->gridFieldAlterAction(array('StateID'=>$stateID), $this->form, $request);*/

		$fieldHolder1 = $this->gridField1->FieldHolder();
		$content1 = new CSSContentParser($fieldHolder1);
		$this->assertEquals(6, count($content1->getBySelector('tr.ss-gridfield-item')));
		Session::clear('GridField.PaginatorWithShowAll.Mode');
	}

	public function testTurnOffShowAllMode() {
		Session::clear('GridField.PaginatorWithShowAll.Mode');
		$this->gridField1->State->GridFieldShowAll->showAllMode = true;

		$fieldHolder1 = $this->gridField1->FieldHolder();
		$content1 = new CSSContentParser($fieldHolder1);
		$this->assertEquals(6, count($content1->getBySelector('tr.ss-gridfield-item')));

		$this->gridField1->State->GridFieldShowAll->showAllMode = false;
		$this->gridField1->getConfig()->getComponentByType('GridFieldPaginatorWithShowAll')->setItemsPerPage(2);

		$fieldHolder2 = $this->gridField1->FieldHolder();
		$content1 = new CSSContentParser($fieldHolder2);
		$this->assertEquals(2, count($content1->getBySelector('tr.ss-gridfield-item')));

		Session::clear('GridField.PaginatorWithShowAll.Mode');
	}

	public function testGoballyEffected() {
		Session::clear('GridField.PaginatorWithShowAll.Mode');
		$this->gridField1->State->GridFieldShowAll->showAllMode = true;
		$this->gridField1->FieldHolder();

		$fieldHolder21 = $this->gridField2->FieldHolder();
		$content21 = new CSSContentParser($fieldHolder21);
		$this->assertEquals(6, count($content21->getBySelector('tr.ss-gridfield-item')));

		$this->gridField1->State->GridFieldShowAll->showAllMode = false;
		$this->gridField1->FieldHolder();

		$this->gridField2->getConfig()->getComponentByType('GridFieldPaginatorWithShowAll')->setItemsPerPage(2);
		$fieldHolder22 = $this->gridField2->FieldHolder();
		$content22 = new CSSContentParser($fieldHolder22);
		$this->assertEquals(2, count($content22->getBySelector('tr.ss-gridfield-item')));
		Session::clear('GridField.PaginatorWithShowAll.Mode');
	}
	
}

class GridFieldPaginator_ShowAll_Item extends DataObject implements TestOnly {
	static $db = array(
		'Title' => 'Varchar',
	);
}