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
function add($currentsku,$tokens)
{
	$objPHPExcel=$GLOBALS['objPHPExcel'];
	$objWorksheet=$GLOBALS['objWorksheet'];
	$objWriter=$GLOBALS['objWriter'];
	$num_rows=$GLOBALS['objPHPExcel']->getActiveSheet()->getHighestRow();
	$GLOBALS['objWorksheet']->insertNewRowBefore($num_rows + 1,1); 
	$row=$num_rows+1;
	$objPHPExcel->getActiveSheet()->SetCellValue('AK'.$row, $tokens[$currentsku]);
	$n_file=fopen("n.txt","rw");
	fwrite($n_file,$tokens);
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, $tokens[$currentsku+2]);
	$objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, $tokens[$currentsku+3]);
	$objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, $tokens[$currentsku+6]);
	$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, $tokens[$currentsku+7]);
	$objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, $tokens[$currentsku+8]);
	$objPHPExcel->getActiveSheet()->SetCellValue('T'.$row, $tokens[$currentsku+9]);
	$objPHPExcel->getActiveSheet()->SetCellValue('U'.$row, $tokens[$currentsku+15]);
	$objPHPExcel->getActiveSheet()->SetCellValue('V'.$row,  $tokens[$currentsku+16]);
	$objPHPExcel->getActiveSheet()->SetCellValue('W'.$row,  $tokens[$currentsku+17]);
	$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row, $tokens[$currentsku+18]);
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	ob_end_clean();
	$objWriter->save("Air April16.xls");
}
$row=1;
$txt_fil=fopen("dealer.txt","r");
fgets($txt_fil);
while(!feof($txt_fil))
{
	$line=fgets($txt_fil);$i=0;
	$tokens= explode(" ",$line);
	$col=37;$num_rows=$objPHPExcel->getActiveSheet()->getHighestRow();
	for($itr=1;$itr<$num_rows;$itr++)
	if($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()==$tokens[$i])
		$objWorkSheet->SetCellValue('W'.$itr , $tokens[$i+18]); 
	else 
		add($i,$tokens);
}
$objPHPExcel->disconnectWorksheets();
unset($objWriter,$objPHPExcel);
?>