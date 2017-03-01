<?php

require 'config.php';

require 'inc/session.php';

require 'inc/home_core.php';

require 'inc/items_core.php';

if($_session->isLogged() == false)

	header('Location: index.php');



$_page = 1;



$role = $_session->get_user_role();

if($role != 1 && $role != 2)

	header('Location: items.php');



if(isset($_POST['act']) && $_POST['act'] == 'reqinfo') {

	$interval = $_POST['int'];

	

	$res = array(

		$_home->get_new_items($interval),

		$_home->get_checked_in($interval),

		$_home->get_checked_out($interval),

	);

	

	$_check_in_price = $_home->get_checked_in_price($interval);

	$_check_out_price = $_home->get_checked_out_price($interval);

	

	$res[] = 'RM '.$_check_in_price;

	$res[] = 'RM '.$_check_out_price;

	

	$res = implode('|', $res);

	

	echo $res;

	die();

}
if(!isset($_GET['page']) || $_GET['page'] == 0 || !is_numeric($_GET['page']))
	$page = 1;
else
	$page = $_GET['page'];

	
if(!isset($_GET['pp']) || !is_numeric($_GET['pp'])) {
	$pp = 10;
}else{
	$pp = $_GET['pp'];
	if($pp != 10 && $pp != 20 && $pp != 30 && $pp != 40 && $pp != 50 && $pp != 60 && $pp != 70)
		$pp = 20;
}
$items = $_items->get_items_home();
$c_items = $_items->count_items();
$label50 = $_items->count_items_label50();
$label10 = $_items->count_items_label10();
$box50 = $_items->count_items_box50();
$box10 = $_items->count_items_box10();
$bottle = $_items->count_items_bottle();
$box_pack = $_items->count_items_boxpack();
$merchandise = $_items->count_items_merchandise();
$others = $_items->count_items_others();
$marketing = $_items->count_items_marketing();
$daging = $_items->count_items_daging();


//Tin Yummy Series
$tingreen=$_items->count_items_quantity(66);
$tintrap=$_items->count_items_quantity(67);
$tincush=$_items->count_items_quantity(65);




//count Low Mint item label 50ml
$lblbad3mg = $_items->count_items_quantity(1);
$lblasap6mg = $_items->count_items_quantity(54);
$lblbad0mg = $_items->count_items_quantity(42);
$lblbad6mg = $_items->count_items_quantity(43);
$lblfat0mg = $_items->count_items_quantity(44);
$lblfat6mg = $_items->count_items_quantity(45);
$lblfat3mg = $_items->count_items_quantity(46);
$lblwicked3mg = $_items->count_items_quantity(49);
$lblwicked6mg = $_items->count_items_quantity(50);
$lblslow3mg = $_items->count_items_quantity(51);
$lblslow6mg = $_items->count_items_quantity(52);
$lblasap3mg = $_items->count_items_quantity(53);
$lblasap6mg = $_items->count_items_quantity(54);
$lblasap0mg = $_items->count_items_quantity(7);
$lblslow0mg = $_items->count_items_quantity(6);
$lblwicked0mg = $_items->count_items_quantity(5);
$lbldevil3mg = $_items->count_items_quantity(3);
$lbldevil0mg  = $_items->count_items_quantity(47);
$lbldevil6mg  = $_items->count_items_quantity(48);

//count No-menthol item label 50ml
$n_lblblack0mg = $_items->count_items_quantity(68);
$n_lblblack3mg = $_items->count_items_quantity(69);
$n_lblblack6mg = $_items->count_items_quantity(70);

$n_lblmango0mg = $_items->count_items_quantity(71);
$n_lblmango3mg = $_items->count_items_quantity(72);
$n_lblmango6mg = $_items->count_items_quantity(73);

$n_lblhoney0mg = $_items->count_items_quantity(74);
$n_lblhoney3mg = $_items->count_items_quantity(75);
$n_lblhoney6mg = $_items->count_items_quantity(76);

$n_lbllemon0mg = $_items->count_items_quantity(77);
$n_lbllemon3mg = $_items->count_items_quantity(78);
$n_lbllemon6mg = $_items->count_items_quantity(79);

$n_lblpine0mg = $_items->count_items_quantity(80);
$n_lblpine3mg = $_items->count_items_quantity(81);
$n_lblpine6mg = $_items->count_items_quantity(82);

$n_lblgrape0mg = $_items->count_items_quantity(83);
$n_lblgrape3mg = $_items->count_items_quantity(84);
$n_lblgrape6mg = $_items->count_items_quantity(85);


//count Yummy item label 50ml
$y_lblmango0mg = $_items->count_items_quantity(93);
$y_lblmango3mg = $_items->count_items_quantity(94);
$y_lblmango6mg = $_items->count_items_quantity(95);

$y_lblapple0mg = $_items->count_items_quantity(96);
$y_lblapple3mg = $_items->count_items_quantity(97);
$y_lblapple6mg = $_items->count_items_quantity(98);

$y_lblstraw0mg = $_items->count_items_quantity(99);
$y_lblstraw3mg = $_items->count_items_quantity(100);
$y_lblstraw6mg = $_items->count_items_quantity(101);

//count item label 10ml
$lblbad10ml = $_items->count_items_quantity(14);
$lblfat10ml = $_items->count_items_quantity(15);
$lbldevil10ml = $_items->count_items_quantity(16);
$lblwicked10ml = $_items->count_items_quantity(17);
$lblslow10ml = $_items->count_items_quantity(18);
$lblasap10ml = $_items->count_items_quantity(19);

//count item box color 50ml
$box011 = $_items->count_items_quantity(86);
$box021= $_items->count_items_quantity(87);
$box031 = $_items->count_items_quantity(88);
$box041 = $_items->count_items_quantity(89);
$box051 = $_items->count_items_quantity(90);
$box061 = $_items->count_items_quantity(91);
$box071 = $_items->count_items_quantity(92);

//count item box color 50ml
$box01 = $_items->count_items_quantity(8);
$box02= $_items->count_items_quantity(9);
$box03 = $_items->count_items_quantity(10);
$box04 = $_items->count_items_quantity(11);
$box05 = $_items->count_items_quantity(12);
$box06 = $_items->count_items_quantity(13);

//count item box color 10ml
$box07 = $_items->count_items_quantity(20);
$box08 = $_items->count_items_quantity(21);
$box09 = $_items->count_items_quantity(22);
$box10 = $_items->count_items_quantity(23);
$box11 = $_items->count_items_quantity(24);
$box12 = $_items->count_items_quantity(25);

//bottle,sticker,large box
$btl01 = $_items->count_items_quantity(26);
$btl02 = $_items->count_items_quantity(27);
$px02 = $_items->count_items_quantity(33);
$MAINSTKR = $_items->count_items_quantity(36);
$px01 = $_items->count_items_quantity(32);
$px03 = $_items->count_items_quantity(34);
$SHT01 = $_items->count_items_quantity(37);


//marketing tools & others
$pktfile = $_items->count_items_quantity(62);
$pprpunch = $_items->count_items_quantity(61);
$yellowA4 = $_items->count_items_quantity(60);
$bagblack = $_items->count_items_quantity(59);
$filerp = $_items->count_items_quantity(63);
$HLG01 = $_items->count_items_quantity(28);
$bagblue = $_items->count_items_quantity(58);
$SLT02 = $_items->count_items_quantity(129);
$SLT01 = $_items->count_items_quantity(29);
$USG01 = $_items->count_items_quantity(31);
$A1PST01 = $_items->count_items_quantity(41);
$STK01 = $_items->count_items_quantity(35);
$A3PST01 = $_items->count_items_quantity(39);
$FLY01 = $_items->count_items_quantity(40);


?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd"><html>
<link type="text/css" rel="stylesheet" href="../asset/bootstrap/bootstrap.css" media="all"/>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<style>
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
  width: 740px;
max-width:740px;
	height: 500px;
	max-height:500px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);

@keyframes bake-pie {
  from {
    transform: rotate(0deg) translate3d(0,0,0);
  }
}

body {
  font-family: "Open Sans", Arial;
  background: #EEE;
}
main {
  width: 400px;
  margin: 30px auto;
}
section {
  margin-top: 30px;
}

#chartdiv2 {
  width: 100%;
  height: 300px;
  font-size: 11px;
  border:thick;
}

.amcharts-pie-slice {
  transform: scale(1);
  transform-origin: 50% 50%;
  transition-duration: 0.3s;
  transition: all .3s ease-out;
  -webkit-transition: all .3s ease-out;
  -moz-transition: all .3s ease-out;
  -o-transition: all .3s ease-out;
  cursor: pointer;
  box-shadow: 0 0 30px 0 #000;
}

.amcharts-pie-slice:hover {
  transform: scale(1.1);
  filter: url(#shadow);
}
#chartdiv8 {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}

#boxTPD {
	width		: 50%;
	height		: 350px;
	font-size	: 11px;
}

#chartdiv7 {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}

#othersItem {
  width   : 100%;
  height    : 500px;
  font-size : 11px;
} 

#tinYummy {
  width   : 50%;
  height    : 300px;
  font-size : 7px;
} 

#chartdiv6 {
  width   : 50%;
  height    : 400px;
  font-size : 7px;
} 
#chartdiv5 {
  width   : 50%;
  height    : 400px;
  font-size : 11px;
}   
#chartdiv4 {
	width		: 50%;
	height		: 350px;
	font-size	: 11px;
}		
#chartdiv3 {
	width		: 50%;
	height		: 350px;
	font-size	: 11px;
}	

#chartdiv {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}	
.pieID {
  display: inline-block;
  vertical-align: top;
}
.pie {
  height: 200px;
  width: 200px;
  position: relative;
  margin: 0 30px 30px 0;
}
.pie::before {
  content: "";
  display: block;
  position: absolute;
  z-index: 1;
  width: 100px;
  height: 100px;
  background: #EEE;
  border-radius: 50%;
  top: 50px;
  left: 50px;
}
.pie::after {
  content: "";
  display: block;
  width: 120px;
  height: 2px;
  background: rgba(0,0,0,0.1);
  border-radius: 50%;
  box-shadow: 0 0 3px 4px rgba(0,0,0,0.1);
  margin: 220px auto;
  
}
.slice {
  position: absolute;
  width: 200px;
  height: 200px;
  clip: rect(0px, 200px, 200px, 100px);
  animation: bake-pie 1s;
}
.slice span {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  background-color: black;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  clip: rect(0px, 200px, 200px, 100px);
}
.legend {
  list-style-type: none;
  padding: 0;
  margin: 0;
  background: #FFF;
  padding: 15px;
  font-size: 13px;
  box-shadow: 1px 1px 0 #DDD,
              2px 2px 0 #BBB;
}
.legend li {
  width: 110px;
  height: 1.25em;
  margin-bottom: 0.7em;
  padding-left: 0.5em;
  border-left: 1.25em solid black;
}
.legend em {
  font-style: normal;
  font-size:8px;
}
.legend span {
  float: right;
}
footer {
  position: fixed;
  bottom: 0;
  right: 0;
  font-size: 13px;
  background: #DDD;
  padding: 5px 10px;
  margin: 5px;
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
    background-color: #e21627;
    color: white;
	font-size:24px;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;    background-color: #5cb85c;
    color: white;
}

.button{
	background-color:#008CBA;
	border:none;
	color:white;
	padding: 10px 24px;
	text-align:center;
	text-decoration:none;
	font-size:14px;
	cursor:pointer;
}

  
ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 0px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 14px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 0px solid #ccc;
    border-top: none;
}

</style>

<!--<link rel="stylesheet" type="text/css" href="media/css/jquery.tablescroll.css"/>
--><?php require 'inc/head.php'; ?>
<script src="media/js/jquery.table2excel.min.js"></script>


<body>

	<div id="main-wrapper">

		<?php require 'inc/header.php'; ?>

		

		<div class="wrapper-pad">

			<h2>Home</h2>
		

			
			

		<div class="clear" style="margin-bottom:20px;height:1px;"></div>
			<div class="clear" style="margin-bottom:20px;height:1px;"></div>
			<div class="clear" style="margin-bottom:20px;height:1px;"></div>
			<div class="clear" style="margin-bottom:5px;height:1px;"></div>			
                        <div class="row">
            				
                        <!--	<div class="col-lg-3">
                                <div class="alert alert-danger">
                                New Items<br/>
                                <h1><?php /*?><?php echo $_home->get_new_items('all_time'); ?><?php */?></h1>
                                </div>
                            </div>-->
            
                            <div class="col-sm-3">
                                <div class="alert alert-success">
                                Total Qty Check-In<br/>
                                <?php echo $_home->get_checked_in('all_time'); ?>
                                </div>
            
                            </div>
            
                            <div class="col-sm-3">
                                <div class="alert alert-success">
                                 Total Qty Check-Out<br/>
                                <?php echo $_home->get_checked_out('all_time'); ?>
                                </div>
                                
                            </div>
                            
                             <div class="col-sm-3">
                                <div class="alert alert-warning">
                                Check-In<br/>
                                RM <?php echo $_check_in_price = $_home->get_checked_in_price('all_time'); ?>
                                </div>
            
                            </div>
                            
                             <div class="col-sm-3">
                                <div class="alert alert-warning">
                                 Check-Out<br/>
                                RM <?php echo $_check_out_price = $_home->get_checked_out_price('all_time'); ?>
                                </div>
                            </div>
                            
                      </div>
                    
                     
            	<div class="clear" style="height:30px;"></div>

					<div id="chartdiv2" style="border:thick;"></div>	          
	
				<div class="clear" style="height:30px;"></div>
                           
                      
                      </div>
                  
                      
			
    
            
		<div class="clear" style="margin-bottom:20px;height:1px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>

		

		<div class="wrapper-pad">

			<h2>General Statistic</h2>

			
		<div class="clear" style="margin-bottom:20px;height:1px;"></div>

			<div id="row">

				<div class="col-sm-3">
					<div class="alert alert-danger">
                    Registered Items<br/>
					<?php echo $_home->general_registered_items(); ?>
					</div>
					

				</div>

				<div class="col-sm-3">
					<div class="alert alert-info">
                    Warehouse Items Qty<br/>
					<?php echo $_home->general_warehouse_items(); ?>
					</div>

				</div>

			
				<div class="col-sm-3">
					<div class="alert alert-success">
                    Value In Warehouse<br/>
					RM <?php echo $_home->general_warehouse_value(); ?></span>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="alert alert-success">
                    Value Checked Out<br/>
					RM <?php echo $_home->general_warehouse_checked_out(); ?>
                    </div>
				</div>

			</div>

		</div>
		<div class="clear" style="height:30px;"></div>
          
          
                	
           <!-- test -->  
         <ul class="tab">
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'London')">Low Mint</a></li>
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Low')">No-Menthol</a></li>
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Paris')">Yummy Series</a></li>
        
        </ul>

        <div id="London" class="tabcontent" style="display:block;">
     	<div id="chartdiv"></div>
     	
     	<div class="clear" style="height:40px;"></div>
	        <!--<div id="chartdiv5" class="pull-left"></div>
	        <div id="chartdiv4" class="pull-right"></div>-->
     	
        </div>
	<div id="Low" class="tabcontent">
          <div id="chartdiv7"></div>
          
           <div class="clear" style="height:40px;"></div>
	        <div id="chartdiv5" class="pull-left"></div>
	        <div id="chartdiv4" class="pull-right"></div>
        </div>
        <div id="Paris" class="tabcontent">
          <div id="chartdiv8"></div>
          <div class="clear" style="height:40px;"></div>
          <div id="boxTPD" class="pull-left"></div>
          <div id="tinYummy" class="pull-right"></div>
        </div>
   
     <!--<div class="clear" style="height:30px;"></div>
     	<hr/>
      	        <!--<div id="chartdiv3" class="pull-left"></div>-->
      		<div id="chartdiv6" class="pull-right"></div>-->
      <hr/>
     <div id="othersItem" class="pull-right"></div>
      <div class="clear" style="height:30px;"></div>
      <hr/>

        

	</div>
    <!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true" style="color:#FF0"></i>
      
      &nbsp;Alert !
    </div>
    <div class="modal-body">
    <br>
    <div style="text-align:left">
      The inventory item that less than:
      </div>
      <br>		
                   <table border="1" cellspacing="0" id="thetable1" style="width:709px;" >
                            <thead style="background-color:#e21627">
                            <tr >
                            <td style="color:#FFF;width:21px;">ID</td>
                            <td style="color:#FFF;width:323px;">NAME</td>
                            <td style="color:#FFF;width:133px;">CATEGORY</td>
                            <td style="color:#FFF;">PRICE</td>
                            <td style="color:#FFF;width:34px;">QTY</td>
                            <td style="color:#FFF;">DATE ADDED</td>
                            </tr>
                            </thead>
                          </table>  
                           <div id="tablescroll" style="overflow:auto; height:230px;text-align:left;font:12px normal Tahoma, Geneva, "Helvetica Neue", Helvetica, Arial, sans-serif;"> 
                            <table border="1" cellspacing="0" id="thetable"  class="table2excel" data-tableName="Test Table 2"> 
                                                 <tbody style="width:650px;"> 
                                                              
                                                         <?php
                                                         
                                                             while($item = $items->fetch_object()) {
                                                        ?>
                                              								 
                                                                            
                                                                                <?php 
									if(($item->category==1)|| ($item->category==2)&& ($item->qty<10000)){
										?>
										<tr data-type="element" data-id="<?php echo $item->id; ?>"  >
										<td style="width:21px;"><?php echo $item->id; ?></td>
                                                                                <td style="width:323px;"><?php echo $item->name; ?></td>
                                                                               <td style="width:133px;"><?php echo $_items->get_category_name($item->category); ?></td>
                                                                                <td style="width:58px;"><?php echo $_items->parse_price($item->price); ?></td>
                                                                                <td style="width:30px;color:#E0293C;"><?php echo $item->qty; ?></td>
										<td style="width:110px;"><?php echo $item->date_added; ?></td>
										</tr>
								<?php
                                                                      }elseif(($item->category==3)|| ($item->category==4)&& ($item->qty<15000)){
								?>
										<tr data-type="element" data-id="<?php echo $item->id; ?>"  >			
										<td style="width:21px;"><?php echo $item->id; ?></td>
                                                                                <td style="width:323px;"><?php echo $item->name; ?></td>
                                                                        <td style="width:133px;"><?php echo $_items->get_category_name($item->category); ?></td>
                                                                                <td style="width:58px;"><?php echo $_items->parse_price($item->price); ?></td>
                                                                                <td style="width:30px;color:#E0293C;"><?php echo $item->qty; ?></td>
										<td style="width:110px;"><?php echo $item->date_added; ?></td>
										</tr>
                                                               <?php
                                                                     }elseif(($item->category==5)&& (($item->qty>50000)&&($item->qty<=70000))){
								?>
										<tr data-type="element" data-id="<?php echo $item->id; ?>"  >			
										<td style="width:21px;"><?php echo $item->id; ?></td>
                                                                                <td style="width:323px;"><?php echo $item->name; ?></td>
                                                                           <td style="width:133px;"><?php echo $_items->get_category_name($item->category); ?></td>
                                                                                <td style="width:58px;"><?php echo $_items->parse_price($item->price); ?></td>
                                                                                <td style="width:30px;color:#F3FA18;"><?php echo $item->qty; ?></td>
										<td style="width:110px;"><?php echo $item->date_added; ?></td>
										</tr>
                                                                   <?php
                                                                     }elseif(($item->category==5)&& ($item->qty<=50000)){
								?>
									<tr data-type="element" data-id="<?php echo $item->id; ?>"  >
									<td style="width:21px;"><?php echo $item->id; ?></td>
                                                                                <td style="width:323px;"><?php echo $item->name; ?></td>
                                                                             <td style="width:133px;"><?php echo $_items->get_category_name($item->category); ?></td>
                                                                                <td style="width:58px;"><?php echo $_items->parse_price($item->price); ?></td>
                                                                                <td style="width:30px;color:#E0293C;"><?php echo $item->qty; ?></td>
										<td style="width:110px;"><?php echo $item->date_added; ?></td>
									</tr>
								<?php
                                                                    }elseif(($item->category==6)&& ($item->qty<=200)){
								?>
										<tr data-type="element" data-id="<?php echo $item->id; ?>"  >
										<td style="width:21px;"><?php echo $item->id; ?></td>
                                                                                <td style="width:323px;"><?php echo $item->name; ?></td>
                                                                               <td style="width:133px;"><?php echo $_items->get_category_name($item->category); ?></td>
                                                                                <td style="width:58px;"><?php echo $_items->parse_price($item->price); ?></td>
                                                                                <td style="width:30px;color:#E0293C;"><?php echo $item->qty; ?></td>
									<td style="width:110px;"><?php echo $item->date_added; ?></td>
									
									</tr>
                                                                  <?php
                                                                        }elseif(($item->category==9)&& ($item->qty<=4000)){
								?>
										<tr data-type="element" data-id="<?php echo $item->id; ?>"  >
										<td style="width:21px;"><?php echo $item->id; ?></td>
                                                                                <td style="width:323px;"><?php echo $item->name; ?></td>
                                                                               <td style="width:133px;"><?php echo $_items->get_category_name($item->category); ?></td>
                                                                                <td style="width:58px;"><?php echo $_items->parse_price($item->price); ?></td>
                                                                                <td style="width:30px;color:#E0293C;"><?php echo $item->qty; ?></td>
									<td style="width:110px;"><?php echo $item->date_added; ?></td>
									</tr>
									<?php }?>
																			
																			
                                                                            
                                                                            
                                                                            
                                                                          
                                                                             <?php
                                                                                
                                                                            }
                                                        ?>
                                                    </tbody>
                                                    </table>
                                 </div>
                 
                
        
                
                
                

    
    <br/>
     <div style="text-align:left">
     <form>
    <input type="checkbox" name="" value="A" /> Dont show this message again
    </form>
    </div>	
    <br><br>
    			<div style="text-align:right">
                
                
                				 <a href="#" class="button"  onClick="export_table();" value="export">Export to Excel</a>
                               
                             <!--  &nbsp;&nbsp; 
                                 <a href="#" id="open_print" class="button" onclick="open_print('thetable1','thetable')"><i class="fa fa-print fa-lg" aria-hidden="true" style="color:#FFF"></i>Print</a>
                                  
                             
                               -->
                               
                                &nbsp;&nbsp; 
                                 <a href="#" class="button" onClick="close_modal();" value="close">Ignore</a>
                                  
                 </div>
                
    </div>
    <br>
  </div>

</div>

<script src="../asset/bootstrap/bootstrap.js"></script>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script type="text/javascript" src="media/js/chart.js"></script>
<script>

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


</script>

<script>



document.getElementById("export").onclick
function export_table() {
		var today=new Date();
		var dd=today.getDate();
		var mm=today.getMonth();
		var yyyy=today.getFullYear();
        $(function() {
            $(".table2excel").table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "inventory_report "+dd+"-"+mm+"-"+yyyy,
					fileext: ".xls"
                    });
        });
         modal.style.display = "none";
}
</script>

<script>

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];



//When the page onload, open the modal
window.onload=function(){

	modal.style.display = "block";
	
	
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





document.getElementById("close").onclick
function close_modal() {
    modal.style.display = "none";
}

</script>
<script type="text/javascript">

var chart = AmCharts.makeChart( "tinYummy", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "Item": "Green Ape",
    "Qty": <?php echo $tingreen?>,
    "color": "#29DA14"
  }, {
    "Item": "Trap Queen",
    "Qty": <?php echo $tintrap?>,
    "color": "#FC0224"
  }, {
    "Item": "Cush Man",
    "Qty": <?php echo $tincush?>,
    "color": "#F4FC02"
  }
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Tin Yummy Series)",
    "size": 15
    
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":40000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "fillColorsField": "color",
	"fixedColumnWidth":30,
    "valueField": "Qty",
	"autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Item",
  "categoryAxis": {
	  "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );





var chart = AmCharts.makeChart( "boxTPD", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "Item": "Grape",
    "Qty": <?php echo $box011?>,
    "color": "#7F02FC"
  }, {
    "Item": "Pineapple",
    "Qty": <?php echo $box021?>,
    "color": "#0202FC"
  }, {
    "Item": "Blackurrant Lemonade",
    "Qty": <?php echo $box031?>,
    "color": "#FC02C3"
  }, {
    "Item": "Honey Dew",
    "Qty": <?php echo $box041?>,
    "color": "#FC7B02"
  }, {
    "Item": "Mango",
    "Qty": <?php echo $box051?>,
    "color": "#F4FC02"
  }, {
    "Item": "Blackurrant",
    "Qty": <?php echo $box061?>,
    "color": "#FC0224"
  }
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Box Color TPD)",
    "size": 15
    
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":5000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "fillColorsField": "color",
	"fixedColumnWidth":20,
    "valueField": "Qty",
	"autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Item",
  "categoryAxis": {
	  "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );


var chart = AmCharts.makeChart( "chartdiv8", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "#LBL01_0mg  - Cush Man (Mango)",
    "visits": <?php echo $y_lblmango0mg ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL01_3mg -  Cush Man (Mango)",
    "visits": <?php echo $y_lblmango3mg ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL01_6mg -  Cush Man (Mango)",
    "visits": <?php echo $y_lblmango6mg ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL02_0mg - Green Ape (Apple)",
    "visits": <?php echo $y_lblapple0mg ?>,
    "color": "#29DA14"

  }, {
    "country": "#LBL02_3mg - Green Ape (Apple)",
    "visits": <?php echo $y_lblapple3mg ?>,
    "color": "#29DA14"
  }, {
    "country": "#LBL02_6mg - Green Ape (Apple)",
    "visits":<?php echo $y_lblapple6mg ?>,
    "color": "#29DA14"
  }, {
    "country": "#LBL04_0mg - Trap Queen (Strawberry)",
    "visits": <?php echo $y_lblstraw0mg  ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL04_3mg - Trap Queen (Strawberry) ",
    "visits": <?php echo $y_lblstraw3mg   ?>,
    "color": "#FC0224"
  },{
    "country": "#LBL04_6mg - Trap Queen (Strawberry) ",
    "visits": <?php echo $y_lblstraw6mg  ?>,
    "color": "#FC0224"
  } 
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Label 50ml) Yummy Series",
    "size": 15
    
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":50000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "fillColorsField": "color",
	"fixedColumnWidth":20,
    "valueField": "visits",
	"autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
	  "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );





var chart = AmCharts.makeChart( "chartdiv7", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "#LBL01_0mg  - Blackcurrant",
    "visits": <?php echo $n_lblblack0mg ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL01_3mg - Blackcurrant",
    "visits": <?php echo $n_lblblack3mg   ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL01_6mg - Blackcurrant",
    "visits": <?php echo $n_lblblack6mg    ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL02_0mg - Mango",
    "visits": <?php echo $n_lblmango0mg ?>,
    "color": "#F4FC02"

  }, {
    "country": "#LBL02_3mg - Mango",
    "visits": <?php echo $n_lblmango3mg ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL02_6mg - Mango",
    "visits":<?php echo $n_lblmango6mg ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL04_0mg - Blkurrant + Lemonade ",
    "visits": <?php echo $n_lbllemon0mg ?>,
    "color": "#FC02C3"
  }, {
    "country": "#LBL04_3mg - Blkurrant + Lemonade ",
    "visits": <?php echo $n_lbllemon3mg ?>,
    "color": "#FC02C3"
  },{
    "country": "#LBL04_6mg - Blkurrant + Lemonade ",
    "visits": <?php echo $n_lbllemon6mg ?>,
    "color": "#FC02C3"
  } , {
    "country": "#LBL05_0mg - Pineapple + Lemonade ",
    "visits": <?php echo $n_lblpine0mg ?>,
    "color": "#0202FC"
  } , {
    "country": "#LBL05_3mg - Pineapple + Lemonade ",
    "visits": <?php echo $n_lblpine3mg ?>,
    "color": "#0202FC"
  }, {
    "country": "#LBL05_6mg - Pineapple + Lemonade",
    "visits": <?php echo $n_lblpine6mg ?>,
    "color": "#0202FC"
  }, {
    "country": "#LBL06_0mg - Grape ",
    "visits": <?php echo $n_lblgrape0mg ?>,
    "color": "#7F02FC"
  } , {
    "country": "#LBL06_3mg - Grape",
    "visits": <?php echo $n_lblgrape3mg ?>,
    "color": "#7F02FC"
  } , {
    "country": "#LBL06_6mg - Grape ",
    "visits": <?php echo $n_lblgrape6mg ?>,
    "color": "#7F02FC"
  } , {
    "country": "#LBL04_0mg - Honeydew ",
    "visits": <?php echo $n_lblhoney0mg ?>,
    "color": "#FC7B02"
  } , {
    "country": "#LBL03_3mg - Honeydew",
    "visits": <?php echo $n_lblhoney3mg ?>,
    "color": "#FC7B02"
  }, {
    "country": "#LBL03_6mg - Honeydew",
    "visits": <?php echo $n_lblhoney6mg ?>,
    "color": "#FC7B02"
  }
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Label 50ml) No-Menthol",
    "size": 15
    
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":50000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "fillColorsField": "color",
	"fixedColumnWidth":20,
    "valueField": "visits",
	"autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
	  "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );




var chart = AmCharts.makeChart( "othersItem", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "POCKET FILE  (PAPER)",
    "visits": <?php echo $pktfile  ?>,
    "color": "#4ACC81"
  }, {
    "country": "MAX PAPER PUNCH ",
    "visits": <?php echo $pprpunch  ?>,
    "color": "#4ACCBE"
  }, {
    "country": "YELLOW A4  ",
    "visits": <?php echo $yellowA4  ?>,
    "color": "#4A91CC"
  }, {
    "country": "RUBBISH BAG BLACK",
    "visits":<?php echo $bagblack  ?>,
    "color": "#734ACC"
  }, {
    "country": "FILE RP (PLASTIC)",
    "visits": <?php echo $filerp  ?>,
    "color": "#B84ACC"

  }, {
    "country": "#HLG01 - HOLOGRAM STICKER (BOX) ",
    "visits":<?php echo $HLG01  ?>,
    "color": "#CC4ABC"
  }, {
    "country": "RUBBISH BAG BLUE",
    "visits": <?php echo $bagblue  ?>,
  "color": "#CC4A73"
  }, {
    "country": "#SLT02 - SALLOTAPE TRANSPARENT",
    "visits": <?php echo $SLT02  ?>,
    "color": "#CC4A52"
  },{
    "country": "#SLT01 - SALLOTAPE BROWN",
    "visits": <?php echo $SLT01  ?>,
    "color": "#CCA94A"
  }, {
    "country": "#USG01 - USER GUIDE (ATTENTION MENU)",
    "visits": <?php echo $USG01  ?>,
    "color": "#77CC4A"
  }, {
    "country": "#A1PST01 - A1 Poster",
    "visits": <?php echo $A1PST01  ?>,
    "color": "#4ACC73"
  }, {
    "country": "#STK01 - Free Gift sticker",
    "visits":<?php echo $STK01  ?>,
    "color": "#4ACCCC"
  }, {
    "country": "#A3PST01 - A3 Poster",
    "visits":<?php echo $A3PST01  ?>,
    "color": "#4A6ACC"
  } , {
    "country": "#FLY01 - A4 Fyers ",
    "visits":<?php echo $FLY01  ?>,
    "color": "#914ACC"
  } ],
   "titles": [ {
  "text":"Inventory Item Quantity (Marketing Tools & Others)",
    "size": 15
    
  } ],
  "valueAxes": [ {
  "title":"Quanitity",
    "gridColor": "#FFFFFF",
  "maximum":1000000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
     "fillColorsField": "color",
  "fixedColumnWidth":20,
    "valueField": "visits",
  "autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );



//box, sticker, bottle


var chart = AmCharts.makeChart( "chartdiv6", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "#PX02 - 20pcs X 20pcs",
    "visits": <?php echo $px02  ?>,
    "color": "#D660C0"
  }, {
    "country": "#MAINSTKR - Sticker inside the box",
    "visits": <?php echo $MAINSTKR  ?>,
    "color": "#82D660"
  }, {
    "country": "#PX01 - 100pcs X 100pcs",
    "visits": <?php echo $px01  ?>,
    "color": "#F1AD1C"

  } , {
    "country": "#PX03 - 300pcs X 300pcs ( Large Box ) ",
    "visits": <?php echo $px03  ?>,
    "color": "#F11C76"

  } , {
    "country": "#SHT01 - T-shirt",
    "visits": <?php echo $SHT01  ?>,
    "color": "#1CF176"

  }],"titles": [ {
  "text":"Item Quantity (Bottle, Sticker, Box)",
    "size": 15
    
  } ],
  "valueAxes": [ {
  "title":"Quanitity",
    "gridColor": "#FFFFFF",
  "maximum":150000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
     "fillColorsField": "color",
  "fixedColumnWidth":14,
    "valueField": "visits",
  "autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );





//box color 10ml


var chart = AmCharts.makeChart( "chartdiv5", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "#BOX08 - YELLOW - Mango",
    "visits": <?php echo $box08  ?>,
    "color": "#F4FC02"
  }, {
    "country": "#BOX12 - Grape",
    "visits": <?php echo $box12  ?>,
    "color": "#7F02FC"
  }, {
    "country": "#BOX11 - BLUE - Pineapple + Lemonade",
    "visits": <?php echo $box11  ?>,
    "color": "#0202FC"
  }, {
    "country": "#BOX09 - ORANGE - Honeydew",
    "visits": <?php echo $box09  ?>
  }, {
    "country": "#BOX07 - RED - Blackcurrant",
    "visits": <?php echo $box07  ?>,
    "color": "#FC0224"

  } , {
    "country": "#BOX10 - PINK - Blackcurrant + Lemonade ",
    "visits": <?php echo $box10  ?>,
    "color": "#FC02C3"

  } ],"titles": [ {
  "text":"Inventory Item Quantity (Box Color 10ml)",
    "size": 15
    
  } ],
  "valueAxes": [ {
  "title":"Quanitity",
    "gridColor": "#FFFFFF",
  "maximum":5000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
     "fillColorsField": "color",
  "fixedColumnWidth":14,
    "valueField": "visits",
  "autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );




//box color 50ml


var chart = AmCharts.makeChart( "chartdiv4", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "#BOX01 - RED - Bad Blood ",
    "visits": <?php echo $box01  ?>,
    "color": "#FC0224"
  }, {
    "country": "#BOX02 - YELLOW - Fat Boy",
    "visits": <?php echo $box02  ?>,
    "color": "#F4FC02"
  }, {
    "country": "#BOX03 - ORANGE - Devil Teeth ",
    "visits": <?php echo $box03 ?>
  }, {
    "country": "#BOX04 - PINK - Wicked Haze",
    "visits": <?php echo $box04  ?>,
    "color": "#FC02C3"
  }, {
    "country": "#BOX05 - BLUE - Slow Blow",
    "visits": <?php echo $box05   ?>,
    "color": "#0202FC"

  } , {
    "country": "#BOX06 - PURPLE - Asap Grape ",
    "visits": <?php echo $box06    ?>,
    "color": "#7F02FC"

  } ],"titles": [ {
	"text":"Inventory Item Quantity (Box Color 50ml)",
    "size": 15
    
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":50000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
     "fillColorsField": "color",
	"fixedColumnWidth":14,
    "valueField": "visits",
	"autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
	  "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );
</script>
<!-- <script type="text/javascript">


//label 10ml


var chart = AmCharts.makeChart( "chartdiv3", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "Label": "#LBL07 - Blackcurrant",
    "total": <?php echo $lblbad10ml  ?>,
    "color": "#FC0224"
  }, {
    "Label": "#LBL08 - Mango ",
    "total": <?php echo $lblfat10ml  ?>,
    "color": "#F4FC02"
  }, {
    "Label": "#LBL09 - Honeydew",
    "total": <?php echo $lbldevil10ml ?>,
     "color": "#FC7B02"
  }, {
    "Label": "#LBL10 - Blackcurrant+Lemonade",
    "total": <?php echo $lblwicked10ml  ?>,
    "color": "#FC02C3"
  }, {
    "Label": "#LBL11 - Pineapple+Lemonade",
    "total": <?php echo $lblslow10ml   ?>,
    "color": "#0202FC"

  } , {
    "Label": "#LBL12 - Grape",
    "total": <?php echo $lblasap10ml    ?>,
    "color": "#7F02FC"

  } ],"titles": [ {
  "text":"Inventory Item Quantity (Label 10ml)",
    "size": 15
    
  } ],
  "valueAxes": [ {
  "title":"Quanitity",
    "gridColor": "#FFFFFF",
  "maximum":6000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
     "fillColorsField": "color",
  "fixedColumnWidth":14,
    "valueField": "total",
  "autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Label",
  "categoryAxis": {
    "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );
</script> -->


<script type="text/javascript">


var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "#LBL01_0mg  - Blackcurrant",
    "visits": <?php echo $lblbad0mg  ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL01_3mg - Blackcurrant",
    "visits": <?php echo $lblbad3mg  ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL01_6mg - Blackcurrant",
    "visits": <?php echo $lblbad6mg   ?>,
    "color": "#FC0224"
  }, {
    "country": "#LBL02_0mg - Mango",
    "visits": <?php echo $lblfat0mg    ?>,
    "color": "#F4FC02"

  }, {
    "country": "#LBL02_3mg - Mango",
    "visits": <?php echo $lblfat3mg ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL02_6mg - Mango",
    "visits":<?php echo $lblfat6mg     ?>,
    "color": "#F4FC02"
  }, {
    "country": "#LBL04_0mg - Blkurrant + Lemonade ",
    "visits": <?php echo $lbldevil3mg     ?>,
    "color": "#FC02C3"
  }, {
    "country": "#LBL04_3mg - Blkurrant + Lemonade ",
    "visits": <?php echo $lblwicked3mg    ?>,
    "color": "#FC02C3"
  },{
    "country": "#LBL04_6mg - Blkurrant + Lemonade ",
    "visits": <?php echo $lblwicked6mg    ?>,
    "color": "#FC02C3"
  } , {
    "country": "#LBL05_0mg - Pineapple + Lemonade ",
    "visits": <?php echo $lblslow0mg       ?>,
    "color": "#0202FC"
  } , {
    "country": "#LBL05_3mg - Pineapple + Lemonade ",
    "visits": <?php echo $lblslow3mg     ?>,
    "color": "#0202FC"
  }, {
    "country": "#LBL05_6mg - Pineapple + Lemonade",
    "visits": <?php echo $lblslow6mg     ?>,
    "color": "#0202FC"
  } , {
    "country": "#LBL06_3mg - Grape",
    "visits": <?php echo $lblasap3mg     ?>,
    "color": "#7F02FC"
  } , {
    "country": "#LBL06_0mg - Grape ",
    "visits": <?php echo $lblasap0mg      ?>,
    "color": "#7F02FC"
  }, {
    "country": "#LBL06_6mg - Grape ",
    "visits": <?php echo $lblasap6mg  ?>,
    "color": "#7F02FC"
  } , {
    "country": "#LBL04_0mg - Honeydew ",
    "visits": <?php echo $lbldevil0mg     ?>,
    "color": "#FC7B02"
  } , {
    "country": "#LBL03_3mg - Honeydew",
    "visits": <?php echo $lbldevil3mg     ?>,
    "color": "#FC7B02"
  }, {
    "country": "#LBL03_6mg - Honeydew",
    "visits": <?php echo $lbldevil6mg     ?>,
    "color": "#FC7B02"
  }
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Label 50ml) Low Mint",
    "size": 15
    
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":50000,
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "fillColorsField": "color",
	"fixedColumnWidth":20,
    "valueField": "visits",
	"autoColor": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
	  "labelRotation":70,
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );
</script>
<script type="text/javascript">



var chart = AmCharts.makeChart("chartdiv2", {
  "type": "pie",
  "startDuration": 0,
   "theme": "light",
  "addClassNames": true,
  "legend":{
   	"position":"right",
    "marginRight":100,
    "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "300%",
      "height": "300%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
   "titles": [ {
	"text":"Inventory Item Quantity (sorts by category)",
    "size": 15
    
  } ],
   
 "dataProvider": [{
    "category": "Label Sticker 50ml",
    "column-1":<?php echo $label50?>
  }, {
    "category": "Label Sticker 10ml",
    "column-1": <?php echo $label10?>
  }, {
    "category": "Box Color 50ml",
    "column-1": <?php echo $box50?>
  }, {
    "category": "Box Color 10ml",
    "column-1": <?php echo $box10?>
  }, {
    "category": "Bottle",
    "column-1": <?php echo $bottle?>
  }, {
    "category": "Box Packaging",
    "column-1": <?php echo $box_pack?>
  }, {
    "category": "Merchandise",
    "column-1": <?php echo $merchandise?>
  }, {
    "category": "Others",
    "column-1": <?php echo $others?>
  }, {
    "category": "Marketing Tools",
    "column-1": <?php echo $marketing?>
  }],
     "valueField": "column-1",
  "titleField": "category",
  "export": {
    "enabled": true
  }
});

chart.addListener("init", handleInit);

chart.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>

</body>

</html>
