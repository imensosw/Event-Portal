<?php include_once('administrator/common/model/conn.php'); ?>
<?php include_once('administrator/common/model/function.php'); ?>
<?php
if((isset($_SESSION['reg_id']) && !empty($_SESSION['reg_id'])) || (isset($_SESSION['reg_type']) && $_SESSION['reg_type'] == 'USER')) 
{

}
else
{
	header('location:index.php');
}

?>