<?php ob_start(); ?>
<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
if(isset($_POST['category_id']) && isset($_POST['event_id']) && isset($_POST['event_user']) && isset($_POST['end_date']) && isset($_POST['budget']))
{
	
	$we_users_event_cat_data = remove_array_diff_col('we_users_event_cat',$_POST);
	//echo count($we_users_event_cat_data['category_id']);
	//print_r($we_users_event_cat_data); 
	$count = 0;
	while($count < count($we_users_event_cat_data['category_id']))
	{
		$data['category_id'] 	= $we_users_event_cat_data['category_id'][$count];
		$data['event_user'] 	= $we_users_event_cat_data['event_user'][$count];
		$data['event_id'] 		= $we_users_event_cat_data['event_id'][$count];
		$data['user_event_id'] 		= $we_users_event_cat_data['user_event_id'][$count];
		$data['end_date'] 		= $we_users_event_cat_data['end_date'][$count];
		$data['budget'] 		= $we_users_event_cat_data['budget'][$count];

		$data['end_date']		= date_db_format($data['end_date']);

		$check_data 	= select_single_col('we_users_event_cat','count(*)','WHERE event_user ='.$data['event_user'].' AND category_id ='.$data['category_id'].' AND user_event_id ='.$data['user_event_id']);
		

		if($check_data > 0)
		{
			$where['id'] 	= select_single_col('we_users_event_cat','id','WHERE event_user ='.$data['event_user'].' AND category_id ='.$data['category_id'].' AND user_event_id ='.$data['user_event_id'].' LIMIT 1');

			$update_id = update_data('we_users_event_cat',$data,$where);
			if($update_id > 0)
			{
				header('location:../checklist.php');
			}
			
		}
		else
		{
			$insert_id = insert_data('we_users_event_cat',$data);
			if($insert_id > 0)
			{
				header('location:../checklist.php');
			}
		}
		$count++;
	}
}
else
{
	?> <script type="text/javascript">alert("Can't Update Data, Please Try Again!");</script> <?php
	header('location:../checklist.php');
}

?>

