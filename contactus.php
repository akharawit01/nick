<?php session_start();
$title = "ติดต่อเรา";
include 'myadmin/class/connect_db.php';
include 'components/components.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datetime = date("Y-m-d H:i:s");
    $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $subject = mysql_real_escape_string($_POST['subject']);
    $message = mysql_real_escape_string($_POST['message']);

    $query="INSERT INTO contactus
        VALUES ('',
            '".$name."',
            '".$email."',
            '".$subject."',
            '".$message."',
            '".$datetime."')";
        mysql_query($query) or die(mysql_error());
        mysql_close();
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว!');</script>";
        echo "<script language='javascript'>window.location='contactus.php'</script>";
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
        <ol class="breadcrumb">
            <li><a href="index.php">หน้าหลัก</a></li>
            <li class="active">ติดต่อเรา</li>
        </ol>
        
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    ชื่อ-นามสกุล</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required="required">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    อีเมล</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    เรื่อง</label>
                                    <input type="text" class="form-control" name="subject" placeholder="Enter subject" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    ข้อความ</label>
                                <textarea name="message" name="message" class="form-control" rows="9" cols="25" required="required"
                                    placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                Send Message</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <form>
                <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                <address>
                    <strong>Twitter, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">
                        P:</abbr>
                    (123) 456-7890
                </address>
                <address>
                    <strong>Full Name</strong><br>
                    <a href="mailto:#">first.last@example.com</a>
                </address>
                </form>
            </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96817.6887330845!2d-74.55044699999995!3d40.68382200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3bd03395a63ed%3A0x9ae696318bbefc77!2sAstrahealth+Urgent+Care!5e0!3m2!1sen!2sin!4v1428910572976" width="100%" height="200px" frameborder="0" style="border:0"></iframe>
    </div>
    <?php footer(); ?>
</body>

</html>
