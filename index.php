<?php session_start();
$title = "home";
include 'myadmin/class/connect_db.php';
include 'components/components.php';
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
        <div>
            <ul class="bxslider">
                <?php
                $result_photoslide=mysql_query("SELECT * FROM photoslide ORDER BY sort ASC,id DESC") or die(mysql_error());
                while ($row_photoslide = mysql_fetch_array($result_photoslide)) { 
                ?>
                <li><img src="uploads/pic_photoslide/<?php echo $row_photoslide['name']; ?>" width="100%"></li>
                <?php } ?>
            </ul>
        </div>
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
        <div class="calcula">
           xxx
        </div>

        <article class="row">
            <div class="col-lg-12">
                <div class="pagin-sub-series">
                    <div class="pagin-sub-line-series-left"></div>
                    <h2>สินค้าใหม่</h2>
                    <div class="pagin-sub-line-series-right"></div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <div class="thumbnail">
                    <div class="hovereffect">
                        <a href="product.php">
                            <img src="images/pd1.jpg" alt="...">
                            <div class="overlay">
                                <h2><span class="glyphicon glyphicon-search"></span></h2>
                            </div>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="caption">
                        <h4>นิวเลิฟลี่เนื้อ<br><small>DD0215</small></h4>
                        <div class="text-right">
                            <span class="price">฿179.00</span> / ตร.ม. </span>
                        </div>
                        <p><a href="#" class="btn btn-cart" role="button"><span></span></a></p>
                    </div>
                </div>
            </div>
        </article>
        <article class="row">
            <div class="col-lg-12">
                <div class="pagin-sub-series">
                    <div class="pagin-sub-line-series-left"></div>
                    <h2>สินค้าขายดี</h2>
                    <div class="pagin-sub-line-series-right"></div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <div class="thumbnail">
                    <div class="hovereffect">
                        <a href="product.php">
                            <img src="images/pd1.jpg" alt="...">
                            <div class="overlay">
                                <h2><span class="glyphicon glyphicon-search"></span></h2>
                            </div>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="caption">
                        <h4>นิวเลิฟลี่เนื้อ<br><small>DD0215</small></h4>
                        <div class="text-right">
                            <span class="price">฿179.00</span> / ตร.ม. </span>
                        </div>
                        <p><a href="#" class="btn btn-cart" role="button"><span></span></a></p>
                    </div>
                </div>
            </div>
        </article>
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
