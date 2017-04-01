<?php session_start();
$title = $_SESSION['fname_user']." ".$_SESSION['lname_user'];
include 'myadmin/class/connect_db.php';
include 'components/components.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldpassword = mysql_real_escape_string($_POST['oldpassword']);
    $newpassword = mysql_real_escape_string($_POST['newpassword']);
    $cfnewpassword = mysql_real_escape_string($_POST['cfnewpassword']);

    $strSQL = "SELECT * FROM user WHERE id='".$_POST['id']."'";
    $objQuery = mysql_query($strSQL) or die(mysql_error());
    $objResult = mysql_fetch_array($objQuery);

    if ($objResult['password']==$oldpassword) {
        if ($newpassword==$cfnewpassword) {
            $strSQL="UPDATE user SET password='".$newpassword."' WHERE id='".$_POST['id']."'";
            mysql_query($strSQL) or die(mysql_error());
            echo "<script language='javascript'>alert('แก้ไขข้อมูล เสร็จสมบูรณ์!');</script>";
        }else {
            echo "<script language='javascript'>alert('รหัสผ่านใหม่ไม่ตรงกัน!');</script>";
        }
    }else {
        echo "<script language='javascript'>alert('รหัสผ่านเก่าไม่ถูกต้อง!');</script>";
    }
    echo "<script language='javascript'>window.location='mypassword.php'</script>";
}


$strSQL = "SELECT * FROM user WHERE id='".$_SESSION["id_user"]."'";
$objQuery = mysql_query($strSQL) or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php stylesheet($title); ?>
</head>

<body>
    <?php topHeader(); ?>
    <div class="container">
        <?php navHeader(); ?>
        <ol class="breadcrumb">
            <li class="active">
                <?php
                if (!empty($_SESSION['id_user'])) {
                ?>
                    <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['fname_user']." ".$_SESSION['lname_user']; ?>
                <?php
                }
                ?>
            </li>
        </ol>

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        รายการ
                    </div>
                    <div class="list-group">
                        <li class="list-group-item"><a href="myuser.php">ข้อมูลส่วนตัว</a></li>
                        <li class="list-group-item active">แก้ไขรหัสผ่าน</li>
                        <li class="list-group-item"><a href="myorder.php">รายการสั่งซื้อ</a></li>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="pagin-sub-series">
                    <div class="pagin-sub-line-series-left"></div>
                    <h2>แก้ไขรหัสผ่าน</h2>
                    <div class="pagin-sub-line-series-right"></div>
                </div>
                <form class="form-horizontal" method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $_SESSION["id_user"]; ?>">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">รหันผ่านเดิม*</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="oldpassword" minlength="8" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">รหัสผ่านใหม่*</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="newpassword" minlength="8" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">ยืนยันรหัสผ่านใหม่*</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="cfnewpassword" minlength="8" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-success"> บันทึกข้อมูล </button>
                            <button type="reset" class="btn btn-primary"> ล้างค่า </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    <?php footer(); ?>
</body>

</html>
