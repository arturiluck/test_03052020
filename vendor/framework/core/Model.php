<?php

namespace Framework;

abstract class Model implements Interfaces\Model
{
	const NOT_VALID = 'notvalid';
	const EXIST = 'exist';
	
	public $id;

	public function __construct($data = null)
	{
		foreach ($this as $key => &$value) {
			if(isset($data[$key])){
				$value = $data[$key];
			}
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