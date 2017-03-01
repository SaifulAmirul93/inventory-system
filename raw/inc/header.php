<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
   position:absolute;
   z-index: 10;
    background-color: #f9f9f9;
    min-width: 155px;
    text-align: left;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;

}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>










<?php
$headrole = $_session->get_user_role();
if($headrole == 1)
	$as = 'Administrator';
elseif($headrole == 2)
	$as = 'General Supervisor';
elseif($headrole == 3)
	$as = 'Supervisor';
elseif($headrole == 4)
	$as = 'Employee';
?>
<div id="header">
			<div class="left">
				<a href="home.php"><img src="media/img/logo3x.png" width="150" height="50" alt="Invento" /></a>
				<div style="font-size:12px; font-style:italic;color:#bbb;"><?php echo $as; ?></div>
			</div>
			<div class="right">
				<?php
				if($headrole == 1 || $headrole == 2 || $headrole == 3)
					echo '<a href="users.php" title="Users">Users</a>|';
				?>
				<a href="settings.php" title="Settings">Settings</a>|
				<a href="logout.php" title="Logout">Logout</a>
			</div>
			<div class="clear"></div>
		</div>
		
		<input type="checkbox" class="toggle" id="opmenu" style="display:none"/>
		<label for="opmenu" id="open-menu"><i class="fa fa-align-justify"></i> Menu</label>
		<div id="menu">
			<ul id="menuli">
				<?php
				// Home only for Admin and General Supervisor (Stats)
				if($headrole == 1 || $headrole == 2) {
				?>
					<li<?php if($_page == 1) { ?> class="active"<?php } ?>><a href="home.php" title="Home"><i class="fa fa-home"></i> Home</a></li>
				<?php
				}
				?>
				
				<?php
				// Add Item only for Admin, General Supervisor and Supervisor
				if($headrole == 1 || $headrole == 2 || $headrole == 3){
				?>
					<li<?php if($_page == 2) { ?> class="active"<?php } ?>><a href="new-item.php" title="New Item"><i class="fa fa-plus"></i> New Item</a></li>
				<?php
				}
				?>
				 <div class="dropdown">
				<li<?php if($_page == 3) { ?> class="active"<?php } ?>>
				
				<a href="#" title="Items" class="dropbtn"><i class="fa fa-list-ul"></i> Items</a></li>
						 <div id="myDropdown" class="dropdown-content">
		                            	<li>
		                                    <ul><a href="items.php?type=1">Label Sticker 50ml</a></ul>
		                                    <ul><a href="items.php?type=2">Label Sticker 10ml</a></ul>
		                                    <ul><a href="items.php?type=3">Box Color 50ML</a></ul>
		                                    <ul><a href="items.php?type=4">Box Color 10ML</a></ul>
		                                    <ul><a href="items.php?type=5">Bottle</a></ul>
		                                    <ul><a href="items.php?type=6">Box Packaging</a></ul>
		                                    <ul><a href="items.php?type=7">Merchandise</a></ul>
		                                    <ul><a href="items.php?type=9">Marketing Tools</a></ul>
		                                    <ul><a href="items.php?type=12">Tin</a></ul>
		                                    <ul><a href="items.php?type=13">Box Color TPD</a></ul>
		                                    <ul><a href="items.php?type=8">Others</a></ul>
		                                    
		                                    
		                                </li>
		                           </div> 
				
				
				</div>
				<li<?php if($_page == 4) { ?> class="active"<?php } ?>><a href="check-in.php" title="Check-In Item"><i class="fa fa-arrow-down"></i> Check-In Item</a></li>
				<li<?php if($_page == 5) { ?> class="active"<?php } ?>><a href="check-out.php" title="Check-Out Item"><i class="fa fa-arrow-up"></i> Check-Out Item</a></li>
				
				<?php
				// Add Item only for Admin, General Supervisor and Supervisor
				if($headrole == 1 || $headrole == 2 || $headrole == 3){
				?>
					 <div class="dropdown">
					<li <?php if($_page == 6) { ?> class="active"<?php } ?>>
                      
                       <a href="#" title="Logs" class="dropbtn" >
                       <i class="fa fa-file-text-o"></i> Logs</a></li>
                            <div id="myDropdown" class="dropdown-content">
                            	<li>
                                    <ul><a href="logs.php?type=1">Check-In</a></ul>
                                    <ul><a href="logs.php?type=2">Check-Out</a></ul>
                                    <ul><a href="logs.php?type=3">Price Change</a></ul>
                                </li>
                           </div> 
                  </div>
                      
                           
                      
                    </li>
                    
				<?php
				}
				?>
				<li<?php if($_page == 7) { ?> class="active"<?php } ?>><a href="categories.php" title="Categories"><i class="fa fa-folder"></i> Categories</a></li>
			</ul>
		</div>