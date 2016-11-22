<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
if(isset($_POST['reg_email']) && !empty($_POST['reg_email']))
{
	//echo $_POST['username']; exit;
	$where = "WHERE reg_email = '".$_POST['reg_email']."'";
	$tb_site_user = select_data_array('we_registration','',$where);
	//print_r($tb_site_user);
	if(is_array($tb_site_user) && count($tb_site_user) == 1)
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