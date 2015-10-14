<?php

/**
 * Class RootController
 *
 * The controller to handle requests to the site's root URL - This just hands off to `ListController`
 *
 * Possibly redundant for such a mundane example
 *
 */
class RootController extends Controller {

	/**
	 * The url handlers
	 *
	 * @var array
	 * @config
	 */
	private static $url_handlers = array(
		'' => 'index',
	);

	/**
	 * The default action - hand off to ListController
	 *
	 * @param $request
	 * @return mixed
	 */
	public function index($request) {
		return ListController::create()->handleRequest($request, $this->model);
	}

}
