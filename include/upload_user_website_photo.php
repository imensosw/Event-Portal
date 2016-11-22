<?php ob_start(); ?>
<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); 
header('Content-Type: application/json');
?>

<?php
if(isset($_POST['image_name']) && !empty($_POST['image_name']) && isset($_POST['image_src']) && !empty($_POST['image_src']) && isset($_POST['web_id']) && !empty($_POST['web_id']))
{
	//print_r($_POST); die;
	$basic_path = select_single_col('we_setting','basic_path','LIMIT 1');
	$path = $basic_path.'event/';
	$path .= select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';

	$user_id = select_single_col('we_user_event_website','event_user','WHERE id='.$_POST['web_id']);
	if($user_id == $_SESSION['reg_id'])
	{
		$data['image_name'] = $_POST['image_name'];
		$data['website_id'] = $_POST['web_id'];
		//$insert_id = insert_data('we_user_event_website_photo',$data);
		//if($insert_id>0)
		//{
		$FILE['image_name']['name'][0] = $_POST['image_name'];
		$FILE['image_name']['tmp_name'][0] = $_POST['image_src'];
		$FILE['image_name']['error'][0] = '';
		$FILE['image_name']['size'][0] = '';
		
		$cols['website_id'] = $_POST['web_id'];
		$total = upload_multi_files($FILE,'we_user_event_website_photos',$cols,'image_name',$path);
		if($total>0)
		{
			echo "{\"VerficationStatus\":\"Y\"}";
			exit;
		}
		else
		{
			echo "{\"VerficationStatus\":\"A\"}";
			exit;
		}
		//}
	}
	else
	{
		echo "{\"VerficationStatus\":\"B\"}";
		exit;
	}

}
else
{
	echo "{\"VerficationStatus\":\"C\"}";
	exit;
}

?>

