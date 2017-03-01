<?php
require 'config.php';
require 'inc/session.php';
require 'inc/ejuice_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 19;

$role = $_session->get_user_role();
if($role != 1 && $role != 2)
	header('Location: ejuice.php');

if(isset($_POST['act'])) {
	if($_POST['act'] == '1') {
		if(!isset($_POST['name']) || $_POST['name'] == '')
			die('wrong');
		if($_ejuice->new_lineup($_POST['name'], $_POST['desc']) == true)
			die('1');
		die('wrong');
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<?php require 'inc/head.php'; ?>
</head>
<body>
	<div id="main-wrapper">
		<?php require 'inc/header.php'; ?>
		
		<div class="wrapper-pad">
			<h2>New Lineup Series</h2>
			<div class="center">
				<div class="new-cat form">
					<form method="post" action="" name="new-ejuice">
						Lineup Name:<br />
						<div class="ni-cont">
							<input type="text" name="nejuice-name" class="ni"/>
						</div>
					
						<span class="ncat-desc-left">Lineup Description (400 characters):</span><br />
						<div class="ni-cont">
							<textarea name="nejuice-descrp" class="ni"></textarea>
						</div>
						<input type="submit" name="nuser-submit" class="ni btn blue" value="Create new Lineup" />
					</form>
				</div>
			</div>
		</div>
		
		<div class="clear" style="margin-bottom:40px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
	</div>
</body>
</html>