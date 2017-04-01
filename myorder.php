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
                        <li class="list-group-item"><a href="mypassword.php">แก้ไขรหัสผ่าน</a></li>
                        <li class="list-group-item active">รายการสั่งซื้อ</li>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="pagin-sub-series">
                    <div class="pagin-sub-line-series-left"></div>
                    <h2>รายการสั่งซื้อ</h2>
                    <div class="pagin-sub-line-series-right"></div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">รหัสสั่งซื้อ</th>
                            <th class="text-center">วันที่</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $strSQL = "SELECT * FROM orders WHERE uid = '".$_SESSION['id_user']."' ";
                        $objQuery = mysql_query($strSQL)  or die(mysql_error());


                        $Num_Rows = mysql_num_rows($objQuery);

                        $Per_Page = 10;   // Per Page

                        @$Page = $_GET["Page"];
                        if(!@$_GET["Page"])
                        {
                          $Page=1;
                        }

                        $Prev_Page = $Page-1;
                        $Next_Page = $Page+1;

                        $Page_Start = (($Per_Page*$Page)-$Per_Page);
                        if($Num_Rows<=$Per_Page)
                        {
                          $Num_Pages =1;
                        }
                        else if(($Num_Rows % $Per_Page)==0)
                        {
                          $Num_Pages =($Num_Rows/$Per_Page) ;
                        }
                        else
                        {
                          $Num_Pages =($Num_Rows/$Per_Page)+1;
                          $Num_Pages = (int)$Num_Pages;
                        }

                        $strSQL .=" ORDER BY create_time DESC LIMIT $Page_Start , $Per_Page";
                        $objQuery  = mysql_query($strSQL);

                        while ($objResult = mysql_fetch_array($objQuery)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td>OR-<?php echo $objResult['id']; ?></td>
                            <td><?php echo DateThai($objResult['create_time']); ?></td>
                            <td class="text-center"><?php echo $objResult['status']; ?></td>
                            <td class="text-center"><a href="reports/reOrder.php?order=<?php echo $objResult['id']; ?>" target="_blank"><span class="glyphicon glyphicon-search"></span></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        if($Prev_Page) {
                        ?>
                            <li>
                                <a href="<?php echo $_SERVER['SCRIPT_NAME']."?Page=".$Prev_Page; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php
                        }

                        for($i=1; $i<=$Num_Pages; $i++){
                            if($i != $Page) {
                            ?>
                                <li><a href="<?php echo $_SERVER['SCRIPT_NAME']."?Page=".$i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }else {
                                echo "<li class='active'><a href='#'>$i</a></li>";
                            }
                        }
                        if($Page!=$Num_Pages) {
                        ?>
                            <li>
                                <a href="<?php echo $_SERVER['SCRIPT_NAME']."?Page=".$Next_Page; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>

            </div>
        </div>
        
    </div>
    <?php footer(); ?>
</body>

</html>
