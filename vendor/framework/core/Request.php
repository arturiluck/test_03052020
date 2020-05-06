<?php

namespace Framework;

class Request implements Interfaces\Request
{
	private $request;

	private function prepareVariable($variable)
	{
		return htmlspecialchars($variable);
	}

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function getPost($name = null)
	{
		if (is_null($name)){
			$arrayPost = [];

			foreach($this->request as $key => $value){
				$arrayPost[$key] = $this->prepareVariable($value);
			}

			return $arrayPost;
			/*
			foreach($this->request as $key => $value){
				yield $key => $this->prepareVariable($value);
			}
			*/
		}

		return $this->prepareVariable($this->request[$name]);
	}

	public function getParameter($name)
	{
		return $this->prepareVariable($this->request[$name]);
	}

	public function isAjax()
	{
		if (isset($_SERVER['CONTENT_TYPE']) 
			&& strtolower($_SERVER['CONTENT_TYPE']) == 'application/x-www-form-urlencoded') {

			return true;
 		}

		return false;
	}
}
