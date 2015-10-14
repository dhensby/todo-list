<?php

/**
 * Class TodoTask
 *
 * The DataObject representing a todo task within a list
 */
class TodoTask extends DataObject {

	/**
	 * @var array
	 * @config
	 */
	private static $db = array(
		'Title' => 'Varchar(255)',
		'isComplete' => 'Boolean',
		'Sort' => 'Int',
	);

	/**
	 * @var array
	 * @config
	 */
	private static $has_one = array(
		'List' => 'TodoList',
	);

	/**
	 * @var string
	 * @config
	 */
	private static $default_sort = 'Sort';

	/**
	 * @var string
	 * @config
	 */
	private static $singular_name = 'Task';

	/**
	 * Before write logic
	 */
	protected function onBeforeWrite() {
		parent::onBeforeWrite();
		//if there is no sort and the list ID is set
		if (!$this->Sort && $this->List()->exists()) {
			$this->setSortToEnd();
		}
	}

	/**
	 * Set the sort to be the highest in the list
	 *
	 * @return $this
	 */
	protected function setSortToEnd() {
		$max = max(0, $this->List()->Tasks()->count(), $this->List()->Tasks()->max('Sort'));
		$this->Sort = $max + 1;
		return $this;
	}

	public function Link($action = null) {
		return Controller::join_links($this->List()->Link(), 'task', $this->ID, $action);
	}

}
