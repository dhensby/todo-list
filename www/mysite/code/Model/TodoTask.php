<?php

class TodoTask extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'isComplete' => 'Boolean',
	);

	private static $has_one = array(
		'List' => 'TodoList',
	);

}
