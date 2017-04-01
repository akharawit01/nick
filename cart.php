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
        <table id="cart" class="table table-bordered">
            <thead>
                <tr>
                    <th style="width:50%">สินค้า</th>
                    <th style="width:10%">ราคา</th>
                    <th style="width:8%">จำนวน</th>
                    <th style="width:22%" class="text-center">รวม</th>
                    <th style="width:10%"></th>
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

                        $totaldis = $objResult['price']-(($objResult['price']*$objResult['discount'])/100);
                        $Total = $_SESSION["strQty"][$key] * $totaldis;
                        $SumTotal = $SumTotal + $Total;


                    ?>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img src="uploads/pic_product/<?php echo $objResult['cover']; ?>" alt="<?php echo $objResult['cover']; ?>" class="img-responsive" /></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin"><?php echo $objResult["name"];?></h4>
                                    <p>รหัสสินค้า <?php echo $objResult["code"];?></p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price"><?php echo number_format($totaldis,2);?></td>
                        <form action="php/update.php" method="get">
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center" name="qty" value="<?php echo $_SESSION["strQty"][$key];?>">
                            <input type="hidden" name="Line" value="<?php echo $key;?>">
                        </td>
                        <td data-th="Subtotal" class="text-center"><?php echo number_format($Total,2);?></td>
                        <td class="actions" data-th="">
                            <button type="submit" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-refresh"></i></button>
                            <a href="php/delete.php?Line=<?php echo $key;?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                        </form>
                    </tr>
                    <?php
                    }
                }
                ?>
                
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>จำนวนเงินสุทธิ <?php echo number_format($SumTotal,2);?></strong></td>
                </tr>
                <tr>
                    <td><a onclick="history.go(-1);" class="btn btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> เลือกสินค้า</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>จำนวนเงินสุทธิ <?php echo number_format($SumTotal,2);?></strong></td>
                    <?php
                    if (!empty($_SESSION['id_user'])) {
                    ?>
                        <td><a href="cartout.php" class="btn btn-success btn-block">ยืนยันการสั่งซื้อ <i class="glyphicon glyphicon-chevron-right"></i></a></td>
                    <?php
                    }else {
                    ?>
                        <td><a href="#" onClick="alert('กรุณาเข้าสู่ระบบก่อนค่ะ!')" class="btn btn-success btn-block">ยืนยันการสั่งซื้อ <i class="glyphicon glyphicon-chevron-right"></i></a></td>
                    <?php
                    }
                    ?>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php footer(); ?>
</body>

</html>
