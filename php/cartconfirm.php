<?php session_start();
include("../myadmin/class/connect_db.php");
echo "<meta charset=\"utf-8\">";

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['name'])) {

    $name = mysql_real_escape_string($_POST['name']);
    $tel = mysql_real_escape_string($_POST['tel']);
    $address = mysql_real_escape_string($_POST['address']);

    $Order="INSERT INTO orders VALUES ('','".$_SESSION['id_user']."','$name','$address','$tel','0','".date("Y-m-d H:i:s")."')";
    $OrderQuery = mysql_query($Order) or die(mysql_error());
    $OrderId = mysql_insert_id();

    $Total = 0;
    $SumTotal = 0;
    $i=0;
    $sql="";
    foreach ($_SESSION["strProductID"] as $key => $value) {
        if($value)
        {
            $strSQL = "SELECT * FROM product WHERE id = '".$value."' ";
            $objQuery = mysql_query($strSQL)  or die(mysql_error());
            $objResult = mysql_fetch_array($objQuery);

            $totaldis = $objResult['price']-(($objResult['price']*$objResult['discount'])/100);
            $Total = $_SESSION["strQty"][$key] * $totaldis;
            $SumTotal = $SumTotal + $Total;

            $cmm=($i==0)?'':',';
            $sql.=$cmm."('','$OrderId','$value','".$_SESSION["strQty"][$key]."','".$totaldis."')";
            $i++;
        }
    }
    $OrderDetail="INSERT INTO order_detail VALUES $sql";
    mysql_query($OrderDetail) or die(mysql_error());

    unset($_SESSION["intLine"]);
    unset($_SESSION["strProductID"]);
    unset($_SESSION["strQty"]);

    header("location:../myorder.php");
}

