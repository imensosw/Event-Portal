<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');

if(isset($_POST['row_id']) && !empty($_POST['row_id']))
{
	$where['id'] = $_POST['row_id'];
	if(isset($_POST['end_date'])) { $data['end_date'] = $_POST['end_date'];} else { $data['end_date'] = '0000-00-00';}
	if(isset($_POST['budget'])) { $data['budget'] = $_POST['budget'];} else { $data['budget'] = 0;}
	if(isset($_POST['actual_budget'])) { $data['actual_budget'] = $_POST['actual_budget'];} else { $data['actual_budget'] = 0;}
	if(isset($_POST['event_cat_note'])) { $data['event_cat_note'] = $_POST['event_cat_note'];} else { $data['event_cat_note'] = '';}
	
	
	$data['end_date'] = date_db_format($data['end_date']);

	$uec_id = select_single_col('we_users_event_cat','event_user','WHERE id='.$where['id']);
	
	if($uec_id == $_SESSION['reg_id'])
	{
		$update_id = update_data('we_users_event_cat',$data,$where);
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
	echo "{\"VerficationStatus\":\"E\"}";
	exit;
}

?>

