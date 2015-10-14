<?php

class TaskController extends Controller {

	private static $url_handlers = array(
		'$TaskID' => 'index',
	);

	public function index($request) {
		Debug::message(sprintf('%s - %s', __CLASS__, __FUNCTION__));
		if (!$request->latestParam('TaskID')) {
			return $this->httpError(404);
		}
		die('task index');
	}

}
