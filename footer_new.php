<script type="text/javascript">
  var check_reg_validation = 1;
  
  $.validator.setDefaults({
    submitHandler: function() {
      //alert($('#username').val());
      //alert($('#useremail').val());
      //alert($('#userpassword').val());

      if(check_reg_validation == 1)
      {
        return false;
      }
      else
      {
        //alert($("#g-recaptcha-response").val());
         if ($("#g-recaptcha-response").val()) {
            $.ajax(
              {
                type:"post",
                url:"include/newUser.php",
                data:{
                reg_name : $('#reg_name').val(),
                reg_email : $('#reg_email').val(),
                reg_password : $('#reg_password').val(),
                g_recaptcha_response : $('#g-recaptcha-response').val(),
                },
                success:function(data)
                {
                    //alert(data);
                    if(data.VerficationStatus=="Y")
                    {
                      $(".reg_message").html('<h6 class="wht-text" style="color:green;">Register Successfull , Please wait we are activating your a/c! IF System Not Redirect you then please <a href="dashboard.php" >click here</a></h6>.');
                      $(".reg_message").css('color','green');
                      //$(".reg_message").addClass('green');
                      window.location ='dashboard.php';
                    }
                    else if(data.VerficationStatus=="N")
                    {
                      $(".reg_message").html('<h6 class="wht-text"  style="color:red;">User Already Exist!</h6>');
                      $(".reg_message").css('color','red');
                    }
                    else if(data.VerficationStatus=="E")
                    {
                      $(".reg_message").css('color','red');
                      $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Something Went Wrong, Please Try again with valid username & email!</h6>');
                    }
                    else if(data.VerficationStatus=="F")
                    {
                      $(".reg_message").css('color','red');
                      $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Robot verification failed, please try again!</h6>');
                    }
                    else if(data.VerficationStatus=="R")
                    {
                      $(".reg_message").css('color','red');
                      $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Please click on the reCAPTCHA box.!</h6>');
                    }
                    else
                    {
                      $(".reg_message").css('color','red');
                      $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Please fill correct info!</h6>');
                    }
                     
                },dataType: "json"
                  
            });
        //alert(check_reg_validation);
         }
         else
         {
            $(".reg_message").css('color','red');
            $(".reg_message").html('<h6 class="wht-text"  style="color:red;">Please click on the reCAPTCHA box.!</h6>');
         }
      }
    }
  });
  
  $("#regform").validate();
  //$("#login_form").validate();

  
  $('#reg_email').blur(function(){
      $.ajax(
      {
        type:"post",
        url:"include/check_email.php",
        data:{
          reg_email : $('#reg_email').val()
        },
        success:function(data)
        {
          //alert(data);
            if(data.VerficationStatus=="Y")
            {
              check_reg_validation = 1;
              $(".reg_email_error").html('Useremail Already Exist!');
              $(".reg_email_error").css('color','red');
            }
            else
            {
              check_reg_validation = 0;
              $(".reg_email_error").css('color','white');
              $(".reg_email_error").html('');
            }
             
        },dataType: "json"
          
      });
    
    });

    $("#login_button").click(function(e) {
        var reg_email = $('#login_email').val();
        var reg_password = $('#login_password').val();
        var checker = 0;
        if(reg_email == '')
        {
            $('#login_email_message').html('Please fill your email!');
            checker = 0;
        }
        else
        {
          $('#login_email_message').html('');
          checker = 1;
        }
        if(reg_password == '')
        {
            $('#login_pass_message').html('Please fill your password!');
            checker = 0;
        }
        else
        {
          $('#login_pass_message').html('');
          checker = 1;
        }


        if(checker == 1)
        {
            $.ajax(
            {
              type:"post",
              url:"include/check_login.php",
              data:{
                reg_email : reg_email,
                reg_password : reg_password
              },
              success:function(data)
              {
                //alert(data);
                  if(data.VerficationStatus=="Y")
                  {
                    $("#login_message").html('Login Successfull!');
                    window.location = 'dashboard.php';
                  }
                  else
                  {
                    $("#login_message").html('Login faild! email/password not match!');
                  }
                   
              },dataType: "json"
                
            });
        }
    });
    
</script>