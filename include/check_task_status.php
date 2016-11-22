<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');


if(isset($_POST['row_id']) && isset($_POST['status']))
{
	$val['status'] = $_POST['status'];
	$where = "WHERE id = ".$_POST['row_id'];
	$update_id = update_data('we_users_event_cat',$val,$where);
	//print_r($tb_site_user);
	if($update_id > 0)
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
	echo "{\"VerficationStatus\":\"W\"}";
	exit;
}


?>