<?php

class TaskController extends Controller {

	private static $url_handlers = array(
		'$TaskID' => 'index',
	);

	public function index($request) {
		if (!$request->latestParam('TaskID')) {
			return $this->httpError(404);
		}
		die('task index');
	}

}
