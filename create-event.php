<?php include('connection.php'); ?>
<?php
ob_start();
$users_events = select_single_col('we_users_event','count(*)','WHERE event_user = '.$_SESSION['reg_id']);
if($users_events > 0)
{
  ?>
    <script type="text/javascript">window.location = 'dashboard.php';</script>
  <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create an Event | Zuruuna.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/intlTelInput.css">
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
</head>
<body onload="initialize()">
<?php include('header.php'); ?>
  <h3 class="text-center" id="banner-sm">Create your event</h3>
  <section id="createEvent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="eventForm">
             <form class="form-horizontal" name="" id="" method="post" action="include/newEvent.php" enctype="multipart/form-data" >          
               <article class="wrapper shade">  
                  <div class="form-group">
                 
                    <label for="">Event</label>
                    <select required data-placeholder="Choose an Event" name="event_id" id="event_id" class="chosen-select" style="width:100%;" tabindex="2">
                        <option value=""></option>
                        <?php 
                        $events = select_data_array('we_event','','');
                        if($events)
                        {
                            $count = 0;
                            while($count < count($events)) 
                            {
                                ?>
                                <option value="<?php echo $events[$count]['id']; ?>"><?php echo $events[$count]['event_name']; ?>
                                    </option>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                      </select>
                  </div>                
                <div class="form-group">
                  	<label>Event Address</label>
                   	<div class="">
                    	<input id="event_address" name="event_address" class="form-control" type="text" required/>
                   	</div>
       
                </div>

               	
                 <div class="form-group">
                  <label>Event Location</label>
                   <div id="locationField">
                    <input id="autocomplete" name="event_location" class="form-control" onFocus="geolocate()" type="text" required/>
                   </div>
       
                 </div>

                  <div class="form-group">
                    <label>Event Date</label>      
                    <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" name="event_date" required />
                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                    </div>      
                 </div>   

                  <div class="form-group">
                   <label>Estimated Budget</label>
                   <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" placeholder="US Dollar" name="event_budget" class="form-control">
                      </div>
                 </div>       
                 <div class="form-group">
                   <label>Mobile No.</label>
                   <input id="phone" class="form-control" type="tel">
                 </div>          
                  <div class="form-group">
                    <label>People Invloved</label>
                    <div class="input-group">
                      <span class="input-group-addon">Spouse Name</span>
                      <input type="text" required value="" placeholder="First name" name="first_fname" class="form-control">
                      <input type="text" required value="" placeholder="Last Name" name="first_lname" class="form-control">
                    </div>
                    
                    <div class="input-group event_people" style="display:none;">
                      <span class="input-group-addon">Person Name</span>
                      <input type="text" value="" required placeholder="First Name" name="second_fname" id="second_fname" class="form-control">
                      <input type="text" value="" required placeholder="Last Name" name="second_lname" id="second_lname" class="form-control">
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <input class="btn btn-alpha btn-block mt5 theme-bg sub-mt" type="submit" name="submit" value="Start"/>
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
<script src="js/intlTelInput.js"></script>
<script>
    $("#phone").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: false,
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // initialCountry: "auto",
      // nationalMode: false,
      // numberType: "MOBILE",
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "js/utils.js"
    });
  </script>

</body>
</html>

