<?php

class TaskController extends Controller {

	private static $url_handlers = array(
		'$TaskID/delete' => 'deletetask',
		'$TaskID' => 'index',
	);

	private static $allowed_actions = array(
		'deletetask',
	);

	private $task;

	public function getTask() {
		if (!$this->task) {
			$this->setTask($this->getTaskFromRequest());
		}
		return $this->task;
	}

	public function getTaskFromRequest($request = null) {
		if (!$request) {
			$request = $this->getRequest();
		}
		$taskID = $request->latestParam('TaskID');
		if ($taskID) {
			return TodoTask::get()->byID($taskID);
		}
		return TodoTask::create();
	}

	public function setTask($task) {
		$this->task = $task;
		return $this;
	}

	public function index($request) {
		if (!$request->latestParam('TaskID')) {
			return $this->httpError(404);
		}
		die('task index');
	}

	/**
	 * @param SS_HTTPRequest $request
	 * @return SS_HTTPResponse
	 */
	public function deletetask($request) {
		$this->getTask()->delete();
		return $this->redirectBack();
	}

}
