<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>

<?php
if(isset($_POST['cat_id']) && !empty($_POST['cat_id']))
{
	$subcat_list = select_data_array('we_vendor_cat_subcat_master','','WHERE category_id='.$_POST['cat_id']);
	if(count($subcat_list)>0)
	{
		$count = 0;
		?><option value=""></option><?php
		while($count < count($subcat_list))
		{

			$cat_name = select_single_col('we_vendor_subcategory_master','category_name','WHERE id='.$subcat_list[$count]['subcat_id']);
			/*?><option value="<?php echo $subcat_list[$count]['id']; ?>"><?php echo $cat_name; ?></option> */ ?>
			<option value="<?php echo $subcat_list[$count]['id']; ?>"><?php echo $cat_name; ?></option>
			<?php
			$count++;
		}
		
	}
	else
	{
		/*?><option value=""></option><?php*/
	}
}
else
{
	/*?><option value=""></option><?php*/
}
?>