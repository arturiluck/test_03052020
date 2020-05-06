<?php

namespace Framework\Interfaces;

interface Authorization
{
	public function isGranted();

	public function createAccess($login, $password);

	public function deleteAccess();
}