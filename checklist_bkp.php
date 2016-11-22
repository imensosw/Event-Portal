<?php include('connection.php'); ?>
<?php
ob_start();
if(isset($_GET['event_id']) && !empty($_GET['event_id']))
{
  $user_event_data = select_data_array('we_users_event','','WHERE event_user='.$_SESSION['reg_id'].' AND id ='.$_GET['event_id'].' LIMIT 1');
  if($user_event_data && is_array($user_event_data) && count($user_event_data) > 0)
  {

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
<div id="addNewWizard" style="display:block;">
  <div id="overlay"></div>
  <div class="wht-flag">
    <div class="container">
      <div class="row gutter">
        <div id="step-box">        
         
         <section class="steps">
          <h3 class="text-center">Choose the applicable tasks for Wedding</h3>       
           <div class="col-md-4">          
              <div class="checkbox">
                <input id="check4" type="checkbox" name="check" value="check4">
                <label for="check4">Ceremony</label>
                <br>
                <input id="check2" type="checkbox" name="check" value="check2">
                <label for="check2">Reception</label>
                <br>
                <input id="check3" type="checkbox" name="check" value="check3">
                <label for="check3">Attire + Beauty</label>
                <br>
                <input id="check5" type="checkbox" name="check" value="check3">
                <label for="check5">Flowers</label>
                <br>
                <input id="check6" type="checkbox" name="check" value="check3">
                <label for="check6">Music</label>
                <br>
                <input id="check7" type="checkbox" name="check" value="check3">
                <label for="check7">Phote + Video</label>
                <br>
                <input id="check8" type="checkbox" name="check" value="check3">
                <label for="check8">Stationary</label>              
             </div>
           </div><!--/col-md-4-->
           <div class="col-md-4">         
              <div class="checkbox">
                <input id="check4" type="checkbox" name="check" value="check4">
                <label for="check4">Ceremony</label>
                <br>
                <input id="check2" type="checkbox" name="check" value="check2">
                <label for="check2">Reception</label>
                <br>
                <input id="check3" type="checkbox" name="check" value="check3">
                <label for="check3">Attire + Beauty</label>
                <br>
                <input id="check5" type="checkbox" name="check" value="check3">
                <label for="check5">Flowers</label>
                <br>
                <input id="check6" type="checkbox" name="check" value="check3">
                <label for="check6">Music</label>
                <br>
                <input id="check7" type="checkbox" name="check" value="check3">
                <label for="check7">Phote + Video</label>
                <br>
                <input id="check8" type="checkbox" name="check" value="check3">
                <label for="check8">Stationary</label>

               
             </div>
           </div><!--/col-md-4-->
           <div class="col-md-4">           
              <div class="checkbox">
                <input id="check4" type="checkbox" name="check" value="check4">
                <label for="check4">Ceremony</label>
                <br>
                <input id="check2" type="checkbox" name="check" value="check2">
                <label for="check2">Reception</label>
                <br>
                <input id="check3" type="checkbox" name="check" value="check3">
                <label for="check3">Attire + Beauty</label>
                <br>
                <input id="check5" type="checkbox" name="check" value="check3">
                <label for="check5">Flowers</label>
                <br>
                <input id="check6" type="checkbox" name="check" value="check3">
                <label for="check6">Music</label>
                <br>
                <input id="check7" type="checkbox" name="check" value="check3">
                <label for="check7">Phote + Video</label>
                <br>
                <input id="check8" type="checkbox" name="check" value="check3">
                <label for="check8">Stationary</label>
                <br>
                
             </div>
           </div><!--/col-md-4-->
           <div class="clearfix"></div>

           <div class="text-center mt5">
             <a href="javascript:;" id="next" class="btn btn-alpha mb1">Next</a>
           </div>
           <div class="clearfix"></div>
          </section><!--/step1-->

        <section class="steps">
          <h3 class="text-center">Planning you ceremony</h3> 
              
           <div class="col-md-12">          
              <form class="form-horizontal gutter" name="" id="" method="post" action="include/newEvent.php" enctype="multipart/form-data" > 
                <div class="form-group">
                    <div class="inpt-3">
                      <label for="">Category</label>
                      <input type="text" class="form-control" value="Ceremony" disabled="">                    
                    </div>  
                    <div class="inpt-3">
                      <label>Deadline</label>                 
                      <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" placeholder="Deadline" name="date" required />
                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                    </div> 
                    </div>
                    <div class="inpt-3">
                      <label>Estimated Budget</label>                 
                      <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" placeholder="US Dollar" class="form-control">
                      </div>
                    </div>       
                 </div>
                <div class="clearfix"></div>
                   <div class="form-group">
                    <div class="inpt-3">
                      <label for="">Category</label>
                      <input type="text" class="form-control" value="Ceremony" disabled="">                    
                    </div>  
                    <div class="inpt-3">
                      <label>Deadline</label>                 
                      <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" placeholder="Deadline" name="date" required />
                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                    </div> 
                    </div>
                    <div class="inpt-3">
                      <label>Estimated Budget</label>                 
                      <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" placeholder="US Dollar" class="form-control">
                      </div>
                    </div>       
                 </div>
                  <div class="clearfix"></div>
                   <div class="form-group">
                    <div class="inpt-3">
                      <label for="">Category</label>
                      <input type="text" class="form-control" value="Ceremony" disabled="">                    
                    </div>  
                    <div class="inpt-3">
                      <label>Deadline</label>                 
                      <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" placeholder="Deadline" name="date" required />
                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                    </div> 
                    </div>
                    <div class="inpt-3">
                      <label>Estimated Budget</label>                 
                      <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" placeholder="US Dollar" class="form-control">
                      </div>
                    </div>       
                 </div>
                  <div class="clearfix"></div>
                   <div class="form-group">
                    <div class="inpt-3">
                      <label for="">Category</label>
                      <input type="text" class="form-control" value="Ceremony" disabled="">                    
                    </div>  
                    <div class="inpt-3">
                      <label>Deadline</label>                 
                      <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" placeholder="Deadline" name="date" required />
                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                    </div> 
                    </div>
                    <div class="inpt-3">
                      <label>Estimated Budget</label>                 
                      <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" placeholder="US Dollar" class="form-control">
                      </div>
                    </div>       
                 </div>
                <div class="clearfix"></div>
                   <div class="form-group">
                    <div class="inpt-3">
                      <label for="">Category</label>
                      <input type="text" class="form-control" value="Ceremony" disabled="">                    
                    </div>  
                    <div class="inpt-3">
                      <label>Deadline</label>                 
                      <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" placeholder="Deadline" name="date" required />
                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                    </div> 
                    </div>
                    <div class="inpt-3">
                      <label>Estimated Budget</label>                 
                      <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" placeholder="US Dollar" class="form-control">
                      </div>
                    </div>       
                 </div>
                  <div class="clearfix"></div>
              </form> 
            
          </div><!--/col-md-12-->
         
           <div class="clearfix"></div>
           <div class="text-center mt5">
             <a href="" class="btn btn-beta mb1" id="previous">Previous</a>&nbsp;&nbsp;&nbsp;
               <a href="" class="btn btn-alpha mb1" id="next">Next</a>
           </div>
           <div class="clearfix"></div>
         

          </div><!--/step-box-->
      </div>
    </div>
  </div>
</div><!--/addNewWizard-->
<!--Edit Checklist items-->
<div class="container">
<div class="pop-up-width">
        <div id="modal1" class="popupContainer" style="display:none;">
         <header class="popupHeader">
                        <span class="">Edit Checklist item</span>                        
                        <span class="modal_close"><i class="fa fa-times"></i></span>
                       </header>
                <section class="popupBody">
                       
                        <!-- Register Form -->
                        <div class="user_register">
                                <form method="post" action="include/newUser.php">
                                       <div class="form-group">
                                         <label for="">Category</label>
                                          <input type="text" class="form-control" value="Ceremony" disabled="">                    
                                        </div>
                                      
                                        <div class="form-group">
                                          <label>Deadline</label>                 
                                          <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control" placeholder="Deadline" name="date" required />
                                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                         </div> 
                                        </div>
                                      <div class="form-group">
                                        <label>Estimated Budget</label>                 
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" placeholder="US Dollar" class="form-control">
                                        </div>
                                      </div>  
                                      <div class="form-group">
                                        <label>Actual Budget</label>                 
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" placeholder="US Dollar" class="form-control">
                                        </div>
                                      </div>       
                                        
                                   
                                        <div class="action_btns">
                                                <div class="one_half"><a href="#" class="btn btn-beta modal_close">Cancel</a></div>
                                                <div class="one_half last"><input type="submit" class="btn btn-alpha btn-block" name="submit" value="Register"/></div>
                                        </div>
                                </form>
                        </div>
                </section>
        </div>
      </div>
      </div>
<!--/Edit Checklist items-->
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard</h3>
      </div>
    </div>
    <div class="row profile">
    <div class="col-md-3">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <img src="images/avatar.png" class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
            Marcus & Julia
          </div>
          <div class="profile-usertitle-job">
            25 July 2016
          </div>
          <div class="profile-usertitle-name">
            254 Days to go
          </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
          <ul class="nav">
            <li class="active">
              <a href="#"><i class="fa fa-dashboard"></i>Dashboard </a>
            </li>
            <li>
              <a href="#"><i class="fa fa-check-square-o"></i>Checklist </a>
            </li>
            <li>
             <a href="#"><i class="fa fa-users"></i>Invitations</a>
            </li>
            <li>
             <a href="#"><i class="fa fa-gift"></i>Registry</a>
            </li>
            
          </ul>
        </div>
        <!-- END MENU -->
      </div>
    </div>
    <div class="col-md-9">
      <div class="side-content" id="checklistList">
        <table class="table">
          <thead>
            <tr>
             <th> 
              </th>
             <th>Category</th>
             <th>Deadline</th>
             <th><small>Estimated</small><br> Budget</th>
             <th><small>Actual</small><br>  Budget</th>
             <th></th>
             <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
            <td>
              <div class="checkbox-xl">
                  <input id="lcheck2" type="checkbox" name="check" value="check1">
                  <label for="lcheck2"></label>                   
                 </div>
            </td>
              <td><span class="cat_name">Ceremony <a title="Search Vendors" href="#"><span class="info-link"><i class="fa fa-search"></i></span></a>
              </td>
              <td>12 Mar 2017</td>
              <td>$5000.00</td>
              <td>$4700.00</td>
              <td><span class="indicator green"></span></td>
              <td>
                <a id="modal_trigger1" href="#modal1" class="action-btn"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                <a href="" class="action-btn"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <tr>
            <td>
              <div class="checkbox-xl">
                  <input id="lcheck3" type="checkbox" name="check" value="check1">
                  <label for="lcheck3"></label>                   
                 </div>
            </td>
              <td><span class="cat_name">Ceremony <a title="Search Vendors" href="#"><span class="info-link"><i class="fa fa-search"></i></span></a>
              </td>
              <td>12 Mar 2017</td>
              <td>$5000.00</td>
              <td>$4700.00</td>
              <td><span class="indicator green"></span></td>
              <td>
                <a href="" class="action-btn"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                <a href="" class="action-btn"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>

</body>
</html>

<?php
  }
  else
  {
    echo 'Please Select Proper Event!';
  }
}
else
{
  echo 'Please Select Proper Event!';
}
?>