<?php ob_start(); ?>
<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
if(isset($_POST['submit']))
{
	//print_r($_POST); die;
	$we_users_event_data = remove_array_diff_col('we_users_event',$_POST);

	

	$we_users_event_data['event_date']	= date_db_format($we_users_event_data['event_date']);	
	$where['id'] = $_POST['id'];
	$uec_id = select_single_col('we_users_event','event_user','WHERE id='.$where['id']);
	
	if($uec_id == $_SESSION['reg_id'])
	{
		unset($we_users_event_data['id']);
		$update_id = update_data('we_users_event',$we_users_event_data,$where);
		if($update_id > 0)
		{
			header('location:../dashboard.php');
				//edit-user-event.php?event_id=<?php echo $event_id;	
		}
		else
		{
			header('location:../edit-user-event.php?event_id='.$_POST['id']);
		}
	}
}
else
{
	?> <script type="text/javascript">alert("Can't Update Event, Please Try Again!");</script> <?php
	header('location:../edit-user-event.php?event_id='.$_POST['id']);
}

?>
