<?php

class ListController extends Controller {

	private static $url_handlers = array(
		'' => 'index',
		'$ListID/task' => 'task',
 		'$ListID!' => 'viewlist',
	);

	private static $allowed_actions = array(
		'task',
		'viewlist',
	);

	public function index($request) {
		Debug::message(sprintf('%s - %s', __CLASS__, __FUNCTION__));
		Debug::show($request->latestParams());
		die('index');
	}

	public function viewlist($request) {
		Debug::message(sprintf('%s - %s', __CLASS__, __FUNCTION__));
		Debug::show($request->latestParam('ID'));
		die('viewlist');
	}

	public function task(SS_HTTPRequest $request) {
		Debug::message(sprintf('%s - %s', __CLASS__, __FUNCTION__));
		return TaskController::create()->handleRequest($request, $this->model);
	}

}
