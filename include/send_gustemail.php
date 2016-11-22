<?php include_once('../administrator/common/model/conn.php'); ?>
<?php include_once('../administrator/common/model/function.php'); ?>
<?php
header('Content-Type: application/json');
//$_POST['id'] = 8;
if(isset($_POST['id']) && !empty($_POST['id']))
{
	
	$guset_data = select_data_array('we_users_event_guestlist','','WHERE id='.$_POST['id'].' AND event_user='.$_SESSION['reg_id']);
	if(count($guset_data) > 0)
	{
		$count = 0;
		while($count < 1)
		{
			if($guset_data[$count]['guest_status'] == 0)
			{
				$website_url = select_single_col('we_setting','website_url','LIMIT 1');
				$path = $website_url.'event/'.select_single_col('we_user_event_website','website_name','WHERE event_user='.$_SESSION['reg_id']);
				$guest_name = $guset_data[$count]['guest_name'];
				$guest_email = $guset_data[$count]['guest_email'];
				$guest_contact_no = $guset_data[$count]['guest_contact_no'];
				$category_ids = select_data_array('we_users_event_cat','','WHERE event_user='.$_SESSION['reg_id'].' AND user_event_id='.$guset_data[$count]['user_event_id']);
				
				
				$event_id = select_single_col('we_users_event','event_id','WHERE id='.$guset_data[$count]['user_event_id']);
				$event_name = select_single_col('we_event','event_name','WHERE id='.$event_id);
				$event_date = select_single_col('we_users_event','event_date','WHERE id='.$guset_data[$count]['user_event_id']);
				$event_location = select_single_col('we_users_event','event_location','WHERE id='.$guset_data[$count]['user_event_id']);
				$event_address = select_single_col('we_users_event','event_address','WHERE id='.$guset_data[$count]['user_event_id']);
				
				/*
				$event_cats = array();
				if(count($category_ids) > 0)
				{
					$count2 = 0;
					while($count2 < count($category_ids))
					{
						$msg .='<tr style="  height:30px">

			                <td style="padding-left:10px">'.select_single_col('we_category','category_name','WHERE id='.$category_ids[$count2]['category_id']).'</td>
			                <td colspan="2" style="padding-left:10px;border-left:solid 1px #e5e5e5" width="70%">
			                  '.$email.'
			                </td>
			            </tr>';
						
						$event_cats[] = $category_ids[$count2];
						$count2++;
					}
				}
				*/
				// mail start
				$msg = '
				  	<html>
				    <body>
				      <div style="width:550px;min-height:30px;border:groove 2px #132953;box-shadow:3px 3px 10px rgba(0,0,0,0.5); background:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#eee));">
				        <table >
				          <thead>
				            <tr style="background-color:#132953; color:white">
				              <th colspan="2">
				                <h1 style="margin:10px; ">Zuruuna</h1>
				              </th>
				              <th style="color:white">
				                <h3 style="margin:10px; ">'. 'Event Invitation'.'</h3>
				              </th>
				            </tr>
				            <tr>
				              <th colspan="3">
				                <p style="padding:5px 0px;color:#132953;">You Have Event invitation From <font style="color:#000">'.$_SESSION['reg_name'].','.$_SESSION['reg_email'].'</font>.</p>
				              </th>
				            </tr>
				          </thead>
				          <tbody>
				              <tr><th colspan="3"><hr><p style="margin:10px 0px;text-decoration:underline;">Event Info</p></th></tr>
				              <tr style="height:30px">
				                <td style="padding-left:10px">Event Name</td>
				                <td colspan="2" style="padding-left:10px;border-left:solid 1px #e5e5e5" width="70%">
				                  '.$event_name.'
				                </td>
				              </tr>
				              <tr style="  height:30px">
				                <td style="padding-left:10px">Date</td>
				                <td colspan="2" style="padding-left:10px;border-left:solid 1px #e5e5e5" width="70%">
				                  '.$event_date.'
				                </td>
				              </tr>
				              <tr style="  height:30px">
				                <td style="padding-left:10px">Address</td>
				                <td colspan="2" style="padding-left:10px;border-left:solid 1px #e5e5e5" width="70%">
				                  '.$event_address.'
				                </td>
				              </tr>
				              <tr style="  height:30px">
				                <td style="padding-left:10px">Location</td>
				                <td colspan="2" style="padding-left:10px;border-left:solid 1px #e5e5e5" width="70%">
				                  '.$event_location.'
				                </td>
				              </tr>
				              <tr style="  height:30px">
				                <td style="padding-left:10px"></td>
				                <td colspan="2" style="padding-left:10px;border-left:solid 1px #e5e5e5" width="70%">
				                  <a href="'.$path.'?ueid=8&guest='.$guest_email.'" target="_blank">Accept</a>
				                  <a href="'.$path.'?ueid=8&guest='.$guest_email.'" target="_blank">Not Comming</a>
				                </td>
				              </tr>
				          </tbody>
				        </table>
				      </div>
				    </body>
				  </html>'; 
				    $body = $msg;
				    $to = $guest_email;
				    $headers = 'From: '.$_SESSION['reg_name'].' <' . $_SESSION['reg_email'] . '>' . "\r\n";
				    $headers .= "MIME-Version: 1.0\r\n";
				    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				    $subject = 'Event Invitation';
				    // send email
			    if(mail($to, $subject, $body, $headers ))
			    {
			    	echo "{\"VerficationStatus\":\"Y\"}";
					exit;
			    }
			    else
			    {
			    	echo "{\"VerficationStatus\":\"B\"}";
					exit;	
			    }

				// mail ends

			}
			$count++;
		}
		
	}
	else
	{
		echo "{\"VerficationStatus\":\"A\"}";
		exit;
	}
}
else
{
	echo "{\"VerficationStatus\":\"N\"}";
	exit;
}
?>