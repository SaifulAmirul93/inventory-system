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
</style>


<?php

require 'config.php';

require 'inc/session.php';

require 'inc/items_core.php';

require 'inc/logs_core.php';

require 'inc/users_core.php';

require 'inc/categories_core.php';

if($_session->isLogged() == false)

	header('Location: index.php');



$_page = 16;



if(!isset($_GET['id']))
	header('Location: log.php');

$log = $_logs->get_log($_GET['id']);

if(!$log->id)

	header('Location: log.php');

?>
<link rel="stylesheet" type="text/css" href="../asset/bootstrap/bootstrap.css">
<!DOCTYPE HTML>

<html>

<head>

<?php require 'inc/head.php'; ?>

</head>

<body>

	<div id="main-wrapper">

		<?php require 'inc/header.php'; ?>
			 <br/>
           <div class="wrapper-pad">
                       <div style="text-align:left">  
                      <a href="#" id="open_print" class="button" onclick="open_print('wrapper-pad')">Print</a> 
                      </div>
          </div>
            <br/>
			<div class="clear" style="height:30px;"></div>
            <div class="border" style="margin-bottom:30px;"></div>

		<div class="wrapper-pad" id="wrapper-pad">

		
          
			<br><br>
					<img src="../asset/logoheader.png" class="pull-left">
                    <br><br>
                    <h3 class="pull-right">Log Information Details</h3> 
                    <br><br><br>
                    <hr/>
                    <br><br>
                    <h3>#<?php echo $log->id; ?></h3>
                    <br>
					
					<form>
                    <div class="row">
                    		
                            <div class="form-group">
                            <div class="col-sm-2  pull-left">	
                                    
                                    <label class="pull-left">Log ID:</label>
                                    <input type="text" class="form-control" value="<?php echo $log->id; ?>" disabled>
                            </div>
                            
                    
                       
                             <div class="col-sm-3 pull-right">
                                    <label class="pull-left">Type:</label>
                                    <?php
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
                
                                    
                                        <input type="text" class="form-control" value="<?php echo $type ?>" disabled>
                                </div>
                                </div>
                          </div>
					<br/><br/>
                    <div class="row">
                    
                    <div class="form-group">
                    
                        <div class="col-lg-8">
                                <label class="pull-left">Item Name:</label>
                                <input type="text" class="form-control" value="<?php echo $_items->get_item_name($log->item); ?>" disabled>
                            </div>
                        </div>
                        </div>
                        <br /><br />
                        <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-2 pull-left">
                                            <label class="pull-left">From:</label>
                                            <input type="text" class="form-control" value="<?php echo $from ?>" disabled>
                                    </div>
                           
                                     <div class="col-lg-2 pull-left">
                                        <label class="pull-left">To:</label>
                                         <input type="text" class="form-control" value="<?php echo $to ?>" disabled><br>
                                    </div>
                                         <div class="col-lg-2 pull-right">
                                <label class="pull-left">Difference:</label>
                                
            
                                    <?php $diff=$to-$from; 
                                    if($to>$from){
                                        ?>
                                        <input type='text' class='form-control' value="<?php echo '+'.$diff ?>" disabled>
                                    <?php
                                    }
                                    elseif($to<$from){
                                        ?>
                                        <input type='text' class='form-control' value="<?php echo $diff ?>" disabled>
                                        <?php
                                    }
                                    else{?>
                                        <input type='text' class='form-control' value="<?php echo $diff ?>" disabled>
                                    <?php
                                        }
                                     ?>
                                     </div>
                                </div>
                          </div>      
						<br /><br />
				
                		<div class="row">
                            <div class="form-group">
                            <div class="col-sm-3 pull-left">
                                    <label class="pull-left">User:</label>
                                    <input type='text' class='form-control' value="<?php echo $_session->get_user_name_by_id($log->user);  ?>" disabled>
                            </div>
                             </div>
                           </div>

					<br /><br />                     
                    <div class="row">
                            <div class="form-group">
                                      <div class="col-sm-3 pull-left">
                                             <label class="pull-left">Date Added:</label>
                                             <input type='text' class='form-control' value="<?php echo $log->date_added; ?>" disabled>
                                        </div>
                            </div>
                    </div>
                    <br /><br />    
                     <div class="row">
                            <div class="form-group">
                                      <div class="col-sm-12">
                                             <label class="pull-left">Note:</label>
                                             <textarea name="note" rows="5" cols="40" class='form-control' placeholder="Write some notes here..."></textarea>
                                        </div>
                            </div>
                    </div>
					</form>
			

			

		</div>

		

		<div class="clear" style="margin-bottom:40px;"></div>

		<div class="border" style="margin-bottom:30px;"></div>

	</div>
    
<script>

    function open_print(el){
		var restorepage= document.body.innerHTML;
		var printcontent= document.getElementById(el).innerHTML;
		
		document.body.innerHTML=printcontent;
		
		window.print() ;
		document.body.innerHTML=restorepage;
	
		
		
}
</script>

</body>

</html>
<script src="../asset/bootstrap/bootstrap.min.js"></script>