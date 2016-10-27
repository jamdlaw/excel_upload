<?php
echo "howdy";
require_once dirname(__FILE__) . '/vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';	
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('America/Los_Angeles');

/** PHPExcel_IOFactory */
$headers = array();
$values = array();

if (!file_exists("test_import.xlsx")) 
	{
	exit("could not find file" . EOL);
	}
echo date('H:i:s') , " Load from Excel2007 file" , EOL;
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("test_import.xlsx");
echo date('H:i:s') , " Iterate worksheets" , EOL;
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
	{
	//echo 'Worksheet - ' , $worksheet->getTitle() , EOL;
	foreach ($worksheet->getRowIterator() as $row) 
		{
		//echo '    Row number - ' , $row->getRowIndex() , EOL;
		if($row->getRowIndex() == 1) 
			{
			//set headers
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(False); // Loop all cells, even if it is not set
			foreach ($cellIterator as $cell) 
				{
				if (!is_null($cell)) 
					{
					//echo ' Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , EOL;
					//substr($cell->getCoordinate(), 0,1) , EOL);
					if(!array_key_exists(substr($cell->getCoordinate(), 0,1),$headers))
						{
						$headers[substr($cell->getCoordinate(), 0,1)] = $cell->getCalculatedValue();
						}	
					}
				}		
			}
		if($row->getRowIndex() > 1)
			{	
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(False); // Loop all cells, even if it is not set
			$value = array();
			foreach ($cellIterator as $cell) 
				{
				if (!is_null($cell)) 
					{
					echo ' Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , EOL;
					//echo 'value searched for ' . substr($cell->getCoordinate(),0,1) , EOL;
					$key = $headers[substr($cell->getCoordinate(),0,1)];
					//echo 'header ke is : ' . $key, EOL;
					$value[$key] = $cell->getCalculatedValue();
					}
				}			
			$values[] = $value;
			} 
		} 
	}
var_dump($headers);
var_dump($values);
// Echo memory peak usage


