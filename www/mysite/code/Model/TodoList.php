<?php

/**
 * Class TodoList
 *
 * DataObject representing a Todo list (a set of todo tasks)
 */
class TodoList extends DataObject {

	/**
	 * @var array
	 * @config
	 */
	private static $db = array(
		'Title' => 'Varchar(255)',
	);

	/**
	 * @var array
	 * @config
	 */
	private static $has_many = array(
		'Tasks' => 'TodoTask',
	);

	/**
	 * @var string
	 * @config
	 */
	private static $singular_name = 'List';

	/**
	 * @return float
	 */
	public function PercentComplete() {
		return round(($this->CompleteTasks()->Count() / $this->Tasks()->Count()) * 100);
	}

	/**
	 * All the completed tasks
	 *
	 * @return SS_List
	 */
	public function CompleteTasks() {
		return $this->Tasks()->filter(array(
			'isComplete' => true,
		));
	}

	/**
	 * All the incompleted tasks
	 *
	 * @return SS_List
	 */
	public function IncompleteTasks() {
		return $this->Tasks()->filter(array(
			'isComplete' => false,
		));
	}

	/**
	 * The link to the todo list
	 * @param string $action
	 * @return string
	 */
	public function Link($action = null) {
		return Controller::join_links('todo', $this->ID, $action);
	}

	/**
	 * Before delete logic
	 */
	protected function onBeforeDelete() {
		parent::onBeforeDelete();
		foreach($this->Tasks() as $task) {
			$task->delete();
		}
	}

}
