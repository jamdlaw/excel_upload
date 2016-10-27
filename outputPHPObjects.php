<?php
//outputPHPObjects.php

class outputPHPObjects implements outputInterface
{
	public function load($input)
		{
		//var_dump($input);
		//exit();
		$result = array();
		foreach($input as $k=>$v)  
				{
				$result[] = $this->createObject($v);
				}
		//return 'howdy';
		return $result;
		}

	public function createObject($values)
		{
		$obj = new stdClass;
		foreach ($values as $key=>$value)
			{
			$obj->$key = $value;
			}
		return $obj;
		}
}