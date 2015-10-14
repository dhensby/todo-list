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

	private static $has_one = array(
		'Owner' => 'Member',
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

	public function isComplete() {
		return $this->Tasks()->exists() && !$this->IncompleteTasks()->exists();
	}

	/**
	 * @return float
	 */
	public function PercentComplete() {
		if ($taskCount = $this->Tasks()->Count()) {
			return round(($this->CompleteTasks()->Count() / $taskCount) * 100);
		}
		return 0;
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

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		if (ClassInfo::exists('GridFieldOrderableRows')) {
			$fields->dataFieldByName('Tasks')->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));
		}

		return $fields;
	}

	public function extendedCan($methodName, $member) {
		if (!$member) {
			$member = Member::currentUser();
		}
		if ($this->Owner()->exists() && $this->Owner()->ID == $member->ID) {
			return true;
		}
		return parent::extendedCan($methodName, $member);
	}

}
