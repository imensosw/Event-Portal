<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Verify your identity | Zuruuna.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/intlTelInput.css">
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
</head>
<body>
<?php include('header.php'); ?>
 <section id="sucurityCheck">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>We need some security information.</h3>
          <p>If we see any unusual to your account we need to verify this info. </p>
          <div style="margin-top:30px;"></div>          
             <h4>Verify your Email ID</h4>
             <div class="mail_not_verified">
             <p>We sent a confirmation mail to <strong>jparihar69@gmail.com</strong> please click on the activation link to verify. Did't got email?</p>
             <a href="" class="btn btn-beta">Resend email</a>
             </div>
             <div class="mail_verified" style="display:none;">
              <span class="green_text"> <i class="fa fa-check-circle"></i> Email Verified Successfully</span>
             </div>
         
         <br>
          <h4>Verify your mobile number</h4>
                       <div class="input-group" style="width:320px;">
                            <input type="text" placeholder="+919977808469" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-beta" type="button">Send OTP</button>
                            </span>
                        </div>
        
          <div class="tmarg"></div>
          <a href="">I'll do it later</a>
        </div>
      </div>
    </div>
  </section>
<?php include('footer.php'); ?>


</body>
</html>

