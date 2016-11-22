<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
if(isset($_POST['dataid']) && !empty($_POST['dataid']) && isset($_POST['dataemail']) && !empty($_POST['dataemail']) && isset($_POST['datakey']) && !empty($_POST['datakey']) && isset($_POST['dataueid']) && !empty($_POST['dataueid']))
{
	$status = select_single_col('we_users_event_guestlist','guest_status','WHERE guest_email="'.$_POST['dataemail'].'" AND access_key="'.$_POST['datakey'].'" AND user_event_id='.$_POST['dataueid']);
	if(!empty($status) && $status>0)
	{
		$update_data['guest_status'] = $_POST['dataid'];
		$update_id = update_data('we_users_event_guestlist',$update_data,'WHERE guest_email="'.$_POST['dataemail'].'" AND access_key="'.$_POST['datakey'].'" AND user_event_id='.$_POST['dataueid']);
		if($update_id>0)
		{
			echo "{\"VerficationStatus\":\"Y\"}";
			exit;
		}
		else
		{
			echo "{\"VerficationStatus\":\"N\"}";
			exit;
		}
	}
	else
	{
		echo "{\"VerficationStatus\":\"N\"}";
		exit;
	}
	
}
else
{
	echo "{\"VerficationStatus\":\"N\"}";
	exit;
}
?>

