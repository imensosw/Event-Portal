<?php
class export
{
 public function exportxls($cols,$values)
{
function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
}
function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
}
function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
}
function xlsWriteLabel($Row, $Col, $Value) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
} 
// prepare headers information
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"export_".date("Y-m-d").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
// start exporting
xlsBOF();

$j=1;
$ret = array_map (
  function ($_) {return explode (',', $_);},
  explode (';', $values)
);




$colarray=explode(',',$cols);



$number=count($colarray);



for($i=0;$i<$number;$i++)
{
   xlsWriteLabel(0,$i,$colarray[$i]); 
}
foreach($ret as $key->$value)
{ 

xlsWriteLabel($j,$key,$value[$key]);
$j=$j+1;
}

xlsEOF();
}
}
?>