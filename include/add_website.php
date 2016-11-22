<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
//print_r($_FILES['cover_image']);
//die;
if(isset($_POST))
{

	$data = remove_array_diff_col('we_user_event_website',$_POST);

	$data['entry_date'] 	= date('Y-m-d');
	$data['event_user'] 	= $_SESSION['reg_id'];
	$our_story = $data['our_story'];
	$our_story	=	str_replace("'","apostrophe_s",$our_story);
	$data['our_story'] = trim($our_story);

	$basic_path = select_single_col('we_setting','basic_path','LIMIT 1');
	$path = $basic_path.'event/';
	$path .= select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
	

	$check_id = select_data_array('we_user_event_website','','WHERE event_user ='.$_SESSION['reg_id'].' AND user_event_id='.$data['user_event_id']);
	

	if(count($check_id)>0 && $check_id[0]['event_user'] == $_SESSION['reg_id'] && $data['id'] == $check_id[0]['id'])
	{
		
		$update_id = update_data('we_user_event_website',$data,'WHERE id='.$_POST['id']);
		if($update_id >0)
		{
			if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name']))
			{
				$table_id['id'] = $data['id'];
				$cover_image = upload_image($_FILES,'we_user_event_website',$table_id,'cover_image',$path,'REPLACE');
			}
			if(isset($_FILES['image_name']['name']) && !empty($_FILES['image_name']['name'][0]))
			{
				//echo 'gggg';
				$cols['website_id'] = $data['id'];
				upload_multi_files($_FILES,'we_user_event_website_photos',$cols,'image_name',$path);
				//$cover_image = upload_image($_FILES,'we_user_event_website',$table_id,'cover_image',$path,'REPLACE');
			}
			//echo 'Updated';
		}
	}
	else
	{
		$insert_id = insert_data('we_user_event_website',$data);
		if($insert_id >0)
		{
			if(isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name']))
			{
				$table_id['id'] = $insert_id;
				$cover_image = upload_image($_FILES,'we_user_event_website',$table_id,'cover_image',$path,'REPLACE');
			}
			if(isset($_FILES['image_name']['name']) && !empty($_FILES['image_name']['name'][0]))
			{
				//echo 'ssss';
				$cols['website_id'] = $insert_id;
				upload_multi_files($_FILES,'we_user_event_website_photos',$cols,'image_name',$path);
				//$cover_image = upload_image($_FILES,'we_user_event_website',$table_id,'cover_image',$path,'REPLACE');
			}
			//echo "Saved";
			
		}
		
		//exit;
	}
}
else
{
	//echo "{\"VerficationStatus\":\"N\"}";
	//exit;
}
header('location:../website-customize.php');
?>

