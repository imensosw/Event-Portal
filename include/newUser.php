<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
if(isset($_POST['reg_email']) && !empty($_POST['reg_email']) && isset($_POST['reg_name']) && !empty($_POST['reg_name']) && isset($_POST['reg_password']) && !empty($_POST['reg_password']))
{
	if(isset($_POST['g_recaptcha_response']) && !empty($_POST['g_recaptcha_response']))
	{
		$secret = '6LfweyATAAAAABz-5u6j63dMkN_2r3lDsUzskvZi';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g_recaptcha_response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {
			$we_user_data = remove_array_diff_col('we_registration',$_POST);

			$check_duplicate_user = check_duplicate_data('we_registration','WHERE OR reg_email = "'.$_POST['reg_email'].'"');
			if($check_duplicate_user > 0)
			{
				echo "{\"VerficationStatus\":\"N\"}";
				exit;
			}
			else
			{
				$we_user_data['reg_date'] = date('Y-m-d');
				$we_user_data['access_key'] = get_unique_key('');
				$we_user_data['reg_status'] = 'Y';
				$we_user_data['	events'] = 0;

				$insert_id = insert_data('we_registration',$we_user_data);
				if($insert_id > 0)
				{
					$_SESSION['reg_email'] = $we_user_data['reg_email'];
					$_SESSION['reg_id'] = $insert_id;
					$_SESSION['events'] = 0;
					$_SESSION['reg_name'] = $we_user_data['reg_name'];
					$_SESSION['reg_type'] = 'USER';

					echo "{\"VerficationStatus\":\"Y\"}";
					exit;
				}
				else
				{
					echo "{\"VerficationStatus\":\"E\"}";
					exit;
				}
			}
		}
		else
		{
			echo "{\"VerficationStatus\":\"F\"}";
		}
	}
	else
	{
		echo "{\"VerficationStatus\":\"R\"}";
	}
}
else
{
	echo "{\"VerficationStatus\":\"W\"}";
	exit;
}

?>