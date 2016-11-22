<?php
ob_start();

include('connection.php');

  //$user_event_data = select_data_array('we_users_event','','WHERE event_user='.$_SESSION['reg_id'].' LIMIT 1');
  //print_r($user_event_data);
$user_event_id       = select_single_col('we_users_event','id','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  if(isset($user_event_id) || !empty($user_event_id))
  {
    $event_id = select_single_col('we_users_event','event_id','WHERE id='.$user_event_id);
    $event_type = select_single_col('we_event','event_type','WHERE id='.$event_id);
    if(empty($event_type) || $event_type == '') { $event_type = 1;}
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
      /** @type {HTMLInputElement} */(document.getElementById('guest_location')),
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
<!--add guest-->
    <?php
      $guestlist = select_data_array('we_users_event_guestlist','','WHERE user_event_id ='.$user_event_id.' AND event_user ='.$_SESSION['reg_id']);
      if(count($guestlist) > 0)
      {
        ?><input type="hidden" value="<?php echo count($guestlist); ?>" id="tot_model_trigger" />

        <?php  
      }
    ?>
      
  <div id="addGuestModall" class="modal" style="display:none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <header class="modal-header">
          <span class="">Add Guest</span>                        
        </header>
        <div class="modal-body">                       
          <form method="post" id="addGuestForm" >
            <div class="add_message" style=""></div>
              <div>
                <input type="hidden" name="user_event_id" id="user_event_id" value="<?php echo $user_event_id; ?>" />
              </div>
              <div class="form-group">
                <?php if($event_type != 1) { ?>
                <label for="">Guest Of</label>
                <select id="guest_of" name="guest_of" class="form-control" required>
                  <option value="">Select...</option>
                  <option value="bride">Bride</option>
                  <option value="groom">Groom</option>
                </select>
                <?php } ?>
              </div>  
              <div class="form-group">
                <label for="">Full Name</label>
                <input type="text"  id="guest_name" name="guest_name" class="form-control">                    
              </div>                
              <div class="form-group">
                <label>Email</label>                 
                <input type="text"  id="guest_email" name="guest_email" class="form-control"> 
              </div>
                <div class="form-group">
                  <label>Phone No</label>                 
                  <input type="text"  id="guest_contact_no" name="guest_contact_no" class="form-control"> 
                </div>  
                <div class="form-group">
                  <label>Address</label>                 
                 <input type="text"  id="guest_address" name="guest_address" class="form-control"> 
                </div>
                <div class="form-group">
                  <label>Location</label>                 
                 <input type="text" id="guest_location" name="guest_location" class="form-control"> 
                </div>
                <div class="form-group">
                  <label>No. Of Guest</label> 
                  <div class="input-group">
                    <span class="input-group-addon">+</span>                
                    <input type="number" id="no_of_plus_guest" name="no_of_plus_guest" class="form-control"> 
                  </div>
                </div>
                <div class="form-group">
                  <label>Note</label>                 
                  <div class="">
                      <input type="text" id="guest_note" name="guest_note" placeholder="Note" class="form-control">
                  </div>
                </div>  
                <div class="action_btns">
                      <div class="one_half"><a href="#" class="btn btn-beta" data-dismiss="modal">Cancel</a></div>
                      <div class="one_half last"><input type="submit" class="btn btn-alpha btn-block" name="submit" value="Add"/></div>
                </div>
          </form>
        </div>
      </div>
   </div>
</div><!--/add guest-->
<div id="updateGuestModall" class="modal" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
         <header class="modal-header">
              <span class="">Edit Guest</span>                        
          </header>
          <div class="modal-body">                       
            <form method="post" id="updateGuestForm" >
                    <div class="update_message" style=""></div>
                      <div>
                        <input type="hidden" name="user_event_id" id="user_event_id" value="" />
                        <input type="hidden" name="id" id="id" value="" />
                      </div>
                      <div class="form-group">
                      <?php if($event_type != 1) { ?>
                        <label for="">Guest Of</label>
                        <select id="guest_of" name="guest_of" class="form-control" required >
                          <option value="">Select...</option>
                          <option value="bride">Bride</option>
                          <option value="groom">Groom</option>
                        </select>
                      <?php } ?>
                      </div>  
                      <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" id="guest_name" name="guest_name" class="form-control">                    
                      </div>
                      <div class="form-group">
                        <label>Email</label>                 
                       <input type="text" id="guest_email" name="guest_email" class="form-control"> 
                      </div>
                        <div class="form-group">
                          <label>Phone No</label>                 
                          <input type="text" id="guest_contact_no" name="guest_contact_no" class="form-control"> 
                        </div>  
                        <div class="form-group">
                          <label>Address</label>                 
                         <input type="text" id="guest_address" name="guest_address" class="form-control"> 
                        </div>
                        <div class="form-group">
                          <label>Location</label>                 
                         <input type="text" id="guest_location" name="guest_location" class="form-control"> 
                        </div>
                        <div class="form-group">
                          <label>No. Of Guest</label> 
                          <div class="input-group">
                            <span class="input-group-addon">+</span>                
                            <input type="number" id="no_of_plus_guest" name="no_of_plus_guest" class="form-control"> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Note</label>                 
                          <div class="">
                              <input type="text" id="guest_note" name="guest_note" placeholder="Note" class="form-control">
                          </div>
                        </div>   
                        <div class="action_btns">
                          <div class="one_half"><a href="#" class="btn btn-beta" data-dismiss="modal">Cancel</a></div>
                          <div class="one_half last"><input type="submit" class="btn btn-alpha btn-block" name="submit" value="Update"/></div>
                        </div>
                  </form>
               </div>
          </div>
    </div>
</div><!--/Edit guest-->

<section id="guestList">
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Guest List</h3>
      </div>
    </div>
    <div class="row profile">
    <div class="col-md-3">
      <?php include('include/dashboard_sidebar.php'); ?>
    </div>
    <div class="col-md-9">
      <div class="guestlist" id="">
       <div class="actionbtns pa">
         <a href="#addGuestModall" data-toggle="modal" class="btn btn-alpha btn-sm"><i class="fa fa-plus"></i> Add Guest</a>&nbsp;&nbsp;
          <a href="" class="btn btn-beta btn-sm"><i class="fa fa-download"></i> </a>&nbsp;&nbsp;
           <a href="" class="btn btn-beta btn-sm"><i class="fa fa-upload"></i> </a>
       </div>
              
       <table width="100%" cellspacing="0" class="table dataTable no-footer" id="example" role="grid" aria-describedby="example_info" style="width: 100%;">
        <thead>
         <tr role="row">
         <th>Name</th>
         <th>Email</th>
         <th>Phone No.</th>
         <th>Address</th>
         <?php if($event_type !=1) { ?><th>Guest Of</th><?php } ?>
         <th>RSVP</th>
         <th>Actions</th>          
         </tr>
       </thead>
       <tbody>
        <?php 
        $guestlist = select_data_array('we_users_event_guestlist','','WHERE user_event_id ='.$user_event_id.' AND event_user ='.$_SESSION['reg_id']);
        if($guestlist)
        {
          $count = 0;
          while($count < count($guestlist))
          {
            ?>
            <tr role="row">
              <td class="sorting_1"><?php echo $guestlist[$count]['guest_name']; ?> 
              <?php if($guestlist[$count]['no_of_plus_guest'] > 0) { echo ' +'.$guestlist[$count]['no_of_plus_guest'];} ?>
              </td>
              <td><?php echo $guestlist[$count]['guest_email']; ?></td>
              <td><?php echo $guestlist[$count]['guest_contact_no']; ?></td>
              <td><?php echo $guestlist[$count]['guest_address']; ?></td>
              <?php if($event_type !=1) { ?><td><?php echo $guestlist[$count]['guest_of']; ?></td><?php } ?>
              <td>
              <?php $gust_status = 'Invite'; $guest_class=""; ?>
                <?php if($guestlist[$count]['guest_status'] == 0) { $gust_status = 'Invite'; $guest_class="send_guest_email";} ?>
                <?php if($guestlist[$count]['guest_status'] == 1) { $gust_status = 'Awated';} ?>
                <?php if($guestlist[$count]['guest_status'] == 2) { $gust_status = 'Accepted';} ?>
                <?php if($guestlist[$count]['guest_status'] == 3) { $gust_status = 'Not Comming';} ?>
                <a <?php if($guestlist[$count]['guest_status'] == 0) { ?>rowid="<?php echo $guestlist[$count]['id']; ?>" <?php } ?> class="btn btn-beta btn-sm <?php //echo $guest_class; ?>" href="javascript:;"><?php echo $gust_status; ?></a>
              </td>
              <td rowid="<?php echo $guestlist[$count]['id']; ?>" 
              userEventId="<?php echo $guestlist[$count]['user_event_id']; ?>" 
              guestName="<?php echo $guestlist[$count]['guest_name']; ?>" 
              guestEmail="<?php echo $guestlist[$count]['guest_email']; ?>" 
              guestAddress="<?php echo $guestlist[$count]['guest_address']; ?>"
              guestLocation="<?php echo $guestlist[$count]['guest_location']; ?>" 
              noOfPlusGuest="<?php echo $guestlist[$count]['no_of_plus_guest']; ?>"
              guestNote="<?php echo $guestlist[$count]['guest_note']; ?>" 
              guestContactNo="<?php echo $guestlist[$count]['guest_contact_no']; ?>" 
              guestStatus="<?php echo $guestlist[$count]['guest_status']; ?>"
              guestOf="<?php echo $guestlist[$count]['guest_of']; ?>"
              >
                <a href="#updateGuestModall" myid="<?php echo $count; ?>" data-toggle="modal" class="editGuest action-btn"><i class="  fa fa-pencil"></i></a>
                    <a href="javascript:;" onclick="if(confirm('Do you want to delete!')){delete_event_guest(<?php echo $guestlist[$count]['id']; ?>);}" class="action-btn"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php
            $count++;
          }
        }
        ?>
        
         
       </tbody>
       </table>
      </div>
    </div>
  </div>
</div>
</section>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/datatables.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script>
    <script type="text/javascript">
      $('#addGuestForm').submit(function(){
        var guest_name = $(this).find('#guest_name').val();
        var guest_email = $(this).find('#guest_email').val();
        var guest_contact_no = $(this).find('#guest_contact_no').val();
        var guest_address = $(this).find('#guest_address').val();
        var guest_location = $(this).find('#guest_location').val();
        var no_of_plus_guest = $(this).find('#no_of_plus_guest').val();
        
        var guest_note = $(this).find('#guest_note').val();
        var guest_of = $(this).find('#guest_of').val();
        var user_event_id = $(this).find('#user_event_id').val();
        $.ajax(
          {
            type:"post",
            url:"include/add_guestlist.php",
            data:{
              guest_name : guest_name,
              guest_email : guest_email,
              guest_contact_no : guest_contact_no,
              guest_address : guest_address,
              guest_location : guest_location,
              no_of_plus_guest : no_of_plus_guest,
              guest_of : guest_of,
              guest_note : guest_note,
              user_event_id : user_event_id
            },
            success:function(data)
            {
              //alert(data);
                if(data.VerficationStatus=="Y")
                {
                  $('.add_message').html('Saved!');
                  $('.add_message').css('color','green');
                  location.reload();
                }
                else if(data.VerficationStatus=="A")
                {
                  $('.add_message').html('Already exists!');
                  $('.add_message').css('color','orange');
                  //location.reload();
                }
                else
                {
                  $('.add_message').html('Faild!');
                  $('.add_message').css('color','red');
                }
                 
            },dataType: "json"
              
        });
        
        return false;
        e.preventDefault();
      });

      $('.editGuest').click(function(){
        $('#updateGuestForm').find('#user_event_id').val($(this).parent('td').attr('userEventId'));
        $('#updateGuestForm').find('#id').val($(this).parent('td').attr('rowid'));
        $('#updateGuestForm').find('#guest_name').val($(this).parent('td').attr('guestName'));
        $('#updateGuestForm').find('#guest_email').val($(this).parent('td').attr('guestEmail'));
        $('#updateGuestForm').find('#guest_address').val($(this).parent('td').attr('guestAddress'));
        $('#updateGuestForm').find('#guest_location').val($(this).parent('td').attr('guestLocation'));
        $('#updateGuestForm').find('#no_of_plus_guest').val($(this).parent('td').attr('noOfPlusGuest'));
        
        $('#updateGuestForm').find('#guest_contact_no').val($(this).parent('td').attr('guestContactNo'));
        $('#updateGuestForm').find('#guest_note').val($(this).parent('td').attr('guestnote'));
        $('#updateGuestForm').find('#guest_of').val($(this).parent('td').attr('guestOf'));
        //alert($(this).parent('td').attr('guestOf'));
        
      });

      $('#updateGuestForm').submit(function(){
        var guest_name = $(this).find('#guest_name').val();
        var guest_email = $(this).find('#guest_email').val();
        var guest_contact_no = $(this).find('#guest_contact_no').val();
        var guest_address = $(this).find('#guest_address').val();
        var guest_location = $(this).find('#guest_location').val();
        var no_of_plus_guest = $(this).find('#no_of_plus_guest').val();
        var guest_note = $(this).find('#guest_note').val();
        var guest_of = $(this).find('#guest_of').val();
        var user_event_id = $(this).find('#user_event_id').val();
        var id = $(this).find('#id').val();


        $.ajax(
          {
            type:"post",
            url:"include/update_guestlist.php",
            data:{
              guest_name : guest_name,
              guest_email : guest_email,
              guest_contact_no : guest_contact_no,
              guest_address : guest_address,
              guest_location : guest_location,
              no_of_plus_guest : no_of_plus_guest,
              guest_note : guest_note,
              guest_of : guest_of,
              user_event_id : user_event_id,
              id : id
            },
            success:function(data)
            {
                if(data.VerficationStatus=="Y")
                {
                  $('.update_message').html('Data Update Done!');
                  $('.update_message').css('color','green');
                  location.reload();
                }
                else if(data.VerficationStatus=="A")
                {
                  $('.update_message').html('Already exists!');
                  $('.update_message').css('color','orange');
                  //location.reload();
                }
                else
                {
                  $('.update_message').html('Update Faild!');
                  $('.update_message').css('color','red');
                }
                 
            },dataType: "json"
              
        });
        
        return false;
        e.preventDefault();
      });

      function delete_event_guest(row_id)
        {
          $.ajax(
            {
              type:"post",
              url:"include/delete_event_guest.php",
              data:{
                row_id : row_id
              },
              success:function(data)
              {
                //alert(data);
                  if(data.VerficationStatus=="Y")
                  {
                    $('#tr_id_'+row_id).remove();
                    location.reload();
                  }
                  else
                  {
                    
                  }
                   
              },dataType: "json"
          });
        }

      $('.send_guest_email').click(function(){
        var id = $(this).attr('rowid');
        $.ajax(
          {
            type:"post",
            url:"include/send_gustemail.php",
            data:{
              id : id
            },
            success:function(data)
            {
alert(data.VerficationStatus);
                if(data.VerficationStatus=="Y")
                {
                  //$('.update_message').html('Data Update Done!');
                  //$('.update_message').css('color','green');
                  location.reload();
                }
                else if(data.VerficationStatus=="A")
                {
                  //$('.update_message').html('Already exists!');
                  //$('.update_message').css('color','orange');
                  //location.reload();
                }
                else
                {
                  //$('.update_message').html('Update Faild!');
                  //$('.update_message').css('color','red');
                }
                 
            },dataType: "json"
              
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
