<?php
//outputHTML.php

class outputHTML implements outputInterface
{
	public function load($input)
		{
		$results = '';
		
		$results = '<ul>';	
		foreach ($input as $k=>$v) 
			{
			$results .= '<ul>';		
			foreach($v as $key=>$value)
				{
				$results .= '<li>' . $key . ' : ' . $value . '</li>';
				}
			$results .= '</ul>';				
			}
		$results .= '</ul>';
		return $results;
		}
}