<?php

class RootController extends Controller {

	private static $url_handlers = array(
		'' => 'index',
		'$Action!' => 'index',
	);

	public function index($request) {
		Debug::message(sprintf('%s - %s', __CLASS__, __FUNCTION__));
		return ListController::create()->handleRequest($request, $this->model);
	}

}
