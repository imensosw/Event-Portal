<?php $users_events = select_single_col('we_users_event','count(*)','WHERE event_user = '.$_SESSION['reg_id']); ?>
<?php $script_name = $_SERVER['SCRIPT_NAME']; ?>
<?php if($users_events > 0) 
{ 
  $user_event_id  = select_single_col('we_users_event','id','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  $my_event_id    = select_single_col('we_users_event','event_id','WHERE event_user ='.$_SESSION['reg_id'].' AND id='.$user_event_id.' LIMIT 1');
  $event_id       = select_single_col('we_users_event','event_id','WHERE event_user ='.$_SESSION['reg_id'].' AND id='.$user_event_id.' LIMIT 1');
  $event_name     = select_single_col('we_event','event_name','WHERE id ='.$my_event_id);
  $event_location = select_single_col('we_users_event','event_location','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  $event_date     = select_single_col('we_users_event','event_date','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  $event_address  = select_single_col('we_users_event','event_address','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  $event_budget   = select_single_col('we_users_event','event_budget','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  $event_date = date_view_format($event_date);
  $now = time(); // or your date as well
  $your_date = strtotime($event_date);
  $datediff = $now - $your_date ;
  $days = floor($datediff/(60*60*24));

  if($days < 0)
  {
      $days_msg = abs($days).' Days to go';
  }
  else if($days == 0)
  {
    $days_msg = 'Today is our '.$event_name;
  }
  else
  {
    $days_msg = $event_name.' Ends '.$days.' days ago';
  }
}
?>

<div class="profile-sidebar">
  <!-- SIDEBAR USERPIC -->
  <div class="profile-userpic">
    <img src="images/avatar.png" class="img-responsive" alt="">
  </div>
  <!-- END SIDEBAR USERPIC -->
  <!-- SIDEBAR USER TITLE -->
  <div class="profile-usertitle">
    <div class="profile-usertitle-name">
      <?php if(isset($_SESSION['reg_name']) && !empty($_SESSION['reg_name'])) { echo $_SESSION['reg_name'];} else { echo 'User Name'; } ?>
    </div>
    <?php if($users_events > 0) { ?>
    <div class="profile-usertitle-job">
      <?php echo $event_name; ?>
    </div>
    <div class="profile-usertitle-job">
      <?php echo $event_date; ?>
    </div>
    <div class="profile-usertitle-job">
      <?php echo $event_address; ?>
    </div>
    <div class="profile-usertitle-job">
      <?php echo $event_location; ?>
    </div>
    <div class="profile-usertitle-job">
      <?php echo '$'.$event_budget; ?>
    </div>
    <div class="profile-usertitle-name">
      <?php echo $days_msg; ?>
    </div>
    <?php } ?>
  </div>
  <!-- END SIDEBAR USER TITLE -->
  <!-- SIDEBAR BUTTONS -->
  
  <!-- END SIDEBAR BUTTONS -->
  <!-- SIDEBAR MENU -->
  <div class="profile-usermenu">
    <ul class="nav">
    
      <li class="<?php if (strpos($script_name, 'dashboard.php') !== false){ echo 'active'; }?>">
        <a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard </a>
      </li>
      
      <?php if($users_events > 0) { ?>
      <li class="<?php if (strpos($script_name, 'edit-user-event.php') !== false){ echo 'active'; }?>">
        <a href="edit-user-event.php"><i class="fa fa-pencil-square-o"></i>Edit Your Event</a>
      </li>
      <?php } ?>
      <li class="<?php if (strpos($script_name, 'checklist.php') !== false){ echo 'active'; }?>">
        <a href="checklist.php"><i class="fa fa-check-square-o"></i>Checklist </a>
      </li>
      <li class="<?php if (strpos($script_name, 'guest-list.php') !== false){ echo 'active'; }?>">
       <a href="guest-list.php"><i class="fa fa-list"></i>Guest List</a>
      </li>
       <li class="<?php if (strpos($script_name, 'website.php') !== false){ echo 'active'; }?>">
       <a href="website.php"><i class="fa fa-desktop"></i>Website</a>
      </li>
      <li class="<?php if (strpos($script_name, 'registry.php') !== false){ echo 'active'; }?>">
       <a href="registry.php"><i class="fa fa-gift"></i>Registry</a>
      </li>
      
    </ul>
  </div>
  <!-- END MENU -->
</div>