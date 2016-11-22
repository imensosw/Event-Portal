<?php

if(isset($_SESSION['reg_id']) && isset($_SESSION['reg_email']) && !empty($_SESSION['reg_id']) && !empty($_SESSION['reg_email']))
{}else
{
include_once("administrator/common/model/conn.php");
include_once("administrator/common/model/function.php");
include_once("fb_login/config.php");
//include_once("includes/functions.php");
//destroy facebook session if user clicks reset
$fb_login_url = '';
if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	$fb_login_url = $loginUrl; 		
}else{
	$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
	//$user = new Users();
	//$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);

	$regdata = select_data_array('we_registration','','WHERE reg_email="'.$user_profile['email'].'"');
	//$output = $regdata;
	if(is_array($regdata) && count($regdata)>0 && $regdata[0]['reg_email'] == $user_profile['email'])
	{
		//set session
		$_SESSION['reg_email'] 	= $regdata[0]['reg_email'];
		$_SESSION['reg_id'] 	= $regdata[0]['reg_id'];
		$_SESSION['events'] 	= $regdata[0]['events'];
		$_SESSION['reg_name'] 	= $regdata[0]['reg_name'];
		$_SESSION['reg_type'] 	= $regdata[0]['reg_type'];
		//print_r($_SESSION);
	}
	else
	{
		$we_user_data['reg_email'] = $user_profile['email'];
		$we_user_data['reg_name'] = $user_profile['first_name'].' '.$user_profile['last_name'];
		$we_user_data['reg_password'] = get_unique_key('LONG');
		$we_user_data['reg_date'] = date('Y-m-d');
		$we_user_data['access_key'] = get_unique_key('');
		$we_user_data['reg_status'] = 'Y';
		$we_user_data['events'] = 0;
	

		$insert_id = insert_data('we_registration',$we_user_data);
		if($insert_id > 0)
		{
			$_SESSION['reg_email'] = $we_user_data['reg_email'];
			$_SESSION['reg_id'] = $insert_id;
			$_SESSION['events'] = 0;
			$_SESSION['reg_name'] = $we_user_data['reg_name'];
			$_SESSION['reg_type'] = 'USER';

			//echo "{\"VerficationStatus\":\"Y\"}";
			//exit;
		}
		else
		{
			//$output = $output.' <br/><p>Something is wrong, Please try again.</p>';
		}
	}
header('location:/beta/dashboard.php');
}
}
?>
