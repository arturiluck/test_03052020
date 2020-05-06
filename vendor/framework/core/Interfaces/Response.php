<?php

namespace Framework\Interfaces;

interface Response
{
	const STATUS = array(
		200 => 'OK',
		401 => 'Unauthorized',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		500 => 'Internal Server Error',
	);

	public function setView($view);

	public function getView();

	public function response($data, $status = 500);

	public function renderView($template, $params = array());
}