<?php
require_once dirname(__FILE__) . '/vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';	
class excelParse
	{
	/** PHPExcel_IOFactory */
	public $file = '';
	public $objReader = '';
	public $objPHPExcel='';
		
	function __construct($newFile)
		{
		if($newFile)
			{
			$this->objReader= PHPExcel_IOFactory::createReaderForFile($newFile);
			$this->objPHPExcel = $this->objReader->load($newFile);	
			}
		}
	function parseAll()
		{
		$result = 'Nothing to parse';
		// this if is not right just yet.
		if(get_class($this->objPHPExcel) == 'PHPExcel')
			{
			$headers = array();
			foreach ($this->objPHPExcel->getWorksheetIterator() as $worksheet) 
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
								//echo ' Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , EOL;
								//echo 'value searched for ' . substr($cell->getCoordinate(),0,1) , EOL;
								$key = $headers[substr($cell->getCoordinate(),0,1)];
								//echo 'header ke is : ' . $key, EOL;
								$value[$key] = $cell->getCalculatedValue();
								}
							}			
						$this->values[] = $value;
						} 
					} 
				}	
			$result = isset($this->values) ? $this->values : 'Not Parsed';
			}
		return $result;	
		}
	}

