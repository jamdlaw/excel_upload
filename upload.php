<?php
require('excelParse.php');
require('outputFormatter.php');
//var_dump($_FILES);
//var_dump($_POST);
$myClass = new excelParse($_FILES[0]['tmp_name']);	
$results = $myClass->parseAll();	
if($results == 'Not Parsed')
	{
	echo $results;
	exit();
	} 
$output = new outputFormatter();
$output->setOutput($_POST['requestedOutput']);
$results = $output->loadOutput($results);

if (is_array($results))
	{
	var_dump($results);
	}
else 
	{
	echo $results;
	}



