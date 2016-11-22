<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
if(isset($_POST['web_name']) && !empty($_POST['web_name']) && isset($_POST['web_id']))
{
	if(!empty($_POST['web_id']))
	{
		
			$dup_val = check_duplicate_data('we_user_event_website','WHERE website_name="'.$_POST['web_name'].'"');
			if($dup_val>0)
			{
				$user_id = select_single_col('we_user_event_website','event_user','WHERE id='.$_POST['web_id']);
				$website_id = select_single_col('we_user_event_website','id','WHERE website_name="'.$_POST['web_name'].'"');
				if($user_id == $_SESSION['reg_id'] && $website_id == $_POST['web_id'])
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

				echo "{\"VerficationStatus\":\"Y\"}";
				exit;
			}
		
	}
	else
	{
		$dup_val = check_duplicate_data('we_user_event_website','WHERE website_name="'.$_POST['web_name'].'"');
		if($dup_val>0)
		{
			echo "{\"VerficationStatus\":\"A\"}";
			exit;		
		}
		else
		{
			echo "{\"VerficationStatus\":\"Y\"}";
			exit;
		}
	}
}
else
{
	echo "{\"VerficationStatus\":\"E\"}";
	exit;
}


?>