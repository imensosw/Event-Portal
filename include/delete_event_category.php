<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');


if(isset($_POST['row_id']) && !empty($_POST['row_id']))
{
	$user_id = select_single_col('we_users_event_cat','event_user','WHERE id='.$_POST['row_id']);
	if($user_id == $_SESSION['reg_id'])
	{
		$delete_id = delete_data('we_users_event_cat','WHERE id='.$_POST['row_id']);
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