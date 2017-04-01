<?php session_start();
include 'myadmin/class/connect_db.php';
include 'components/components.php';


$cat_id=(!empty($_GET['cat'])?$_GET['cat']:null);

if (!empty($_GET['sub'])) {
    $result_parent=mysql_query("SELECT id,name,parent FROM catagory WHERE id='".$_GET['sub']."'") or die(mysql_error());
    $row_parent=mysql_fetch_array($result_parent);
    $cat_id=$row_parent['parent'];
}

$result_title=mysql_query("SELECT id,name FROM catagory WHERE id='".$cat_id."'") or die(mysql_error());
$row_title=mysql_fetch_array($result_title);

$strSql=" where catagory='".$cat_id."'";
$result_cat=mysql_query("SELECT id,name FROM catagory WHERE parent='".$cat_id."'") or die(mysql_error());
while ($row_cat = mysql_fetch_array($result_cat)) { 
    $strSql.=" or catagory='".$row_cat['id']."'";
}

$productid = $row_title['id'];
$title = $row_title['name'];

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
            <li><a href="index.php">หน้าหลัก</a></li>
            <?php
            if (!empty($_GET['sub'])) {
            ?>
                <li><a href="list.php?cat=<?php echo $row_title['id'] ?>"><?php echo $title; ?></a></li>
                <li class="active"><?php echo $row_parent['name']; ?></li>
            <?php
            }else {
            ?>
                <li class="active"><?php echo $title; ?></li>
            <?php
            }
            ?>
        </ol>

        <article class="row">
            
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        หมวดสินค้าหลัก
                    </div>
                    <div class="list-group">
                        <?php
                        $resultListCat=mysql_query("SELECT * FROM catagory WHERE parent='0'") or die(mysql_error());
                        while ($rowListCat = mysql_fetch_array($resultListCat)) { 
                            $strSqlCount=" where catagory='".$rowListCat['id']."'";
                            $resultCountCat=mysql_query("SELECT id,name FROM catagory WHERE parent='".$rowListCat['id']."'") or die(mysql_error());
                            while ($rowCountCat = mysql_fetch_array($resultCountCat)) { 
                                $strSqlCount.=" or catagory='".$rowCountCat['id']."'";
                            }
                            $resultCount=mysql_query("SELECT id FROM product ".$strSqlCount."") or die(mysql_error());

                            if ($productid == $rowListCat['id']) {
                            ?>
                                <li class="list-group-item active">
                                    <span class="badge"><?php echo mysql_num_rows($resultCount); ?></span>
                                    <?php echo $rowListCat['name']; ?>
                                </li>
                            <?php
                            }else {
                            ?>
                                <li class="list-group-item">
                                    <span class="badge"><?php echo mysql_num_rows($resultCount); ?></span>
                                    <a href="list.php?cat=<?php echo $rowListCat['id']; ?>"><?php echo $rowListCat['name']; ?></a>
                                </li>
                            <?php
                            }
                        } ?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        หมวดสินค้าย่อย
                    </div>
                    <div class="list-group">
                        <?php
                        @mysql_data_seek ($result_cat, 0);
                        while ($row_cat = mysql_fetch_array($result_cat)) { 
                            if ($row_cat['id']==@$_GET['sub']) {
                            ?>
                                <li class="list-group-item active"><?php echo $row_cat['name']; ?></li>
                            <?php
                            }else {
                            ?>
                                <li class="list-group-item"><a href="list.php?sub=<?php echo $row_cat['id']; ?>"><?php echo $row_cat['name']; ?></a></li>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagin-sub-series">
                            <div class="pagin-sub-line-series-left"></div>
                            <h2><?php echo $title; ?></h2>
                            <div class="pagin-sub-line-series-right"></div>
                        </div>
                    </div>


                    <?php
                    if (!empty($_GET['sub'])) {
                        $result_products=mysql_query("SELECT * FROM product WHERE catagory='".$_GET['sub']."' ORDER BY sort ASC, id DESC") or die(mysql_error());
                    }else {
                        $result_products=mysql_query("SELECT * FROM product ".$strSql." ORDER BY sort ASC, id DESC") or die(mysql_error());
                    }
                    
                    while ($row_products = mysql_fetch_array($result_products)) { 
                        $result_unit=mysql_query("SELECT name FROM unit WHERE id='".$row_products['unit']."'") or die(mysql_error());
                        $row_unit = mysql_fetch_array($result_unit);

                        $totaldis = $row_products['price']-(($row_products['price']*$row_products['discount'])/100);
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="hovereffect">
                                <a href="product.php?id=<?php echo $row_products['id']; ?>">
                                    <img src="uploads/pic_product/<?php echo $row_products['cover']; ?>">
                                    <div class="overlay">
                                        <h2><span class="glyphicon glyphicon-search"></span></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="caption">
                                <h4><?php echo $row_products['name']; ?><br><small>รหัส: <?php echo $row_products['code']; ?></small></h4>
                                <div class="text-right">
                                    <?php
                                    if (!empty($row_products['discount'])) {
                                    ?>
                                        <span class="price">฿<?php echo number_format($totaldis,2);?> <s style="color: red;">฿<?php echo $row_products['price']; ?></s></span> / <?php echo $row_unit['name']; ?> </span>
                                    <?php
                                    }else {
                                    ?>
                                        <span class="price">฿<?php echo $row_products['price']; ?></span> / <?php echo $row_unit['name']; ?> </span>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                                <p><a href="php/store_items.php?ProductID=<?php echo $row_products["id"];?>" class="btn btn-cart" role="button"><span></span></a></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            
        </article>
    </div>
    <?php footer(); ?>
</body>

</html>
