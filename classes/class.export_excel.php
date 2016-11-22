<?php
#### Roshan's very simple code to export data to excel   
#### Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
#### if you find any problem contact me at http://roshanbh.com.np
#### fell free to visit my blog http://php-ajax-guru.blogspot.com
class ExportExcel
{
	//variable of the class
	var $titles=array();
	var $all_values=array();
	var $filename;
	//functions of the class
	function ExportExcel($f_name) //constructor
	{
		$this->filename=$f_name;
	}
	function setHeadersAndValues($hdrs,$all_vals) //set headers and query
	{
		/*echo "<li> Headers : <br />";
        print_r($hdrs);
        echo "<li> Values : <br />";
        for($i=0;$i<sizeof($all_vals);$i++) 
 		{
			if(is_array($all_vals[$i]))
			{
				foreach($all_vals[$i] as $value) 
				{
					echo $value."&nbsp;&nbsp;--&nbsp;&nbsp;";
				}
			}
 			echo "<li>";		
		}
        die;*/	
		$this->titles=$hdrs;
		$this->all_values=$all_vals;
	}
	function GenerateExcelFile() //function to generate excel file
	{
		$header="";$value="";$data="";
		foreach ($this->titles as $title_val) 
 		{ 
 			$header .= $title_val."\t"; 
 		} 
 		for($i=0;$i<sizeof($this->all_values);$i++) 
 		{ 
 			$line = '';
			if(is_array($this->all_values[$i]))
			{
				foreach($this->all_values[$i] as $value) 
				{ 
					if ((!isset($value)) OR ($value == "")) 
					{
						//$value = "\t"; 
					} //end of if
					else 
					{ 
						//$value = str_replace('"', '""', $value); 
						//$value = '"' . $value . '"' . "\t"; 
					} //end of else
					$line .= $value; 
				} //end of foreach
			}
 			$data .= trim($line)."\n"; 
 		}//end of the while 
 		$data = str_replace("\r", "", $data);
		if ($data == "") 
 		{ 
 			$data = "\n(0) Records Found!\n"; 
 		} 
		//echo $data;die;
		//header("Content-type:application/octet-stream");
		//header("content-type:application/csv;charset=UTF-8");
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=$this->filename"); 
		

/*echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b>सेम्पल की तिथि </b> \t <u>testdata2</u> \t \n ";
echo "</body>";
echo "</html>";*/

       
	   header('Content-Transfer-Encoding: binary');
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print chr(255) . chr(254) . mb_convert_encoding($header, 'UTF-16LE', 'UTF-8');
        print chr(255) . chr(254) . mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
		//print "$header\n$data";		
	}
}
?>