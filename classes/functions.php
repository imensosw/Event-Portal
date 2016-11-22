<?php

    include_once("connection.php");

    //include_once("../classes/crud.php");

    $conn1=new Connection();

    $connection1=$conn1->get_connection();

    function convertToDBFormat($date)

    {

        $date = mktime(0,0,0,date("m",strtotime($date)),date("d",strtotime($date)),date("Y",strtotime($date)));

        $date = date("Y-m-d",$date);

        return $date;

    }

    function get_fullmonth_name($month)
    {
		if($month==1)
		{
			$ret_month='January';
		}
		else if($month=='01')
		{
			$ret_month='January';
		}
		else if($month==2)
		{
			$ret_month='February';
		}
		else if($month=='02')
		{
			$ret_month='February';
		}
		else if($month==3)
		{
			$ret_month='March';
		}
		else if($month=='03')
		{
			$ret_month='March';
		}
		else if($month==4)
		{
			$ret_month='April';
		}
		else if($month=='04')
		{
			$ret_month='April';
		}
		else if($month==5)
		{
			$ret_month='May';
		}
		else if($month=='05')
		{
			$ret_month='May';
		}
		else if($month==6)
		{
			$ret_month='June';
		}
		else if($month=='06')
		{
			$ret_month='June';
		}
		else if($month==7)
		{
			$ret_month='July';
		}
		else if($month=='07')
		{
			$ret_month='July';
		}
		else if($month==8)
		{
			$ret_month='August';
		}
		else if($month=='08')
		{
			$ret_month='August';
		}
		else if($month==9)
		{
			$ret_month='September';
		}
		else if($month=='09')
		{
			$ret_month='September';
		}
		else if($month==10)
		{
			$ret_month='October';
		}
		else if($month==11)
		{
			$ret_month='November';
		}
		else if($month==12)
		{
			$ret_month='December';
		}
		return $ret_month;
    }


    function convertToUIFormat($date)



    {



        if($date == "0000-00-00 00:00:00" || $date == "")



        {



            return "&nbsp;";



        }



        $date = mktime(0,0,0,date("m",strtotime($date)),date("d",strtotime($date)),date("Y",strtotime($date)));



        if($date == 0)



        {



            return "&nbsp;";



        }



        $date = date("d-m-Y",$date);



        return $date;



    }



    function convertToUIFormat1($date)



    {



        if($date == "0000-00-00 00:00:00" || $date == "")



        {



            return "&nbsp;";



        }



        $date_array=explode(" ",$date);



        $d_array=explode("-",$date_array[0]);



        $date1 = mktime(0,0,0,$d_array[1],$d_array[2],$d_array[0]);



        if($date1 == 0)



        {



            return "&nbsp;";



        }



        $date1 = date("d-m-Y",$date1);



        return $date1;



    }



	function firstDayOfMonth($uts=null)

	

	{

	

		$today = is_null($uts) ? getDate() : getDate($uts);

	

		$first_day = getdate(mktime(0,0,0,$today['mon'],1,$today['year']));

	

		return $first_day[0];

	

	}

	

	function get_days_in_month($month, $year) 

	

	{ 

	

	   return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);

	

	}

	
	

	$nwords = array( "", "One", "Two", "Three", "Four", "Five", "Six","Seven","Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Fourty",50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eigthy",

	

	90 => "Ninety");

	

	

	

	function number_to_words ($x)

	

	{

	

		global $nwords;

	

		if(!is_numeric($x))

	

		{

	

			$w = '#';

	

		}

	

		else if(fmod($x, 1) != 0)

	

		{

	

			$w = '#';

	

		}

	

		else

	

		{

	

			if($x < 0)

	

			{

	

				$w = 'minus ';

	

				$x = -$x;

	

			}

	

			else

	

			{

	

				$w = '';

	

			}

	

			if($x < 21)

	

			{

	

				$w .= $nwords[$x];

	

			}

	

			else if($x < 100)

	

			{

	

				$w .= $nwords[10 * floor($x/10)];

	

				$r = fmod($x, 10);

	

				if($r > 0)

	

				{

	

					$w .= ' '. $nwords[$r];

	

				}

	

			}

	

			else if($x < 1000)

	

			{

	

				$w .= $nwords[floor($x/100)] .' Hundred';

	

				$r = fmod($x, 100);

	

				if($r > 0)

	

				{

	

					$w .= ' '. number_to_words($r);

	

				}

	

			}

	

			else if($x < 1000000)

	

			{

	

				$w .= number_to_words(floor($x/1000)) .' Thousand';

	

				$r = fmod($x, 1000);

	

				if($r > 0)

	

				{

	

					$w .= ' ';

	

					if($r < 100)

	

					{

	

						$w .= ' ';

	

					}

	

					$w .= number_to_words($r);

	

				}

	

			} 

	

			else

	

			{

	

				$w .= number_to_words(floor($x/1000000)) .' Million';

	

				$r = fmod($x, 1000000);

	

				if($r > 0)

	

				{

	

					$w .= ' ';

	

					if($r < 100)

	

					{

	

						$word .= ' ';

	

					}

	

					$w .= number_to_words($r);

	

				}

	

			}

	

		}

	

		return $w;

	

	}

	

	function custCode($id)

	

	{

	

		if(strlen($id)==1)

	

		{

	

		$custCode="571657_000000".$id;

	

		}

	

		else if(strlen($id)==2)

	

		{

	

		$custCode="571657_00000".$id;

	

		}

	

		else if(strlen($id)==3)

	

		{

	

		$custCode="571657_0000".$id;

	

		}

	

		else if(strlen($id)==4)

	

		{

	

		$custCode="571657_000".$id;

	

		}

	

		else if(strlen($id)==5)

	

		{

	

		$custCode="571657_00".$id;

	

		}

	

		else if(strlen($id)==6)

	

		{

	

		$custCode="571657_0".$id;

	

		}

	

		else if(strlen($id)==7)

	

		{

	

		$custCode="571657_".$id;

	

		}

	

		else

	

		{

	

		$custCode="571657_".$id;

	

		}

	

		return $custCode;

	

	}

	

	function sys_dispatch($id)

	

	{

	

		if(strlen($id)==1)

	

		{

	

		$sysCode="702544_000000".$id;

	

		}

	

		else if(strlen($id)==2)

	

		{

	

		$sysCode="702544_00000".$id;

	

		}

	

		else if(strlen($id)==3)

	

		{

	

		$sysCode="702544_0000".$id;

	

		}

	

		else if(strlen($id)==4)

	

		{

	

		$sysCode="702544_000".$id;

	

		}

	

		else if(strlen($id)==5)

	

		{

	

		$sysCode="702544_00".$id;

	

		}

	

		else if(strlen($id)==6)

	

		{

	

		$sysCode="702544_0".$id;

	

		}

	

		else if(strlen($id)==7)

	

		{

	

		$sysCode="702544_".$id;

	

		}

	

		else

	

		{

	

		$sysCode="702544_".$id;

	

		}

	

		

	

		return $sysCode;

	

	}

	

	

	
	function convertToUIFormat_order($date)

    {

        

		//echo "<li>Recieved Date : ".$date;

		if($date == "0000-00-00 00:00:00" || $date == "")

        {

            return "&nbsp;";

        }

	    $date_array=explode(" ",$date);

        $d_array=explode("-",$date_array[0]);

		$t_array=explode(":",$date_array[1]);

        $date1 = mktime(0,0,0,$d_array[1],$d_array[2],$d_array[0]);

        if($date1 == 0)

        {

            return "&nbsp;";

        }

		if($date_array[1]>='12:00:00' && $date_array[1]<='12:59:59')

		{

			$orderTime = $date_array[1]." PM";

		}

		else if($date_array[1]>'12:00:00')

		{

			 $orderTime = getMyTimeDiff_order($date_array[1],'12:00:00')." PM";

		}

		else

		{

			 $orderTime=getMyTimeDiff1_order($date_array[1])." AM";

		}

        $date1 = date("d-m-Y",$date1)." ".$orderTime;

		//echo "<li>Returned Date : ".$date1."<li>Returned Time : ".$orderTime;

        return $date1;

    }
	

	

	function time_convertToUIFormat($start_time)

	{

		$times=explode(":",$start_time);

		if($times[0]==12)

		{

			$startTime =$start_time." PM";

		}

		elseif($times[0]>12)

		{

			$startTime = getMyTimeDiff($start_time,'12:00:00')." PM";

		}

		else

		{

			$startTime=$start_time." AM";

		}

		return $startTime;

	}
        function getSpendTime($t1,$t2)

    {

		$a1 = explode(":",$t1);

		$a2 = explode(":",$t2);

		$time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));

		$time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));

		$diff = abs($time1-$time2);

		$hours = floor($diff/(60*60));

		$mins = floor(($diff-($hours*60*60))/(60));

		$secs = floor(($diff-(($hours*60*60)+($mins*60))));

		if(strlen($hours)==1)

		{

			$hours="0".$hours;	     

		}

		else

			$hours=$hours;

		if(strlen($mins)==1)

		{

			$mins="0".$mins;	     

		}

		else

			$mins=$mins;

		if(strlen($secs)==1)

		{

			$secs="0".$secs;	     

		}

		else

			$secs=$secs;

		$result = $hours.":".$mins.":".$secs;

		return $result;

    }

	function addtimeToUIFormat($t1,$t2)

	{
		$a1 = explode(":",$t1);

		$a2 = explode(":",$t2);

		$time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));

		$time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));

		$diff = abs($time1+$time2);
		$hours = floor($diff/(60*60));

		$mins = floor(($diff-($hours*60*60))/(60));

		$secs = floor(($diff-(($hours*60*60)+($mins*60))));

		if(strlen($hours)==1)

		{

			$hours="0".$hours;	     

		}

		else

			$hours=$hours;

		if(strlen($mins)==1)

		{

			$mins="0".$mins;	     

		}

		else

			$mins=$mins;

		if(strlen($secs)==1)

		{

			$secs="0".$secs;	     

		}

		else

			$secs=$secs;

		$result = $hours.":".$mins.":".$secs;

		return $result;
	}
    function timeToUIFormat($diff)

	{
		
		$hours = floor($diff/(60*60));

		$mins = floor(($diff-($hours*60*60))/(60));

		$secs = floor(($diff-(($hours*60*60)+($mins*60))));

		if(strlen($hours)==1)

		{

			$hours="0".$hours;	     

		}

		else

			$hours=$hours;

		if(strlen($mins)==1)

		{

			$mins="0".$mins;	     

		}

		else

			$mins=$mins;

		if(strlen($secs)==1)

		{

			$secs="0".$secs;	     

		}

		else

			$secs=$secs;

		$result = $hours." Hours ".$mins." Minutes ".$secs." Seconds";

		return $diff;
	}

	function getMyTimeDiff($t1,$t2)

    {



		$a1 = explode(":",$t1);

		$a2 = explode(":",$t2);

		$time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));

		$time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));

		$diff = abs($time1-$time2);

		$hours = floor($diff/(60*60));

		$mins = floor(($diff-($hours*60*60))/(60));

		$secs = floor(($diff-(($hours*60*60)+($mins*60))));

		if(strlen($hours)==1)

		{

			$hours="0".$hours;	     

		}

		else

			$hours=$hours;

		if(strlen($mins)==1)

		{

			$mins="0".$mins;	     

		}

		else

			$mins=$mins;

		if(strlen($secs)==1)

		{

			$secs="0".$secs;	     

		}

		else

			$secs=$secs;

		$result = $hours.":".$mins.":".$secs;

		return $result;

    }
     function get_makdate($date,$day)
        {
             list($y,$m,$d) = explode('-',$date);
             $time = mktime(0, 0, 0, $m, $d, $y);
             $fromDate=date('Y-m-d',mktime(0, 0, 0, $m,$d+$day, $y));
             return $fromDate;
        }
		 function prev_makdate($date,$day)
        {
             list($y,$m,$d) = explode('-',$date);
             $time = mktime(0, 0, 0, $m, $d, $y);
             $fromDate=date('Y-m-d',mktime(0, 0, 0, $m,$d-$day, $y));
             return $fromDate;
        }
	function get_createDate($days)
	{
		$ret_date=date('Y-m-d H:i:s',mktime(0, 0, 0, date("m"),date("d")-$days,date("Y")));
		return $ret_date;
	}
	
	
?>