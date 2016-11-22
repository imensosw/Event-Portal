<?php
$where = "WHERE id IN (
  SELECT category_id from we_event_cat WHERE event_id = ".$event_id." AND category_id NOT IN (
  SELECT category_id FROM we_users_event_cat WHERE event_user = ".$_SESSION['reg_id']." AND event_id = ".$event_id."
  ))";

  $categories = select_data_array('we_category','',$where);

?>
<!--Edit Checklist items-->
<div id="updateTask" class="modal" style="display:none;">
 <div class="modal-dialog">
  <div class="modal-content">
    <header class="modal-header">
      <span class="">Edit Checklist item</span>                        
    </header>
    <div class="modal-body">
      <form method="post" id="updateUserEventCat" >
        <div class="update_message" style=""></div>
        <div class="form-group">
         <label for="">Category</label>
         <input type="hidden" id="row_id" class="form-control" value="" disabled="">
         <input type="text" id="category_id" class="form-control" value="Ceremony" disabled="">                    
       </div>

       <div class="form-group">
        <label>Deadline</label>                 
        <div class="input-group input-append date" id="datePicker_my">
          <input type="text" id="end_date" name="end_date" class="form-control" placeholder="Deadline"  required />
          <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
        </div> 
      </div>
      <div class="form-group">
        <label>Estimated Budget</label>                 
        <div class="input-group">
          <span class="input-group-addon">$</span>
          <input type="text" id="budget" name="budget" placeholder="US Dollar" class="form-control">
        </div>
      </div>  
      <div class="form-group">
        <label>Actual Budget</label>                 
        <div class="input-group">
          <span class="input-group-addon">$</span>
          <input type="text" id="actual_budget" name="actual_budget" placeholder="US Dollar" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label>Note</label>                 
        <div class="">
          <input type="text" id="event_cat_note" name="event_cat_note" placeholder="Note" class="form-control">
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
</div><!--/Edit checklist items-->

<!-- Form To add Remaining Tasks -->
<div id="addnewTask" class="modal" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
    <header class="modal-header">
      <span class="">Add Checklist item</span>                        
    </header>
    <div class="modal-body">
        <form method="post" id="addTaskForm">
          <div class="add_message" style="padding:10px; margin-top:10px; margin-bottom:10px;"></div>
          <div class="form-group">
            <input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>" />
            <input type="hidden" name="user_event_id" id="user_event_id" value="<?php echo $user_event_id; ?>" />
            <label for="">Event</label>
            <select required name="category_id" id="category_id" class="form-control " style="width:100%;" >
              <option value=""></option>
              <?php

              if($categories)
              {
                $count = 0;
                while($count < count($categories)) 
                {
                  ?>
                  <option value="<?php echo $categories[$count]['id']; ?>"><?php echo $categories[$count]['category_name']; ?>
                  </option>
                  <?php
                  $count++;
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Deadline</label>                 
            <div class="input-group input-append date" id="datePicker">
              <input type="text" id="end_date" name="end_date" class="form-control" placeholder="Deadline"  required />
              <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
            </div> 
          </div>
          <div class="form-group">
            <label>Estimated Budget</label>                 
            <div class="input-group">
              <span class="input-group-addon">$</span>
              <input type="text" id="budget" name="budget" placeholder="US Dollar" class="form-control">
            </div>
          </div>  
          <div class="form-group">
            <label>Actual Budget</label>                 
            <div class="input-group">
              <span class="input-group-addon">$</span>
              <input type="text" id="actual_budget" name="actual_budget" placeholder="US Dollar" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label>Note</label>                 
            <div class="">
              <input type="text" id="event_cat_note" name="event_cat_note" placeholder="Note" class="form-control">
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
</div>
<!-- / Form to add remaining Tasks -->
    
<div class="container">
<div class="row">
      <div class="col-md-12">
        <h3>Event Checklist</h3>
      </div>
    </div>
  <div class="row profile">
    <div class="col-md-3">
      <?php include('include/dashboard_sidebar.php'); ?>
    </div>
    <div class="col-md-9">
    <?php if($categories) { ?>
      <h3><a href="#addnewTask" class="btn btn-alpha btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> Add Task</a></h3>
      <?php } ?>
      <div class="side-content" id="checklistList" style="width:60%; float:left;">
       <div id="SurveyRedesign" class="ProjectTodoItems">    
            <ul class="TodoItems Incomplete">
              <li class="TodoItem" id="Item1">
               <a href="#addnewTask" class="media" data-toggle="modal">
                   <span class="pull-left CheckBox" href="javascript:void(0);"></span>
                    <div class="media-body">
                        <h4 class="media-heading">Nested Media Heading  <span class="pull-right">01/25/25</span></h4>
                        <p>
                          <em>Actual / Estimate Budget - $1 / $1500</em>                          
                        </p>
                    </div>
                </a>
                <div class="drag-handler"></div>
              </li>
              <li class="TodoItem" id="Item2">
               <div class="media">
                   <a class="pull-left CheckBox" href="javascript:void(0);"></a>
                    <div class="media-body">
                        <h4 class="media-heading">Nested Media Heading  <span class="pull-right">01/25/25</span></h4>
                        <p>
                          <em>Actual / Estimate Budget - $2 / $1500</em>                          
                        </p>
                    </div>
                </div>
                <div class="drag-handler"></div>
              </li>                         
            </ul>

             <ul class="TodoItems Complete" style="padding:0; margin:0; list-style:none">
             <li class="TodoItem" id="Item3">
                <div class="media">
                   <a class="pull-left CheckBox" href="javascript:void(0);"></a>
                    <div class="media-body">
                        <h4 class="media-heading">Nested Media Heading  <span class="pull-right">01/25/25</span></h4>
                        <p>
                          <em>Actual / Estimate Budget - $3 / $1500</em>                          
                        </p>
                    </div>
                </div>
                <div class="drag-handler"></div>
             </li>
             </ul>


<div style="clear:both"></div>
 </div>
    </div>

<div class="rightBox">
  <div class="login_box">
    <form>
      <div class="col-md-12 col-xs-12 rightBox-header">
           <div class="media">
                   <span href="javascript:void(0);" class="pull-left CheckBox"></span>
                    <div class="media-body">
                        <h4 class="media-heading">Nested Media Heading  <span class="pull-right"><i class="fa fa-clock-o"></i> 2 Oct 2016</span></h4>
                      
                    </div>
            </div>        
            
      </div>
       <div class="col-md-12 col-xs-12" align="center">
      <textarea>This is just a php integration of the form</textarea>
      </div>
        <div class="col-md-6 col-xs-6 follow line" align="center" style="border-right:1px solid #EEE;">
            <p>
                 <input type="text" value="$5000.00"> <span>Actual Budget</span>
            </p>
        </div>
        <div class="col-md-6 col-xs-6 follow line" align="center">
            <p>
                <input type="text" value="$5000.00">  <span>Estimated Budget</span>
            </p>
        </div>
        
        <div class="clearfix"></div>
        <div class="display-table">
                <div class="display-table-cell h100 border-bottom text-center">
                                                      
                  <div class="show_before_guestlist">
                    <p class="text-muted">No vendor added yet. </p>
                    <a class="btn" href=""><i class="fa fa-plus"></i> Add Vendors</a>
                  </div>
                                    
              </div>
              </div>  
        <div class="clearfix"></div>
        <a href="" class="btn btn-gama btn-block">Submit</a>         
      
</div>

</div>


        <table class="table">
          <thead>
            <tr>
             <th> 
              </th>
             <th>Category</th>
             <th>Deadline</th>
             <th><small>Estimated</small><br> Budget</th>
             <th><small>Actual</small><br>  Budget</th>
             <th></th>
             <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            while($count < count($user_event_cat_data))
            {
              if($user_event_cat_data[$count]['status'] == 1) { $checked = 'checked'; $no_edit = 'hide';} else { $checked=""; $no_edit = '';}
                ?>
                <tr id="tr_id_<?php echo $user_event_cat_data[$count]['id']; ?>">
                  <td>
                    <div class="checkbox-xl">
                        <input id="status_<?php echo $user_event_cat_data[$count]['id']; ?>" rowid="<?php echo $user_event_cat_data[$count]['id']; ?>" type="checkbox" <?php echo $checked; ?> name="check" value="<?php echo $user_event_cat_data[$count]['status'];  ?>" onclick="set_task_status(this.id);">
                        <label for="status_<?php echo $user_event_cat_data[$count]['id']; ?>"></label>                   
                       </div>
                  </td>
                  <td>
                    <span class="cat_name">
                      <?php
                        echo $cat_name = select_single_col('we_category','category_name','WHERE id='.$user_event_cat_data[$count]['category_id']);
                      ?>
                      <a title="Search Vendors" href="#">
                        <span class="info-link">
                          <i class="fa fa-search"></i>
                        </span>
                      </a>
                    </span>
                  </td>
                  
                  <?php if($user_event_cat_data[$count]['end_date'] < date('Y-m-d'))
                  {
                    
                    ?><td style="color:red;"><?php echo date_view_format($user_event_cat_data[$count]['end_date']); ?></td><?php
                  }
                  else
                  {
                    ?><td><?php echo date_view_format($user_event_cat_data[$count]['end_date']); ?></td><?php
                  }
                  ?>
                  <td>$<?php echo $user_event_cat_data[$count]['budget']; ?></td>
                  <td>$<?php echo $user_event_cat_data[$count]['actual_budget']; ?></td>
                  <td>
                    <?php 
                    $blcass="green";
                    if($user_event_cat_data[$count]['actual_budget'] > $user_event_cat_data[$count]['budget'])
                    {
                      $blcass="red";
                    }
                    ?>
                    <span class="indicator <?php echo $blcass; ?>"></span>
                  </td>
                  <td eventCatId="<?php echo $user_event_cat_data[$count]['id']; ?>" catName="<?php echo $cat_name ?>" catId="<?php echo $user_event_cat_data[$count]['category_id']; ?>" endDate="<?php echo date_view_format($user_event_cat_data[$count]['end_date']); ?>" budget="<?php echo $user_event_cat_data[$count]['budget']; ?>" actualBudget="<?php echo $user_event_cat_data[$count]['actual_budget']; ?>" eventId="<?php echo $user_event_cat_data[$count]['event_id']; ?>" eventCatNote="<?php echo $user_event_cat_data[$count]['event_cat_note']; ?>">
                    <a href="#updateTask" myid="<?php echo $count; ?>" data-toggle="modal" class="editListing action-btn"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                    <a href="javascript:;" onclick="if(confirm('Do you want to delete!')){delete_event_cat(<?php echo $user_event_cat_data[$count]['id']; ?>);}" class="action-btn"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
              $count++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>