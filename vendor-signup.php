<?php include_once('administrator/common/model/conn.php'); ?>
<?php include_once('administrator/common/model/function.php'); ?>
<?php
ob_start();

$_SESSION['reg_email'] = 'rahuljoshi.gogu@gmail.com';
$_SESSION['reg_id'] = 16;
$_SESSION['reg_name'] = 'rahul joshi';
$_SESSION['reg_type'] = 'VENDOR';

if(isset($_SESSION['vendor_id']) && !empty($_SESSION['vendor_id']))
{
  header('location:vendor-dashboard.php');
}


/*
$vendor_id = select_single_col('we_vendor','count(*)','WHERE vendor = '.$_SESSION['vendor_id']);
if($vendor_id > 0)
{
  ?>
    <script type="text/javascript">window.location = 'vendor_dashboard.php';</script>
  <?php
}
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Vendor SignUp | Zuruuna.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea', entity_encoding : "raw",toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", });</script>

</head>
<body onload="initialize()">
<?php //include('header.php'); ?>
  <h3 class="text-center" id="banner-sm">Vendor SignUp</h3>
  <section id="createEvent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="eventForm">
             <form class="form-horizontal" name="" id="vendorRegForm" method="post" action="include/newVendor.php"  enctype="multipart/form-data" >          
               <article class="wrapper shade">  
                  <div class="form-group">
                    <label for="">Business Category</label>
                    <select required_ data-placeholder="Choose Category" name="category_id" id="category_id" class="chosen-select" style="width:100%;" tabindex="2">
                      <option value=""></option>
                      <?php 
                      $categories = select_data_array('we_vendor_category_master','','');
                      if($categories)
                      {
                          $count = 0;
                          while($count < count($categories)) 
                          {
                              ?>
                              <option value="<?php echo $categories[$count]['id']; ?>"><?php echo $categories[$count]['category_name']; ?>
                                  </option>
                              <?php
                              $count++;
                          }
                      }
                      ?>
                    </select>
                  </div> 
                  <div class="form-group">
                    <label for="">Sub Category</label>
                    <select required_ multiple="multiple" data-placeholder="Choose Sub Category" name="subcat_id" id="subcat_id" class="chosen-select_" style="width:100%;" tabindex="2">
                      <option value=""></option>
                      <?php 
                      $subcats = select_data_array('we_vendor_subcategory_master','','');
                      if($subcats)
                      {
                        $count = 0;
                        while($count < count($subcats)) 
                        {
                            ?>
                            <option value="<?php echo $subcats[$count]['id']; ?>"><?php echo $subcats[$count]['category_name']; ?></option>
                            <?php
                            $count++;
                        }
                      }
                      ?>
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Vendor Name</label>
                    <div class="">
                      <input required_ id="reg_name" name="reg_name" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Vendor Email</label>
                    <div class="">
                      <input required_ id="reg_email" name="reg_email" class="form-control" type="email" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <div class="">
                      <input required_ id="reg_password" name="reg_password" class="form-control" type="password" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Vendor Contact No.</label>
                    <div class="">
                      <input required_ id="mobile_no" name="mobile_no" class="form-control" type="text" />
                    </div>
                  </div>               
                  <div class="form-group">
                    <label>Business Name</label>
                    <div class="">
                      <input required_ id="business_name" name="business_name" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Business Description</label>
                    <div class="">
                      <textarea id="business_description" name="business_description" class="form-control"  ></textarea>
                    </div>
                  </div>
                  <div class="form-group" style="position:relative">
                      <label for="">Profile Image</label> 
                      <div class="attach-text">Change Image</div>
                      <input type="file" name="vendor_image" id="vendor_image" onchange="loadFile(event)" accept="image/*" class="attach-file">
                      <span> (The ideal size is 1072X450PX)</span>

                    <?php 
                    $vendor_image = 'images/avatar.png';
                    //if((count($website_data) >0) && !empty($website_data[0]['cover_image'])) 
                    //{ 
                        //$path = 'vendor/'.select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
                        //$cover_image = $path.$website_data[0]['cover_image'];
                    //}
                    
                    ?>                                   
                      <div class="col-md-4"><img class="img-responsive" id="loadVendorImage" src="<?php echo $vendor_image; ?>"></div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label>Min-Price</label>
                    <div class="">
                      <input required_ id="min_price" name="min_price" class="form-control" type="number" min="1"  />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Max-Price</label>
                    <div class="">
                      <input required_ id="max_price" name="max_price" class="form-control" type="number" min="1"  />
                    </div>
                  </div>
                  <div class="form-group">
                      
                              <label class="control-label" style="font-weight:normal;">Business Address</label>
                              <input type="text" id="us3-address" name="business_address" value="" class="form-control" placeholder="Enter a location" autocomplete="off"/>
                      
                          <div id="us3" style="width: 100%; height:300px;"></div>
                      
                      <div class="clearfix"></div>
                  </div>
                  <div class="form-group">
                    <label>Important Detail about Business</label>
                    <div class="">
                      <textarea id="imp_details" name="imp_details" class="form-control"  ></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                 	<!--<div class="g-recaptcha" data-callback="capcha_filled" data-expired-callback="capcha_expired" data-sitekey="6LfweyATAAAAAHC8V3m4B7Z_gA1huBHPt4cg2iX4"></div>
                  
                  <script src='https://www.google.com/recaptcha/api.js'></script>-->
                  </div>
                    <div class="form-group">
                      <input class="btn btn-alpha btn-block mt5 sub-mt" type="submit" name="submit" value="Create your Account"/>
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
  var loadFile = function(event) {
    var output = document.getElementById('loadVendorImage');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<script type="text/javascript">


$('#vendorRegForm').submit(function(event){
  event.preventDefault();
  tinyMCE.triggerSave();
  //alert($('#business_description').val());
  //if ($("#g-recaptcha-response").val()) {
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: formURL,
    type: 'POST',
        data:  formData,
    mimeType:"multipart/form-data",
    contentType: false,
        cache: false,
        processData:false,
    success: function(data)
    {

        if(data.VerficationStatus=="Y")
        {
          $(".reg_message").html('<h6 class="wht-text" style="color:green;">Register Successfull , Please wait we are activating your a/c! IF System Not Redirect you then please <a href="dashboard.php" >click here</a></h6>.');
          $(".reg_message").css('color','green');
          //$(".reg_message").addClass('green');
          window.location ='vendor-dashboard.php';
        }
        else if(data.VerficationStatus=="N")
        {
          alert('User Already Exist!');
          $(".reg_message").html('<h6 class="wht-text"  style="color:red;">User Already Exist!</h6>');
          $(".reg_message").css('color','red');
        }
        else if(data.VerficationStatus=="E")
        {
          alert('Something Went Wrong, Please Try again with valid username & email!');
          $(".reg_message").css('color','red');
          $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Something Went Wrong, Please Try again with valid username & email!</h6>');
        }
        else if(data.VerficationStatus=="F")
        {
          alert('Robot verification failed, please try again!');
          $(".reg_message").css('color','red');
          $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Robot verification failed, please try again!</h6>');
        }
        else if(data.VerficationStatus=="R")
        {
          alert('Please click on the reCAPTCHA box.!');
          $(".reg_message").css('color','red');
          $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Please click on the reCAPTCHA box.!</h6>');
        }
        else
        {
          alert('Please fill correct info!');
          $(".reg_message").css('color','red');
          $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Please fill correct info!</h6>');
        }
    },dataType: "json"        
    });
  //}
  //else
  //{
  //  alert('Please, fill re-captcha!');
  //}
    //e.preventDefault(); //Prevent Default action. 
    //e.unbind();
});


  $('#category_id').change(function(){
    var cat_id = $(this).val();
    $.ajax(
      {
        type:"post",
        url:"include/get_subcat_list.php",
        data:{
          cat_id : cat_id
        },
        success:function(data)
        {
          $('#subcat_id').empty();
          //$("#subcat_id").trigger("liszt:updated");
          //$("#subcat_id").chosen({ width: "100%" });
          //$("#cb_info").append(data);
          $('#subcat_id').html(data);
          //$("#subcat_id").trigger("liszt:updated");
          //$("#subcat_id").chosen({ width: "100%" });
          
        }
    });
  });
</script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
  <script src="js/locationpicker.jquery.min.js"></script>
   <script>
   //$(document).ready(function(){
      $('#us3').locationpicker({
          location: {
              latitude: 4526521,
              longitude: 25654125
          },
          radius: 300,
          inputBinding: {
              latitudeInput: $('#us3-lat'),
              longitudeInput: $('#us3-lon'),
              radiusInput: $('#us3-radius'),
              locationNameInput: $('#us3-address')
          },
          enableAutocomplete: true,
          onchanged: function (currentLocation, radius, isMarkerDropped) {
            $('.ceremony_location_lat').val(currentLocation.latitude);
            $('.ceremony_location_lon').val(currentLocation.longitude);
              // Uncomment line below to show alert on each Location Changed event
              //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
          }
      });
      
  //});
  </script>
</body>
</html>

