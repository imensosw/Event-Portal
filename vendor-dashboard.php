<?php
include('connection_vendor.php');

ob_start();

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
      <?php include('include/vendor_dashboard_sidebar.php'); ?>
    </div>
    <div class="col-md-9">
            <div class="side-content">
              <div class="display-table">
                <div class="display-table-cell h300 border-bottom text-center">
                  
                  
                  <div class="show_before_checklist">
                    <p>You have not created any checklist yet. </p>
                    <a href="checklist.php" class="btn btn-beta">Create your Checklist</a>
                  </div>
                  
                    
                
              </div>
              </div>
              <div class="display-table">
                <div class="display-table-cell h300 border-bottom text-center">
                  
                  
                  <div class="show_before_guestlist">
                    <p>You have not created your Guest list. </p>
                    <a href="guest-list.php" class="btn btn-beta">Create Guest List</a>
                  </div>
                  
                  
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
 
</body>
</html>

