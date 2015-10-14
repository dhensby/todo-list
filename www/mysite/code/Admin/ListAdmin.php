<?php

/**
 * Class ListAdmin
 *
 * An admin to manage TodoList objects
 */
class ListAdmin extends ModelAdmin {

	/**
	 * @var array
	 * @config
	 */
	private static $managed_models = array(
		'TodoList',
		//'TodoTask',
	);

	/**
	 * @var string
	 * @config
	 */
	private static $menu_title = 'Todo Lists';

	/**
	 * @var string
	 * @config
	 */
	private static $url_segment = 'todos';

	/**
	 * @var int
	 * @config
	 */
	private static $menu_priority = 1;

	/**
	 * @var string
	 * @config
	 */
	private static $menu_icon = 'framework/admin/images/menu-icons/16x16/pencil.png';

}
