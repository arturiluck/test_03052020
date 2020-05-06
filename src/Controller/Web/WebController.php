<?php

namespace App\Controller\Web;

class WebController extends \Framework\Controller
{
	public function index()
	{
		return $this->container->get('response')->renderView('site/index');
	}
}
