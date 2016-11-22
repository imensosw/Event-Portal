<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
if(isset($_POST['vendor_email']) && !empty($_POST['vendor_email']) && isset($_POST['vendor_pass']) && !empty($_POST['vendor_pass']))
{
	/*if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	{
		$secret = '6LfweyATAAAAABz-5u6j63dMkN_2r3lDsUzskvZi';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {*/

        	//print_r($_POST);
        	$_POST['business_description']	= str_replace("'","apostrophe_s",$_POST['business_description']);
        	$_POST['imp_details']	= str_replace("'","apostrophe_s",$_POST['imp_details']);
			$we_vendor_data = remove_array_diff_col('we_vendor',$_POST);

			$check_duplicate_user = check_duplicate_data('we_vendor','WHERE vendor_email = "'.$_POST['vendor_email'].'"');
			if($check_duplicate_user > 0)
			{
				echo "{\"VerficationStatus\":\"N\"}";
				exit;
			}
			else
			{
				$we_vendor_data['entry_date'] = date('Y-m-d');
				$we_vendor_data['start_date'] = date('Y-m-d');
				//$we_vendor_data['end_date'] = date('Y-m-d');
				$we_vendor_data['access_key'] = get_unique_key('');
				$we_vendor_data['vendor_status'] = 'Y';

				//$we_vendor_data['business_description']	= str_replace("'","apostrophe_s",$we_vendor_data['business_description']);
				//print_r($we_vendor_data);
				$insert_id = insert_data('we_vendor',$we_vendor_data);
				if($insert_id > 0)
				{
					//vendors
					$basic_path = select_single_col('we_setting','basic_path','LIMIT 1');
					$path = $basic_path.'vendors/';
					$path .= $we_vendor_data['access_key'].'/';

					if(isset($_FILES['vendor_image']['name']) && !empty($_FILES['vendor_image']['name']))
					{
						$cols['id'] = $insert_id;
						upload_image($_FILES,'we_vendor',$cols,'vendor_image',$path,'REPLACE');	
					}

					$_SESSION['reg_email'] = $we_vendor_data['vendor_email'];
					$_SESSION['reg_id'] = $insert_id;
					$_SESSION['reg_name'] = $we_vendor_data['vendor_name'];
					$_SESSION['reg_type'] = 'VENDOR';

					echo "{\"VerficationStatus\":\"Y\"}";
					exit;
				}
				else
				{
					echo "{\"VerficationStatus\":\"E\"}";
					exit;
				}
			}
		/*}
		else
		{
			echo "{\"VerficationStatus\":\"F\"}";
		}
	
	}
	else
	{
		echo "{\"VerficationStatus\":\"R\"}";
	}
	*/
}
else
{
	echo "{\"VerficationStatus\":\"W\"}";
	exit;
}

?>