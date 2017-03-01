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
$finished = $_items->count_items_finished();
$unfinished = $_items->count_items_unfinished();

//finished item
$bad0mg =  $_items->count_items_quantity(1);
$bad3mg =  $_items->count_items_quantity(2);
$bad6mg =  $_items->count_items_quantity(4);
$fat0mg =  $_items->count_items_quantity(5);
$fat3mg =  $_items->count_items_quantity(6);
$fat6mg =  $_items->count_items_quantity(7);
$devil0mg =  $_items->count_items_quantity(8);
$devil3mg =  $_items->count_items_quantity(9);
$devil6mg =  $_items->count_items_quantity(10);
$slow0mg =  $_items->count_items_quantity(11);
$slow3mg =  $_items->count_items_quantity(12);
$slow6mg =  $_items->count_items_quantity(13);
$wicked0mg =  $_items->count_items_quantity(14);
$wicked3mg =  $_items->count_items_quantity(15);
$wicked6mg =  $_items->count_items_quantity(16);
$asap0mg =  $_items->count_items_quantity(17);
$asap3mg =  $_items->count_items_quantity(18);
$asap6mg =  $_items->count_items_quantity(19);

//Unfinished item
$un_slow3mg =  $_items->count_items_quantity(34);
$un_slow6mg =  $_items->count_items_quantity(35);
$un_wicked0mg =  $_items->count_items_quantity(36);
$un_wicked3mg =  $_items->count_items_quantity(37);
$un_wicked6mg =  $_items->count_items_quantity(38);
$un_asap6mg =  $_items->count_items_quantity(40);
$un_asap3mg =  $_items->count_items_quantity(41);
$un_slow0mg =  $_items->count_items_quantity(33);
$un_devil6mg =  $_items->count_items_quantity(32);
$un_devil3mg =  $_items->count_items_quantity(31);
$un_devil0mg =  $_items->count_items_quantity(30);
$un_fat6mg =  $_items->count_items_quantity(29);
$un_fat3mg =  $_items->count_items_quantity(28);
$un_fat0mg =  $_items->count_items_quantity(27);
$un_bad6mg =  $_items->count_items_quantity(22);
$un_bad3mg =  $_items->count_items_quantity(21);
$un_bad0mg =  $_items->count_items_quantity(20);
$un_asap0mg =  $_items->count_items_quantity(42);
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
#chartdiv3 {
	width		: 100%;
	height		: 500px;
	font-size	: 14px;
}	
#chartdiv2 {
  width: 100%;
  height: 300px;
  font-size: 11px;
 
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
#chartdiv {
	width		: 100%;
	height		: 500px;
	font-size	: 14px;
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
    border: 1px solid #ccc;
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
    border: 1px solid #ccc;
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
		

				
			<!--<ul id="selectors">

				<li class="selected" value="today">TODAY</li>

				<li value="this_week">THIS WEEK</li>

				<li value="this_month">THIS MONTH</li>

				<li value="this_year">THIS YEAR</li>

				<li value="all_time">ALL TIME</li>

			</ul>-->

			

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

					<div id="chartdiv2"></div>	          
	
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
		<div class="clear" style="height:10px;"></div>
      <hr/>
        <!-- test -->  
         <ul class="tab">
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'London')">Finished Product</a></li>
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Paris')">Unfinished Product</a></li>
        
        </ul>

        <div id="London" class="tabcontent">
      <div id="chartdiv"></div>  
        </div>

        <div id="Paris" class="tabcontent">
          <div id="chartdiv3"></div>
        </div>

      
          <!-- test -->



         
	
		
		
        <br><br>	
	</div>
     <div class="clear" style="height:30px;"></div>
      <div class="clear" style="height:30px;"></div>
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
      The inventory item that less than 500:
      </div>
      <br>		<div id="thetable1">
                   <table border="1" cellspacing="0" id="thetable1" style="width:709px;" >
                            <thead style="background-color:#e21627">
                            <tr >
                            <td style="color:#FFF;width:21px;">ID</td>
                            <td style="color:#FFF;width:328px;">NAME</td>
                            <td style="color:#FFF;width:133px;">CATEGORY</td>
                            <td style="color:#FFF;">PRICE</td>
                            <td style="color:#FFF;width:34px;">QTY</td>
                            <td style="color:#FFF;">DATE ADDED</td>
                            </tr>
                            </thead>
                          </table>
                            
                           <div id="tablescroll" style="overflow:auto; height:230px;text-align:left;font:12px normal Tahoma, Geneva, 'Helvetica Neue', Helvetica, Arial, sans-serif;"> 
                            <table border="1" cellspacing="0" id="thetable"  class="table2excel" data-tableName="Test Table 2"> 
                                                 <tbody style="width:650px;"> 
                                                           
                                                         <?php
                                                         
                                                   
                                               
                                                             while($item = $items->fetch_object()) {
                                                            
                                                        ?>
                                                        					
                                              			
                                                                        
                                                                        
                                                                        
                                                                        <?php 
									if(($item->qty<=500)){
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
                                                                                }
                                                                            
                                                        ?>
   
                                                                                
                                                                           <?php
                                                                                }
                                                                            
                                                        ?>
                                                    </tbody>
                                                    </table>
                                 </div>
                                 
                               </div>
                 
                
        
                
                
                

    
    <br/>
     <div style="text-align:left">
     <form>
    <input type="checkbox" name="" value="A" /> Don't show this message again
    </form>
    </div>	
    <br><br>
    			<div style="text-align:right">
                
                
                				 <a href="#" class="button"  onClick="export_table();" value="export" id="export">Export to Excel</a>
                                 <!--&nbsp;&nbsp; 
                                 <a href="#" id="open_print" class="button" onclick="open_print();" value="open_print"><i class="fa fa-print fa-lg" aria-hidden="true" style="color:#FFF"></i>Print</a>
                                  
                             
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

/*document.getElementById("open_print").onclick
function open_print(){
		var printdiv=document.getElementById('thetable1');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">'+printdiv.innerHTML+'</body></html>');
		newWin.document.close();
		setTimeout(Function(){newWin.close();},10);
		
		
}*/



document.getElementById("close").onclick
function close_modal() {
    modal.style.display = "none";
}



</script>



<script type="text/javascript">

// AmCharts.addInitHandler(function(chart) {
//   // check if there are graphs with autoColor: true set
//   for(var i = 0; i < chart.graphs.length; i++) {
//     var graph = chart.graphs[i];
//     if (graph.autoColor !== true)
//       continue;
//     var colorKey = "autoColor-"+i;
//     graph.lineColorField = colorKey;
//     graph.fillColorsField = colorKey;
//     for(var x = 0; x < chart.dataProvider.length; x++) {
//       var color = chart.colors[x]
//       chart.dataProvider[x][colorKey] = color;
//     }
//   }
  
// }, ["serial"]);


var chart = AmCharts.makeChart( "chartdiv3", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "country": "3mg  Grape 50ml 70/30 ",
    "visits": <?php echo $un_asap0mg ?>,
    "color": "#AC43F5"

  }, {
    "country": "3mg  Grape 50ml 70/30 ",
    "visits": <?php echo $un_asap3mg?>,
    "color": "#AC43F5"
  }, {
    "country": "6mg  Grape 50ml 70/30 ",
    "visits": <?php echo $un_asap6mg ?>,
    "color": "#AC43F5"
  }, {
    "country": "0mg Honey Dew 50ml 70/30 ",
    "visits": <?php echo $un_devil0mg  ?>,
    "color": "#FB8600"
  }, {
    "country": "3mg Honey Dew 50ml 70/30 ",
    "visits": <?php echo $un_devil3mg  ?>,
    "color": "#FB8600"
  },  {
    "country": "6mg Honey Dew 50ml 70/30 ",
    "visits": <?php echo $un_devil6mg  ?>,
    "color": "#FB8600"
  }, {
    "country": "0mg Pineapple Lemonade 50ml 70/30 ",
    "visits": <?php echo $un_slow0mg ?>,
    "color": "#5667F8"
  }, {
    "country": "3mg Pineapple Lemonade 50ml 70/30 ",
    "visits": <?php echo $un_slow3mg ?>,
    "color": "#5667F8"
  }, {
    "country": "6mg  Pineapple Lemonade 50ml 70/30 ",
    "visits": <?php echo $un_slow6mg  ?>,
    "color": "#5667F8"
  },
   {
    "country": "0mg Blackurrant Lemonade 50ml 70/30 ",
    "visits": <?php echo $un_wicked0mg ?>,
    "color": "#FB00D5"
  },{
    "country": "3mg Blackurrant Lemonade 50ml 70/30 ",
    "visits": <?php echo $un_wicked3mg  ?>,
    "color": "#FB00D5"
  }, {
    "country": "6mg Blackurrant Lemonade 50ml 70/30 ",
    "visits": <?php echo $un_wicked6mg ?>,
    "color": "#FB00D5"
  } ,
   {
    "country": "0mg Blackcurrant 50ml 70/30  ",
    "visits": <?php echo $un_bad0mg ?>,
    "color": "#EE0A37"
  }   , {
    "country": "3mg Blackcurrant 50ml 70/30 ",
    "visits": <?php echo $un_bad3mg ?>,
    "color": "#EE0A37"
  }, {
    "country": "6mg Blackcurrant 50ml 70/30 ",
    "visits": <?php echo $un_bad6mg ?>,
    "color": "#EE0A37"
  }, {
    "country": "0mg Mango 50ml 70/30 ",
    "visits": <?php echo $un_fat0mg  ?>,
    "color": "#FFFF00"
  }
  , {
    "country": "3mg Mango 50ml 70/30 ",
    "visits": <?php echo $un_fat3mg  ?>,
    "color": "#FFFF00"
  }
  , {
    "country": "6mg Mango 50ml 70/30 ",
    "visits": <?php echo $un_fat6mg  ?>,
    "color": "#FFFF00"
  }
 
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Unfinished Product)",
    "size": 14   
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":100,
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

// AmCharts.addInitHandler(function(chart) {
//   // check if there are graphs with autoColor: true set
//   for(var i = 0; i < chart.graphs.length; i++) {
//     var graph = chart.graphs[i];
//     if (graph.autoColor !== true)
//       continue;
//     var colorKey = "autoColor-"+i;
//     graph.lineColorField = colorKey;
//     graph.fillColorsField = colorKey;
//     for(var x = 0; x < chart.dataProvider.length; x++) {
//       var color = chart.colors[x]
//       chart.dataProvider[x][colorKey] = color;
//     }
//   }
  
// }, ["serial"]);



var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [  {
    "country": "0mg  Grape 50ml 70/30 ",
    "visits": 100,
    "color": "#AC43F5"
  }, {
    "country": "3mg  Grape 50ml 70/30 ",
    "visits": <?php echo $asap3mg?>,
    "color": "#AC43F5"
  }, {
    "country": "6mg  Grape 50ml 70/30 ",
    "visits": <?php echo $asap6mg ?>,
    "color": "#AC43F5"
  }, {
    "country": "0mg Honey Dew 50ml 70/30 ",
    "visits": <?php echo $devil0mg  ?>,
    "color": "#FB8600"
  }, {
    "country": "3mg Honey Dew 50ml 70/30 ",
    "visits": <?php echo $devil3mg  ?>,
    "color": "#FB8600"
  },  {
    "country": "6mg Honey Dew 50ml 70/30 ",
    "visits": <?php echo $devil6mg  ?>,
    "color": "#FB8600"
  }, {
    "country": "0mg Pineapple Lemonade 50ml 70/30 ",
    "visits": <?php echo $slow0mg ?>,
    "color": "#5667F8"
  }, {
    "country": "3mg Pineapple Lemonade 50ml 70/30 ",
    "visits": <?php echo $slow3mg ?>,
    "color": "#5667F8"
  }, {
    "country": "6mg  Pineapple Lemonade 50ml 70/30 ",
    "visits": <?php echo $slow6mg  ?>,
    "color": "#5667F8"
  },
   {
    "country": "0mg Blackurrant Lemonade 50ml 70/30 ",
    "visits": <?php echo $wicked0mg ?>,
    "color": "#FB00D5"
  },{
    "country": "3mg Blackurrant Lemonade 50ml 70/30 ",
    "visits": <?php echo $wicked3mg  ?>,
    "color": "#FB00D5"
  }, {
    "country": "6mg Blackurrant Lemonade 50ml 70/30 ",
    "visits": <?php echo $wicked6mg ?>,
    "color": "#FB00D5"
  } ,
   {
    "country": "0mg Blackcurrant 50ml 70/30  ",
    "visits": <?php echo $bad0mg ?>,
    "color": "#EE0A37"
  }   , {
    "country": "3mg Blackcurrant 50ml 70/30 ",
    "visits": <?php echo $bad3mg ?>,
    "color": "#EE0A37"
  }, {
    "country": "6mg Blackcurrant 50ml 70/30 ",
    "visits": <?php echo $bad6mg ?>,
    "color": "#EE0A37"
  }, {
    "country": "0mg Mango 50ml 70/30 ",
    "visits": <?php echo $fat0mg  ?>,
    "color": "#FFFF00"
  }
  , {
    "country": "3mg Mango 50ml 70/30 ",
    "visits": <?php echo $fat3mg  ?>,
    "color": "#FFFF00"
  }
  , {
    "country": "6mg Mango 50ml 70/30 ",
    "visits": <?php echo $fat6mg  ?>,
    "color": "#FFFF00"
  }
 
  ],
   "titles": [ {
	"text":"Inventory Item Quantity (Finished Product)",
    "size": 14   
  } ],
  "valueAxes": [ {
	"title":"Quanitity",
    "gridColor": "#FFFFFF",
	"maximum":10000,
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
      "width": "200%",
      "height": "200%",
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
    "country": "Finished Product",
    "litres": <?php echo $finished?>
  }, {
    "country": "Unfinished Product",
    "litres": <?php echo $unfinished?>
  }],
  "valueField": "litres",
  "titleField": "country",
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
