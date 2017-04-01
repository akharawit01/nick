<?php session_start();
$title = $_SESSION['fname_user']." ".$_SESSION['lname_user'];
include 'myadmin/class/connect_db.php';
include 'components/components.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysql_real_escape_string($_POST['email']);
    $fname = mysql_real_escape_string($_POST['fname']);
    $lname = mysql_real_escape_string($_POST['lname']);
    $company = mysql_real_escape_string($_POST['company']);
    $branch = mysql_real_escape_string($_POST['branch']);
    $acompanytaxid = mysql_real_escape_string($_POST['acompanytaxid']);
    $address = mysql_real_escape_string($_POST['address']);
    $province = mysql_real_escape_string($_POST['province']);
    $country = mysql_real_escape_string($_POST['country']);
    $postcode = mysql_real_escape_string($_POST['postcode']);
    $tel = mysql_real_escape_string($_POST['tel']);

    $strSQL="UPDATE user SET email='".$email."',
        fname='".$fname."',
        lname='".$lname."',
        company='".$company."',
        branch='".$branch."',
        acompanytaxid='".$acompanytaxid."',
        address='".$address."',
        province='".$province."',
        country='".$country."',
        postcode='".$postcode."',
        tel='".$tel."' WHERE id='".$_POST['id']."'";
    mysql_query($strSQL) or die(mysql_error());

    mysql_close();
    echo "<script language='javascript'>alert('บันทึกข้อมูล เสร็จสมบูรณ์!');</script>";
    echo "<script language='javascript'>window.location='myuser.php'</script>";
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
                        <li class="list-group-item active">ข้อมูลส่วนตัว</li>
                        <li class="list-group-item"><a href="mypassword.php">แก้ไขรหัสผ่าน</a></li>
                        <li class="list-group-item"><a href="myorder.php">รายการสั่งซื้อ</a></li>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="pagin-sub-series">
                    <div class="pagin-sub-line-series-left"></div>
                    <h2>ข้อมูลส่วนตัว</h2>
                    <div class="pagin-sub-line-series-right"></div>
                </div>
                <form class="form-horizontal" method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $_SESSION["id_user"]; ?>">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">อีเมล*</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" value="<?php echo $objResult['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">ชื่อ*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="fname" placeholder="First name" value="<?php echo $objResult['fname']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">นามสกุล*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="lname" placeholder="Last name" value="<?php echo $objResult['lname']; ?>" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">บริษัท</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="company" value="<?php echo $objResult['company']; ?>" placeholder="Company">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">สาขา</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="branch" value="<?php echo $objResult['branch']; ?>" placeholder="Branch">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">เลขประจำตัวผู้เสียภาษี</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="acompanytaxid" value="<?php echo $objResult['acompanytaxid']; ?>" placeholder="Tax Identification Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">ที่อยู่*</label>
                        <div class="col-sm-8">
                            <textarea name="address" class="form-control" name="address" rows="4" placeholder="Address" required><?php echo $objResult['address']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">จังหวัด*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="province" placeholder="Province" value="<?php echo $objResult['province']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">ประเทศ*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo $objResult['country']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">รหัสไปรษณี*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="postcode" placeholder="Postcode" value="<?php echo $objResult['postcode']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">เบอร์โทรติดต่อ*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tel" placeholder="Tel." value="<?php echo $objResult['tel']; ?>" required>
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
