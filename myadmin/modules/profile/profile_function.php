<?php
function profile_index() {

$strSQL = "SELECT * FROM user WHERE id='".$_SESSION["id_user"]."'";
$objQuery = mysql_query($strSQL) or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);

?>
	<div id="content-header">
      	<div id="breadcrumb"> <a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> <a href="#" class="current">ข้อมูลส่วนตัว</a> </div>
      	<h1>ข้อมูลส่วนตัว</h1>
 	</div>
  	<div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5>ข้อมูลส่วนตัว</h5>
		              	</div>
	              	<?php
	                if (!empty($_GET['message'])) {
	                ?>
	                <div class="x_title">
		                <div class="alert alert-info">
		                    <button type="button" aria-hidden="true" class="close">×</button>
		                    <strong>บันทึกข้อมุลเรียบร้อย!</strong>
		                </div>
	            	</div>
					<?php
					}
					?>
	              	<div class="widget-content nopadding">
	                 	<form method="post" action="?module=profile&action=profile_update" class="form-horizontal" data-toggle="validator" role="form">
	                 		<input type="hidden" name="id" value="<?php echo $_SESSION["id_user"]; ?>">
	                      	<div class="control-group">
	                          	<label class="control-label">อีเมล :</label>
	                          	<div class="controls">
	                              	<input type="email" class="span11" name="email" value="<?php echo $objResult['email']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ชื่อ :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="fname" value="<?php echo $objResult['fname']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">นามสกุล :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="lname" value="<?php echo $objResult['lname']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">บริษัท :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="company" value="<?php echo $objResult['company']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">สาขา :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="branch" value="<?php echo $objResult['branch']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">เลขประจำตัวผู้เสียภาษี :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="acompanytaxid" value="<?php echo $objResult['acompanytaxid']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ที่อยู่ :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="address" value="<?php echo $objResult['address']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">จังหวัด :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="province" value="<?php echo $objResult['province']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ประเทศ :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="country" value="<?php echo $objResult['country']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รหัสไปรษณี :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="postcode" value="<?php echo $objResult['postcode']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">เบอร์โทร :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="tel" value="<?php echo $objResult['tel']; ?>" required>
	                          	</div>
	                      	</div>
	                      	
	                      	<div class="form-actions">
	                          	<button type="submit" class="btn btn-success"> บันทึกข้อมูล </button>
	                      		<button type="reset" class="btn btn-primary"> ล้างค่า </button>
	                      	</div>
	                  	</form>
	              	</div>
	            </div>
          	</div>
      	</div>
    </div>


    <div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5>แก้ไขรหัสผ่าน</h5>
	              	</div>
					<div class="widget-content nopadding">
	                 	<form method="post" action="?module=profile&action=profile_password" class="form-horizontal" data-toggle="validator" role="form">
	                 		<input type="hidden" name="id" value="<?php echo $_SESSION["id_user"]; ?>">
	                      	<div class="control-group">
	                          	<label class="control-label">รหันผ่านเดิม :</label>
	                          	<div class="controls">
	                              	<input type="password" class="span11" name="oldpassword" minlength="8" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รหัสผ่านใหม่ :</label>
	                          	<div class="controls">
	                              	<input type="password" class="span11" name="newpassword" minlength="8" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ยืนยันรหัสผ่านใหม่ :</label>
	                          	<div class="controls">
	                              	<input type="password" class="span11" name="cfnewpassword" minlength="8" required>
	                          	</div>
	                      	</div>
	                   
	                      	<div class="form-actions">
	                          	<button type="submit" class="btn btn-success"> บันทึกข้อมูล </button>
	                      		<button type="reset" class="btn btn-primary"> ล้างค่า </button>
	                      	</div>
	                  	</form>
	              	</div>
	            </div>
          	</div>
      	</div>
    </div>
<?php
}



function profile_update() {
	$email = mysql_real_escape_string($_POST['email']);
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$company = mysql_real_escape_string($_POST['company']);
	$branch = mysql_real_escape_string($_POST['branch']);
	$acompanytaxid = mysql_real_escape_string($_POST['acompanytaxid']);
	$address = mysql_real_escape_string($_POST['address']);
	$province = mysql_real_escape_string($_POST['province']);
	$country = mysql_real_escape_string($_POST['country']);
	$postcode = mysql_real_escape_string($_POST['postcode']);
	$tel = mysql_real_escape_string($_POST['tel']);

	$strSQL="UPDATE user SET email='".$email."',
		fname='".$fname."',
		lname='".$lname."',
		company='".$company."',
		branch='".$branch."',
		acompanytaxid='".$acompanytaxid."',
		address='".$address."',
		province='".$province."',
		country='".$country."',
		postcode='".$postcode."',
		tel='".$tel."' WHERE id='".$_POST['id']."'";
	mysql_query($strSQL) or die(mysql_error());

	mysql_close();
	echo "<script language='javascript'>alert('บันทึกข้อมูล เสร็จสมบูรณ์!');</script>";
	echo "<script language='javascript'>window.location='?module=profile&action=profile_index&message=mess'</script>";
}

function profile_password() {
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
	echo "<script language='javascript'>window.location='?module=profile&action=profile_index'</script>";
}