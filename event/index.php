<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $event_name; ?> | <?php echo $event_title; ?></title>
    <meta name="distributor" content="Global" />
    <meta itemprop="contentRating" content="General" />
    <meta name="robots" content="All" />
    <meta name="revisit-after" content="7 days" />
    <meta name="description" content="The source of truly unique and awesome jquery plugins." />
    <meta name="keywords" content="slider, carousel, responsive, swipe, one to one movement, touch devices, jquery, plugin, bootstrap compatible, html5, css3" />
    <meta name="author" content="w3widgets.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url"           content="<?php echo $url_full; ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Zuruuna" />
    <meta property="og:description"   content="Welcome to the online home of Joshua and Maggie. we’ve created this website to inform you all the stuff we could not fit on the invitation. We can’t wait to get married. Honestly we’re so excited to share our special" />
    <meta property="og:image"         content="<?php echo $url.'/beta/event/'.$path.$cover_image; ?>" />

    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="css/master.css">


        <link rel="stylesheet" href="countdown/jquery.countdown.css" />
<link type="text/css" href="countdown/jquery.countdown.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="countdown/jquery.countdown.min.js?v=1.0.0.0"></script>
  </head>
  <body>
 <!--social media share-->
 <div class="socail_icon">
        <div class="icon_list ">          
          <div id="fb-root"></div>
          <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1652462151670702";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>
          <div class="fb-share-button" data-href="<?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" data-layout="icon" data-mobile-iframe="true"></div>
        </div>
       <div class="icon_list"> <a href="#"><i class="fa fa-twitter"></i></a></div>
       <div class="icon_list"><a href="#"><i class="fa fa-pinterest-p"></i></a></div>
      <div class="icon_list"> <a href="#"><i class="fa fa-google-plus"></i></a></div>
  </div>
 <!--/social media share-->


  
<section class="banner_section" id="banner" style="background-image: url(<?php echo $cover_image; ?>);">
   <div class="container">
      <div classs="row">
          <div class="col-lg-5 col-md-5">
           <div class="sloganBox">
            <h1 class="first_heading curve"> Wedding </h1>
            <div class="divideline"></div>
            <h2 class="second_heading"> Jay & Manisha </h2>
            <span class="bigtxt"> 11 Feb 2017 <span>
           </div>
          </div>
          <div class="col-lg-7 col-md-7"></div>

      </div>
   </div>
</section>

<section class="counter burger" id="countdown">
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
     <h1 class="text-center pad20"> Are You Attending? </h1>            
      <div class="tmargin20 text-center">               
        <a href="#" class="btn btn-alpha"> Yes </a>&nbsp; &nbsp;
        <a href="#" class="btn btn-beta"> May Be </a>&nbsp;&nbsp;
        <a href="#" class="btn btn-no"> No </a> 
      </div>
</section>

<section class="burger" id="story">
   <div class="container">
     <div class="row gutter">
        
          
        
          <div class="col-lg-12">
            <h1> Our Story </h1>
            <div class="panel">
              <p> Meet our perfect bride and groom </p>
              <p class="tmargin20">We were dating, and I felt and still do feel, the happiest girl in the world. Joshua makes me feel so special and loved. You are the love of my life, my best friend. I don’t think anybody could be happier than I am today.</p>

              <p class="tmargin20">We were dating, and I felt and still do feel, the happiest girl in the world. Joshua makes me feel so special and loved. You are the love of my life, my best friend. I don’t think anybody could be happier than I am today.</p>
            </div>
          </div>
      
</div>
</div>
</section>

<section id="photostack-1" class="photostack photostack-transition">
        <div>
          <figure>
            <a href="http://goo.gl/Qw3ND4" class="photostack-img"><img src="img/1.jpg" alt="img01"/></a>
            <figcaption>
              <h2 class="photostack-title">Serenity Beach</h2>
            </figcaption>
          </figure>
          <figure>
            <a href="http://goo.gl/fhwlSP" class="photostack-img"><img src="img/2.jpg" alt="img02"/></a>
            <figcaption>
              <h2 class="photostack-title">Happy Days</h2>
            </figcaption>
          </figure>
          <figure>
            <a href="http://goo.gl/Jmvr4u" class="photostack-img"><img src="img/3.jpg" alt="img03"/></a>
            <figcaption>
              <h2 class="photostack-title">Beautywood</h2>
            </figcaption>
          </figure>
          <figure>
            <a href="http://goo.gl/49lN3k" class="photostack-img"><img src="img/4.jpg" alt="img04"/></a>
            <figcaption>
              <h2 class="photostack-title">Heaven of time</h2>
            </figcaption>
          </figure>
          <figure>
            <a href="http://goo.gl/NJ1Dhf" class="photostack-img"><img src="img/5.jpg" alt="img05"/></a>
            <figcaption>
              <h2 class="photostack-title">Speed Racer</h2>
            </figcaption>
          </figure>
          <figure>
            <a href="http://goo.gl/Ms7VDl" class="photostack-img"><img src="img/6.jpg" alt="img06"/></a>
            <figcaption>
              <h2 class="photostack-title">Forever this</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/7.jpg" alt="img07"/></a>
            <figcaption>
              <h2 class="photostack-title">Lovely Green</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/8.jpg" alt="img08"/></a>
            <figcaption>
              <h2 class="photostack-title">Wonderful</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/9.jpg" alt="img09"/></a>
            <figcaption>
              <h2 class="photostack-title">Love Addict</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/10.jpg" alt="img10"/></a>
            <figcaption>
              <h2 class="photostack-title">Friendship</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/11.jpg" alt="img11"/></a>
            <figcaption>
              <h2 class="photostack-title">White Nights</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/12.jpg" alt="img12"/></a>
            <figcaption>
              <h2 class="photostack-title">Serendipity</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/13.jpg" alt="img13"/></a>
            <figcaption>
              <h2 class="photostack-title">Pure Soul</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/14.jpg" alt="img14"/></a>
            <figcaption>
              <h2 class="photostack-title">Winds of Peace</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/15.jpg" alt="img15"/></a>
            <figcaption>
              <h2 class="photostack-title">Shades of blue</h2>
            </figcaption>
          </figure>
          <figure data-dummy>
            <a href="#" class="photostack-img"><img src="img/16.jpg" alt="img16"/></a>
            <figcaption>
              <h2 class="photostack-title">Lightness</h2>
            </figcaption>
          </figure>
        </div>
      </section>

  

  <section class="burger" id="location">
    <link rel="stylesheet" type="text/css" href="css/google.css" />
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/google.js"></script>

      <div class="text-center">
        <h1> Location </h1>    
        <span class="line-break"></span>
      </div>
  
    <div class="half padd_65 bck_color_1">
      <div class="location_group">
        <h1><font class="theme_col">  MAIN  </font></br>CEREMONY </h1>
        <h2> India</h2>
        <span class="line-break"></span>
        <p> This is India my dear</p>
      </div>
    </div>
    <div class="half  bck_color_2">
      <div class="comm_height padd_0">
        <form style="display:none;" >
          <input id="ceremonyLocation" type="text" value="" placeholder="Type in an address" size="100" />
          <input id="find" type="button" value="find" />
        </form>
        <div class="map_canvas"></div>        
      </div>
    </div>
    <div class="clearfix"></div>
   
    <div class="half bck_color_2">
      <div class="comm_height padd_0">
        <form style="display:none;" >
          <input id="partyLocation" type="text" value="" placeholder="Type in an address" size="100" />
          <input id="find" type="button" value="find" />
        </form>
        <div class="map_canvas1"></div>
        
      </div>
    </div>
    <div class="half padd_65 bck_color_1">
      <div class="location_group">
        <h1> <font class="theme_col"> Wedding</font> </br> PARTY </h1>
        <h2>India</h2>
        <span class="line-break"></span>
        <p> this i note </p>
      </div>
    </div>
    <div class="clearfix"></div>
    
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
 
<div class="clearfix"></div>
<section class="burger" id="social-feeds">
   <div class="container">
      <div class="row">
   
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
</section>
    

<section class="burger" id="wishes">
  <div class="container">
  <div class="row">
  <div class="col-lg-12">
   <div id="myCarousel" class="carousel slide carousel" data-interval="5000" data-ride="carousel">
     <div class="text-center">
      <h1> Wishes </h1>    
      <span class="line-break"></span>
     </div>

    <div class="carousel-inner">

        
      <div class="item">
        <div class="testi-content text-center">
          <p>this si y flkfj kfj askfjsd fkajsf ksjfksa fkasfj asklfjsk sfk jfksl fjsklfjsa kfljsf kasjfkfjask fjsklf jakfla sjfklas fjlkf jasklf jsklfj kfl ajsfkl sajfkls jfklasdjf asklfjs faslkf</p>
        </div>
        <div align="center" class="mt30">
          <span class="wisher-name">Jay</span>
        </div>
      </div>
    
      </div>
    </div>
    <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-long-arrow-left arrow-circled"></i>
    </a><a class="carousel-control right" href="#myCarousel" data-slide="next"><br>
    <i class="fa fa-long-arrow-right arrow-circled"></i></a> 
   <div class="mt3 text-center">
     <a href="javascript:;" onclick="$('.add_wish').show()" class="btn btn-alpha" >Write your wish</a>
   </div>   
  
  </div></div></div> 
  <div id="add_wish" class="add_wish form-group" style="display:none;">
              <div id="overlay"></div>
               <div class="OuterContainer">
               <div class="burger">
               <div class="wish_form">
               <h1>Write your wish</h1>
                <input type="text" placeholder="Your Name" name="user_name" class="form-control" id="user_name" required />
                <span class="user_name_msg" style="color:red;"></span>
                <input type="hidden" name="web_id" id="web_id" value="<?php echo $website_id; ?>" required />
                <textarea name="user_wish" placeholder="Your Message" id="user_wish" class="form-control" required></textarea>
                <span class="user_wish_msg" style="color:red;"></span>
                <div class="mt30">
                <button type="button" name="submit_wish" class="btn btn-alpha" id="submit_wish" >Publish</button>&nbsp;&nbsp;
                <button type="button" name="submit_wish" class="btn btn-beta" onclick="$('.add_wish').hide()">Cancel</button>
                </div>
                <span class="wish_msg"></span>
                </div>
                </div>
                </div>
              </div><!--/add_wish-->   
  </section>

  <section class="burger" id="registry">
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

              <p>© 2016 Zuruuna.com. All rights reserved. </p>
       </div>

       <div class="col-lg-6" style="text-align: right;">
           
       </div>
    </div>
   </div>
</footer>

<script>
  $(document).ready(function () {
    $('#myCarousel .item:first').addClass('active');
   });
</script>


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
<script src="js/classie.js"></script>
    <script src="js/photostack.js"></script>
    <script>
      // [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
      
      new Photostack( document.getElementById( 'photostack-1' ), {
        callback : function( item ) {
          //console.log(item)
        }
      } );
      new Photostack( document.getElementById( 'photostack-2' ), {
        callback : function( item ) {
          //console.log(item)
        }
      } );
      new Photostack( document.getElementById( 'photostack-3' ), {
        callback : function( item ) {
          //console.log(item)
        }
      } );
    </script>




  </body>
</html>
