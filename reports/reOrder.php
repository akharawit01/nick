<?php 
ob_start();
session_start();
include("../myadmin/class/connect_db.php");

$oid = $_GET['order'];
$strSQL = "SELECT * FROM orders WHERE id = '".$oid."' ";
$objQuery = mysql_query($strSQL)  or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);

function DateThai($strDate) {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
</head>
<body>
<div id="wrapper">
     
    <p style="text-align:center; font-weight:bold; padding-top:5mm;">ใบสั่งซื้อสินค้า</p>
    <br />
    <table class="heading" style="width:100%;">
        <tr>
            <td style="width:80mm;">
                <h1 class="heading">ทวีลักษ์</h1>
                <h2 class="heading">
                    26 ถ.เชียงใหม่ - แม่ออน<br />
                    ต.ไชยสถาน อ.สารภี จ.เชียงใหม่ 50140<br />
                    (ห่างจากแยกศรีบัวเงินไปทางแม่ออน 400 เมตร)<br /><br />
                     
                    Website : www.website.com<br />
                    E-mail : info@website.com<br />
                    Phone : 053-115510, 097-9241851, <br />
                    081-8811315
                </h2>
            </td>
            <td rowspan="2" valign="top" style="padding:3mm;">
                <table>
                    <tr><td>Order No : </td><td>OR-<?php echo $objResult['id']; ?></td></tr>
                    <tr><td>Dated : </td><td><?php echo DateThai($objResult['create_time']); ?> </td></tr>
                </table>
                <hr>
                <h2 class="heading txt-left">
                    ผู้ซื้อ : <?php echo $objResult['name']; ?> <br>
                    ที่อยู่ : <?php echo $objResult['address']; ?> <br>
                    เบอร์โทรติดต่อ : <?php echo $objResult['tel']; ?> <br>
                </h2>
            </td>
        </tr>
    </table>
         
         
    <div id="content">
         
        <div id="invoice_body">
            <table>
            <tr style="background:#eee;">
                <td style="width:8%;"><b>Sl. No.</b></td>
                <td><b>สินค้า</b></td>
                <td style="width:15%;"><b>จำนวน</b></td>
                <td style="width:15%;"><b>ราคา</b></td>
                <td style="width:15%;"><b>รวมเงิน</b></td>
            </tr>
            </table>
             
            <table>
            
            <?php
            $i=1;
            $Total = 0;
            $SumTotal = 0;
            $strSQL = "SELECT * FROM order_detail WHERE orid = '".$oid."' ";
            $objQuery = mysql_query($strSQL)  or die(mysql_error());
            while ($objResult = mysql_fetch_array($objQuery)) {
                $Total = $objResult['qty'] * $objResult['price'];
                $SumTotal = $SumTotal + $Total;


                $productSQL = "SELECT * FROM product WHERE id = '".$objResult['pid']."' ";
                $productQuery = mysql_query($productSQL)  or die(mysql_error());
                $productResult = mysql_fetch_array($productQuery);
            ?> 
                <tr>
                    <td style="width:8%;"><?php echo $i++; ?></td>
                    <td style="text-align:left; padding-left:10px;"><?php echo $productResult['name']; ?><br />รหัส : <?php echo $productResult['code']; ?></td>
                    <td class="mono" style="width:15%;"><?php echo $objResult['qty']; ?></td><td style="width:15%;" class="mono"><?php echo $objResult['price']; ?></td>
                    <td style="width:15%;" class="mono">
                        <?php echo number_format($Total,2);?>
                    </td>
                </tr> 

            <?php } ?>      
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td></td>
            </tr>
             
            <tr>
                <td colspan="3"></td>
                <td>รวมทั้งหมด :</td>
                <td class="mono"><?php echo number_format($SumTotal,2);?></td>
            </tr>
        </table>
        </div>
         
    </div>
     
</div>
     
    <sethtmlpagefooter name="footer" value="on" />
     
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
include("mpdf/mpdf/mpdf.php");

$mpdf=new mPDF('th', 'A4', '0', 'THSaraban');

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);



$mpdf->Output();
?>     
ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>
