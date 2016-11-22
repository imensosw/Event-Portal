<?php
ob_start();

include('connection.php');

  //$user_event_data = select_data_array('we_users_event','','WHERE event_user='.$_SESSION['reg_id'].' LIMIT 1');
  //print_r($user_event_data);
$user_event_id       = select_single_col('we_users_event','id','WHERE event_user ='.$_SESSION['reg_id'].' LIMIT 1');
  if(isset($user_event_id) || !empty($user_event_id))
  {

    //$event_id = $user_event_data[0]['event_id'];
      $website_data = select_data_array('we_user_event_website','','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id='.$user_event_id.' LIMIT 1');

      //print_r($website_data); die;
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

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', entity_encoding : "raw",toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", });</script>
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
       <form id="addWebsite" method="POST" class="website-edit" enctype="multipart/form-data" action="include/add_website.php">
            <?php if(isset($website_data[0]['ceremony_location_lat']) && !empty($website_data[0]['ceremony_location_lat'])) { $ceremony_location_lat = $website_data[0]['ceremony_location_lat']; } else { $ceremony_location_lat ='46.15242437752303';} ?>
            <input type="hidden" class="ceremony_location_lat" name="ceremony_location_lat" value="<?php echo $ceremony_location_lat; ?>" />
            <?php if(isset($website_data[0]['ceremony_location_lon']) && !empty($website_data[0]['ceremony_location_lon'])) { $ceremony_location_lon = $website_data[0]['ceremony_location_lon']; } else { $ceremony_location_lon ='2.7470703125';} ?>
            <input type="hidden" class="ceremony_location_lon" name="ceremony_location_lon" value="<?php echo $ceremony_location_lon; ?>" />

            <?php if(isset($website_data[0]['party_location_lat']) && !empty($website_data[0]['party_location_lat'])) { $party_location_lat = $website_data[0]['party_location_lat']; } else { $party_location_lat ='46.15242437752303';} ?>
            <input type="hidden" class="party_location_lat" name="party_location_lat" value="<?php echo $party_location_lat; ?>" />
            <?php if(isset($website_data[0]['party_location_lon']) && !empty($website_data[0]['party_location_lon'])) { $party_location_lon = $website_data[0]['party_location_lon']; } else { $party_location_lon ='2.7470703125';} ?>
            <input type="hidden" class="party_location_lon" name="party_location_lon" value="<?php echo $party_location_lon; ?>" />
 

             <div class="form-group">
                <label for="">Website url</label>
               <?php if(isset($website_data[0]['website_name']) && !empty($website_data[0]['website_name'])) { ?>
                    <a href="event/<?php echo $website_data[0]['website_name']; ?>" target="_blank" class="pull-right">Website Preview</a>
                  <?php } ?>                
                   
                    <input type="text" class="form-control" name="website_name" id="website_name" value="<?php if(isset($website_data[0]['website_name'])) { echo $website_data[0]['website_name'];} ?>" />
                    <span class="website_name_error"></span>
                 <input type="hidden" name="user_event_id" id="user_event_id" value="<?php echo $user_event_id; ?>" />
              <input type="hidden" name="id" id="id" value="<?php echo $website_data[0]['id']; ?>" />
            </div>
            <div class="form-group">
                <label for="">Our Story</label>
                <textarea name="our_story" id="our_story" class="form-control" >
                    <?php if((count($website_data) >0) && !empty($website_data[0]['our_story'])) {
                      $our_story  = str_replace("apostrophe_s","'",$website_data[0]['our_story']);
                      echo $our_story;
                    }
                    ?>
                  </textarea>
            </div>
           
            <div class="form-group" style="position:relative">
                <label for="">Cover Image</label> 
                <div class="attach-text">Change Image</div>
                <input type="file" name="cover_image" id="cover_image" onchange="loadFile(event)" accept="image/*" class="attach-file">
                <span> (The ideal size is 1072X450PX)</span>

              <?php 
              $cover_image = 'images/couple.jpg';
              if((count($website_data) >0) && !empty($website_data[0]['cover_image'])) 
              { 
                  $path = 'event/'.select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
                  $cover_image = $path.$website_data[0]['cover_image'];
              }
              
              ?>                                   
                <img class="img-responsive cover_image " id="show_cover" src="<?php echo $cover_image; ?>">
              
            </div>

            <div class="form-group" style="position:relative">
                <label for="">Photo Gallery</label> 
                <div class="attach-text">Add Images</div>
                <input type="file" name="image_name[]" multiple="multiple" id="image_name" accept="image/*" class="attach-file">               
                <div class="card">
                

                <ul class="photo-gallery">
                  <?php

                  $photo_gallary = array();
                  if(count($website_data)>0)
                  {
                    $photo_gallary = select_data_array('we_user_event_website_photos','','WHERE website_id='.$website_data[0]['id']);
                  }
                  if((count($website_data) >0) && (count($photo_gallary)>0)) 
                  { 
                    $path = 'event/'.select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
                    //echo $website_data[0]['our_story'];
                    $cnt =0;
                    while($cnt < count($photo_gallary))
                      {

                        ?>
                        <li class="web_img_<?php echo $photo_gallary[$cnt]['id'] ?>">
                          <img src="<?php echo $path.$photo_gallary[$cnt]['image_name'] ?>" class="img-responsive">
                          <div class="x-image"><a href="javascript:;" data-id="<?php echo $photo_gallary[$cnt]['id'] ?>"  class="delete_web_image" >
                            <i class="fa fa-trash"></i> Remove
                          </a></div>
                        </li>
                          
                        <?php
                        $cnt++;
                      }
                      
                  } ?>
                   
                </ul>
                </div>
            </div>
             
            <label class="control-label">Ceremony Location</label>
            <div class="location-group">             
            <div class="col-lg-6">
               <div class="form-group">

                    <label class="control-label" style="font-weight:normal;">Location</label>
                    
                    <input type="text" id="us3-address" name="ceremony_location" value="" class="form-control" placeholder="Enter a location" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label class="control-label" style="font-weight:normal;">Note</label>
                    <input type="text" name="ceremony_location_note" value="<?php if(isset($website_data[0]['ceremony_location_note'])) { echo $website_data[0]['ceremony_location_note'];} ?>" class="form-control" placeholder="Enter location note" autocomplete="off"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="us3" style="width: 400px; height:300px;"></div>
            </div>  
             <div class="clearfix"></div>           
            </div> 
              <br>
              <label class="control-label">Party Location</label>
            <div class="location-group">             
            <div class="col-lg-6">
               <div class="form-group">
                    <label class="control-label" style="font-weight:normal;">Location</label>
                    

                    <input type="text" id="us4-address" name="party_location" value="" class="form-control" placeholder="Enter a location" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="control-label" style="font-weight:normal;">Note</label>
                    <input type="text" name="party_location_note" value="<?php if(isset($website_data[0]['party_location_note'])) { echo $website_data[0]['party_location_note'];} ?>" class="form-control" placeholder="Enter location note" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-6">
                <div id="us4" style="width: 400px; height:300px;"></div>
            </div>  
             <div class="clearfix"></div>           
            </div> 
            <br>
            <label class="control-label">Twitter Feed</label>
            <div class="location-group">             
            <div class="col-lg-6">
               <?php $tw_ac_url = $tw_tweet_limit= $tw_widget_id = $tw_nofooter = $tw_noborders = $tw_noheader =
                    $tw_noscrollbar = $tw_transparent = ''; ?>
                    <?php
                        if(isset($website_data[0]['tw_ac_url']) && !empty($website_data[0]['tw_ac_url'])) { $tw_ac_url = $website_data[0]['tw_ac_url'];}
                        if(isset($website_data[0]['tw_tweet_limit']) && !empty($website_data[0]['tw_tweet_limit'])) { $tw_tweet_limit = $website_data[0]['tw_tweet_limit'];}
                        if(isset($website_data[0]['tw_widget_id']) && !empty($website_data[0]['tw_widget_id'])) { $tw_widget_id = $website_data[0]['tw_widget_id'];}
                        if(isset($website_data[0]['tw_nofooter']) && !empty($website_data[0]['tw_nofooter'])) { $tw_nofooter = $website_data[0]['tw_nofooter'];}
                        if(isset($website_data[0]['tw_noborders']) && !empty($website_data[0]['tw_noborders'])) { $tw_noborders = $website_data[0]['tw_noborders'];}
                        if(isset($website_data[0]['tw_noheader']) && !empty($website_data[0]['tw_noheader'])) { $tw_noheader = $website_data[0]['tw_noheader'];}
                        if(isset($website_data[0]['tw_noscrollbar']) && !empty($website_data[0]['tw_noscrollbar'])) { $tw_noscrollbar = $website_data[0]['tw_noscrollbar'];}
                        if(isset($website_data[0]['tw_transparent']) && !empty($website_data[0]['tw_transparent'])) { $tw_transparent = $website_data[0]['tw_transparent'];}                    
                    ?>
                <div class="form-group tw_div">
                  <lable for="tw_ac_url">Twitter A/c Url</lable>
                    <input type="text" name="tw_ac_url" id="tw_ac_url" value="<?php echo $tw_ac_url; ?>" class="form-control" />
                  
                  <lable for="tw_tweet_limit">No. of tweet to show</lable>
                  <input type="number" max="10" min="1" name="tw_tweet_limit" value="<?php echo $tw_tweet_limit; ?>" id="tw_tweet_limit" class="form-control" />
                  
                  <lable for="tw_nofooter">Footer</lable>
                  <select name="tw_nofooter" id="tw_nofooter" class="form-control">
                    <option value="1" <?php if($tw_nofooter == 1) { echo 'selected="selected"';} ?> >No</option>
                    <option value="0" <?php if($tw_nofooter == 0) { echo 'selected="selected"';} ?> >Yes</option>
                  </select>

                  <lable for="tw_noborders">Border</lable>
                  <select name="tw_noborders" id="tw_noborders" class="form-control">
                    <option value="1" <?php if($tw_noborders == 1) { echo 'selected="selected"';} ?> >No</option>
                    <option value="0" <?php if($tw_noborders == 0) { echo 'selected="selected"';} ?> >Yes</option>
                  </select>
                  
                  <lable for="tw_noheader">Header</lable>
                  <select name="tw_noheader" id="tw_noheader" class="form-control">
                    <option value="1" <?php if($tw_noheader == 1) { echo 'selected="selected"';} ?> >No</option>
                    <option value="0" <?php if($tw_noheader == 0) { echo 'selected="selected"';} ?> >Yes</option>
                  </select>
                  
                  <lable for="tw_noscrollbar">Scrollbar</lable>
                  <select name="tw_noscrollbar" id="tw_noscrollbar" class="form-control">
                    <option value="1" <?php if($tw_noscrollbar == 1) { echo 'selected="selected"';} ?> >No</option>
                    <option value="0" <?php if($tw_noscrollbar == 0) { echo 'selected="selected"';} ?> >Yes</option>
                  </select>
                  
                  <lable for="tw_transparent">Transparent</lable>
                  <select name="tw_transparent" id="tw_transparent" class="form-control">
                    <option value="0" <?php if($tw_transparent == 0) { echo 'selected="selected"';} ?> >No</option>
                    <option value="1" <?php if($tw_transparent == 1) { echo 'selected="selected"';} ?> >Yes</option>
                  </select>
                </div>  
                <?php if(isset($website_data[0]['tw_ac_url']) && !empty($website_data[0]['tw_ac_url'])) {}else{
                    ?><?php
                }
                ?> 
               
           
            </div>
            <div class="col-lg-6">
                <!--place for preview-->
            </div>  
             <div class="clearfix"></div>           
            </div> 
              <br>
            <label class="control-label">Facebook Feed</label>
            <div class="location-group">             
            <div class="col-lg-6">
               <?php 
                    $fb_app_id = select_single_col('we_setting','fb_app_id','WHERE 1=1 LIMIT 1');
                    $fb_page_url = '';
                    $fb_data_small_header = 'true';
                    $fb_data_hide_cover = 'false';
                    $fb_show_facepile = 'true';
                    $fb_data_tab = 'timeline';

                    if(isset($website_data[0]['fb_page_url']) && !empty($website_data[0]['fb_page_url'])) { $fb_page_url = $website_data[0]['fb_page_url'];}
                    if(isset($website_data[0]['fb_data_small_header']) && !empty($website_data[0]['fb_data_small_header'])) { $fb_data_small_header = $website_data[0]['fb_data_small_header'];}
                    if(isset($website_data[0]['fb_data_hide_cover']) && !empty($website_data[0]['fb_data_hide_cover'])) { $fb_data_hide_cover = $website_data[0]['fb_data_hide_cover'];}
                    if(isset($website_data[0]['fb_show_facepile']) && !empty($website_data[0]['fb_show_facepile'])) { $fb_show_facepile = $website_data[0]['fb_show_facepile'];}
                    if(isset($website_data[0]['fb_data_tab']) && !empty($website_data[0]['fb_data_tab'])) { $fb_data_tab = $website_data[0]['fb_data_tab'];}

                   ?>
                    <div class="form-group fb_div">   
                        <input type="hidden" name="fb_app_id" id="fb_app_id" value="<?php echo $fb_app_id; ?>" class="form-control" />

                        <lable for="fb_page_url">FB page URl</lable>
                        <input type="text" name="fb_page_url" id="fb_page_url" value="<?php echo $fb_page_url; ?>" class="form-control" />

                        <lable for="fb_data_small_header">Small Header</lable>
                        <select name="fb_data_small_header" id="fb_data_small_header" class="form-control">
                            <option value="false" <?php if($fb_data_small_header == 'false') { echo 'selected="selected"';} ?> >No</option>
                            <option value="true" <?php if($fb_data_small_header == 'true') { echo 'selected="selected"';} ?> >Yes</option>
                        </select>

                        <lable for="fb_data_hide_cover">Hide Cover</lable>
                        <select name="fb_data_hide_cover" id="fb_data_hide_cover" class="form-control">
                            <option value="false" <?php if($fb_data_hide_cover == 'false') { echo 'selected="selected"';} ?> >No</option>
                            <option value="true" <?php if($fb_data_hide_cover == 'true') { echo 'selected="selected"';} ?> >Yes</option>
                        </select>

                        <lable for="fb_show_facepile">Show Facepile</lable>
                        <select name="fb_show_facepile" id="fb_show_facepile" class="form-control">
                            <option value="false" <?php if($fb_show_facepile == 'false') { echo 'selected="selected"';} ?> >No</option>
                            <option value="true" <?php if($fb_show_facepile == 'true') { echo 'selected="selected"';} ?> >Yes</option>
                        </select>

                        <lable for="fb_data_tab">Data Tab</lable>
                        <select name="fb_data_tab" id="fb_data_tab" class="form-control">
                            <option value="timeline"    <?php if($fb_data_tab == 'timeline')    { echo 'selected="selected"';} ?> >Timeline</option>
                            <option value="events"      <?php if($fb_data_tab == 'events')      { echo 'selected="selected"';} ?> >Events</option>
                            <option value="messages"    <?php if($fb_data_tab == 'messages')    { echo 'selected="selected"';} ?> >Messages</option>
                        </select>
                    </div>
                    <?php if(!empty($fb_app_id) && !empty($fb_page_url)) {}else{
                        ?><?php
                        } ?>
            </div>
            <div class="col-lg-6">
                <!--place for preview-->
            </div>  
             <div class="clearfix"></div>           
            </div> 

        <div class="clearfix"></div>
       

           
            <button class="btn btn-alpha mt5" type="submit" id="submit">Save Change</button>
        </form>

       
       
      </div>
      <div class="clearfix"></div>
             
            </div>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>
  <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
  <script src="js/locationpicker.jquery.min.js"></script>
   <script>
   //$(document).ready(function(){
            $('#us3').locationpicker({
                location: {
                    latitude: $('.ceremony_location_lat').val(),
                    longitude: $('.ceremony_location_lon').val()
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
            $('#us4').locationpicker({
                location: {
                    latitude: $('.party_location_lat').val(),
                    longitude: $('.party_location_lon').val()
                },
                radius: 300,
                inputBinding: {
                    latitudeInput: $('#us4-lat'),
                    longitudeInput: $('#us4-lon'),
                    radiusInput: $('#us4-radius'),
                    locationNameInput: $('#us4-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                  $('.party_location_lat').val(currentLocation.latitude);
                  $('.party_location_lon').val(currentLocation.longitude);
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
        //});
        </script>
        <script type="text/javascript">
  //delete_web_image
  $('.delete_web_image').click(function(){
    var delete_id = $(this).attr('data-id');
    //var this = $(this);
    $.ajax(
      {
        type:"post",
        url:"include/delete_website_photos.php",
        data:{
          delete_id : delete_id
        },
        success:function(data)
        {
          //alert(data);
            if(data.VerficationStatus=="Y")
            {
              $('.web_img_'+delete_id).remove();
              
            }
            else
            {
              
            }
             
        },dataType: "json"
    });  
  });
  
  $('.delete_cover_image').click(function(){
    var cover_id = $(this).attr('data-id');
    //var this = $(this);
    $.ajax(
      {
        type:"post",
        url:"include/delete_website_cover.php",
        data:{
          cover_id : cover_id
        },
        success:function(data)
        {
          //alert(data);
            if(data.VerficationStatus=="Y")
            {
              $('.cover_image').attr('src','images/couple.jpg');
              $('.delete_cover_image').remove();
              
            }
            else
            {
              
            }
             
        },dataType: "json"
    });
  });

    $('#website_name').keyup(function(){
      var web_name = $(this).val();
      var web_id = $('#id').val();
      //var this = $(this);
      $.ajax(
        {
          type:"post",
          url:"include/check_website_name.php",
          data:{
            web_name : web_name,
            web_id : web_id
          },
          success:function(data)
          {
            //alert(data);
              if(data.VerficationStatus=="Y")
              {
                $('#submit').attr('type','submit');
                $('#submit').show();
                $('.website_name_error').html('Available!');
                $('.website_name_error').css('color','green');
              }
              else if(data.VerficationStatus=="A")
              {
                $('#submit').attr('type','button');
                $('#submit').hide();
                $('.website_name_error').html('Not Available!');
                $('.website_name_error').css('color','red');
              }
              else if(data.VerficationStatus=="N")
              {
                $('#submit').attr('type','button');
                $('#submit').hide();
                $('.website_name_error').html('Wrong User ID!');
                $('.website_name_error').css('color','red');
              }
              else
              {
                $('#submit').attr('type','button');
                $('#submit').hide();
                $('.website_name_error').html('Please Add Correct Name!');
                $('.website_name_error').css('color','red');
              }

               
          },dataType: "json"
      });
    });

  $('.delete_wish').click(function(){
      var del_id = $(this).attr('data-id');
      //var this = $(this);
      $.ajax(
        {
          type:"post",
          url:"include/delete_user_event_wish.php",
          data:{
            del_id : del_id
          },
          success:function(data)
          {
            //alert(data);
              if(data.VerficationStatus=="Y")
              {
                $('#wish_'+del_id).remove();
              }
              
              else
              {
                
              }

               
          },dataType: "json"
      });
    });
  
</script>


<script>
  var loadFile = function(event) {
    var output = document.getElementById('show_cover');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
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