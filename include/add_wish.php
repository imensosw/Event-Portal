<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
if(isset($_POST['user_name']) && !empty($_POST['user_name']) && isset($_POST['user_wish']) && !empty($_POST['user_wish']) && isset($_POST['web_id']) && !empty($_POST['web_id']))
{
	$data['entry_date'] 	= date('Y-m-d');
	$data['author_name'] 	= $_POST['user_name'];
	$data['author_wish'] 	= $_POST['user_wish'];
	$data['website_id'] 	= $_POST['web_id'];
	
	$insert_id = insert_data('we_user_event_wishes',$data);
	if($insert_id>0)
	{
		echo "{\"VerficationStatus\":\"Y\"}";
		exit;
	}
	else
	{
		echo "{\"VerficationStatus\":\"A\"}";
		exit;
	}
}
else
{
	echo "{\"VerficationStatus\":\"N\"}";
	exit;
}
?>

