<?php

namespace Framework\Interfaces;

interface Request {
	public function getPost($name);
	public function getParameter($name);
	public function isAjax();
}
