<?php

/**
 * Class ListController
 *
 * ListController for handling requests to do with managing and showing lists and their tasks
 */
class ListController extends Controller {

	/**
	 * @var array
	 * @config
	 */
	private static $url_handlers = array(
		'' => 'index',
		'AddListForm' => 'AddListForm',
		'$ListID/task' => 'task',
		'$ListID/delete' => 'deletelist',
		'$ListID/TaskForm' => 'TaskForm',
 		'$ListID!' => 'viewlist',
	);

	/**
	 * @var array
	 * @config
	 */
	private static $allowed_actions = array(
		'task',
		'viewlist',
		'deletelist',
		'AddListForm',
		'TaskForm',
	);

	/**
	 * @var SS_List
	 */
	private $lists;

	/**
	 * @var TodoList
	 */
	private $list;

	/**
	 * Get the DataList of TodoLists
	 * @return SS_List
	 */
	public function getLists() {
		//if there is no "lists" then set it
		if (!$this->lists) {
			$this->setLists(TodoList::get());
		}
		return $this->lists;
	}

	/**
	 * The list of TodoLists
	 *
	 * @param SS_List $lists
	 * @return $this
	 */
	public function setLists($lists) {
		$this->lists = $lists->filterByCallback(function($item) {
			return $item->canView();
		});
		return $this;
	}

	/**
	 * Get the specific TodoList
	 *
	 * @return TodoList
	 */
	public function getTodoList() {
		//if we don't have a list, populate it form the request
		if (!$this->list) {
			$this->setTodoList($this->getTodoListFromRequest());
		}
		return $this->list;
	}

	/**
	 * Get the TodoList from the request ID
	 *
	 * @param SS_HTTRequest $request
	 * @return TodoList
	 */
	public function getTodoListFromRequest($request = null) {
		//if we aren't passed a request object, assume the current request
		if (!$request) {
			$request = $this->getRequest();
		}
		$listID = $request->latestParam('ListID');
		if ($listID) {
			return TodoList::get()->byID($listID);
		}
		//if there was no list ID return a new TodoList object to keep a consistent API
		return TodoList::create();
	}

	/**
	 * Set the todo list
	 *
	 * @param TodoList $list
	 * @return $this
	 */
	public function setTodoList($list) {
		if (!$list->canView()) {
			$list = TodoList::create();
		}
		$this->list = $list;
		return $this;
	}

	/**
	 * The title for the page
	 *
	 * @return string
	 */
	public function Title() {
		return 'Todo Lists';
	}

	/**
	 * The meta title for the page
	 * @return string
	 */
	public function MetaTitle() {
		return self::Title();
	}

	/**
	 * The default request handler
	 *
	 * @param SS_HTTPRequest $request
	 * @return $this
	 */
	public function index($request) {
		return $this;
	}

	/**
	 * The action to display an individual list
	 *
	 * @param SS_HTTPRequest $request
	 * @return $this
	 */
	public function viewlist($request) {
		return $this;
	}

	/**
	 * The action to display an individual list
	 *
	 * @param SS_HTTPRequest $request
	 * @return $this
	 */
	public function deletelist($request) {
		$this->getTodoList()->delete();
		return $this->redirectBack();
	}

	/**
	 * The action to hanle an individual task
	 *
	 * @param SS_HTTPRequest $request
	 * @return TaskController
	 */
	public function task($request) {
		return TaskController::create()->handleRequest($request, $this->model);
	}

	/**
	 * Generates a Link to the current controller
	 *
	 * @param string $action
	 * @return string
	 */
	public function Link($action = null) {
		return Controller::join_links('todo', $action);
	}

	/**
	 * Create a form for adding lists to the DB
	 *
	 * @return Form
	 */
	public function AddListForm() {
		return Form::create($this, __FUNCTION__, FieldList::create(
			TextField::create('Title')
				->addExtraClass('form-control')
		), FieldList::create(
			FormAction::create('doAddNewList', 'Add list')
				->addExtraClass('btn btn-primary')
		), RequiredFields::create('Title'));
	}

	/**
	 * The form handler for AddListForm
	 *
	 * @param array $rawData
	 * @param Form $form
	 * @param SS_HTTPRequest $request
	 */
	public function doAddNewList($rawData, $form, $request) {
		$list = TodoList::create();
		$form->saveInto($list);
		$list->write();
		$this->redirectBack();
	}

	/**
	 * The form for adding Tasks to a TodoList
	 *
	 * @return Form
	 */
	public function TaskForm() {
		return Form::create($this, __FUNCTION__, FieldList::create(
			TextField::create('Title', 'Add task')
				->addExtraClass('form-control')
		), FieldList::create(
			FormAction::create('doAddTask', 'Add task')
				->addExtraClass('btn btn-primary')
		), RequiredFields::create('Title'))
			//we need to set the FormAction to keep the URL correct so we can determine the List from the URL
			->setFormAction($this->Link($this->getTodoList()->ID . '/' . __FUNCTION__));
	}

	/**
	 * The form handler for TaskForm
	 *
	 * @param array $rawData
	 * @param Form $form
	 * @param SS_HTTPRequest $request
	 */
	public function doAddTask($rawData, $form, $request) {
		$task = TodoTask::create();
		$form->saveInto($task);
		$task->write();
		$this->getTodoList()->Tasks()->add($task);
		$this->redirectBack();
	}

}
