<footer id="footer" class="burger-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="followus wht-text">
        <h2 class="text-center">Follow Us</h2>
     <div class="divide-sm"></div>
     <div class="mt5"></div>
          <ul>
          <li><a href=""><i class="fa fa-facebook"></i></a></li>
          <li><a href=""><i class="fa fa-twitter"></i></a></li>
          <li><a href=""><i class="fa fa-linkedin"></i></a></li>
          <li><a href=""><i class="fa fa-instagram"></i></a></li>
          <li><a href=""><i class="fa fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
    <div class="clearfix mt5 hide-phone"></div>
    <div class="row gutter hide-phone">
      <div class="footer-links">
        <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Registry</a></li>
        <li><a href="">Starter Guides</a></li>
        <li><a href="">How it Works</a></li>
        <li><a href="">Ideas</a></li>
        <li><a href="">Store</a></li>
        <li><a href="">Vendors</a></li>
        <li><a href="">Support</a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p class="wht-text mt5">© 2016 Zuruuna. All rights reserved</p>
      </div>
    </div>
  </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="administrator/validation/js/jquery.validate.js"></script>
<script type="text/javascript" src="administrator/validation/js/additional-methods.js"></script>


<script src="js/jQuery-plugin-progressbar.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.leanmodal/1.1/jquery.leanmodal.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript" src="js/lib.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('.TodoText').editTodo();
  $('.CheckBox, .CheckBoxChecked').toggleComplete();
  
  $('.Incomplete, .Complete').sortable({ opacity: 0.8, cursor: 'move', update: function(e, ui) {
      var str = '';
      
      $(this).find('.TodoItem').each(function(i){
        str += (str.length>0)?'&':'';
        str += $(this).attr('id')+'='+i;
      });
      alert(str);
                                         
    }
  });
});
</script> 

<!--
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
 -->

<script type="text/javascript">
  $("#dd").click(function(){
    $("#overlay").show();
  });
</script>
<script type="text/javascript">
// Plugin options and our code
$("#modal_trigger").leanModal({
        top: 50,
        overlay: 0.6,
        closeButton: ".modal_close"
});
$("#modal_trigger1").leanModal({
        top: 50,
        overlay: 0.6,
        closeButton: ".modal_close"
});
var tec = $('#tot_model_trigger').val();
var i = 0;
while (i < tec) {
  $("#modal_trigger"+i).leanModal({
      top: 50,
      overlay: 0.6,
      closeButton: ".modal_close"
  });
  i++;
}

$(function() {  
        // Calling Login Form
        $(".user_register").show();
        $(".header_title").text('Register');
        $("#login_form").click(function() {
                $(".social_login").hide();
                $(".user_register").hide();
                
                $(".user_login").show();

                return false;
        });

        // Calling Register Form
        $("#register_form").click(function() {
                $(".social_login").hide();
                $(".user_register").show();
                $(".header_title").text('Register');
                return false;
        });

        // Going back to Social Forms
        $(".back_btn").click(function() {
                $(".user_login").show();
                $(".user_register").hide();
                //$(".social_login").show();
                $(".header_title").text('Login');
                return false;
        });
        $('.show_login').click(function() {
          $('#signup').modal();
                $(".user_login").show();
                $(".user_register").hide();
                //$(".social_login").show();
                $(".header_title").text('Login');
                return false;
        });
        $('.show_register').click(function() {
          $('#signup').modal();
                $(".user_login").hide();
                $(".user_register").show();
                //$(".social_login").show();
                $(".header_title").text('Register');
                return false;
        });
        $(".back_btn_reg").click(function() {
                $(".user_login").hide();
                $(".user_register").show();
                //$(".social_login").show();
                $(".header_title").text('Register');
                return false;
        });

 $('#event_id').change(function(){
          var e_id = $(this).val();
          $.ajax(
            {
              type:"post",
              url:"include/get_event_type.php",
              data:{
                e_id : e_id
              },
              success:function(data)
              {
                //alert(data);
                  if(data.VerficationStatus=="Y")
                  {
                    $('.event_people').show();
                  }
                  else
                  {
                    $('.event_people').hide();
                    $('#second_fname').val('');
                    $('#second_lname').val('');
                  }
                   
              },dataType: "json"
                
            });
        });
        
});
</script>
<script type="text/javascript"> 
$('.phone-box').click(function(){

    if($(this).hasClass('ps_other_type') && $(this).hasClass('active-box'))
    {

    }
    else
    {
              $('.phone-box').removeClass('active-box');
              if($(this).hasClass('ps_other_type'))
              {
                   $('.integration').show();

                            
                    $('#home-inner1').html("");
                    $('.ps_other_lg:eq( 0 )').addClass('active-box');
                   
              }
             else if($(this).hasClass('ps_other_lg'))
              {

                $('.ps_other_type').addClass('active-box');

               
              }
               else
              {
                 $('.integration').hide();
              }
              $(this).addClass('active-box');
    }
}); 

$('.phone-box1').click(function(){

      $('.phone-box1').removeClass('active-box');
      $(this).addClass('active-box');
});

      function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
      }
      DropDown.prototype = {
        initEvents : function() {
          var obj = this;

          obj.dd.on('click', function(event){
            $(this).toggleClass('active');
            return false;
          });

          obj.opts.on('click',function(){
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
          });
        },
        getValue : function() {
          return this.val;
        },
        getIndex : function() {
          return this.index;
        }
      }

      $(function() {

        var dd = new DropDown( $('#dd') );

        $(document).click(function() {
          // all dropdowns
          $('.wrapper-dropdown-3').removeClass('active');
        });

      });
</script>

<script type="text/javascript">
var current_step, next_step, previous_step;  
$("#next").click(function(){
  current_step = $(this).parent();
  next_step = $(this).parent().next(current_step);
 $('.steps:eq(0)').hide();
  $('.steps:eq(1)').show();
  $('.steps:eq(2)').hide();
});
</script>
<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'dd-M-yyyy'
    });

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });
});
</script>
 <script src="js/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
 <script>
$(function () {
  $('.percent').percentageLoader({
    valElement: 'p',
    strokeWidth: 20,
    bgColor: '#d9d9d9',
    ringColor: '#d53f3f',
    textColor: '#2C3E50',
    fontSize: '14px',
    fontWeight: 'normal'
  });

});
</script>