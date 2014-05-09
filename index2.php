<?php

require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel/Reader/Excel5.php';

global  $objPHPExcel;
 
global $objWriter;
global $objWorksheet;
$objPHPExcel= PHPExcel_IOFactory::load("Air April16.xls");
$objWorksheet  =   $objPHPExcel->getActiveSheet();

function add($tokens)   
{$objPHPExcel= PHPExcel_IOFactory::load("Air April16.xls");
$objWorksheet  =   $objPHPExcel->getActiveSheet();
$objPHPExcel=$GLOBALS['objPHPExcel'];
$objWorksheet=$GLOBALS['objWorksheet'];
$objWriter=$GLOBALS['objWriter'];//o
set_time_limit(3000);
$rows=$GLOBALS['objPHPExcel']->getActiveSheet()->getHighestRow();
$GLOBALS['objWorksheet']->insertNewRowBefore($rows+1,1); 
$rows=$GLOBALS['objPHPExcel']->getActiveSheet()->getHighestRow();
$objPHPExcel->getActiveSheet()->SetCellValue('AK'.$rows, $tokens[0]);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rows, $tokens[2]);
$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rows, $tokens[3]);
$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rows, $tokens[6]);
$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rows, $tokens[7]);
$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rows, $tokens[8]);
$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rows, $tokens[9]);
$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rows, $tokens[15]);
$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rows,  $tokens[16]);
$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rows,  $tokens[17]);
$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$rows, $tokens[18]);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
$objWriter->save("Air April16.xls");
}
$txt_file=fopen("dealer.txt","r");
fgets($txt_file);
$new_txt_file=fopen("n.txt","w+");
while(!feof($txt_file))
{
$line=fgets($txt_file);
$flag=false;
$tokens= explode("\t",$line);
$col=36;
$num_rows=$GLOBALS['objPHPExcel']->getActiveSheet()->getHighestRow();
	for($itr=0;$itr<=$num_rows;$itr++)
	{
	   	if($objWorksheet->getCellByColumnAndRow($col,$itr)->getValue()==$tokens[0])
		{
		$objWorksheet->SetCellValue('W'.$itr,$tokens[17]);
		$flag=true;
		break ;
		}
	
	}//i		
	if(!$flag)
	{
	fwrite($new_txt_file,$line);
	add($tokens);
	}
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
$objWriter->save("Air April16.xls");
$objPHPExcel->disconnectWorksheets();
unset($objWriter,$objPHPExcel);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
$objWriter->save("Air April16.xls"); 


?>
