<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
if(isset($_POST['review']) && !empty($_POST['review']))
{
	if(isset($_SESSION['reg_id']) && !empty($_SESSION['reg_id']))
	{
		$data['review_by'] 		= $_SESSION['reg_id'];
		$data['review_point'] 	= $_POST['review_point'];
		$data['review_for'] 	= $_POST['review_for'];
		$data['review_date'] 	= date('Y-m-d');
		$data['review'] 		= $_POST['review'];
		$data['review_type'] 	= $_SESSION['reg_type'];
		
		$insert_id = insert_data('we_review',$data);
		if($insert_id>0)
		{
			echo "{\"VerficationStatus\":\"Y\"}";
			exit;
		}
		else
		{
			echo "{\"VerficationStatus\":\"F\"}";
			exit;
		}
	}
	else
	{
		echo "{\"VerficationStatus\":\"S\"}";
		exit;
	}

	
}
else
{
	echo "{\"VerficationStatus\":\"N\"}";
	exit;
}
?>

