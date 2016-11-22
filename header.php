<header id="header">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-xs-6">
        <div class="logo">
          <img src="images/logo.png" class="img-responsive">
        </div>   
      </div>
      <div class="col-lg-6 col-md-6 col-xs-3">
         
        <div class="search hide-phone">
               <input type="text" placeholder="Search gifts.." class="form-control">        
        </div>
      </div>
			<div class="col-lg-4 col-md-4 col-xs-6">
        <div class="top-links">
        
          <ul>
            <li class=""><a href="vendor-signup.php" class="theme-btn hide-phone">Vendor Portal</a></li>
            <?php if(isset($_SESSION['reg_id']) && !empty($_SESSION['reg_id'])) { ?>
            <li><a href="dashboard.php">Dashboard </a></li>
            <li><a id="logout_user" href="logout.php">Logout</a></li>
            <?php } else { ?>            

            <li style="display:none;"><a href="#signup" data-toggle="modal" class="show_register btn btn-alpha">Sign Up</a></li>
            <li><a href="#signup" class="show_login" data-toggle="modal"><img src="images/avatar.png" width="35" class="img-circle">&nbsp;&nbsp;<span class="hide-phone">Sign In</span></a></li>
            <?php } ?>
            <?php if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail'])){ ?>
                <li><a href="edit_index.php" class="btn ">Edit Home</a></li>
<li><a href="administrator" class="btn ">AdminPanel</a></li>
            <?php } ?>             
          </ul>

        </div>   
      </div>
		</div>
	</div>
</header>

<!---sign up modal start-->
<div class="modal" id="signup" style="display:none;">
  <div class="modal-dialog">
     <div class="modal-content">
        <header class="modal-header">
            <span class="header_title">Login</span> 
            <span class="modal_close" data-dismiss="modal"><i class="fa fa-times"></i></span>                       
        </header>
        <div class="modal-body">
            <div class="social_login" style="display:none;">
                <div class="">
                    <a href="#" class="social_box fb">
                        <span class="icon"><i class="fa fa-facebook"></i></span>
                        <span class="icon_title">Connect with Facebook</span>
                    </a>

                    <a href="#" class="social_box google">
                        <span class="icon"><i class="fa fa-google-plus"></i></span>
                        <span class="icon_title">Connect with Google</span>
                    </a>
                 </div>

                <div class="centeredText">
                    <span>Or use your Email address</span>
                </div>
                <div class="action_btns">
                    <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
                    <div class="one_half last"><a href="" id="register_form" class="btn btn-alpha">Sign up</a></div>
                </div>
            </div><!--/social_login-->
                <div class="user_login">
                    <div id="login_message" class="login_message" style="margin-bottom:15px; padding:10px;"></div>
                       <form id="login_form" method="POST">
                            <label>Email</label>
                            <input type="email" class="email" name="login_email" id="login_email" required />
                            <span id="login_email_message" style="color:red;"></span>
                            <br />
                            <label>Password</label>
                            <input type="password" name="login_password" id="login_password" required />
                            <span id="login_pass_message" style="color:red;"></span>
                            <br />
                            <div class="checkbox">
                                    <input id="remember" type="checkbox" />
                                    <label for="remember">Remember me on this computer</label>
                            </div>
                            <div class="action_btns">
                                    <div class="one_half"><a href="#" class="btn btn-beta back_btn_reg"><i class="fa fa-angle-double-left"></i> Register</a></div>
                                    <div class="one_half last"><input type="button" id="login_button" class="btn theme-bg btn-alpha btn-block " name="submit" value="Login"/></div>
                            </div>
                        </form>
                            <a href="#" class="forgot_password">Forgot password?</a>
                    </div>

                    <div class="user_register">
                            <div id="reg_message" class="reg_message" style=""></div>
                                <form id="regform" method="POST" >
                                        <label>Full Name</label>
                                        <input type="text" placeholder="Enter you full name.." name="reg_name" id="reg_name" required />
                                        <br />

                                        <label>Email Address</label>
                                        <input type="email" placeholder="Email address.." class="email" name="reg_email" id="reg_email" required />
                                        <span class="reg_email_error"></span>
                                        <br />

                                        <label>Password</label>
                                        <input type="password"  id="reg_password" maxlength="20" minlength="6" placeholder="Password" name="reg_password" required />
                                        <br />
                                        <label>Confirm Password</label>
                                        <input type="password" equalTo="#reg_password" id="confirn_password" placeholder="Confirm Password" />
                                        <br />

                                       <div class="checkbox">
                                          <input id="check1" type="checkbox" name="check" value="check1">
                                          <label for="check1">I accept <a href="#">Terms</a> and <a href="#">Policies</a></label>
                                         
                                       </div>
                                       <div class="g-recaptcha" data-sitekey="6Lf5eyATAAAAAHuHNN8GTm4V-bk-7gxqtOmNEBq2"></div>
                                       <script src='https://www.google.com/recaptcha/api.js'></script>
                                        <div class="action_btns">
                                                <div class="one_half"><a href="#" class="btn btn-beta back_btn"><i class="fa fa-angle-double-left"></i> Login</a></div>
                                                <div class="one_half last"><input type="submit" class="btn theme-bg btn-alpha btn-block" name="submit" value="Register"/></div>
                                        </div>
                                </form>
                        </div><!--user_register-->
            </div>   
        </div>
    </div>
</div>

<!---sing up modal end-->

<section id="navigate" class="nav_menu" style="display:none;">
   <nav role="navigation" class="navbar navbar-default" id="myNavbar">
            <!-- Brand and toggle get grouped for better mobile display-->
            <div class="">
                <div class="navbar-header">
                    <button data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  <!--  <a class="navbar-brand" href="#"><i class="fa fa-leaf"></i> Fresh</a>-->
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="">Registry</a></li>
                        <li><a target="" href="">Starter Guides</a></li>
                        <li><a target="" href="">How it works</a></li>
                        <li><a target="" href="">Ideas</a></li>
                        <li><a target="" href="">Store</a></li>
                        <li><a target="" href="vendor-club.php">Vendor Club</a></li>
                        <li><a target="" class="btn btn-alpha" href="vendor-signup.php">SignUp for Vendor</a></li>
                        <!--<li><a target="" class="btn btn-alpha" href="vendor-login.php">Vendor Login</a></li>-->
                    </ul>
                </div>
            </div>
        </nav>
</section>