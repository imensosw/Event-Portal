<?php ob_start(); ?>
<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
if(isset($_POST['submit']))
{
	//print_r($_POST); die;
	$we_users_event_data = remove_array_diff_col('we_users_event',$_POST);

	
	$we_users_event_data['event_user'] = $_SESSION['reg_id'];
	$we_users_event_data['status'] = 1;
	$we_users_event_data['create_date'] = date('Y-m-d');

	$we_users_event_data['event_date']	= date_db_format($we_users_event_data['event_date']);
	
	$insert_id = insert_data('we_users_event',$we_users_event_data);
	if($insert_id > 0)
	{
		$values['events'] = 1;
		$where['reg_id'] = $_SESSION['reg_id'];
		$updatedata = update_data('we_registration',$values,$where);
		if($updatedata > 0)
		{
			$_SESSION['events'] = 1;
				
		}
		$website['user_event_id'] = $insert_id;
		$website['entry_date'] = date('Y-m-d');
		$website['event_user'] = $_SESSION['reg_id'];
		$website['website_name'] = $insert_id.select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']);
		$insert = insert_data('we_user_event_website',$website);
		
		header('location:../dashboard.php');
	}
	else
	{
		header('location:../create-event.php');
	}
}
else
{
	?> <script type="text/javascript">alert("Can't Create Event, Please Try Again!");</script> <?php
	header('location:../create-event.php');
}

?>

