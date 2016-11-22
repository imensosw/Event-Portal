<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
//$_POST['delete_id'] = 23;

if(isset($_POST['cover_id']) && !empty($_POST['cover_id']))
{
	
	$user_id = select_single_col('we_user_event_website','event_user','WHERE id='.$_POST['cover_id']);
	$image_name = select_single_col('we_user_event_website','cover_image','WHERE id='.$_POST['cover_id']);
	if($user_id == $_SESSION['reg_id'])
	{
		$value['cover_image'] = '';
		$update_id = update_data('we_user_event_website',$value,'WHERE id='.$_POST['cover_id']);
		if($update_id > 0)
		{
			$basic_path = select_single_col('we_setting','basic_path','LIMIT 1');
			$path = $basic_path.'event/';
			$path .= select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
			unlink($path.$image_name);
			
			echo "{\"VerficationStatus\":\"Y\"}";
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
	echo "{\"VerficationStatus\":\"W\"}";
	exit;
}


?>