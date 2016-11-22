<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
//$_POST['delete_id'] = 23;

if(isset($_POST['del_id']) && !empty($_POST['del_id']))
{
	$web_id = select_single_col('we_user_event_wishes','website_id','WHERE id='.$_POST['del_id']);
	$user_id = select_single_col('we_user_event_website','event_user','WHERE id='.$web_id);
	if($user_id == $_SESSION['reg_id'])
	{
		$delete_id = delete_data('we_user_event_wishes','WHERE id='.$_POST['del_id']);
		if($delete_id > 0)
		{
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