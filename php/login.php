<?php session_start();
include("../myadmin/class/connect_db.php");
echo "<meta charset=\"utf-8\">";

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['myusername'])) {
    $myusername = mysql_real_escape_string($_POST['myusername']);
    $mypassword = mysql_real_escape_string($_POST['mypassword']); 

    $sql = "SELECT * FROM user WHERE email='$myusername' AND password='$mypassword' AND type='2'";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $count = mysql_num_rows($result);

    if($count == 1) {
        $_SESSION['id_user'] = $row['id'];
        $_SESSION['email_user'] = $myusername;
        $_SESSION['fname_user'] = $row['fname'];
        $_SESSION['lname_user'] = $row['lname'];    
        $_SESSION['tel_user'] = $row['tel']; 
        $_SESSION['address_user'] = $row['address']." ".$row['province']." ".$row['country']." ".$row['postcode'];    
        $_SESSION['type_user'] = $row['type'];
        echo "<script language='javascript'>alert('ยินดีต้องรับคุณ $row[fname]');</script>";
        header("location: ../index.php");
        exit();
    }else {
        echo "<script language='javascript'>alert('อีเมล หรือ รหัสผ่านผิดพลาด!');</script>";
        echo "<script language='javascript'>window.history.back();</script>";
        exit();
    }
    echo "<script language='javascript'>window.history.back();</script>";
    
}
