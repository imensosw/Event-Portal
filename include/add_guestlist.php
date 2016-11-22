<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
if(isset($_POST['user_event_id']) && !empty($_POST['user_event_id']))
{
	$data = remove_array_diff_col('we_users_event_guestlist',$_POST);
	$data['entry_date'] 	= date('Y-m-d');
	$data['event_user'] 	= $_SESSION['reg_id'];
	$data['no_of_guest'] 	= $data['no_of_plus_guest'] + 1;

	$check_id = select_single_col('we_users_event','event_user','WHERE id='.$_POST['user_event_id']);

	if($check_id == $_SESSION['reg_id'])
	{
		$uec_id = select_single_col('we_users_event_guestlist','guest_email','WHERE guest_email ="'.$data['guest_email'].'" AND event_user='.$_SESSION['reg_id'].' AND user_event_id ='.$_POST['user_event_id']);
		

		if($uec_id == $_POST['guest_email'])
		{
			echo "{\"VerficationStatus\":\"A\"}";
			exit;
		}
		else
		{
			$insert_id = insert_data('we_users_event_guestlist',$data);
			if($insert_id >0)
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

