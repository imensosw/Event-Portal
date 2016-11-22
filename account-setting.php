<?php include('connection.php'); ?>
<?php
ob_start();
$user_event_data = select_data_array('we_users_event','','WHERE event_user='.$_SESSION['reg_id'].' LIMIT 1');
if(count($user_event_data) > 0)
{
  $event_type = select_single_col('we_event','event_type','WHERE id='.$user_event_data[0]['event_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Account Setting | Zuruuna.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

</head>
<body onload="initialize()">
<?php include('header.php'); ?>
  
  <section id="createEvent">
    <div class="container">
      <div class="eventHeader"> 
   <div class="row">
      <div class="col-lg-12">
        <div class="pull-left">
          <span class="zTitle"><i class="fa fa-cog"></i> Account Setting</span>
        </div>       
      </div>
    </div>
  </div>

    <div class="row ">
    <div class="col-md-3">
      
<div class="profile-sidebar">
 
  <div class="profile-usermenu">
    <ul class="nav">
    <li class="active">
        <a href="#"> Account setting </a>
      </li>
      <li>
        <a href="edit-user-event.php"> Event setting</a>
      </li>
      <li class="">
        <a href="change-password.php"> Change password </a>
      </li>     
      
    </ul>
  </div>
  <!-- END MENU -->
</div>    </div>
        <div class="col-md-9">
          <div class="" style="">
             <form class="form-horizontal" name="" id="" method="post" action="include/updateEvent.php" enctype="multipart/form-data" >          
               <article class="wrapper editEventForm">  
                          
                <div class="form-group">
                    <label>Profile Picture</label>
                      <div>
                       <img src="images/avatar.png" class="image_setting">
                      </div>    
                     <input type="file" id="profile_image">       
                </div> 

               
                 <div class="form-group">
                  <label>Name</label>
                   <input class="form-control" type="text" required/> 
                 </div>

                  <div class="form-group">
                    <label>Email</label>  
                     <input type="email" class="form-control" required />
                  </div>  

                   <div class="form-group">
                    <label>Phone No.</label>  
                     <input type="text" class="form-control" required />
                   </div>   

                  <div class="form-group">
                    <input class="btn btn-alpha mt5 sub-mt" type="submit" name="submit" value="Update"/>
                  </div>
                 
                    <div class="form-group">
                     <h4>Delete your account</h4>
                     Does it not worked for you? <strong> <a href="delete-account.php" class="">DELETE ACCOUNT</a></strong>
                  </div>   
                         
              
               <div class="clearfix"></div>
                </article> 
              </form> 
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include('footer.php'); ?>
<script>
 $(document).ready(function() {  
   $("input#event_date").datepicker({"dateFormat":"d-MM-yy"});
 });
</script>
<script>
$(function(){
    $('#profile_image').change( function(e) {
        
        var img = URL.createObjectURL(e.target.files[0]);
        $('.image_setting').attr('src', img);
    });
});
</script>
</body>
</html>

<?php

}
else
{
  echo 'Please Select Proper Event!';
}
?>
