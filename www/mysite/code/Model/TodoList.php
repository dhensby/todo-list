<?php

class TodoList extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
	);

	private static $has_many = array(
		'Todos' => 'TodoTask',
	);

}
