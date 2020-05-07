<?php

namespace Framework;

use \Framework\Exception\ApiException;

class Request implements Interfaces\Request
{
	private $bodyRequest = [];
	private $request = [];

	private function prepareVariable($variable)
	{
		return htmlspecialchars($variable);
	}

	public function __construct($request)
	{
		$jsonRequest = file_get_contents("php://input");
		$this->bodyRequest = json_decode($jsonRequest);

		if (!is_object($this->bodyRequest)) {
			throw new ApiException('', 400);
		}

		$this->request = $request;
	}

	public function getPost($name = null)
	{
		if (is_null($name)){
			$arrayPost = [];

			foreach($this->bodyRequest as $key => $value){
				$arrayPost[$key] = $this->prepareVariable($value);
			}

			return $arrayPost;
			/*
			foreach($this->bodyRequest as $key => $value){
				yield $key => $this->prepareVariable($value);
			}
			*/
		}

		return $this->prepareVariable($this->bodyRequest->{$name});
	}

	public function getParameter($name)
	{
		return $this->prepareVariable($this->request[$name]);
	}
}
