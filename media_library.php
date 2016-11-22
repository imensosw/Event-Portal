<?php include('connection.php'); ?>
<?php
ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Media | Zuruuna.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>

</head>
<body onload="initialize()">
<?php include('header.php'); ?>
  
  <section id="createEvent">
    <div class="container">
      <div class="row">
      <div class="col-md-12">
        <h3 class="">Edit your event</h3>
      </div>  
    </div>
    <div class="row ">
    <div class="col-md-3">
      <?php include('include/vendor_dashboard_sidebar.php'); ?>
    </div>
        <div class="col-md-9 form-group">
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
          <input type="text" class="form-control" id="my_image" name="my_image" /><a href="javascript:;" data-type="text" data-id="my_image" class="call_media_library">Select Image</a>
        </div>
          <!-- Modal -->
          <div id="myModal" class="modal fade col-md-12" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <input type="file" id="add_new_image" name="add_new_image" />
                  <?php $upload_path = select_single_col('we_setting','basic_path','LIMIT 1').'uploads/default/'; ?>
                  <button onclick="uploadFile('<?php echo $upload_path; ?>');">Upload</button>
                </div>
                <div class="modal-body">
                  <article id="media_library" class="row">  
                    <?php
                      $basic_path = select_single_col('we_setting','basic_path','LIMIT 1');
                      $website_url = select_single_col('we_setting','website_url','LIMIT 1');
                      $path = $basic_path.'uploads/';
                      $image_path = $website_url.'uploads/';
                      //$path .= $we_vendor_data['access_key'].'/';
                      //$media_path = $dir;
                      
                      $slug_array[] = 'default';
                      $slug = select_single_col('we_vendor','access_key','WHERE id='.$_SESSION['vendor_id']);
                      if(!empty($slug))
                      {
                        //$slug_array[] = $slug;
                      }

                    ?>
                    <div class="form-group">
                        <?php
                        foreach ($slug_array as $key => $value) {
                          //$sub_path = $media_path.$value;
                          $sub_path =  realpath($path.$value);
                          $dir    = $sub_path;
                          $files1 = scandir($dir);
                          $files2 = scandir($dir, 1);

                          //print_r($files1);
                          //print_r($files2);
                          $count = 1;
                          foreach ($files1 as $key => $values) {

                            if(($values == '.') || ($values == '..'))
                            {
                              
                            }
                            else
                            {
                              //echo 
                              //echo $$image_path.$value.'/'.$values;

                              ?>
                              <div class="col-md-3">
                              <img id="image_<?php echo $count; ?>" src="<?php echo $image_path.$value.'/'.$values; ?>" class="img-responsive" />
                              <div class="checkbox"><input type="checkbox" id="check_<?php echo $count; ?>" data-id="<?php echo $count; ?>" /><label for="check_<?php echo $count; ?>">Select</label></div>
                              </div>
                              <?php
                              if(($count%4) == 0) { echo '<div class="clearfix"></div>';}
                              $count++;
                            }
                          }
                        }
                        ?>
                    </div>    
                  </article> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default select_value_from_media" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

                  
              
            
        
      </div>
    </div>
  </section>
<?php include('footer.php'); ?>

<script type="text/javascript">
  //$('#add_new_image').click(function(event){
    //event.preventDefault();
  //});

  function uploadFile(path){
    var input = document.getElementById("add_new_image");
    file = input.files[0];
    if(file != undefined){
      formData= new FormData();
      if(!!file.type.match(/image.*/)){
        formData.append("image", file);
        formData.append("path", path);
        $.ajax({
          url: "upload.php",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(data){
              $("#media_library").load(location.href + " #media_library");
          } 
        });
      }else{
        alert('Not a valid image!');
      }
    }else{
      alert('Input something!');
    }
  }

  $('.call_media_library').click(function(){
    var data_id = $(this).attr('data-id');
    var data_type = $(this).attr('data-type');
    $('#myModal').find('.select_value_from_media').attr('data-id',data_id);
    $('#myModal').find('.select_value_from_media').attr('data-type',data_type);
    $('#myModal').modal();
  });
</script>
</body>
</html>

