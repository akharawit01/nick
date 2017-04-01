<?php session_start();
include 'myadmin/class/connect_db.php';
include 'components/components.php';

$result_products=mysql_query("SELECT * FROM product WHERE id='".$_GET['id']."'") or die(mysql_error());
$row_products = mysql_fetch_array($result_products);

$result_type=mysql_query("SELECT name FROM catagory WHERE id='".$row_products['catagory']."'") or die(mysql_error());
$row_type = mysql_fetch_array($result_type);

$result_unit=mysql_query("SELECT name FROM unit WHERE id='".$row_products['unit']."'") or die(mysql_error());
$row_unit = mysql_fetch_array($result_unit);

$title = $row_products['name'];


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
            <li><a href="index.php">หน้าหนัก</a></li>
            <li><a href="list.php?sub=<?php echo $row_products['catagory']; ?>"><?php echo $row_type['name']; ?></a></li>
            <li class="active"><?php echo $row_products['code']; ?></li>
        </ol>
        <div class="row">
            <div class="col-md-4">
                <img src="uploads/pic_product/<?php echo $row_products['cover']; ?>" alt="<?php echo $row_products['cover']; ?>" width="100%">
                <br>
                <a href="php/store_items.php?ProductID=<?php echo $row_products["id"];?>" class="btn btn-cart cart"><span></span></a>
            </div>
            <div class="col-md-8">
                <div class="product-shop">
                    <div class="product-name">
                        <label>รหัสสินค้า</label><span>:</span> <strong><?php echo $row_products['code']; ?></strong>
                        <h1><?php echo $row_products['name']; ?></h1>
                        <p class="availability in-stock">สถานะ: 
                            <span>
                            <?php
                            if (!empty($row_products['amount'])) {
                                echo "ในคลังสินค้า";
                            }else {
                                echo "สินค้าหมด";
                            }
                            ?>
                            </span>
                        </p>
                        <h4><span class="price">฿<?php echo $row_products['price']; ?></span> / <?php echo $row_unit['name']; ?> </h4>
                    </div>
                    <div class="product-details-text">
                        <h3>รายละเอียด</h3>
                        <span class="full"><label>ประเภท</label><span>:</span> <?php echo $row_type['name']; ?> </span>
                        <span class="full"><label>ขนาด</label><span>:</span> <?php echo $row_products['size']; ?> </span>
                        <span class="full"><label>ยี่ห้อ</label><span>:</span> <?php echo $row_products['branch']; ?> </span>
                        <span class="full"><label>สี</label><span>:</span> <?php echo $row_products['color']; ?> </span>
                        <span class="full"><label>การใช้งาน</label><span>:</span> <?php echo $row_products['usingpro']; ?> </span>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-12">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">รายละเอียดสินค้า</div>
                    <div class="panel-body">
                        <?php echo $row_products['detail']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php footer(); ?>
</body>

</html>
