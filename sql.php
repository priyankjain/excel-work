<?php
require_once("config.php");
$mysqli = new mysqli($config['host'],$config['user'],$config['pass'],$config['database']);
if($mysqli->connect_errno > 0)
{
	echo "Error connecting to database";
	exit;
}
// $result = $mysqli->query("SELECT * FROM `TABLE 1` WHERE `Prod_model`='PY-470'");
$txt_file=fopen("dealer.txt","r");
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
	$result = $mysqli->query("SELECT * FROM `TABLE 1` WHERE `Prod_model`='".$tokens[0]."'") or die("Could not search rows");

	if($result->num_rows == 0)
	{//If it is a new entry show it in n.txt
		fwrite($new_txt_file,$line);
		$new_entries++;
		echo ' New entry no '.$new_entries.' ';
	}
	else 
	{
		$query = "update `TABLE 1` set `Wnet` = '".$tokens[17]."' where `Prod_model` = '".$tokens[0]."'";;
		$mysqli->query($query)  or die("Could not update rows");	
		echo ' Update ';
	}
	echo " Processed ".$tokens[0]." => ".$tokens[17].'<br/>';

};
fclose($new_txt_file);
fclose($txt_file);
?>