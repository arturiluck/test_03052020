<?php

namespace Framework;

abstract class Model implements Interfaces\Model
{
	public $id;

	public function __construct($data)
	{
		foreach ($this as $key => &$value) {
			$value=$data[$key];
		}
	}

	public function valid()
	{
		$error = [];

		foreach ($this as $key => &$value) {

			if (empty($value) && $key!='id' ){
				$error[$key]='empty';
			}
		}

		return $error;
	}
}