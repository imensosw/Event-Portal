<?php $script_name = $_SERVER['SCRIPT_NAME']; ?>

<div class="profile-sidebar">
  <!-- SIDEBAR USERPIC -->
  <div class="profile-userpic">
    <img src="images/avatar.png" class="img-responsive" alt="">
  </div>
  <!-- END SIDEBAR USERPIC -->
  <!-- SIDEBAR USER TITLE -->
  <div class="profile-usertitle">
    <div class="profile-usertitle-name">
      <?php if(isset($_SESSION['reg_name']) && !empty($_SESSION['vendor_name'])) { echo $_SESSION['vendor_name'];} else { echo 'Vendor Name'; } ?>
    </div>
    
  </div>
  <!-- END SIDEBAR USER TITLE -->
  <!-- SIDEBAR BUTTONS -->
  
  <!-- END SIDEBAR BUTTONS -->
  <!-- SIDEBAR MENU -->
  <div class="profile-usermenu">
    <ul class="nav">
    
      <li class="<?php if (strpos($script_name, 'vendor-dashboard.php') !== false){ echo 'active'; }?>">
        <a href="vendor-dashboard.php"><i class="fa fa-dashboard"></i>Dashboard </a>
      </li>
      <li class="<?php if (strpos($script_name, 'media_library.php') !== false){ echo 'active'; }?>">
        <a href="media_library.php"><i class="fa fa-dashboard"></i>Media Library </a>
      </li>
      
      
      
    </ul>
  </div>
  <!-- END MENU -->
</div>