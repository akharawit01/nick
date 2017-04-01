<?php session_start();
include("include/function.php");
include("class/connect_db.php");
include("modules/home/home_function.php");
include("modules/catagory/catagory_function.php");
include("modules/contact/contact_function.php");


include("modules/news/news_function.php");

$module=empty($_GET['module'])?"":$_GET['module'];
$action=empty($_GET['action'])?"":$_GET['action'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Page - My Admin</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<?php fn_link(); ?>
	</head>

	<body class="no-skin">

		<div class="wrapper">
		    <?php fn_nav(); ?>
		    <div class="main-panel">
				<?php fn_topnav(); ?>
		        <div class="content">
		            <div class="container-fluid">
		                
		                <?php
						if(!empty($module)){
						 	getmodules($module,$action);
						}else {
							getmodules('home','home_index');
						}
				        ?>

		            </div>
		        </div>
		        <?php fn_footer(); ?>
		    </div>
		</div>
		<?php fn_script(); ?>
	</body>


</html>
