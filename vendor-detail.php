<?php include_once('administrator/common/model/conn.php'); ?>
<?php include_once('administrator/common/model/function.php'); ?>
<?php
ob_start();
if(isset($_SESSION['vendor_id']) && !empty($_SESSION['vendor_id']))
{
  //header('location:vendor-dashboard.php');
}

if(isset($_GET['vendor']) && !empty($_GET['vendor']))
{
  $vender_detail = select_data_array('we_vendor','','WHERE access_key = "'.$_GET['vendor'].'"');
  if(count($vender_detail)>0)
    {
      $business_description = $vender_detail[0]['business_description'];
      if(!empty($business_description)) 
      {
        $business_description  = str_replace("apostrophe_s","'",$business_description);
      }

      $imp_details = $vender_detail[0]['imp_details'];
      if(!empty($imp_details)) 
      {
        $imp_details  = str_replace("apostrophe_s","'",$imp_details);
      }
      $price_range = '-';
      $min_price = $vender_detail[0]['min_price'];
      $max_price = $vender_detail[0]['max_price'];
      if(!empty($min_price))
      {
        $price_range = '$'.$min_price;
      }
      if(!empty($max_price))
      {
        $price_range .= '-$'.$max_price;
      }

      
    }
    else{ echo '<h1>No Vendor Found By this ID !</h1> '; die;}
}
else
{
  echo '<h1>First Select Vendor From List !</h1> '; die;
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
<link rel="stylesheet" href="review_files/css/Fr.star.css" />
</head>
<body >

<?php include('header.php'); ?>

<div class="breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">      
          <a href="">Home</a> > <a href="">Vendor List</a> > <?php echo $vender_detail[0]['business_name']; ?>       
      </div>
    </div>
  </div>  
</div>

<div class="container">   
    <div class="row profile">
        
        <div class="col-md-9">
        <div class="side-content">
           <div id="gallery" style="display:none;">
  
    <img alt="Preview Image 1"
       src="images/thumbs/thumb1.jpg"
       data-image="images/big/image1.jpg"
       data-description="Preview Image 1 Description">
    
    <img alt="Preview Image 2"
       src="images/thumbs/thumb2.jpg"
       data-image="images/big/image2.jpg"
       data-description="Preview Image 2 Description">

    
       
    <img alt="Preview Image 3"
       src="images/thumbs/thumb3.jpg"
       data-image="images/big/image3.jpg"
       data-description="Preview Image 3 Description">

    
      
    <img alt="Preview Image 4"
       src="images/thumbs/thumb4.jpg"
       data-image="images/big/image4.jpg"
       data-description="Preview Image 4 Description">
    
    
    
    <img alt="Preview Image 5"
       src="images/thumbs/thumb1.jpg"
       data-image="images/big/image1.jpg"
       data-description="Preview Image 5 Description">

    
        
    <img alt="Preview Image 6"
       src="images/thumbs/thumb2.jpg"
       data-image="images/big/image2.jpg"
       data-description="Preview Image 6 Description">


    

       
    <img alt="Preview Image 7"
       src="images/thumbs/thumb3.jpg"
       data-image="images/big/image3.jpg"
       data-description="Preview Image 7 Description">

       
    <img alt="Preview Image 8"
       src="images/thumbs/thumb4.jpg"
       data-image="images/big/image4.jpg"
       data-description="Preview Image 8 Description">
       
    <img alt="Preview Image 9"
       src="images/thumbs/thumb1.jpg"
       data-image="images/big/image1.jpg"
       data-description="Preview Image 9 Description">
    
    <img alt="Preview Image 10"
       src="images/thumbs/thumb2.jpg"
       data-image="images/big/image2.jpg"
       data-description="Preview Image 10 Description">
       
    <img alt="Preview Image 11"
       src="images/thumbs/thumb3.jpg"
       data-image="images/big/image3.jpg"
       data-description="Preview Image 11 Description">
             
  </div>
  <div class="burger">
  <h2 class="text-center">About Vendor</h2>
  <div class="divide-sm"></div>
  <div class="gutter">
    <p class="text-center"><strong><?php echo $vender_detail[0]['business_name']; ?></strong></p>

<p class="text-center">
  <?php echo $business_description; ?>
</p>
 
   <hr>
   
  <div class="col-md-4">
    <strong>Amenities</strong><br>
    <?php echo $imp_details; ?>
    </div>

    <div class="col-md-4">
      <p> <strong>Price Range</strong><br>
        <?php echo $price_range; ?>
      </p>
      <p><?php echo select_single_col('we_vendor_category_master','category_name','WHERE id='.$vender_detail[0]['category_id']); ?></p>
      <p>(<?php echo select_single_col_string('we_vendor_subcategory_master','category_name','WHERE id IN(SELECT subcat_id FROM we_vendor_cat_subcat_master WHERE category_id='.$vender_detail[0]['category_id'].')'); ?>)</p>
    </div>
    <div class="col-md-4">
    <p> <strong>Contact Info</strong><br>
    <?php echo $vender_detail[0]['business_address']; ?><br>
    <?php echo $vender_detail[0]['vendor_name']; ?><br>
    <?php echo $vender_detail[0]['vendor_email']; ?><br>
    <?php echo $vender_detail[0]['vendor_contact_no']; ?><br>
    </p>
    </div>
    <div class="clearfix"></div>
  <hr>
  <h4 class="">Vendor Reviews <a href="javascript:;" onclick="$('.review_form').toggle();" class="pull-right btn btn-beta">Write a Review</a></h4>
  <div class="row review_form" style="display:none;">
  <div class="form-group">
    <?php
    if(isset($_SESSION['reg_id']) || isset($_SESSION['reg_id'])){
      $id = $name = '';
      if(isset($_SESSION['reg_id'])) { $id = $_SESSION['reg_id']; }
      if(isset($_SESSION['reg_name'])) { $name = $_SESSION['reg_name']; }
      $review_date = date('Y-m-d');

    ?>  
    
      <form method="POST" action="include/add_review.php" id="review_form" >
        <p><input type="hidden" id="review_type" name="review_type" value="VENDOR" class="form-control" /></p>
        <p><input type="hidden" id="review_for" name="review_for" value="<?php if(isset($vender_detail[0]['id'])) { echo $vender_detail[0]['id'];} ?>" class="form-control" /></p>
        <p><input type="hidden" id="review_point" name="review_point" placeholder="Point" class="form-control" value="3"/></p>
        <p><textarea id="review" name="review" class="form-control" placeholder="Review"></textarea></p>
        <div data-rating="1.4" data-title="Set a rating of 1.4" class="Fr-star userChoose size-1"><div style="width: 0%;" class="Fr-star-value"></div><div class="Fr-star-bg"></div></div>
        <input class="btn" type="submit" value="Add Review" />
        <span class="review_msg" ></span>
      </form>
    <?php
  }else
  {
    ?><h4>Please login for add your review!</h4><?php
  }
  ?>
  </div>
  </div>
        <p>&nbsp;</p>
          <div class="reviews_list">
            <?php
            $review_for = $review_by = '';
            if(isset($vender_detail[0]['id'])) { $$review_for =  $vender_detail[0]['id'];}
            if(isset($_SESSION['reg_id'])) { $$review_by =  $_SESSION['reg_id'];}

            $reviews_list = select_data_array('we_review','','WHERE review_for='.$review_for.' AND review_type="VENDOR"');
            if(count($reviews_list)>0)
            {
              $count = 0;
              while($count<count($reviews_list))
              {
                $review_image = select_single_col('we_vendor','vendor_image','WHERE id='.$reviews_list[$count]['review_by']);
                $review_by_name = select_single_col('we_vendor','vendor_image','WHERE id='.$reviews_list[$count]['review_by']);
                ?>
                <div class="media">
                  <a href="#" class="pull-left">
                      <img width="100" src="images/avatar.png" class="img-circle" alt="Sample Image">
                  </a>
                  <div class="media-body">
                      <p class="">Stylish photography, the most expensive digital equipment and the latest image editing techniques and software. <span class="rating pull-right"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></p>
                    
                     <span class="vendor-price"><em>Jay Parihar</em></span><br>
                      <span class="vendor-price"><em> Reviewed on 10/16/2012 </em></span>
                  </div>
                </div>
                <hr>
                <?php  
                $count++;
              }
              
            }
            else
            {
              echo '<h4>No Review!</h4>';
            }
            ?>
            
            <div class="media">
                <a href="#" class="pull-left">
                    <img width="100" src="images/avatar.png" class="img-circle" alt="Sample Image">
                </a>
                <div class="media-body">
                    <p class="">Stylish photography, the most expensive digital equipment and the latest image editing techniques and software. 
                    <span class="rating pull-right"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></p>
                  
                   <span class="vendor-price"><em>Jay Parihar</em></span><br>
                    <span class="vendor-price"><em> Reviewed on 10/16/2012 </em></span>
                </div>
            </div>
          </div>
  </div>
  </div>
       </div>
           </div>
           <div class="col-md-3" style="background:white;">
            <div class="filters">
                <h4>Message to Vendor</h4>
                <form >
                        <div class="form-group">
                            <label for="inputEmail">Your Name</label>
                            <input type="email" placeholder="Enter a location" id="inputEmail" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" placeholder="Enter a location" id="inputEmail" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Contact No.</label>
                            <input type="email" placeholder="Enter a location" id="inputEmail" class="form-control">
                        </div>
                       
                         <div class="form-group">
                           <a href="" class="btn btn-alpha">Send Message</a>
                         </div>
                       
                        
                    </form>
            </div>
        </div>
       
   </div>
</div>


<?php include("footer.php");?>
<script type='text/javascript' src='unitegallery/js/jquery-11.0.min.js'></script> 
  
  <script type='text/javascript' src='unitegallery/js/ug-common-libraries.js'></script> 
  <script type='text/javascript' src='unitegallery/js/ug-functions.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-thumbsgeneral.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-thumbsstrip.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-touchthumbs.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-panelsbase.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-strippanel.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-gridpanel.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-thumbsgrid.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-tiles.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-tiledesign.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-avia.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-slider.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-sliderassets.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-touchslider.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-zoomslider.js'></script> 
  <script type='text/javascript' src='unitegallery/js/ug-video.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-gallery.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-lightbox.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-carousel.js'></script>
  <script type='text/javascript' src='unitegallery/js/ug-api.js'></script>
  <link rel='stylesheet' href='unitegallery/css/unite-gallery.css' type='text/css' />
  
  <script type='text/javascript' src='unitegallery/themes/default/ug-theme-default.js'></script>
  <link rel='stylesheet'      href='unitegallery/themes/default/ug-theme-default.css' type='text/css' />
  <script src="review_files/js/Fr.star.js"></script>
    <script src="review_files/js/rate.js"></script>
  <script type="text/javascript">

    jQuery(document).ready(function(){

      jQuery("#gallery").unitegallery();

    });
    $(".Fr-star.userChoose").Fr_star(function(rating){
    //$.post("ajax_rate.php", {'id' : 'index_page', 'rating': rating}, function(){
      $('#review_point').val(rating);
    });
    $('.review_form').submit(function(event){
      event.preventDefault();
      var review = $(this).find('#review').val();
      var review_point = $(this).find('#review_point').val();
      var review_for = $(this).find('#review_for').val();
      $.ajax({
      url: 'include/add_review.php',
      type: 'POST',
      data:{ 
        review : review,
        review_point : review_point,
        review_for : review_for
    },
      success: function(data)
      {
        alert(data);
          if(data.VerficationStatus=="Y")
          {
            $(".review_msg").html('Review Added !');
            $(".review_msg").css('color','green');
            setTimeout(function() {
              $("#reviews_list").load(location.href + " #reviews_list");
            }, 500);
            
          }
          else if(data.VerficationStatus=="F")
          {
            $(".review_msg").html('failed !');
            $(".review_msg").css('color','red');
          }
          else if(data.VerficationStatus=="S")
          {
            $(".review_msg").css('color','red');
            $(".review_msg").html('Please login first !');
          }
          else if(data.VerficationStatus=="N")
          {
            $(".review_msg").css('color','red');
            $(".review_msg").html('Please Add review before saving !');
          }
          else
          {
            $(".review_msg").css('color','red');
            $(".review_msg").html('Something is wrong!');
          }
          
      },dataType: "json"        
      });
    });
  </script>
</body>
</html>

