<?php
//outputJSON.php

class outputJSON implements outputInterface
{
	public function load($input = '')
	{
	if($input == '') return;

	return json_encode($input);
	}
}
