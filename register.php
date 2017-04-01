<?php
$title = "home";
include 'myadmin/class/connect_db.php';
include 'components/components.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $confirmpassword = mysql_real_escape_string($_POST['confirmpassword']);
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

    if($password != $confirmpassword) {
        echo "<script language='javascript'>alert('รหัสผ่านไม่ตรงกัน!');</script>";
        echo "<script language='javascript'>window.history.back();</script>";
        exit();
    }

    $result_member=mysql_query("SELECT count(id) as countid FROM user WHERE email='".$email."'") or die(mysql_error());
    $data=mysql_fetch_assoc($result_member);
    if (empty($data['countid'])) {
        $strSQL="INSERT INTO user VALUES ('',
            '".$email."',
            '".$password."',
            '".$fname."',
            '".$lname."',
            '".$company."',
            '".$branch."',
            '".$acompanytaxid."',
            '".$address."',
            '".$province."',
            '".$country."',
            '".$postcode."',
            '".$tel."',
            '2',
            '".date("Y-m-d H:i:s")."')";
        mysql_query($strSQL) or die(mysql_error()) or die(mysql_error());
        mysql_close();
        echo "<script language='javascript'>alert('บันทึกข้อมูล เสร็จสมบูรณ์!');</script>";
        echo "<script language='javascript'>window.location='register.php'</script>";
        exit();
    }
    echo "<script language='javascript'>alert('อีเมลซ้ำ!');</script>";
    echo "<script language='javascript'>window.history.back();</script>";
}
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
        <div class="row">
            <div class="col-md-4">
                <div class="media media-bg_blue">
                    <div class="media-left media-middle">
                        <a href="#"> <img class="media-object" src="images/shopping-icon.png"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">ค้นหา</h4>
                        <p>เลือกสินค้าที่คุณต้องการ ได้อย่างสะดวกสบายทุกที่ทุกเวลา</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media media-bg_blue">
                    <div class="media-left media-middle">
                        <a href="#"> <img class="media-object" src="images/order-login.png"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">เข้าสู่ระบบ</h4>
                        <p>ลงชื่อเข้าสู่ระบบหรือสมัครสมาชิก เพื่อทำการสั่งซื้อสินค้า</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media media-bg_blue">
                    <div class="media-left media-middle">
                        <a href="#"> <img class="media-object" src="images/order-payment.png"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">ชำระเงินอย่างปลอดภัย</h4>
                        <p>สะดวก ปลอดภัย รวดเร็ว ด้วยระบบ SSL</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagin-sub-series">
            <div class="pagin-sub-line-series-left"></div>
            <h2>เข้าสู่ระบบ</h2>
            <div class="pagin-sub-line-series-right"></div>
        </div>
        <div>
            <form class="form-horizontal" action="php/login.php" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">อีเมล</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="myusername" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">รหัสผ่าน</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="mypassword" placeholder="Password" minlength="8" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="pagin-sub-series">
            <div class="pagin-sub-line-series-left"></div>
            <h2>สมัครสมาชิก</h2>
            <div class="pagin-sub-line-series-right"></div>
        </div>
        <div>
            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <label class="col-sm-2 control-label">อีเมล*</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">รหัสผ่าน*</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="Password" minlength="8" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ยืนยันรหัสผ่าน*</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm password" minlength="8" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อ*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="fname" placeholder="First name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">นามสกุล*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-sm-2 control-label">บริษัท</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="company" placeholder="Company">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">สาขา</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="branch" placeholder="Branch">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">เลขประจำตัวผู้เสียภาษี</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="acompanytaxid" placeholder="Tax Identification Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ที่อยู่*</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" name="address" rows="2" placeholder="Address" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">จังหวัด*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="province" placeholder="Province" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ประเทศ*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="country" placeholder="Country" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">รหัสไปรษณี*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="postcode" placeholder="Postcode" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">เบอร์โทรติดต่อ*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tel" placeholder="Tel." required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">สมัครสมาชิก</button>
                    </div>
                </div>
            </form>
            <hr>
        </div>

        <table border="0" cellspacing="0" cellpadding="0" class="table-list hidden-xs">
            <tbody>
                <tr>
                    <td align="center" width="25%">
                        <!-- SBC -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td align="right" width="30%" style="padding-right:10px;"><img src="images/block-feature-01-icon.png" width="30" height="32"></td>
                                    <td align="left" width="70%" style="padding-left:10px;">
                                        <div style="color:#0072bb;font-weight:bold;">HOME SERVICE</div>
                                        <div style="color:#0066b3;">บริการเพื่อคนรักบ้าน</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- EBC -->
                    </td>
                    <td><img src="images/block-next-icon.png" width="14" height="50"></td>
                    <td align="center" width="25%">
                        <!-- SBC -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td align="right" width="30%" style="padding-right:10px;"><img src="images/block-feature-02-icon.png" width="34"></td>
                                    <td align="left" width="70%" style="padding-left:10px;">
                                        <div style="color:#0072bb;font-weight:bold;">DELIVERY SERVICE</div>
                                        <div style="color:#0066b3;">บริการส่งทั่วไทย</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- EBC -->
                    </td>
                    <td><img src="images/block-next-icon.png" width="14" height="50"></td>
                    <td align="center" width="25%">
                        <!-- SBC -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td align="right" width="30%" style="padding-right:10px;"><img src="images/block-feature-03-icon.png" width="30" height="30"></td>
                                    <td align="left" width="70%" style="padding-left:10px;">
                                        <div style="color:#0072bb;font-weight:bold;">CUSTOMER SERVICE</div>
                                        <div style="color:#0066b3;">02-8316000</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- EBC -->
                    </td>
                    <td><img src="images/block-next-icon.png" width="14" height="50"></td>
                    <td align="center" width="25%">
                        <div style="color:#646466;font-weight:bold;margin-top:0px;">ติดตามเรา</div>
                        <div style="color:#646466;margin-top:5px;">
                            <a href="https://www.facebook.com/homeprothailand" target="_blank"><img src="images/facebook29.png" width="29" height="29" style="border:none;"></a>
                            <a href="https://www.youtube.com/user/homeprothai" target="_blank"><img src="images/youtube.jpg" width="29" height="29" style="border:none;"></a>
                            <!--img src="images/youtube29.png" width="29" height="29" /-->
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php footer(); ?>
</body>

</html>
