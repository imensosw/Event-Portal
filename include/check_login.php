<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
header('Content-Type: application/json');
if(isset($_POST['reg_email']) && !empty($_POST['reg_email']) && isset($_POST['reg_password']) && !empty($_POST['reg_password']))
{
	//echo $_POST['username']; exit;
	$where = "WHERE reg_email = '".$_POST['reg_email']."' AND reg_password = '".$_POST['reg_password']."'";
	$tb_site_user = select_data_array('we_registration','',$where);
	//print_r($tb_site_user);
	if(is_array($tb_site_user) && count($tb_site_user) == 1)
	{
		$_SESSION['reg_email'] = $tb_site_user[0]['reg_email'];
		$_SESSION['reg_id'] = $tb_site_user[0]['reg_id'];
		$_SESSION['events'] = $tb_site_user[0]['events'];
		$_SESSION['reg_name'] = $tb_site_user[0]['reg_name'];
		$_SESSION['reg_type'] = 'USER';
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