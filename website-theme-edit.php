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
<link rel="stylesheet" type="text/css" media="all" href="css/filedrag.css" />
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', entity_encoding : "raw",toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", });</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript">
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
	  autocomplete = new google.maps.places.Autocomplete(
	      /** @type {HTMLInputElement} */(document.getElementById('ceremony_location')),
	      { types: ['geocode'] });
	  google.maps.event.addListener(autocomplete, 'place_changed', function() {
	    fillInAddress(1);
	  });

	  autocomplete2 = new google.maps.places.Autocomplete(
	      /** @type {HTMLInputElement} */(document.getElementById('party_location')),
	      { types: ['geocode'] });
	  google.maps.event.addListener(autocomplete2, 'place_changed', function() {
	    fillInAddress(2);
	  });


	}
	function fillInAddress(cnt) {
		if(cnt == 1)
		{
			var place = autocomplete.getPlace();
		}
		else
		{
			var place = autocomplete2.getPlace();
		}
	  
	  for (var component in componentForm) {
	    document.getElementById(component).value = '';
	    document.getElementById(component).disabled = false;
	  }
	  for (var i = 0; i < place.address_components.length; i++) {
	    var addressType = place.address_components[i].types[0];
	    if (componentForm[addressType]) {
	      var val = place.address_components[i][componentForm[addressType]];
	      document.getElementById(addressType).value = val;
	    }
	  }
	}
	function geolocate(cnt) {
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(function(position) {
	      var geolocation = new google.maps.LatLng(
	          position.coords.latitude, position.coords.longitude);
	      var circle = new google.maps.Circle({
	        center: geolocation,
	        radius: position.coords.accuracy
	      });
	      if(cnt ==1)
	      {
	      	autocomplete.setBounds(circle.getBounds());	
	      }
	      else
	      {
	      	autocomplete2.setBounds(circle.getBounds());
	      }
	      
	    });
	  }
	}
</script>

</head>
<body onload="initialize()">

<?php include('header.php'); ?>
  <section id="guestList">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>Manage Website</h3>
        </div>
      </div>
      <div class="row profile">
        <div class="col-md-3">
          <?php include('include/dashboard_sidebar.php'); ?>
        </div>
        <div class="col-md-9">
          <div class="" id="manageWebsite">
            <form id="addWebsite" method="POST" enctype="multipart/form-data" action="include/add_website.php">
              	
              	<h4>Website<span class="pull-right"><a href="javascript:;" onclick="jQuery('.website_name_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>
              	<div class="cart">
                 	<div class="form-group website_name_div" style="display:none;">
	              		<span class="website_name_error"></span>
	              		<input type="text" class="form-control" name="website_name" id="website_name" value="<?php if(isset($website_data[0]['website_name'])) { echo $website_data[0]['website_name'];} ?>" />	              		
	              	</div>
	              	<?php if(isset($website_data[0]['website_name']) && !empty($website_data[0]['website_name'])) { ?>
	              		<a href="event/<?php echo $website_data[0]['website_name']; ?>" target="_blank">Website Preview</a>
	              	<?php } ?>
	              </div>
              <input type="hidden" name="user_event_id" id="user_event_id" value="<?php echo $user_event_id; ?>" />
              <input type="hidden" name="id" id="id" value="<?php echo $website_data[0]['id']; ?>" />
              <h4>Cover Image <span class="pull-right"><a href="javascript:;" onclick="jQuery('.cover_image_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>
              
              <div class="card">
                <div class="form-group cover_image_div " style="display:none;" >
                  <input type="file" name="cover_image" id="cover_image" accept="image/*" class="" />
                </div>
                <?php if((count($website_data) >0) && !empty($website_data[0]['cover_image'])) { 
                  $path = 'event/'.select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
                ?>
                <a href="javascript:;" data-id="<?php echo $website_data[0]['id']; ?>"  class="delete_cover_image" ><i class="fa fa-trash"></i></a>
                <img src="<?php echo $path.$website_data[0]['cover_image']; ?>" class="img-responsive cover_image">

                <?php  }else{
                  ?><img src="images/couple.jpg" class="img-responsive cover_image" ><?php
                } ?>
              </div>
              <h4 class="mt5">Our Story <span class="pull-right"><a href="javascript:;" onclick="jQuery('.our_story_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>
              <div class="card">
                <div class="form-group our_story_div" style="display:none;">
                  <textarea name="our_story" id="our_story" class="form-control" >
                    <?php if((count($website_data) >0) && !empty($website_data[0]['our_story'])) {
                      $our_story  = str_replace("apostrophe_s","'",$website_data[0]['our_story']);
                      echo $our_story;
                    }
                    ?>
                  </textarea>
                </div>
                
                <?php if((count($website_data) >0) && !empty($our_story)) { 
                    echo $our_story;
                  }else{
                  ?><a href="javascript:;" onclick="jQuery('.our_story_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Add your story</a><?php
                } ?>
                
              </div>
              <h4 class="mt">Photo Gallery <span class="pull-right"><a href="javascript:;" onclick="jQuery('.image_name_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>
              <div class="card">
                <div class="form-group image_name_div" style="display:none;">
                  

                    
                      <input type="file" name="image_name[]" multiple="multiple" id="image_name" accept="image/*" class="" />
                      
                    
                </div>
                <?php

                $photo_gallary = array();
                 if(count($website_data)>0)
                 {
                  $photo_gallary = select_data_array('we_user_event_website_photos','','WHERE website_id='.$website_data[0]['id']);
                 }
                if((count($website_data) >0) && (count($photo_gallary)>0)) { 
                  $path = 'event/'.select_single_col('we_registration','access_key','WHERE reg_id='.$_SESSION['reg_id']).'/';
                  //echo $website_data[0]['our_story'];
                    $cnt =0;
                    while($cnt < count($photo_gallary))
                      {

                        ?>
                          <div class="col-md-3 web_img_<?php echo $photo_gallary[$cnt]['id'] ?>"><a href="javascript:;" data-id="<?php echo $photo_gallary[$cnt]['id'] ?>"  class="delete_web_image" ><i class="fa fa-trash"></i></a>

                            <img src="<?php echo $path.$photo_gallary[$cnt]['image_name'] ?>" class="img-responsive">
                          </div>
                        <?php
                        $cnt++;
                      }
                    
                  }else{
                  ?>
                  <a href="javascript:;" onclick="jQuery('.image_name_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Add your photo gallery</a>
                  <?php
                } ?>
                

                <div class="clearfix"></div>
              </div>
              <h4 class="mt5">Location <span class="pull-right"><a href="javascript:;" onclick="jQuery('.party_location_div').toggle(); jQuery('.ceremony_location_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>
              <div class="card">
                <p>
                  	<h5><strong>Ceremony Location</strong></h5>
                  	<div class="form-group ceremony_location_div" style="display:none;">
                  		<input type="text" name="ceremony_location" id="ceremony_location" value="<?php if(isset($website_data[0]['ceremony_location'])) { echo $website_data[0]['ceremony_location'];} ?>" onFocus="geolocate(1)" class="form-control" />
                      <label>Note</label>
                      <input type="text" name="ceremony_location_note" id="ceremony_location_note" class="form-control"
                        value="<?php if(isset($website_data[0]['ceremony_location_note'])) { echo $website_data[0]['ceremony_location_note'];} ?>" />
                      
                  	</div>
                  <?php if((count($website_data) >0) && !empty($website_data[0]['ceremony_location'])) {
                      echo $website_data[0]['ceremony_location'];

                    }else{
                    ?><a href="javascript:;" onclick="jQuery('.ceremony_location_div').toggle();" class="editlink"><i class="fa fa-plus"></i> Add Ceremony Location</a><?php
                  } ?>
                </p>
                <p>
                  	<h5><strong>Party Location</strong></h5>
                  	<div class="form-group party_location_div" style="display:none;">
                  		<input type="text" name="party_location" id="party_location" value="<?php if(isset($website_data[0]['party_location'])) { echo $website_data[0]['party_location'];} ?>" onFocus="geolocate(2)" class="form-control" />
                      <label>Note</label>
                      <input type="text" name="party_location_note" id="party_location_note" class="form-control"
                        value="<?php if(isset($website_data[0]['party_location_note'])) { echo $website_data[0]['party_location_note'];} ?>" />
                      
                  	</div>
                  <?php if((count($website_data) >0) && !empty($website_data[0]['party_location'])) { 
                      echo $website_data[0]['party_location'];

                    }else{
                    ?><a href="javascript:;" onclick="jQuery('.party_location_div').toggle();" class="editlink"><i class="fa fa-plus"></i> Add Party Location</a><?php
                  } ?>
                </p>
              </div>
              
            
              <h4 class="mt5">Social Feeds <span class="pull-right"><a href="javascript:;" onclick="jQuery('.tw_div').toggle(); jQuery('.fb_div').toggle();" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>       
              <div class="card">
                <div class="col-md-6">
                  <h5><strong>Twitter</strong></h5>
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
                <div class="form-group tw_div" style="display:none;">
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
                	?><a href="javascript:;" onclick="jQuery('.tw_div').toggle();" class="editlink"><i class="fa fa-plus"></i> Add Twitter</a><?php
                }
                ?> 


                
                  
                  
                </div>
                <div class="col-md-6">

                  <h5><strong>Facebook</strong></h5>
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
	                <div class="form-group fb_div" style="display:none;">  	
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
	                    	<option value="timeline"	<?php if($fb_data_tab == 'timeline') 	{ echo 'selected="selected"';} ?> >Timeline</option>
	                    	<option value="events" 		<?php if($fb_data_tab == 'events') 		{ echo 'selected="selected"';} ?> >Events</option>
	                    	<option value="messages" 	<?php if($fb_data_tab == 'messages') 	{ echo 'selected="selected"';} ?> >Messages</option>
	                  	</select>
	                </div>
                  	<?php if(!empty($fb_app_id) && !empty($fb_page_url)) {}else{
                  		?><a href="javascript:;" onclick="jQuery('.fb_div').toggle();" class="editlink"><i class="fa fa-plus"></i> Add Facebook</a><?php
                  		} ?>

                  	

                </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                	<?php if((count($website_data) >0) && !empty($website_data[0]['tw_ac_url'])) { 
                      $_tw_ac_url      = $tw_ac_url;
                      $_tw_tweet_limit = $tw_tweet_limit;
                      $_tw_widget_id   = $tw_widget_id;
                      $_tw_nofooter    = $tw_nofooter;
                      $_tw_noborders   = $tw_noborders;
                      $_tw_noheader    = $tw_noheader;
                      $_tw_noscrollbar = $tw_noscrollbar;
                      $_tw_transparent = $tw_transparent;
                      if(empty($_tw_tweet_limit) || $_tw_tweet_limit <1) { $_tw_tweet_limit = 3;}
                      if(empty($_tw_nofooter) || $_tw_nofooter <1) { $_tw_nofooter = '';}else { $_tw_nofooter = 'nofooter'; }
                      if(empty($_tw_noborders) || $_tw_noborders <1) { $_tw_noborders = '';}else { $_tw_noborders = 'noborders'; }
                      if(empty($_tw_noheader) || $_tw_noheader <1) { $_tw_noheader = '';}else { $_tw_noheader = 'noheader'; }
                      if(empty($_tw_noscrollbar) || $_tw_noscrollbar <1) { $_tw_noscrollbar = '';}else { $_tw_noscrollbar = 'noscrollbar'; }
                      if(empty($_tw_transparent) || $_tw_transparent <1) { $_tw_transparent = '';}else { $_tw_transparent = 'transparent'; }
                    ?>
                    <meta name="twitter:dnt" content="on" />
                    <a class="twitter-timeline" 
                        href="<?php echo $_tw_ac_url; ?>"
                        data-tweet-limit="<?php echo $_tw_tweet_limit; ?>"
                         data-chrome="<?php echo $_tw_nofooter.' '.$_tw_noborders.' '.$_tw_noheader.' '.$_tw_noscrollbar.' '.$_tw_transparent; ?>">
                        Tweets by @Username
                    </a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                	<?php } ?>
                </div>
                <div class="col-md-6">
                	<?php if(!empty($fb_app_id) && !empty($fb_page_url)) { ?>
		                <div id="fb-root"></div>
		                <script>(function(d, s, id) {
		                    var js, fjs = d.getElementsByTagName(s)[0];
		                    if (d.getElementById(id)) return;
		                    js = d.createElement(s); js.id = id;
		                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=<?php echo $fb_app_id; ?>";
		                    fjs.parentNode.insertBefore(js, fjs);
		                  }(document, 'script', 'facebook-jssdk'));</script>
		                <div class="fb-page" data-href="<?php echo $fb_page_url; ?>" 
		                    data-tabs="<?php echo $fb_data_tab; ?>" 
		                    data-small-header="<?php echo $fb_data_small_header; ?>" 
		                    data-adapt-container-width="true" 
		                    data-hide-cover="<?php echo $fb_data_hide_cover; ?>" 
		                    data-show-facepile="<?php echo $fb_show_facepile; ?>"
		                    data-width="500"
		                    data-height="500"
		                    >
		                    <div class="fb-xfbml-parse-ignore">
		                      	<blockquote cite="<?php echo $fb_page_url; ?>">
		                        	<a href="<?php echo $fb_page_url; ?>">Facebook Page </a>
		                      	</blockquote>
		                    </div>
		                </div>
		            <?php } ?>
                </div>         
              
              <div class="clearfix"></div>
              <div class="card">
                <div class="form-group">
                  <input type="submit" id="submit" value="Submit Website" class="btn btn-success" />
                </div>
              </div>
            </form>
            <h4 class="mt5">Wishes <span class="pull-right"></span></h4>       
            <div class="card">
            	
            	<?php if(isset($website_data[0]['id']) && !empty($website_data[0]['id']))
            	{
            		$user_event_wishes = select_data_array('we_user_event_wishes','','WHERE website_id='.$website_data[0]['id']); 
            	}
            	else
            	{
            		$user_event_wishes = array();	
            	}
	            
	            if(count($user_event_wishes)>0)
	            {
                ?><table class="table"><?php
	            	$i=0;
	            	while($i<count($user_event_wishes))
	            	{
	            		?>
		            	<tr id="wish_<?php echo $user_event_wishes[$i]['id']; ?>">
		                  <td>
		                    <p>
		                      <?php echo $user_event_wishes[$i]['author_wish']; ?>
		                    </p>
		                  </td>
		                  <td width="10%"><?php echo $user_event_wishes[$i]['author_name']; ?></td>
		                  <td width="10%"><a href="javascript:;" data-id="<?php echo $user_event_wishes[$i]['id']; ?>" class="delete_wish action-btn"><i class="fa fa-trash"></i></a></td>
		                </tr>
		            	<?php
	            		$i++;
	            	}
	            	?></table><?php
	            }
	            else
	            { echo 'No any wish found!'; } ?>
	            
            </div>
            <h4 class="mt5">Registry <span class="pull-right"><a href="" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>       
            <div class="card">
              <div class="display-table">
                <div class="display-table-cell h300 text-center">
                  <p>You have not created any registry yet. </p>
                  <a class="btn btn-beta" href="">Create a Registry</a>
                </div>
              </div>
            </div>
            <h4 class="mt5">RSVP <span class="pull-right"><a href="" class="editlink"><i class="fa fa-cog"></i> Manage</a></span></h4>       
            <div class="card">
              <div class="col-md-3 text-center">
                <h1>44</h1>
                <p>Visits</p>
              </div>
              <div class="col-md-3 text-center">
                <h1>44</h1>
                <p>Yes</p>
              </div>
              <div class="col-md-3 text-center">
                <h1>5</h1>
                <p>No</p>
              </div>
              <div class="col-md-3 text-center">
                <h1>12</h1>
                <p>May be</p>
              </div>

              <div class="clearfix"></div>
            </div>

      
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include('footer.php'); ?>
<script src="js/filedrag.js"></script>
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
</body>
</html>
<?php
}
else
{
  echo 'Please Select Proper Event!';
}
?>