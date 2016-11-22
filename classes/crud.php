<?php

 /**


 * 


 * @author Administrator


 * this class is used for CRUD functionality of any table, every method of this class get the name of table and others parameter as per requirements.


 */


class Crud


{


	


	var $table_name,$values,$where,$conn,$connection,$query,$key,$value,$result,$res,$resu;


	


	


	/**


	* 


	* @param string $table_name


	* @param array $values


	* 


	* @desc this method add the record in given table, according to array values and return last inserted id.


	*/


	public static function add($table_name, $values)


	{


		


		//validation


		if(!is_array($values))


		{


			echo 'please submit $values variable as array. Key of array should be the feild name of table and value of corresponding key should be also given.';


			return;


		}


				


		//create connection


		$conn=new Connection();


		$connection=$conn->get_connection();


				


		//create Query


		$query="insert into ".$table_name."(";


		foreach($values as $key=>$value)


				$query=$query.$key.",";


		$query=$query.") values(";


		foreach($values as $key=>$value)


				$query=$query."'".$value."',";


		$query=$query.")";


		 $query=str_ireplace(",)",")",$query);


		


		//echo $query;


						


		//submit Query

         
		mysqli_query($connection,$query) or die("Error in Insertion : ".mysqli_error());


		$insert_id=mysqli_insert_id($connection);


		//close connection


	//	mysqli_close();


		return $insert_id;


	}


	


	/**


	 * 


	 * @param string $table_name


	 * @param array $values


	 * @param array $where


	 * 


	 * @desc this method update the table records according the $values variable on condition define in where variable


	 */


	public static function update($table_name, $values, $where)


	{
		

		//validation


		if(!(is_array($values)&& is_array($where)))


		{


			echo 'please submit $values and $where variable as array. Key of array should be the feild name of table and value of corresponding key should be also given.';


			return;


		}


				


		//create connection


		$conn=new Connection();


		$connection=$conn->get_connection();


				


		//create Query


		$query="update ".$table_name." set ";


		foreach($values as $key=>$value)


			$query=$query.$key."='".$value."', ";


		$query=$query."where ";


		$query=str_ireplace(", where"," where ",$query);


		foreach($where as $key=>$value)


			$query=$query.$key."='".$value."' and ";


		$query=$query.".";


		$query=str_ireplace(" and .","",$query);


		


		//echo $query;


		


		//submit query


		mysqli_query($connection,$query) or die("Error in Updation : ".mysqli_error());


		


		//close connection


//		mysqli_close();


	}


	


	/**


	 * 


	 * @param string $table_name


	 * @param array $where


	 * @return boolean


	 * 


	 * @desc this method update the table records according the $values variable on condition define in where variable and return the boolean value as true on success, and false on unsuccess


	 */


	public static function delete($table_name, $where)


	{


		//validation


		if(!is_array($where))


		{


			echo 'please submit $where variable as array. Key of array should be the feild name of table and value of corresponding key should be also given.';


			return;


		}


		


		$result=Crud::get_record($table_name,$where);


		if(!is_array($result))


			return false;


				


		//create connection


		$conn=new Connection();


		$connection=$conn->get_connection();


				


		//create Query


		$query="delete from ".$table_name." where ";


		foreach($where as $key=>$value)


		{


			$query=$query.$key."='".$value."' and ";


		}


		$query=$query.".";


		$query=str_ireplace(" and .","",$query);


		


		//echo $query;


		


		//submit query


		mysqli_query($connection,$query) or die("Error in Deletion : ".mysqli_error());


		


		//close connection


		mysqli_close();


		


		return true;


	}


	


	/**


	 * 


	 * @param string $table_name


	 * @param array $where


	 * @return array $result


	 * 


	 * @desc this method fetch the records from the given table name on basis of given conditions.


	 */

     public static function make_query($query)
	 {
		 $conn=new Connection();


		$connection=$conn->get_connection();
		
		 $res=mysqli_query($connection,$query) or die("Error in Select According Condition : ".mysqli_error());


		if(mysqli_num_rows($res)>0)


		{


			$result=array();


			$i=0;


			while($resu=mysqli_fetch_array($res))


			{


				$result[$i]=$resu;	


				$i++;		


			}


		}


		else


			$result="No Records Found!";


		


		//close connection


		//mysqli_close();


		


		//return result array


		return $result;
	 }

	public static function get_record($table_name,$where)


	{


		//validation


		if(!is_array($where))


		{


			echo 'please submit $where variable as array. Key of array should be the feild name of table and value of corresponding key should be also given.';


			return;


		}


				


		//create connection


		$conn=new Connection();


		$connection=$conn->get_connection();


				


		//create Query


		$query="select * from ".$table_name." where ";


		foreach($where as $key=>$value)


		{


			$query=$query.$key."='".$value."' and ";


		}

		//echo "<li>QRY : ".$query;
		$query=$query.".";


		$query=str_ireplace(" and .","",$query);


		


		//echo "<li> QUERY : ".$query;


		


		//submit query


		//echo "<li>Query : ".$query;


		$res=mysqli_query($connection,$query) or die("Error in Select According Condition : ".mysqli_error());


		if(mysqli_num_rows($res)>0)


		{


			$result=array();


			$i=0;


			while($resu=mysqli_fetch_array($res))


			{


				$result[$i]=$resu;	


				$i++;		


			}


		}


		else


			$result="No Records Found!";


		


		//close connection


		//mysqli_close();


		


		//return result array


		return $result;


	}


	


/**


	 * 


	 * @param string $table_name


	 * @return array $result


	 * 


	 * @desc this method fetch all records from the given table name.


	 */


	public static function get_all_record($table_name)


	{


		//create connection


		$conn=new Connection();


		$connection=$conn->get_connection();


		


		//create Query


		$query="select * from ".$table_name;


		


		//echo $query;


		


		//submit query


		$res=mysqli_query($connection,$query) or die("Error in Select All Records : ".mysqli_error());


		if(mysqli_num_rows($res)>0)


		{


			$result=array();


			$i=0;


			while($resu=mysqli_fetch_array($res))


			{


				$result[$i]=$resu;	


				$i++;		


			}


		}


		else


			$result="No Records Found!";


		


		//close connection


		mysqli_close();


		


		//return result array


		return $result;


	}


	/**


	 * 


	 * @param string $date1,$date2


	 * @return $d


	 * 


	 * @desc this method fetch all records from the given table name.


	 */


	public static function check_holiday($date1,$date2)


	{


		//create connection


		$conn=new Connection();


		$connection=$conn->get_connection();


		//$res=array();


		$dateMonthYearArr = array();


	$fromDateTS = strtotime($date1);


	$toDateTS = strtotime($date2);


	


	for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)) {


	// use date() and $currentDateTS to format the dates in between


	$currentDateStr = date("Y-m-d",$currentDateTS);


	$dateMonthYearArr[] = $currentDateStr;


	//print $currentDateStr."<br />";


	}


		$diff = abs(strtotime($date2) - strtotime($date1));


		$years = floor($diff / (365*60*60*24));


		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));


		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


		$d=$days+1;


		//create Query


		$query="select * from public_holidays";


			


		//submit query


		$res=mysqli_query($connection,$query) or die(DATABASE_ERROR.mysqli_error());


		if(mysqli_num_rows($res)>0)


		{


			$result=array();


			$i=0;


			while($resu=mysqli_fetch_array($res))


			{


				$result[$i]=$resu['holiday_date'];	


				$i++;		


			}


		}


		//print_r($result);die;


		$count=0;


		for($j=0;$j<count($result);$j++)


		{


			foreach($dateMonthYearArr as $val)


			{


				if($val==$result[$j])


				{


					$count++;


					//$res['remark']="Public Holiday between('".$date1."','".$date2."')";


				}


			}


		}


		echo "<li> : ".$d;


		if($count>0)


		{


			$msg="Public Holiday between (".$date1.",".$date2.")";


			$d=$d-$count;


		}


		else


		{


			$msg="";


			$d=$d;


		}


		$res=array("remark"=>$msg,"days"=>$d);


		return $res;


	}


	public static function get_record_order_by($table_name,$where,$order)
	{
		//validation
		if(!is_array($where))
		{
			echo 'please submit $where variable as array. Key of array should be the feild name of table and value of corresponding key should be also given.';
			return;
		}
		if(!is_array($order))
		{
			echo 'please submit $order variable as array. Key of array should be the feild name of table and value of corresponding key should be also given.';
			return;
		}
		//create connection
		$conn=new Connection();
		$connection=$conn->get_connection();
		//create Query
		$query="select * from ".$table_name." where ";
		foreach($where as $key=>$value)
		{
			$query=$query.$key."='".$value."' and ";
		}
	     //  echo "<li> QUERY : ".$query; 
		$query=$query.".";
		$query=str_ireplace(" and .","",$query);
		//echo "<li> QUERY : ".$query;
		//submit query
		//echo "<li>Query : ".$query;
		foreach($order as $key1=>$value1)
		{
			$query=$query." order by ".$key1." ".$value1;
		}
		//echo "<li> QUERY : ".$query;
		$res=mysqli_query($connection,$query) or die("Error in Select According Condition : ".mysqli_error());
		if(mysqli_num_rows($res)>0)
		{
			$result=array();
			$i=0;
			while($resu=mysqli_fetch_array($res))
			{
				$result[$i]=$resu;	
				$i++;		
			}
		}
		else
			$result="No Records Found!";
		//close connection
	
		//return result array
		return $result;
	}
	
	
	public static function get_all_record_order_by($table_name,$order)
	{
		//create connection
		$conn=new Connection();
		$connection=$conn->get_connection();
		//create Query
		$query="select * from ".$table_name;
		foreach($order as $key=>$value)
		{
			$query=$query." order by ".$key." ".$value;
		}
		//echo $query;
		//submit query
		$res=mysqli_query($connection,$query) or die("Error in Select All Records : ".mysqli_error());
		if(mysqli_num_rows($res)>0)
		{
			$result=array();
			$i=0;
			while($resu=mysqli_fetch_array($res))
			{
				$result[$i]=$resu;	
				$i++;		
			}
		}
		else
			$result="No Records Found!";
		//close connection
		mysqli_close();
		//return result array
		return $result;
	}
	


}


?>