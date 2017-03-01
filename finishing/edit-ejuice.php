<?php
require 'config.php';
require 'inc/session.php';
require 'inc/ejuice_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 14;

$role = $_session->get_user_role();
// Only Admin and General Supervisor can edit categories
if($role != 1 && $role != 2)
	header('Location: categories.php');

if(isset($_POST['act'])) {
	if($_POST['act'] == '1') {
		if($_POST['id'] == '' || $_POST['name'] == '' || $_POST['desc'] == '')
			die('wrong');
	/*	if(!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['desc']))
			die('wrong');*/
/*		if($_POST['id'] == '' || $_POST['name'] == '')
			die('wrong');
		*/
		$ejuiceid = $_POST['id'];
		$name = $_POST['name'];
		
		$desc = $_POST['desc'];
		
		if($_ejuice->get_ejuice($ejuiceid, $name, $desc) == true)
			die('1');
		die('wrong');
	}
}

if(!isset($_GET['id']))
	header('Location: ejuice.php');
$ejuice = $_ejuice->get_ejuice($_GET['id']);
if(!$ejuice->id)
	header('Location: ejuice.php');
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
			<h2>Edit Lineup Series</h2>
			<div class="center">
				<div class="form">
					<form method="post" action="" name="edit-cat" data-id="<?php echo $ejuice->id; ?>">
						Lineup Name:<br />
						<div class="ni-cont">
							<input type="text" name="ncat-name" class="ni" value="<?php echo $ejuice->name; ?>" />
						</div>
					
						<span class="ncat-desc-left">Lineup Description (<?php echo 400-strlen($ejuice->descrp); ?> characters left):</span><br />
						<div class="ni-cont">
							<textarea name="ncat-descrp" class="ni"><?php echo $ejuice->descrp; ?></textarea>
						</div>
						<input type="submit" name="ncat-submit" class="ni btn blue" value="Save Lineup" />
					</form>
				</div>
			</div>
		</div>
		
		<div class="clear" style="margin-bottom:40px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
	</div>
</body>
</html>