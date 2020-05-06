<?php

namespace Framework;

class Response implements Interfaces\Response
{
	private $view;
	
	public function setView($view)
	{
		$this->view = $view;
	}
	
	public function getView()
	{
		return $this->view;
	}

	private function requestStatus($code) {
		$status = Response::STATUS;
		
		return ($status[$code]) ? $status[$code] : $status[500];
	}
	
	public function response($data, $status = 500) {
		header("Access-Control-Allow-Orgin: *");
		header("Access-Control-Allow-Methods: *");
		header("Content-Type: application/json");
		header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));

		return json_encode($data);
	}
	
	public function renderView($template, $params = array())
	{
		header("Content-Type: text/html; charset=UTF-8");
		return $this->view->render($template, $params);
	}
}