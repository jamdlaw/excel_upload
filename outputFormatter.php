<?php
//outputFormatter.php
require('outputInterface.php');
// add the diffirent types of output classes
require ('outputJSON.php');
require ('outputHTML.php');
require ('outputPHPObjects.php');
require ('outputXML.php');
class outputFormatter
{
	private $output;
	
	public function setOutput($output)
		{
		switch ($output) 
			{
			case 'JSON' :
				$this->output = new outputJSON;			
				break;
			case 'HTML' :
				$this->output = new outputHTML;
				break;
			case 'PHPobjects' :
				$this->output = new outputPHPObjects;
				break;
			case 'XML' :
				$this->output = new outputXML;
				break;
			case 'CSV' :
				$this->output = new outputCSV;
				break;
			}
		}

	public function loadOutput($data)
		{
		if(is_object($this->output) == false)
			{
			return;	
			}
		else
			{
			return $this->output->load($data);
			}
		}
}