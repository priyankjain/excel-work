<?php 
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel/Reader/Excel2007.php';
global  $objPHPExcel;
 global $objWriter;
$objPHPExcel =   PHPEXCEL_IOFACTORY::load("Air April 16.xls");
set_time_limit(3000);
global $objWorksheet;
$objWorksheet  =   $objPHPExcel->getActiveSheet();

function add($tokens)
{
$objPHPExcel=$GLOBALS['objPHPExcel'];

$objWorksheet=$GLOBALS['objWorksheet'];
$objWrite=$GLOBALS['objWriter'];
$num_rows=$GLOBALS['objPHPExcel']->getActiveSheet()->getHighestRow();
$GLOBALS['objWorksheet']->insertNewRowBefore($num_rows,1); 


$rows=$GLOBALS['objPHPExcel']->getActiveSheet()->getHighestRow();
$objPHPExcel->getActiveSheet()->SetCellValue('AK'.$rows, $tokens[0]);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rows, $tokens[2]);
$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rows, $tokens[3]);
$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rows, $tokens[6]);
$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rows, $tokens[7]);
$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rows, $tokens[8]);
$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rows, $tokens[9]);//


$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rows,$tokens[15]);
$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rows,  $tokens[16]);
$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rows,  $tokens[17]);
$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$rows, $tokens[18]);
//p
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//");
}
$row=2;
$txt_file=fopen("dealer.txt","r");
fgets($txt_file);$new_txt_file=fopen("n.txt","a+");
while(!feof($txt_file)){


$line=fgets($txt_file);

$flag=false;
$tokens= explode("\t",$line);
$col=36;
$num_rows=$objPHPExcel->getActiveSheet()->getHighestRow();

	for($itr=1;$itr<=$num_rows;$itr++)
{
if($objWorksheet->getCellByColumnAndRow($col,$itr)->getValue()==$tokens[0])
	
	{
$objWorksheet->SetCellValue('W'.$itr,$tokens[18]);$flag=true;

break;
}}
if(!$flag){
fwrite($new_txt_file,$line); add($tokens);
  }
}
$objwriter->save($objPHPExcel);
$objPHPExcel->disconnectWorksheets();

unset($objWriter,$objPHPExcel); ?>

$objWriter->save("Air April16.xls");
fclose($new_txt_file);
?>