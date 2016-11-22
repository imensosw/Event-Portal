<?php ob_start();
//echo $_SERVER['DOCUMENT_ROOT'];
if(!isset($_SESSION)){session_start();} ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Event Portal | Zuruuna.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('fb_login/index.php'); ?>

<div id="myCarousel" class="carousel slide carousel hide-phone" data-interval="3000" data-ride="carousel">
      <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>   
       <!-- Carousel items -->
       
        <div class="carousel-inner">
            <div class="active item">
               <img src="images/ban1.jpg">                
            </div>
            <div class="item">
                <img src="images/slide1.jpg">               
            </div>
            <div class="item">
              <img src="images/slide2.jpg">
            </div>
            <div class="item">
              <img src="images/slide3.jpg">
            </div>
        </div>
                     
    </div>
</div>
<div id="myCarousel1" class="carousel slide carousel hide-pc" data-interval="3000" data-ride="carousel">
      <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel1" data-slide-to="1"></li>
            <li data-target="#myCarousel1" data-slide-to="2"></li>
            <li data-target="#myCarousel1" data-slide-to="3"></li>
        </ol>   
       <!-- Carousel items -->
       
        <div class="carousel-inner">
            <div class="active item">
               <img src="images/ban2.jpg">                
            </div>
            <div class="item">
                <img src="images/ban3.jpg">               
            </div>
            <div class="item">
              <img src="images/ban4.jpg">
            </div>
            <div class="item">
              <img src="images/ban5.jpg">
            </div>
        </div>
         
    </div>
</div>

 <div class="slogan">
    <h2>Your Very Own Occassion Concierge</h2>
    
   <a class="btn btn-alpha theme-bg show_login" href="#signup" data-toggle="modal"><i class="fa fa-envelope"></i>&nbsp;&nbsp; Sign up with email</a> 
    <a class="btn btn-alpha fb-bg" href="<?php if(isset($fb_login_url) && !empty($fb_login_url)) { echo $fb_login_url;} else { echo 'javascript:;';} ?>"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Login with facebook</a>
  </div>
<section class="burger-sm" id="planning">
  <div class="container">
    <div class="row gutter-sm">
     <h2 class="text-center">Plan your Occassion one step at a time</h2>
     <div class="divide-sm"></div>
     <div class="mt5"></div>
      <div class="col-md-3">
        <div class="box-grey">
             <i class="fa fa-check-square-o"></i>
            <h3>Checklist</h3>
            <p>A Occassion planner in your pocket</p>          
        </div>
      </div>
      <div class="col-md-3">
        <div class="box-grey">
           <i class="fa fa-money"></i>
          <h3>Budgeter</h3>
          <p>Advice on what to spend tailored to your budget</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box-grey">
          <i class="fa fa-desktop"></i>
          <h3>Website</h3>
          <p>Pick from hundreds of templates to tell your unique story</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box-grey">
           <i class="fa fa-gift"></i>
          <h3>Registry</h3>
          <p>Manage all your registries and share a single link with guests</p>
        </div>
      </div>

    </div>
</div>
</section>
<section class="burger-sm dark" id="coreFeatures">
 <div class="container">
  <h2 class="text-center bigpara">From planning every detail to booking all your<br> Occassion pros, we’ve got you covered.</h2>
  <div class="row gutter-sm">  
        <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/sqimg1.jpg">
                </div>
                <div class="panel-text">
                  <h3 class="text-center">Find Vendors</h3><br>
                  <form class="lrpad">
                        <div class="form-group">
                          <select required data-placeholder="Choose an Event" name="event_id" id="event_id" class="chosen-select" style="width:100%;" tabindex="2">
                        <option value="">Choose a Vendor</option>
                       
                      </select>
                        </div>
                       
                        <button class="btn btn-alpha theme-bg btn-block" type="submit">Search</button>
                    </form>
                </div> 
                        
            </div>

        </div>
        <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/sqimg2.jpg">
                </div>
                <div class="panel-text">
                  <h3 class="text-center">Our Story</h3><br>
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Full story</a>
                   </div>
                </div>
               
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/sqimg3.jpg">
                </div>  
                <div class="panel-text" style="top:42%;">                  
                  <div align="center">                  
                   <a class="btn btn-alpha theme-bg" href="">Our Registry Partners</a>
                   </div>
                </div>
               
            </div>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="row gutter-sm">
        <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/ban2.jpg">
                </div>                  
                <div class="panel-text" style="margin-top:15%;">                  
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Read More</a>
                   </div>
                </div>
            </div>
      </div>
      <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/ban3.jpg">
                </div>  
                <div class="panel-text" style="margin-top:15%;">                  
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Read More</a>
                   </div>
                </div>
               
            </div>
      </div>
      <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/ban4.jpg">
                </div>  
                 <div class="panel-text" style="margin-top:15%;">                  
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Read More</a>
                   </div>
                </div>
              
            </div>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="row gutter-sm">
        <div class="col-sm-8 col-md-8">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/ban5.jpg">
                </div>  
                  <div class="panel-text" style="margin-top:5%;">                  
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Read More</a>
                   </div>
                </div>
               </div>
      </div>
      <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/ban3.jpg">
                </div>  
                 <div class="panel-text" style="margin-top:5%;">                  
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Read More</a>
                   </div>
                </div>
              
            </div>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="row gutter-sm">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-image hide-panel-body">
                    <img class="panel-image-preview" src="images/sqimg3.jpg">
                </div>  
                 <div class="panel-text" style="margin-top:10%;">                  
                  <div align="center">
                   <p class="lrpad text-center"><strong>From planning every detail to booking all your Occassion pros, we’ve got you covered.</strong></p>
                   <a class="btn btn-alpha wht-border" href="">Read More</a>
                   </div>
                </div>
               
            </div>
      </div>
      </div>
        </div>
</section>

<?php include('footer.php'); ?>
<?php include('footer_new.php'); ?>
</body>
</html>

