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
    <div class="col-md-3">
      <?php include('include/dashboard_sidebar.php'); ?>
    </div>
    <div class="col-md-9">
            <div class="side-content">
             
        <div class="theme-grid">  
        <div class="col-sm-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img src="images/current-theme.png" class="panel-image-preview" />
                </div>
                
                <div class="panel-footer">
                    <a href="customize.php" class="btn btn-alpha">Edit</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img src="images/blog1.jpg" class="panel-image-preview" />
                </div>
               
                <div class="panel-footer">
                    <a href="" class="btn btn-beta">Activate</a>
                </div>
            </div>
      </div>
      <div class="clearfix"></div>
        </div>    
            </div>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>
 
</body>
</html>

