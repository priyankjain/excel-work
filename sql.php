<?php
$txt_name = "dealer.txt";
$table_name = "TABLE 1";
require_once("config.php");
$mysqli = new mysqli($config['host'],$config['user'],$config['pass'],$config['database']);
if($mysqli->connect_errno > 0)
{
	echo "Error connecting to database";
	exit;
}
$txt_file=fopen($txt_name,"r");
fgets($txt_file);
$new_txt_file=fopen("n.txt","w");
$new_entries = 0;
$line_no = 1;
while(!feof($txt_file))
{
	$line=fgets($txt_file);
	$tokens= explode("\t",$line);
	$col=36;
	echo $line_no;
	$select = "SELECT * FROM `".$table_name."` WHERE `Prod_model`='".$tokens[0]."'";
	$result = $mysqli->query($select) or die("Could not search rows");
	if($result->num_rows == 0)
	{//If it is a new entry show it in n.txt
		fwrite($new_txt_file,$line);
		$new_entries++;
		echo ' New entry no '.$new_entries.' ';
	}
	else 
	{
		$query = "update `".$table_name."` set `Wnet` = '".$tokens[17]."' where `Prod_model` = '".$tokens[0]."'";;
		$mysqli->query($query)  or die("Could not update rows");	
		echo ' Update ';
	}
	echo " Processed ".$tokens[0]." => ".$tokens[17].'<br/>';
	$line_no++;
}
fclose($new_txt_file);
fclose($txt_file);
?>