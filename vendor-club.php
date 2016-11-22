<?php include_once('administrator/common/model/conn.php'); ?>
<?php include_once('administrator/common/model/function.php'); ?>
<?php
ob_start();
if(isset($_SESSION['vendor_id']) && !empty($_SESSION['vendor_id']))
{
  //header('location:vendor-dashboard.php');
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
</head>
<body onload="initialize()">

<?php include('header.php'); ?>

<div class="burger extra-dark" id="findVendors">
  <h2 class="text-center">
      Find Vendors
  </h2>  
  <form class="form-inline" method="POST" id="search_form">
    <input type="text" name="min_price" class="min_price hide" value="<?php if(isset($_REQUEST['min_price'])){ echo $_REQUEST['min_price']; } ?>" />
    <input type="text" name="max_price" class="max_price hide" value="<?php if(isset($_REQUEST['max_price'])){ echo $_REQUEST['max_price']; } ?>" />
                            <div class="form-group">
                                <label for="inputEmail" class="sr-only">Email</label>
                                <select  data-placeholder="Choose Category" name="category" id="category" class="chosen-select" style="width:100%;" tabindex="2">
                                  <option value=""></option>
                                  <option value=""> - </option>
                                  <?php 
                                  $categories = select_data_array('we_vendor_category_master','','');
                                  if($categories)
                                  {
                                      $count = 0;
                                      while($count < count($categories)) 
                                      {
                                        if(isset($_REQUEST['category']) && $_REQUEST['category'] == $categories[$count]['id']){ $selected_category = 'selected="selected"'; }else { $selected_category = '';} 
                                          ?>
                                          <option <?php echo $selected_category; ?> value="<?php echo $categories[$count]['id']; ?>"><?php echo $categories[$count]['category_name']; ?>
                                              </option>
                                          <?php
                                          $count++;
                                      }
                                  }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="sr-only">Password</label>
                               <div id="locationField">
                    <input id="autocomplete_" name="location" class="form-control" value="<?php if(isset($_REQUEST['location'])){ echo $_REQUEST['location']; } ?>" onFocus="geolocate()" type="text" />
                   </div>
                            </div>
                         
                            <button class="btn btn-alpha" type="submit"><i class="fa fa-search"></i> Search</button>
                        </form>
      

</div>

<div class="container">   
    <div class="row profile">
        <div class="col-md-3">
            <div class="filters">
                <h4>Filter Vendors</h4>
                
                        <div class="form-group hide">
                            <label for="inputEmail">Location</label>
                            <input type="text" name="_location" placeholder="Enter a location" id="inputEmail" class="form-control">
                        </div>
                       
                        <lable>Price Range</lable>
                        <div class="checkbox">
                            <?php
                            $price_range1 = $price_range2 = $price_range3 = $price_range4 = $price_range5 = $price_range6 = '';
                            if(isset($_REQUEST['max_price']) && $_REQUEST['max_price']<1000)
                            {
                              $price_range1 = 'checked="checked"';
                            }
                            else if(isset($_REQUEST['max_price']) && $_REQUEST['max_price']<2000)
                            {
                              $price_range2 = 'checked="checked"';
                            }
                            else if(isset($_REQUEST['max_price']) && $_REQUEST['max_price']<3000)
                            {
                              $price_range3 = 'checked="checked"';
                            }
                            else if(isset($_REQUEST['max_price']) && $_REQUEST['max_price']<4000)
                            {
                              $price_range4 = 'checked="checked"';
                            }
                            else if(isset($_REQUEST['max_price']) && $_REQUEST['max_price']<5000)
                            {
                              $price_range5 = 'checked="checked"';
                            }
                            else if(isset($_REQUEST['min_price']) && $_REQUEST['min_price']>=5000)
                            {
                              $price_range6 = 'checked="checked"';
                            }

                            ?>
                            <input type="radio" <?php echo $price_range1; ?> id="price_range1" min-price="0" max-price="999" class="price_range" name=""/><label for="price_range1"> $0 - $999</label><br>
                            <input type="radio" <?php echo $price_range2; ?> id="price_range2" min-price="1000" max-price="19999" class="price_range" name=""/><label for="price_range2"> $1000 - $1999</label><br>
                            <input type="radio" <?php echo $price_range3; ?> id="price_range3" min-price="2000" max-price="2999" class="price_range" name=""/><label for="price_range3"> $2000 - $2999</label><br>
                            <input type="radio" <?php echo $price_range4; ?> id="price_range4" min-price="3000" max-price="3999" class="price_range" name=""/><label for="price_range4"> $3000 - $3999</label><br>
                            <input type="radio" <?php echo $price_range5; ?> id="price_range5" min-price="4000" max-price="4999" class="price_range" name=""/><label for="price_range5"> $4000 - $4999</label><br>
                            <input type="radio" <?php echo $price_range6; ?> id="price_range6" min-price="5000" max-price="full" class="price_range" name=""/><label for="price_range6"> $5000+</label>
                        </div>
                        
                    
            </div>
        </div>
        <div class="col-md-9">
           
              <?php
              if(isset($_REQUEST))
              {
                $location_search = $min_price_search = $max_price_search = $category_search = '';
                if(isset($_REQUEST['location']) && !empty($_REQUEST['location']))
                {
                  $location = $_REQUEST['location'];
                  $location_search = " AND business_address LIKE '%$location%' ";
                }
                if(isset($_REQUEST['min_price']) && !empty($_REQUEST['min_price']))
                {
                  $min_price = $_REQUEST['min_price'];
                  $min_price_search = " AND min_price >= $min_price ";
                }
                if(isset($_REQUEST['max_price']) && !empty($_REQUEST['max_price']))
                {
                  $max_price = $_REQUEST['max_price'];
                  $max_price_search = " AND max_price <= $max_price ";
                }
                if(isset($_REQUEST['category']) && !empty($_REQUEST['category']))
                {
                  $category = $_REQUEST['category'];
                  $category_search = " AND category_id = $category ";
                }
                $where = 'where 1=1 '.$min_price_search.$max_price_search.$location_search.$category_search;
              }
              else
              {
                echo $where = 'where 1=1 ';
              }
              
              $vendors = select_data_array('we_vendor','',$where);
              if(count($vendors)>0)
              {
                ?>
                <h4><?php echo count($vendors); ?> Vendors found</h4>
                  <div class="side-content" id="venderList">
                <?php

                $count = 0;
                while($count < count($vendors))
                {
                  $vendor_image = $vendors[$count]['vendor_image'];
                  if(!empty($vendor_image))
                  {
                    //$basic_path = select_single_col('we_setting','basic_path','LIMIT 1');
                    //$path = $basic_path.'vendors/';
                    //$path .= $vendors[$count]['access_key'].'/';
                    $path = 'vendors/'.$vendors[$count]['access_key'].'/';
                    $vendor_image_path = $path.$vendor_image;
                  }
                  else
                  {
                    $vendor_image = 'v3.png';
                    $vendor_image_path = 'images/v3.png';
                  }
                  ?>
                    <div class="media">
                        <a class="pull-left" href="vendor-detail.php?vendor=<?php echo $vendors[$count]['access_key']; ?>">
                            <img alt="Sample Image" width="250" class="img-thumbnail" src="<?php echo $vendor_image_path; ?>">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $vendors[$count]['business_name']; ?><span class="rating pull-right"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></h4>
                            <p>
                            <?php //echo $vendors[$count]['business_description']; ?>
                            <?php if(!empty($vendors[$count]['business_description'])) {
                              $Business_description  = str_replace("apostrophe_s","'",$vendors[$count]['business_description']);
                              echo $small = substr($Business_description, 0, 300);
                            }
                            ?>
                            </p>
                           <span class="vendor-price"><i class="fa fa-money"></i> $<?php echo $vendors[$count]['min_price']; ?> - $<?php echo $vendors[$count]['max_price']; ?></span><br>
                            <span class="vendor-address"><i class="fa fa-map-marker"></i><?php echo $vendors[$count]['business_address']; ?></span>
                            <p class="pull-right"><a href="vendor-detail.php?vendor=<?php echo $vendors[$count]['access_key']; ?>" class="btn btn-beta">View Details</a></p>
                        </div>
                    </div>
                  <?php
                  $count++;
                }
                ?>
                </div><?php
              }
              else
              {
                ?><h4>No Vendors found</h4><?php
              }
              ?>           
               
                
           </div>
       </div>
   </div>
</div>


<?php include('footer.php'); ?>

<script type="text/javascript">
  $('.price_range').click(function(){
    if($(this).attr('max-price') == 'full')
    {
      $('#search_form').find('.max_price').attr('name','');  
    }
    $('#search_form').find('.min_price').val($(this).attr('min-price'));
    $('#search_form').find('.max_price').val($(this).attr('max-price'));

    $('#search_form').submit();  
  });
  
</script>
</body>
</html>

