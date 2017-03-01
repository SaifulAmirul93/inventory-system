<style>
.button{
	background-color:#70abba;
	border:none;
	color:white;
	padding: 5px 12px;
	text-align:center;
	text-decoration:none;
	font-size:14px;
	cursor:pointer;	
}
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
	
	text-align:left;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #70abba;
	font-size:18px;
	text-align:left;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #70abba;
    color: white;
}



</style>


<?php
mysqli_report(MYSQLI_REPORT_STRICT);
require 'config.php';
require 'inc/session.php';
require 'inc/logs_core.php';
require 'inc/items_core.php';
require 'inc/categories_core.php';
require 'inc/users_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');
$_logs->set_session_obj($_session);

$_page = 6;

$role = $_session->get_user_role();
// Employees cannot have access to logs
if($role == 4)
	header('Location: items.php');

if(isset($_POST['act'])) {
	// Search count
	if($_POST['act'] == '1') {
		if(!isset($_POST['val']) || $_POST['val'] == '')
			die('wrong');
		$search_string = $_POST['val'];
		
		$itemid = $_POST['itemid'];
		$catid = $_POST['catid'];
		$userid = $_POST['userid'];
		
		if($itemid != 'no')
			$logs = $_logs->count_logs_search($search_string, $itemid, false, false);
		elseif($catid != 'no')
			$logs = $_logs->count_logs_search($search_string, false, $catid, false);
		elseif($userid != 'no')
			$logs = $_logs->count_logs_search($search_string, false, false, $userid);
		else
			$logs = $_logs->count_logs_search($search_string, false, false, false);
			
		if($logs == 0)
			die('2');
		die('3');
	}
}

if(!isset($_GET['page']) || $_GET['page'] == 0 || !is_numeric($_GET['page']))
	$page = 1;
else
	$page = $_GET['page'];

	
if(!isset($_GET['pp']) || !is_numeric($_GET['pp'])) {
	$pp = 25;
}else{
	$pp = $_GET['pp'];
	if($pp != 25 && $pp != 50 && $pp != 100 && $pp != 150 && $pp != 200 && $pp != 300 && $pp != 500)
		$pp = 25;
}


//start modified
// Logs of an item, category or user id
if(isset($_GET['itemid']) && is_numeric($_GET['itemid'])){
	$s = $_GET['itemid']; 
	$itemid = $_GET['itemid'];
	$catid = false;
	$userid = false;
	$type=false;
	$logs = $_logs->get_logs($type, $itemid, $catid,$userid);
	
}elseif(isset($_GET['catid']) && is_numeric($_GET['catid'])){
	$s = $_GET['catid'];
	$catid = $_GET['catid'];
	$itemid = false;
	$userid = false;
	$type=false;
	$logs = $_logs->get_logs($type, $itemid, $catid,$userid);
}elseif(isset($_GET['userid']) && is_numeric($_GET['userid'])) {
	$s = $_GET['userid'];
	$userid = $_GET['userid'];
	$itemid = false;
	$catid = false;
	$type=false;
	$logs = $_logs->get_logs($type, $itemid, $catid,$userid);
}

elseif(isset($_GET['type']) && is_numeric($_GET['type'])){
	$s = $_GET['type'];
	$type = $_GET['type'];
	$catid = false;
	$itemid = false;
	$userid = false;
	$logs = $_logs->get_logs($type, $itemid, $catid,$userid);
}else{
	$type = false;
	$catid = false;
	$itemid = false;
	$userid = false;
	
	
}



if( (isset($_GET['item-type']))&&  (isset($_GET['item-id']))&& (isset($_GET['user-id']))&& (isset($_GET['demo']) && ($_GET['demo'] != ''))){
			/*$category = urldecode($_GET['item-category']);*/
			$type = $_GET['item-type'];
			$item_id = $_GET['item-id'];
			$user_id = $_GET['user-id'];
			$date = $_GET['demo'];
			$logs = $_logs->search_filter($item_id,$user_id,$date,$type );
}
elseif( (isset($_GET['item-id']) &&  ($_GET['item-id'] != '')) && ((!isset($_GET['demo']))&& (!isset($_GET['user-id'])) &&(!isset($_GET['item-type']))) ){
			
			$type =false;
			$item_id = $_GET['item-id'];
			$user_id = false;
			$date = false;
			$logs = $_logs->search_filter($item_id,$user_id,$date,$type );
}
elseif( ((!isset($_GET['item-id']))&& (!isset($_GET['user-id']))) && (isset($_GET['demo']) && ($_GET['demo'] != ''))&&(isset($_GET['item-type']) && ($_GET['item-type'] != '')) ){
			
			$type =$_GET['item-type'];
			$item_id = false;
			$user_id = false;
			$date = $_GET['demo'];
			$logs = $_logs->search_filter($item_id,$user_id,$date,$type );
}


?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="media/css/dcalendar.picker.css">
<?php require 'inc/head.php'; ?>
</head>
<body>
	<div id="main-wrapper">
		<?php require 'inc/header.php'; ?>
		
		<div class="wrapper-pad">
			<?php
				if($itemid != false)
					echo "<h2>Inventory Logs - Item ID $itemid</h2>";
				elseif($catid != false)
					echo "<h2>Inventory Logs - Category ID $catid</h2>";
				elseif($userid != false)
					echo "<h2>Inventory Logs - User ID $userid</h2>";
				else
					echo '<h2>Inventory Logs</h2>';
			?>
             <div style="text-align:right">
            	<a href="#" id="open_filter" class="button"><i class="fa fa-filter fa-lg" aria-hidden="true" style="color:#FFF"></i>   Filter</a>
                &nbsp;&nbsp;
                <a href="#" id="open_print" class="button" onclick="open_print('div1','logs')" target="_blank"><i class="fa fa-print fa-lg" aria-hidden="true" style="color:#FFF"></i>   Print All</a>
                </div>
                
              
            	

			<?php /*?><div id="table-head">
         
            <!--start modified-->
			<!--	<form method="post" action="" name="searchf">
					<input type="text" name="search" placeholder="Search..." class="search fleft" <?php if($s!=false) echo 'value="'.$s.'"'; ?>/>
				</form>-->
                <!--end modified-->
				<img src="media/img/loader-small.gif" class="fleft loader" width="15" height="15" />
				<div class="fright">
					<div class="select-holder">
						<i class="fa fa-caret-down"></i>
						<select name="show-per-page">
							<option value="25" <?php if($pp==25) echo 'selected'; ?>>25</option>
							<option value="50" <?php if($pp==50) echo 'selected'; ?>>50</option>
							<option value="100" <?php if($pp==100) echo 'selected'; ?>>100</option>
							<option value="150" <?php if($pp==150) echo 'selected'; ?>>150</option>
							<option value="200" <?php if($pp==200) echo 'selected'; ?>>200</option>
							<option value="300" <?php if($pp==300) echo 'selected'; ?>>300</option>
							<option value="500" <?php if($pp==500) echo 'selected'; ?>>500</option>
						</select>
					</div>
				</div>
			</div><?php */?>
            
            
            <br><br>
			<!--start modified-->
	<?php /*?>		<?php
			if($s == false)
				$total_items = $_logs->count_logs($itemid, $catid, $userid);
			else
				$total_items = $_logs->count_logs_search($s, $itemid, $catid, $userid);
			if($total_items == 0)
				echo 'No items matched your query<br /><br /><br />';
			else{
			?><?php */?>
            <!--end modified-->
			  <div id="logs" >
			<table border="3" rules="rows" id="logs" class="display">
				<thead>
					<tr>
						<td width="6%">ID</td>
						<td width="8%">Type</td>
						<td width="48%">Item</td>
						<td width="6%">From</td>
						<td width="7%">To</td>
                        <td  width="7%">Diff.</td>
						<td width="5%">User</td>
						<td>Date</td>
					</tr>
				</thead>
			</table>
            </div>
               <div style="overflow:auto; height:400px;" id="div1" >
            <table id="logs" class="display">
         
				<tbody>
<?php
					if($_logs->is_mysqlnd()) {
						while($log = $logs->fetch_object()) {
							if($log->type == 1){
								$type = 'Check In';
								$from = $log->fromqty;
								$to = $log->toqty;
							}elseif($log->type == 2){
								$type = 'Check Out';
								$from = $log->fromqty;
								$to = $log->toqty;
							}elseif($log->type == 3){
								$type = 'Price Change';
								$from = $_logs->parse_price($log->fromprice);
								$to = $_logs->parse_price($log->toprice);
							}else{
								$type = '-';
								$from = '-';
								$to = '-';
							}
?>
					<tr data-id="<?php echo $log->id; ?>" data-type="element">
						<td class="hover" data-type="id"><?php echo $log->id; ?></td>
						<td class="hover" data-type="type"><?php echo $type; ?> </td>
						<td style="width:50%;" class="hover" data-type="name"><?php echo $_items->get_item_name($log->item); ?></td>
						<td><?php echo $from; ?></td>
						<td><?php echo $to; ?></td>
                         <td><?php $diff=$to-$from; 
						if($to>$from){
							echo "+".$diff;
						}
						else{
						echo $diff;}?></td>
						<td><?php echo $_session->get_user_name_by_id($log->user); ?></td>
						<td><?php echo $log->date_added; ?></td>
					</tr>
<?php
						}
					}else{
						foreach($logs as $log) {
							if($log->type == 1){
								$type = 'Check In';
								$from = $log->fromqty;
								$to = $log->toqty;
							}elseif($log->type == 2){
								$type = 'Check Out';
								$from = $log->fromqty;
								$to = $log->toqty;
							}elseif($log->type == 3){
								$type = 'Price Change';
								$from = $_logs->parse_price($log->fromprice);
								$to = $_logs->parse_price($log->toprice);
							}else{
								$type = '-';
								$from = '-';
								$to = '-';
							}
?>
					<tr data-id="<?php echo $log->id; ?>" data-type="element">
						<td class="hover" data-type="id"><?php echo $log->id; ?></td>
						<td class="hover" data-type="type"><?php echo $type; ?> </td>
						<td class="hover" data-type="name"><?php echo $_items->get_item_name($log->item); ?></td>
						<td><?php echo $from; ?></td>
						<td><?php echo $to; ?></td>
                        <td><?php $diff=$to-$from; 
							if($to<$from){
							echo $diff;
						}elseif($to>$from){
						echo "+".$diff;
						}?></td>
						<td><?php echo $_session->get_user_name_by_id($log->user); ?></td>
						<td><?php echo $log->date_added; ?></td>
					</tr>
<?php
						}
					}
?>
				</tbody>
               
			</table>
             </div>
		</div>
		
<?php /*?>	<div id="pagination">
			<?php
			if($page != 1)
				echo '<div class="prev" name="'.($page-1).'"><i class="fa fa-caret-left"></i></div>';
			?>
<div class="page"><?php echo $page; ?></div>
			<?php
			//start modified
	//		if(($s == false))
//			{
				$total_items = $_logs->count_logs($s,$type,$itemid, $catid, $userid);
		//	}
//			else
//				$total_items = $_logs->count_logs_search($s, $itemid, $catid, $userid);
			//end modified
			if($total_items > $pp) {
				$total_pages = (int)$total_items / (int)$pp;
				if($total_pages > $page)
					echo '<div class="next" name="'.($page+1).'"><i class="fa fa-caret-right"></i></div>';
			}
			?>
		</div><?php */?>
		
		<div class="clear" style="margin-bottom:40px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
		<!--start modified-->
		<?php /*?><?php } ?><?php */?>
        <!--end modified-->
	</div>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <h3 style="color:#FFF">Filter Search</h3>
    </div>
    <div class="modal-body">
    <h4>Sorts By:</h4>
    <br>
					<!--Category:<br />-->
                    <form method="get" action="" name="searchform">
                       <br>	
                        	Type:<br />
						<div class="select-holder">
							
							<select name="item-type" id="item-type" style="left:0px; width:40%;">
                            <option value='' selected>Select Type</option>
                            	<option value="1">Check-In</option>
                                <option value="2">Check-Out</option>
                                <option value="3">Price Change</option>
                            </select>
                            
						<?php /*?>		<?php
							if($_logs->count_logs() == 0)
								echo '<select name="item-type" id="item-category" placeholder="Category name" style="left:0px; width:40%;" disabled><option value="no">You need to create a category first</option></select>';
							else{
								echo '<select name="item-type" id="item-category" placeholder="Category name" style="left:0px; width:40%;">';
								$logs = $_logs->get_type_dropdown();
								while($log = $logs->fetch_object()) {
									echo "<option value=\"{$log->id}\">{$log->type}</option>";
								}
								echo '</select>';
							}
							?><?php */?>
							
						</div>
                        <br><br>	
                        	Item:<br />
						<div class="select-holder">
							
							
							<?php
							if($_items->count_items() == 0)
								echo '<select name="item-id" id="item-id" placeholder="Item name" style="left:0px; width:55%;" disabled><option value="no">You need to create a category first</option></select>';
							else{
								echo '<select name="item-id" id="item-id" placeholder="Item name" style="left:0px; width:55%;">';
								echo "<option value='' selected>Select Item</option>";
								$items = $_items->get_items_dropdown();
								while($item = $items->fetch_object()) {
									echo "<option value=\"{$item->id}\">{$item->name}</option>";
								}
								echo '</select>';
							}
							?>
							
						</div>
                           <br><br>		
                        	User:<br />
						<div class="select-holder">
							
							
										<?php
							if($_users->count_users_dropdown() == 0)
								echo '<select name="user-id" id="user-id"  placeholder="Username" style="left:0px; width:40%;" disabled><option value="no">You need to create a category first</option></select>';
							else{
								echo '<select name="user-id" id="user-id" placeholder="Username" style="left:0px; width:40%;">';
								echo "<option value='' selected>Select User</option>";
								$users = $_users->get_users_dropdown();
								while($user = $users->fetch_object()) {
									echo "<option value=\"{$user->id}\">{$user->username}</option>";
								}
								echo '</select>';
							}
							?>
	
						</div>
                        <br><br>	
                        	Date:<br />
						<div class="ni-cont">
							<input name="demo" class="form-control" placeholder="Date" id="demo" type="text" size="34">
						</div>
		
        <br>
        <input type="submit" class="button" id="search" name="search" value="Search" />
        
		<br><br>
        </form>
    </div>
    
  </div>

</div>
<script src="media/js/dcalendar.picker.js"></script>
<script>
$('#demo').dcalendarpicker({ format:'yyyy-mm-dd'});
/*$('#calendar-demo').dcalendar();*/ //creates the calendar
</script>
<script>

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("open_filter");

function open_print(el,il){
		var restorepage= document.body.innerHTML;
		var printcontent= document.getElementById(el).innerHTML;
		var printheader=document.getElementById(il).innerHTML;
		document.body.innerHTML=printheader+printcontent;
		window.print() ;
		document.body.innerHTML=restorepage;
	
		
		
}


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

//When the page onload, open the modal
btn.onclick = function(){
	
	 modal.style.display ="block" ;
	
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
</body>
</html>