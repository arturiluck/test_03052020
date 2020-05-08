<?php

namespace App\Controller\Web;

class WebController extends \Framework\Controller
{
	public function index()
	{
		//just to show that DB connection has broken
		$this->container->get('connection');
		return $this->container->get('response')->renderView('site/index');
	}
}
