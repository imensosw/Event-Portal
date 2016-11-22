<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
if(isset($_POST['e_id']) && !empty($_POST['e_id']))
{
	//echo $_POST['username']; exit;
	$event_type = select_single_col('we_event','event_type','WHERE id='.$_POST['e_id']);
	if($event_type == 2)
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