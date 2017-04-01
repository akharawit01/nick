<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("include/function.php");
include("class/connect_db.php");
include("modules/home/home_function.php");
include("modules/photoslide/photoslide_function.php");
include("modules/news/news_function.php");
include("modules/catagory/catagory_function.php");
include("modules/tag/tag_function.php");
include("modules/product/product_function.php");
include("modules/contact/contact_function.php");
include("modules/unit/unit_function.php");
include("modules/profile/profile_function.php");
include("modules/user/user_function.php");

$module=empty($_GET['module'])?"":$_GET['module'];
$action=empty($_GET['action'])?"":$_GET['action'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php fn_link(); ?>
</head>

<body>

    <?php
    // login
    if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['myusername'])) {
        $myusername = mysql_real_escape_string($_POST['myusername']);
        $mypassword = mysql_real_escape_string($_POST['mypassword']); 

        $sql = "SELECT id,email,fname,lname FROM user WHERE email='$myusername' AND password='$mypassword' AND type=0";
        $result = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_array($result);
        $count = mysql_num_rows($result);

        if($count == 1) {
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['email_user'] = $myusername;
            $_SESSION['fname_user'] = $row['fname'];
            $_SESSION['lname_user'] = $row['lname'];
        }
        header("location: index.php");
        exit();
    }
    // logout
    if (!empty($_GET['lg'])) {
        unset($_SESSION["id_user"]);
        unset($_SESSION["email_user"]);
        unset($_SESSION["fname_user"]);
        unset($_SESSION["lname_user"]);
        header("location: index.php");
        exit();
    }
    ?>

    <?php if (!empty($_SESSION['id_user'])): ?>
    <!--Header-part-->
    <?php fn_topnav(); ?>
    <div id="content">
    	<?php
		if(!empty($module)){
		 	getmodules($module,$action);
		}else {
			getmodules('home','home_index');
		}
        ?>
    </div>
    <!--Footer-part-->
    <?php fn_footer(); ?>
    <?php else: ?>

    <div id="loginbox">
        <form id="loginform" class="form-vertical" method="post" action="">
            <div class="control-group normal_text">
                <h3><img src="assets/img/logo.png" alt="Logo"></h3></div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                        <input type="text" name="myusername" placeholder="email" required="required">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                        <input type="password" name="mypassword" placeholder="Password" required="required">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                <span class="pull-right"><button type="submit" class="btn btn-success"> Login</button></span>
            </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical" data-parsley-validate>
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lo"><i class="icon-envelope"></i></span>
                    <input type="text" placeholder="E-mail address">
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/matrix.login.js"></script>
    <?php endif; ?>
</body>

</html>
