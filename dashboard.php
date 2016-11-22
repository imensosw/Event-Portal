<?php
include('connection.php');

ob_start();
$users_events = select_single_col('we_users_event','count(*)','WHERE event_user = '.$_SESSION['reg_id']);
if($users_events == 0)
{
  ?>
    <script type="text/javascript">window.location = 'create-event.php';</script>
  <?php
}
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
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- Start Morish Chart -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Morris charts -->
<link rel="stylesheet" href="plugins/morris/morris.css">
<!-- End Morish Chart -->
<style type="text/css">
    #skills span {
      top: -30px;
      left: 2%;
      position: relative;
      font-size: 1.4em;
      font-weight: bolder;
      font-family: monospace;
      color: #fff;
    }

    progress {
        background-color: #f3f3f3;
        border: 0;
        height: 2.5em;
        width: 100%;
    }

    progress::-webkit-progress-bar {
        background-color: #e0eaf0;
    }

    progress::-webkit-progress-value {
        background-color: #329ad1;
    }

    progress::-moz-progress-bar {
        background-color: #329ad1;
    }

    #done {
        
        border: 0;
        height:125px;
        width:125px;
        
    }


  </style>
  <script type="text/javascript">
    $(function() {
        $('progress').each(function() {
          var max = $(this).val();
          $(this).val(0).animate({ value: max }, { duration: 2000, easing: 'easeOutCirc' });
      });
    });
  </script>
</head>
<body>

<?php include('header.php'); ?>


<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard</h3>
      </div>
    </div>
    <div class="row profile">
   
    <div class="col-md-12">
            <div class="side-content">
              <div class="display-table">
                <div class="display-table-cell h300 border-bottom text-center">
                  <!--<div class="donut-chart chart4" style="display:none;">
                    <div class="slice one"></div>
                    <div class="slice two"></div>
                    <div class="chart-center">
                      <span></span>
                    </div>
                  </div>-->
                  <?php
                    $total_estimated_budget   = select_single_col('we_users_event_cat','SUM(budget)','WHERE event_user = '.$_SESSION['reg_id']);
                    $total_actual_budget      = select_single_col('we_users_event_cat','SUM(actual_budget)','WHERE event_user = '.$_SESSION['reg_id']);
                    $status_1       = select_single_col('we_users_event_cat','count(*)','WHERE event_user = '.$_SESSION['reg_id'].' AND status = 1');
                    $status_0       = select_single_col('we_users_event_cat','count(*)','WHERE event_user = '.$_SESSION['reg_id'].' AND status != 1');
                    $total_status   = $status_1+$status_0;
                    if($total_status > 0)
                    {
                      $checklist_per  = ($status_1/$total_status)*100;  
                    }
                    else
                    {
                      $checklist_per = 0.00;
                    }
                     $checklist_per = round($checklist_per, 2);

                  ?>
                  <?php if($total_status > 0) { ?>


                   
                
                  <div class="show_after_checklist">
                  
                  <div class="percent" id="done"><p><?php echo $checklist_per; ?>% Done</p></div>

                  <section id="skills">
                   <p>Estimated Budget - </p><progress value="<?php echo $total_estimated_budget; ?>" max="1000000"></progress><span> $<?php echo $total_estimated_budget; ?></span>

                  <p>Actual Budget - </p><progress value="<?php echo $total_actual_budget; ?>" max="1000000"></progress><span>$<?php echo $total_actual_budget; ?></span>
                  </section>
                  </div>
                  <?php }else { ?>
                  
                  <div class="show_before_checklist">
                    <p>You have not created any checklist yet. </p>
                    <a href="checklist.php" class="btn btn-beta">Create your Checklist</a>
                  </div>
                  <?php } ?>
                    
                
              </div>
              </div>
              <div class="display-table">
                <div class="display-table-cell h300 border-bottom text-center">
                  <?php
                  $guest_status0  = select_single_col('we_users_event_guestlist','count(*)','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id='.$user_event_id.' AND guest_status = 0');
                  $guest_status1  = select_single_col('we_users_event_guestlist','count(*)','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id='.$user_event_id.' AND guest_status = 1');
                  $guest_status2  = select_single_col('we_users_event_guestlist','count(*)','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id='.$user_event_id.' AND guest_status = 2');
                  $guest_status3  = select_single_col('we_users_event_guestlist','count(*)','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id='.$user_event_id.' AND guest_status = 3');

                  $total_guest    =  $guest_status0+$guest_status1+$guest_status2+$guest_status3;
                  ?>
                  <?php if($total_guest > 0) { ?>
                  <div class="show_after_guestlist">
                    <a href="javascript:;" class="btn btn-beta">Total Guests - <?php echo $total_guest; ?></a>
                    <a href="javascript:;" class="btn btn-beta">Have to send Notification - <?php echo $guest_status0; ?></a>
                    <a href="javascript:;" class="btn btn-beta">Awated - <?php echo $guest_status1; ?></a>
                    <a href="javascript:;" class="btn btn-beta">Accepted - <?php echo $guest_status2; ?></a>
                    <a href="javascript:;" class="btn btn-beta">Not Comming - <?php echo $guest_status3; ?></a>
                  </div>
                  <?php }else { ?>
                  
                  <div class="show_before_guestlist">
                    <p>You have not created your Guest list. </p>
                    <a href="guest-list.php" class="btn btn-beta">Create Guest List</a>
                  </div>
                  <?php } ?>
                  
              </div>
              </div>
               <div class="display-table">
                <div class="display-table-cell h300 border-bottom text-center">
                <p>You have not your occasion website. </p>
                <a href="website.php" class="btn btn-beta">Create a Website</a>
              </div>
              </div>
               <div class="display-table">
                <div class="display-table-cell h300 border-bottom text-center">
                <p>You have not created any registry yet. </p>
                <a href="" class="btn btn-beta">Create a Registry</a>
              </div>
              </div>
            </div>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/jQuery.circleProgressBar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script>
$(function () {
  $('.percent').percentageLoader({
    valElement: 'p',
    strokeWidth: 30,
    bgColor: '#d9d9d9',
    ringColor: '#d53f3f',
    textColor: '#2C3E50',
    fontSize: '14px',
    fontWeight: 'normal'
  });

});
</script>

 
</body>
</html>

