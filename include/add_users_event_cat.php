<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
if(isset($_POST['category_id']) && !empty($_POST['category_id']))
{
	$data = remove_array_diff_col('we_users_event_cat',$_POST);
	$data['end_date'] 	= date_db_format($data['end_date']);
	$data['event_user'] = $_SESSION['reg_id'];
	$uec_id = select_single_col('we_users_event_cat','event_user','WHERE category_id ='.$_POST['category_id']);
	
	if($uec_id == $_POST['category_id'])
	{
		echo "{\"VerficationStatus\":\"A\"}";
		exit;
	}
	else
	{
		
		$insert_id = insert_data('we_users_event_cat',$data);
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
?>

