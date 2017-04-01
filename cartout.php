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
        <ol class="breadcrumb">
            <li class="active">ตระกร้าสินค้า</li>
        </ol>

        <hr>
        <table id="cart" class="table table-bordered">
            <thead>
                <tr>
                    <th style="width:50%">สินค้า</th>
                    <th style="width:10%">ราคา</th>
                    <th style="width:8%">จำนวน</th>
                    <th style="width:22%" class="text-center">รวม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Total = 0;
                $SumTotal = 0;
                foreach ($_SESSION["strProductID"] as $key => $value) {
                    if($value)
                    {
                        $strSQL = "SELECT * FROM product WHERE id = '".$value."' ";
                        $objQuery = mysql_query($strSQL)  or die(mysql_error());
                        $objResult = mysql_fetch_array($objQuery);
                        $Total = $_SESSION["strQty"][$key] * $objResult["price"];
                        $SumTotal = $SumTotal + $Total;
                    ?>
                    <tr>
                        <td data-th="สินค้า">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img src="uploads/pic_product/<?php echo $objResult['cover']; ?>" alt="<?php echo $objResult['cover']; ?>" class="img-responsive" /></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin"><?php echo $objResult["name"];?></h4>
                                    <p>รหัสสินค้า <?php echo $objResult["code"];?></p>
                                </div>
                            </div>
                        </td>
                        <td data-th="ราคา"><?php echo $objResult["price"];?></td>
                        <td data-th="จำนวน">
                            <?php echo $_SESSION["strQty"][$key];?>
                        </td>
                        <td data-th="รวม" class="text-center"><?php echo number_format($Total,2);?></td>
                    </tr>
                    <?php
                    }
                }
                ?>
                
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>รวมทั้งหมด <?php echo number_format($SumTotal,2);?></strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="row">
            <div class="col-md-5">
                <table id="cart" class="table table-bordered">
                    <tr>
                        <td>รวมเป็นเงินทั้งหมด</td>
                        <td><?php echo number_format($SumTotal,2);?></td>
                    </tr>
                </table>
                
            </div>
            <div class="col-md-7">
                <form method="post" action="php/cartconfirm.php">
                    <div class="form-group">
                        <label>ชื่อ-นามสกุล</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['fname_user']." ".$_SESSION['lname_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label>ที่อยู่</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $_SESSION['address_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทรติดต่อ</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $_SESSION['tel_user']; ?>">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <?php footer(); ?>
</body>

</html>
