<?php
ob_start();
$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'];
$url_full = $url.'/'.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
include_once('../administrator/common/model/conn.php'); 
include_once('../administrator/common/model/function.php'); 
$website_name = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$website_data = select_data_array('we_user_event_website','','WHERE website_name="'.$website_name.'"');

$counter_date = '6/29/2016 23:59:59';
$event_name = 'My Event';
$event_for = 'Joshua & Maggie';
$cover_image = 'images/banner4.jpg';
$our_story = '';
$website_id = '';
$ceremony_location = 'ON ST.AGUSTIN CHURCH AT 10:00 AM';
$party_location = 'ON ST.AGUSTIN CHURCH AT 10:00 AM';
$fb_page_url = '';
$tw_ac_url = '';
$fb_app_id = select_single_col('we_setting','fb_app_id','WHERE 1=1 LIMIT 1');
$total_gallery = 'null';
if(count($website_data))
{
  $website_id = $website_data[0]['id'];
  $user_event_id = $website_data[0]['user_event_id'];
  $event_user = $website_data[0]['event_user']; 
  
  $path = select_single_col('we_registration','access_key','WHERE reg_id='.$event_user).'/';
  if(!empty($website_data[0]['cover_image'])) { $cover_image = $path.$website_data[0]['cover_image']; }

  $our_story = $website_data[0]['our_story'];
  $our_story  = str_replace("apostrophe_s","'",$our_story);
  //if(empty($our_story)) { $our_story = '<p> <a href="../website.php">Add Your Story</a></p>'; }
  $ceremony_location = $website_data[0]['ceremony_location'];
  $party_location = $website_data[0]['party_location'];
  //if(!empty($website_data[0]['ceremony_location'])) { $ceremony_location =$website_data[0]['ceremony_location']; } else { $ceremony_location = '<p> <a href="../website.php">Add Location</a></p>';}
  //if(!empty($website_data[0]['party_location'])) { $party_location = $website_data[0]['party_location']; } else { $party_location = '<p> <a href="../website.php">Add Location</a></p>';}
  
  $fb_page_url = $website_data[0]['fb_page_url'];
  $fb_data_small_header = $website_data[0]['fb_data_small_header'];
  $fb_data_hide_cover = $website_data[0]['fb_data_hide_cover'];
  $fb_data_tab = $website_data[0]['fb_data_tab'];
  $fb_show_facepile = $website_data[0]['fb_show_facepile'];

  $tw_ac_url = $website_data[0]['tw_ac_url'];
  $tw_tweet_limit = $website_data[0]['tw_tweet_limit'];
  $tw_widget_id = $website_data[0]['tw_widget_id'];
  $tw_nofooter = $website_data[0]['tw_nofooter'];
  $tw_noborders = $website_data[0]['tw_noborders'];
  $tw_noheader = $website_data[0]['tw_noheader'];
  $tw_noscrollbar = $website_data[0]['tw_noscrollbar'];
  $tw_transparent = $website_data[0]['tw_transparent'];
  $total_gallery = 'null';
     
  $user_event = select_data_array('we_users_event','','WHERE event_user ='.$website_data[0]['event_user'].' AND id='.$user_event_id);
  if(count($user_event)>0)
  {
    $event_id = $user_event[0]['event_id'];
    $event_location = $user_event[0]['event_location'];
    $event_address = $user_event[0]['event_address'];
    $event_date = $user_event[0]['event_date'];
    $event_budget = $user_event[0]['event_budget'];
    $status = $user_event[0]['status'];
    $first_fname = $user_event[0]['first_fname'];
    $first_lname = $user_event[0]['first_lname'];
    $second_fname = $user_event[0]['second_fname'];
    $second_lname = $user_event[0]['second_lname'];
    $event_name = select_single_col('we_event','event_name','WHERE id='.$user_event[0]['event_id']);
    $event_type = select_single_col('we_event','event_type','WHERE id='.$user_event[0]['event_id']);
    $event_date_month = select_single_col('we_users_event','MONTH(event_date)','WHERE event_user ='.$website_data[0]['event_user'].' AND id='.$user_event_id);
    $event_date_day = select_single_col('we_users_event','DAY(event_date)','WHERE event_user ='.$website_data[0]['event_user'].' AND id='.$user_event_id);
    $event_date_year = select_single_col('we_users_event','YEAR(event_date)','WHERE event_user ='.$website_data[0]['event_user'].' AND id='.$user_event_id);
    $counter_date = $event_date_month.'/'.$event_date_day.'/'.$event_date_year.' 23:59:59';

    if($event_type == 1)
    {
      $event_for = $first_fname;
    }
    else if($event_type == 2)
    {
      $event_for = $first_fname.' & '.$second_fname;
    }

    $total_gallery = select_single_col('we_user_event_website_photos','count(*)','WHERE website_id='.$website_id);
    if($total_gallery > 0) { $total_gallery = 'yes';} else { $total_gallery = 'no';}
  }
  else
  {

  }
}
else
{
  echo "Can't Find Website By ".$website_name." Name!";
}


?>

<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
  <head>
    <meta charset="utf-8">
    <title>Wedding Jasmine</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url"           content="<?php echo $url_full; ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Zuruuna" />
    <meta property="og:description"   content="Welcome to the online home of Joshua and Maggie. we’ve created this website to inform you all the stuff we could not fit on the invitation. We can’t wait to get married. Honestly we’re so excited to share our special" />
    <meta property="og:image"         content="<?php echo $url.'/beta/event/'.$cover_image; ?>" />

    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="css/master.css">


        <link rel="stylesheet" href="countdown/jquery.countdown.css" />
<link type="text/css" href="countdown/jquery.countdown.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="countdown/jquery.countdown.min.js?v=1.0.0.0"></script>
  </head>
  <body>
 <div class="counter">
    <input type="hidden" id="counter_date" value="<?php echo $counter_date; ?>" />
    
    <ul id="example" >
      <li><span class="days">00</span><p class="days_text">Days</p></li>
      <li class="seperator">:</li>
      <li><span class="hours">00</span><p class="hours_text">Hours</p>
      </li>
      <li class="seperator">:</li>
      <li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
      <li class="seperator">:</li>
      <li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
    </ul>
    <script type="text/javascript">
      $('#example').countdown({
        date: $('#counter_date').val(),
        offset: -1,
        day: 'Day',
        days: 'Days'
      }, function () {
        alert('Done!');
      });
    </script>

</div>

  <div class="socail_icon">

        <div class="icon_list ">
          <a href="#"><i class="fa fa-facebook"></i></a>
          
        </div>
       <div class="icon_list"> <a href="#"><i class="fa fa-twitter"></i></a></div>
       <div class="icon_list"><a href="#"><i class="fa fa-pinterest-p"></i></a></div>
      <div class="icon_list"> <a href="#"><i class="fa fa-google-plus"></i></a></div>

  </div>
<section class="banner_section" style="background-image: url(<?php echo $cover_image; ?>);">
   <div class="container">
      <div classs="row">
          <div class="col-lg-12 padd_top">

            <h1 class="first_heading"> <?php echo $event_name; ?> </h1>

            <h2 class="second_heading"> <?php echo $event_for; ?> </h2>
          </div>

      </div>
   </div>
</section>


    <!--- inner structure ------------>

<div class="bg_color">

    <section class="attending_sec">
     <div class="container">
        <div class="row ">
          <div class="">
             <div class="col-lg-5">
                <h1 class="text-center"> Are You Attending? </h1>
              </div>


                <div class="col-lg-2 text-center tmargin20 ">
                    <a href="#"> Yes </a>
                </div>

                 <div class="col-lg-2 text-center tmargin20">
                    <a href="#"> No </a>
                </div>

                 <div class="col-lg-3 text-center tmargin20">
                    <a href="#"> May Be </a>
                </div>

           </div>
        </div>
     </div>
  </section>

  <section class="about_us">
     <div class="container">
      <div class="row">


        <?php if(!empty($website_id) && !empty($our_story)) { ?>
          <div class="col-lg-7">
            <h1> Our Story </h1>
            <div class="panel">
              <?php echo $our_story; ?>
            </div>
         </div>
         <?php }else if(empty($website_id)) { ?>
          <div class="col-lg-7">
            <h1> Our Story </h1>
            <div class="panel">
              <p> Meet our perfect bride and groom </p>

              <p class="tmargin20">We were dating, and I felt and still do feel, the happiest girl in the world. Joshua makes me feel so special and loved. You are the love of my life, my best friend. I don’t think anybody could be happier than I am today.</p>

              <p class="tmargin20">We were dating, and I felt and still do feel, the happiest girl in the world. Joshua makes me feel so special and loved. You are the love of my life, my best friend. I don’t think anybody could be happier than I am today.</p>
            </div>
          </div>
        <?php } ?>


        <?php if($total_gallery == 'yes' ) { ?>
         <div class="col-lg-5">
           <h1> Gallery </h1>
            <div class="panel">
              <?php  $image_gallery = select_data_array('we_user_event_website_photos','','WHERE website_id='.$website_id);
                if(count($image_gallery)>0)
                {
                  $count = 0;
                  while($count < count($image_gallery))
                  {
                    ?>
                    <div class="img_gallery col-lg-4 tmargin20 col-sm-4">
                        <a href="<?php echo $path.$image_gallery[$count]['image_name']; ?>" target="_blank"><img  src="<?php echo $path.$image_gallery[$count]['image_name']; ?>" class="img-responsive" title="" alt=""></a>
                    </div>
                    <?php
                    $count++;
                  }
                }
              ?>
            </div>
          </div>
        <?php } ?>
        <?php if($total_gallery == 'null' ) {?>
        <div class="col-lg-5">
           <h1> Gallery </h1>
          <div class="panel">
            <div class="img_gallery col-lg-4 tmargin20 col-sm-4">
                <a href="#"><img  src="images/img1.jpg" class="img-responsive" title="" alt=""></a>
            </div>
            <div class="img_gallery col-lg-4 tmargin20 col-sm-4">
               <a href="#"><img src="images/img1.jpg" class="img-responsive" title="" alt=""></a>
            </div>
            <div class="img_gallery col-lg-4 tmargin20 col-sm-4 ">
                <a href="#"><img src="images/img1.jpg" class="img-responsive" title="" alt=""></a>
            </div>
            <div class="img_gallery tmargin30 col-lg-4 col-sm-4">
                <a href="#"><img src="images/img1.jpg" class="img-responsive" title="" alt=""></a>
            </div>
             <div class="img_gallery tmargin30 col-lg-4 col-sm-4">
                <a href="#"><img src="images/img1.jpg" class="img-responsive" title="" alt=""></a>
            </div>
             <div class="img_gallery tmargin30 col-lg-4 col-sm-4">
                <a href="#"><img src="images/img1.jpg" class="img-responsive" title="" alt=""></a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
     </div>
  </section>

  <?php if(!empty($ceremony_location) && !empty($party_location)) {?>
  <section class="burger">
    <link rel="stylesheet" type="text/css" href="css/google.css" />
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/google.js"></script>

    <h1 class="text-center"> Location </h1>
    <div class="text-center">
      <span class="line-break"></span>
    </div>
    <?php if(!empty($ceremony_location)) {?>
    <div class="col-lg-6 padd_65 bck_color_1">
      <div class="location_group">
        <h1><font class="theme_col">  MAIN  </font></br>CEREMONY </h1>
        <h2> <?php echo $ceremony_location; ?></h2>
        <span class="line-break"></span>
        <p> We like everything on the wedding day be perfect! So we made a great plan for this day.</p>
      </div>
    </div>
    <div class="col-lg-6  padd_65 bck_color_2">
      <div class="comm_height padd_0">
        <form style="display:none;" >
          <input id="ceremonyLocation" type="text" value="<?php echo $ceremony_location; ?>" placeholder="Type in an address" size="100" />
          <input id="find" type="button" value="find" />
        </form>
        <div class="map_canvas"></div>
        
      </div>
    </div>
    <?php  } ?>
    <?php if(!empty($party_location)) {?>
    <div class="col-lg-6  padd_65 bck_color_2">
      <div class="comm_height padd_0">
        <form style="display:none;" >
          <input id="partyLocation" type="text" value="<?php echo $party_location; ?>" placeholder="Type in an address" size="100" />
          <input id="find" type="button" value="find" />
        </form>
        <div class="map_canvas1"></div>
        
      </div>
    </div>
    <div class="col-lg-6  padd_65 bck_color_1">
      <div class="location_group">
        <h1> <font class="theme_col"> <?php echo $event_name; ?> </font> </br> PARTY </h1>
        <h2><?php echo $party_location; ?></h2>
        <span class="line-break"></span>
        <p> Guests always love the energy of a live band to hear original artist sing, free drink is on us. </p>
      </div>
    </div>
    <?php } ?>
    <script>
      $(function(){
        var options = {
          map: ".map_canvas"
        };
        $("#ceremonyLocation").geocomplete(options);
        $("#ceremonyLocation").trigger("geocode");

        var options = {
          map: ".map_canvas1"
        };
        $("#partyLocation").geocomplete(options);
        $("#partyLocation").trigger("geocode");
        
        
        
      });
    </script>
  </section>
  <?php } ?>
<div class="clearfix"></div>

<section class="burger">
     <div class="container">
      <div class="row">
      <?php if(!empty($fb_page_url)) { ?>
         <div class="col-lg-6">

          <h1> Facebook feed </h1>

          <div class="panel">

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

            </div>
         </div>
      <?php } ?>
      <?php if(!empty($tw_ac_url)) { ?>
         <div class="col-lg-6">
           <h1> Twitter feed </h1>
            <div class="panel">
              <?php
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


            </div>
         </div>
      <?php } ?>
         <div class="col-lg-12 testmonials" id="wishes_div">

          <h1> Wishes </h1>

            <div class="panel " >
            <?php $wishes = select_data_array('we_user_event_wishes','','WHERE website_id ='.$website_id); ?>
            <?php if(count($wishes)>0) { $count=0; while($count<count($wishes)) {  ?>
              <p class="tmargin20"> " <?php echo $wishes[$count]['author_wish']; ?> "</p>

              <span> - <?php echo $wishes[$count]['author_name']; ?> </span>

              
            <?php $count++; }} ?>


            </div>
              <a href="javascript:;" onclick="$('.add_wish').toggle()" >Add Wish</a>
              <div id="add_wish" class="add_wish form-group" style="display:none;" >
                <input type="text" placeholder="Your Name" name="user_name" class="form-control" id="user_name" required />
                <span class="user_name_msg" style="color:red;"></span>
                <input type="hidden" name="web_id" id="web_id" value="<?php echo $website_id; ?>" required />
                <textarea name="user_wish" placeholder="Your Message" id="user_wish" class="form-control" required></textarea>
                <span class="user_wish_msg" style="color:red;"></span>
                <button type="button" name="submit_wish" class="" id="submit_wish" >Submit Wish</button>
                <span class="wish_msg"></span>
              </div>
         </div>
      </div>
     </div>
  </section>

  <section class="Registration">
    <div class="container">
      <div class="row">
           <div class="col-lg-12">

            <h1 class="text-center Registr_heading">Gift Registration </h1>

       <!--     <h2 class="text-center">We appriciate your kind helps </h2> -->

              <div class="col-sm-4 tmargin50 Registration_img"><img src="images/target1.png" class="img-responsive" alt="" /></div>

              <div class="col-sm-4 tmargin50 Registration_img"><img src="images/amazon.png" class="img-responsive" alt="" /></div>

               <div class="col-sm-4 tmargin50 Registration_img"><img src="images/macys.png" class="img-responsive" alt="" /></div>

           </div>

      </div>
    </div>
  </section>


  <footer>
   <div class="container">
    <div class="row">
      <div class="col-lg-6">

              <p>© 2016 Imenso Software. All rights reserved. </p>
       </div>

       <div class="col-lg-6" style="text-align: right;">
           
       </div>
    </div>
   </div>




    


</footer>
<script type="text/javascript">
  $('#submit_wish').click(function(e){
    var user_name = $('#user_name').val();
    var user_wish = $('#user_wish').val();
    var web_id = $('#web_id').val();
    if(user_name.length <1)
    {
      $('.user_name_msg').html('Please add Your Name!');
    }
    else
    {
      $('.user_name_msg').html(''); 
    }
    if(user_wish.length <1)
    {
      $('.user_wish_msg').html('Please add Your Wish!');
    }
    else
    {
      $('.user_wish_msg').html(''); 
    }
    if(web_id.length <1)
    {
      $('.wish_msg').html('Invalid!');
    }
    else
    {
      $('.wish_msg').html(''); 
    }
    if((user_name.length > 0) && (user_wish.length > 0) && (web_id.length > 0))
    {
      //alert();
      $.ajax(
        {
          type:"post",
          url:"../include/add_wish.php",
          data:{
            user_name : user_name,
            user_wish : user_wish,
            web_id : web_id
          },
          success:function(data)
          {
            //alert(data);
              if(data.VerficationStatus=="Y")
              {
                $("#wishes_div").load(location.href + " #wishes_div");
                setTimeout(function() {
                  $('.wish_msg').html('Your wish added!');
                }, 1000);
                
              }
              else
              {
                $('.wish_msg').html('Invalid!');
              }
          },dataType: "json"
      });
    }
  });
</script>





  </body>
</html>
