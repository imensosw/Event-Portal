<?php include('connection.php'); ?>
<?php
ob_start();

  $user_event_data = select_data_array('we_users_event','','WHERE event_user='.$_SESSION['reg_id'].' LIMIT 1');
  //print_r($user_event_data);
  if($user_event_data && is_array($user_event_data) && count($user_event_data) > 0)
  {
    $event_id = $user_event_data[0]['event_id'];
    $user_event_id = $user_event_data[0]['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Wedding Registry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">


</head>
<body >

<?php include('header.php'); ?>

<?php
$user_event_cat_data = select_data_array('we_users_event_cat','','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id = '.$user_event_id);
  //print_r($user_event_cat_data);
  if(count($user_event_cat_data) > 0)
  {
?><input type="hidden" value="<?php echo count($user_event_cat_data); ?>" id="tot_model_trigger" /><?php
    include('edit_checklist.php');
  }
  else
  {
    

?>
<div id="addNewWizard" style="display:block;">
  <div id="overlay"></div>
  <div class="wht-flag">
    <div class="container">
      <div class="row gutter">
        <div id="step-box">        
         
         <section class="steps">
          <h3 class="text-center">Choose the applicable tasks for Wedding</h3>       
                <?php 
                $event_id = select_single_col('we_users_event','event_id','WHERE id='.$user_event_id);
                $event_cat = select_data_array('we_category','','WHERE id IN (SELECT category_id FROM we_event_cat WHERE event_id = '.$event_id.')');
                if($event_cat)
                {
                  ?><input type="hidden" class="total_cats" value="<?php echo count($event_cat); ?>"/><?php
                    $count = 0;
                    while($count < count($event_cat)) 
                    {
                        if($count == 0 || $count%5 == 0)
                        {
                          ?>
                          <div class="col-md-4">          
                            <div class="checkbox">
                          <?php
                        }
                        ?>
                        <input type="checkbox" id="cat_id_<?php echo $event_cat[$count]['id']; ?>" value="<?php echo $event_cat[$count]['id']; ?>" onclick="show_cat_budget(this.value);">
                        <label for="cat_id_<?php echo $event_cat[$count]['id']; ?>"><?php echo $event_cat[$count]['category_name']; ?></label>
                        <br>
                        <?php
                        if(($count+1)%5 == 0 || $count == count($event_cat))
                        {
                          ?></div></div><!--/col-md-4--><?php
                        }
                        $count++;
                    }
                }
                ?>
           <div class="clearfix"></div>
           <div class="text-center mt5">
             <a href="javascript:;" id="next" class="btn btn-alpha mb1">Next</a>
           </div>
           <div class="clearfix"></div>
          </section><!--/step1-->
        <section class="steps">
          <h3 class="text-center">Planning you ceremony</h3>
          <form class="" name="" id="users_event_cat" method="post" action="include/users_event_cat.php"> 
           <div class="col-md-12">          
            

               
                <?php 
                $event_id = select_single_col('we_users_event','event_id','WHERE id='.$user_event_id);
                $event_cat = select_data_array('we_category','','WHERE id IN (SELECT category_id FROM we_event_cat WHERE event_id = '.$event_id.')');
                if($event_cat)
                {
                    $count = 0;
                    while($count < count($event_cat)) 
                    {
                        ?>
                        <div class="form-group hide cat_id_<?php echo $event_cat[$count]['id']; ?>" >
                          <div class="inpt-3">
                            <label for="">Category</label>
                            <input type="text" class="form-control" value="<?php echo $event_cat[$count]['category_name']; ?>" disabled="">
                            <input type="hidden" id="category_id" name="" class="form-control" value="<?php echo $event_cat[$count]['id']; ?>">
                            <input type="hidden" id ="event_id" name="" value="<?php echo $event_id; ?>" />
                            <input type="hidden" id ="user_event_id" name="" value="<?php echo $user_event_id; ?>" />
                            <input type="hidden" id ="event_user" name="" value="<?php echo $_SESSION['reg_id']; ?>" />
                          </div>  
                          <div class="inpt-3">
                            <label>Deadline</label>                 
                            <div class="input-group input-append date" id="datePicker_<?php echo $count; ?>">
                              <input type="text" class="form-control" placeholder="Deadline" id="end_date" name="" />
                              <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                            </div> 
                          </div>
                          <div class="inpt-3">
                            <label>Estimated Budget</label>                 
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" placeholder="US Dollar" id="budget" name="" class="form-control">
                            </div>
                          </div>       
                        </div>
                        <div class="clearfix"></div>
                        <?php
                        $count++;
                    }
                }
                ?>
                  
                   
               
            
            </div><!--/col-md-12-->
         
            <div class="clearfix"></div>
            <div class="text-center mt5">
              <a href="" class="btn btn-beta mb1" id="previous">Previous</a>&nbsp;&nbsp;&nbsp;
              <input type="submit" name="submit" class="btn btn-alpha mb1" value="Submit" />
              
            </div>
            <div class="clearfix"></div>
            </form>
        </section>
          </div><!--/step-box-->
      </div>
    </div>
  </div>
</div><!--/addNewWizard-->

<?php } ?>
<?php include("footer.php");?>

</body>
</html>

<?php
}
else
{
  echo 'Please Select Proper Event!';
}
?>