<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
if(isset($_POST['id']) && !empty($_POST['id']))
{
	$data = remove_array_diff_col('we_users_event_guestlist',$_POST);
	$data['event_user'] 	= $_SESSION['reg_id'];
	$data['no_of_guest'] 	= $data['no_of_plus_guest'] + 1;
	unset($data['id']);

	$ue_id = select_single_col('we_users_event_guestlist','user_event_id','WHERE id='.$_POST['id'].' LIMIT 1');
	$eu_id = select_single_col('we_users_event_guestlist','event_user','WHERE id='.$_POST['id'].' LIMIT 1');
	if($ue_id == $_POST['user_event_id'] && $eu_id == $_SESSION['reg_id'])
	{
		$uec_id = select_single_col('we_users_event_guestlist','guest_email','WHERE guest_email ="'.$data['guest_email'].'" AND event_user='.$_SESSION['reg_id'].' AND user_event_id ='.$_POST['user_event_id'].' AND id !='.$_POST['id']);
		if($uec_id == $_POST['guest_email'])
		{
			echo "{\"VerficationStatus\":\"A\"}";
			exit;
		}
		else
		{
			$where['id']=$_POST['id'];
			$update_id = update_data('we_users_event_guestlist',$data,$where);
			if($update_id >0)
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

