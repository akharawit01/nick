<?php
function user_index() {
?>

	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="main.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
			<a href="#" class="current">ข้อมูลผู้ใช้</a> 
		</div>
		<h1>ข้อมูลผู้ใช้</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<a href="?module=user&action=user_fm" class="btn btn-primary"> เพิ่มสมาชิก </a>
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
						<h5>ข้อมูลผู้ใช้</h5>
					</div>
					<div class="widget-content">
						<div class="table-responsive">
							<form method="post" action="?module=user&action=user_bkdleall">
								<table class="table table-bordered data-table">
									<thead>
										<tr>
											<th width="50" class="center">
												<label class="pos-rel">
													<input type="checkbox" class="form-control ckall ace" id="selecctall">
													<span class="lbl"></span>
												</label>
											</th>
											<th>อีเมล</th>
											<th>ชื่อ-นามสกุล </th>
											<th>ข้อมุลบริษัท</th>
											<th>ที่อยู่</th>
											<th>ประเภท</th>
											<th>เบอร์ติดต่อ</th>
											<th width="50">จัดการ</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$result_member=mysql_query("SELECT * FROM user WHERE type!='0'") or die(mysql_error());
										while ($row_member = mysql_fetch_array($result_member)) { 
										?>
										<tr>
											<td class="center">
												<label class="pos-rel">
													<input type="checkbox" class="checkbox1 form-control ckall ace" name="chkall[]" value="<?php echo $row_member['id']; ?>">
													<span class="lbl"></span>
												</label>
											</td>
											<td><?php echo $row_member['email']; ?></td>
											<td><?php echo $row_member['fname']." - ".$row_member['lname']; ?></td>
											<td>
												บริษัท: <?php echo $row_member['company']; ?><br>
												สาขา: <?php echo $row_member['branch']; ?><br>
												เลขประจำตัวผู้เสียภาษี: <?php echo $row_member['acompanytaxid']; ?>
											</td>
											<td>
												<?php echo $row_member['address']." ".$row_member['province']; ?><br>
												<?php echo $row_member['country']." ".$row_member['postcode']; ?>
											</td>
											<td><?php echo $row_member['tel']; ?></td>
											<td>
												<?php
												if ($row_member['type']=='1') {
													echo "พนักงาน";
												}elseif ($row_member['type']=='2') {
													echo "สมาชิก";
												}else {
													echo "-";
												}
												?>
											</td>
											<td>
												<div class="pull-right">
													<a class="tip" href="?module=user&action=user_fm&id=<?php echo $row_member['id']; ?>" data-original-title="Edit Task"><i class="icon-pencil"></i></a>
													<a class="tip" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="?module=user&action=user_delete&id=<?php echo $row_member['id']; ?>" data-original-title="Delete"><i class="icon-remove"></i></a>
												</div>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<button type="submit" class="btn btn-success" onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')">DELETE & SORT</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
}

function user_fm() {

	if (!empty($_GET['id'])) {
		$strSQL = "SELECT * FROM user WHERE id='".$_GET['id']."'";
		$objQuery = mysql_query($strSQL) or die(mysql_error());
		$objResult = mysql_fetch_array($objQuery);
	}
?>


	<div id="content-header">
      	<div id="breadcrumb"> 
      		<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
      		<a href="?module=user&action=user_index" class="tip-bottom" data-original-title="Go to News"><i class="icon-user"></i> รายการสมาชิก</a> 
      		<a href="#" class="current"><?php echo (!empty($_GET['id'])?'แก้ไขข้อมูลสมาชิก':'เพิ่มสมาชิก') ?></a> 
      	</div>
      	<h1><?php echo (!empty($_GET['id'])?'แก้ไขข้อมูลสมาชิก':'เพิ่มสมาชิก') ?></h1>
 	</div>
  	<div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5><?php echo (!empty($_GET['id'])?'แก้ไขข้อมูลสมาชิก':'เพิ่มสมาชิก') ?></h5>
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
	              		
	                 	<form method="post" action="?module=user&action=<?php echo (!empty($_GET['id'])?'user_update':'user_insert'); ?>" class="form-horizontal" data-toggle="validator" role="form">
	                 		<input type="hidden" name="id" value="<?php echo @$_GET['id']; ?>">
	                      	<div class="control-group">
	                          	<label class="control-label">อีเมล :</label>
	                          	<div class="controls">
	                              	<input type="email" class="span11" name="email" value="<?php echo @$objResult['email']; ?>" <?php echo (!empty($_GET['id'])?'readonly':'required'); ?> >
	                          	</div>
	                      	</div>
	                      	<?php
	                      	if (empty($_GET['id'])) {
	                      	?>
							<div class="control-group">
	                          	<label class="control-label">รหัสผ่าน :</label>
	                          	<div class="controls">
	                              	<input type="password" class="span11" name="password" value="<?php echo @$objResult['password']; ?>" minlength="8" required>
	                          	</div>
	                      	</div>
	                      	<?php } ?>
	                      	<div class="control-group">
	                          	<label class="control-label">ชื่อ :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="fname" value="<?php echo @$objResult['fname']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">นามสกุล :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="lname" value="<?php echo @$objResult['lname']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">บริษัท :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="company" value="<?php echo @$objResult['company']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">สาขา :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="branch" value="<?php echo @$objResult['branch']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">เลขประจำตัวผู้เสียภาษี :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="acompanytaxid" value="<?php echo @$objResult['acompanytaxid']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ที่อยู่ :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="address" value="<?php echo @$objResult['address']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">จังหวัด :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="province" value="<?php echo @$objResult['province']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ประเทศ :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="country" value="<?php echo @$objResult['country']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รหัสไปรษณี :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="postcode" value="<?php echo @$objResult['postcode']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">เบอร์โทร :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="tel" value="<?php echo @$objResult['tel']; ?>" required>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ประเภท :</label>
	                          	<div class="controls">
	                              	<select class="span11" name="type" required>
										<option value="2" <?php echo !empty($objResult['type'])&&$objResult['type']=='2'?"selected":""; ?>>สมาชิก</option>
										<option value="1" <?php echo !empty($objResult['type'])&&$objResult['type']=='1'?"selected":""; ?>>พนักงาน</option>
										<option value="0" <?php echo !empty($objResult['type'])&&$objResult['type']=='0'?"selected":""; ?>>ผู้ดูแลระบบ</option>
									</select>
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

function user_insert() {
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string($_POST['password']);
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
	$type = mysql_real_escape_string($_POST['type']);


	$result_member=mysql_query("SELECT count(id) as countid FROM user WHERE email='".$email."'") or die(mysql_error());
	$data=mysql_fetch_assoc($result_member);
	if (empty($data['countid'])) {
		$strSQL="INSERT INTO user VALUES ('',
		    '".$email."',
		    '".$password."',
		    '".$fname."',
		    '".$lname."',
		    '".$company."',
		    '".$branch."',
		    '".$acompanytaxid."',
		    '".$address."',
		    '".$province."',
		    '".$country."',
		    '".$postcode."',
		    '".$tel."',
		    '".$type."',
		    '".date("Y-m-d H:i:s")."')";
		mysql_query($strSQL) or die(mysql_error()) or die(mysql_error());
		mysql_close();
		echo "<script language='javascript'>alert('บันทึกข้อมูล เสร็จสมบูรณ์!');</script>";
		echo "<script language='javascript'>window.location='?module=user&action=user_index'</script>";
		exit();
	}

	mysql_close();
	echo "<script language='javascript'>alert('อีเมลซ้ำ!');</script>";
	echo "<script language='javascript'>window.history.back();</script>";
}

function user_update() {
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
	$type = mysql_real_escape_string($_POST['type']);

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
		tel='".$tel."',
		type='".$type."' WHERE id='".$_POST['id']."'";
	mysql_query($strSQL) or die(mysql_error());

	mysql_close();
	echo "<script language='javascript'>alert('บันทึกข้อมูล เสร็จสมบูรณ์!');</script>";
	echo "<script language='javascript'>window.location='?module=user&action=user_index'</script>";
}

function user_delete() {

	$RESULT_DELETE_MEMBER="DELETE FROM user WHERE id='".$_GET['id']."'";
	mysql_query($RESULT_DELETE_MEMBER) or die(mysql_error());

	mysql_close();
	echo "<script language='javascript'>alert('ลบข้อมูล เสร็จสมบูรณ์!');</script>";
  	echo "<script language='javascript'>window.location='?module=user&action=user_index'</script>";
}

function user_bkdleall(){
	$ct=count(@$_POST['chkall']);
    if (!empty($ct)) {
      	foreach ($_POST['chkall'] as  $value) {
	        $result_delete="DELETE FROM user WHERE id='".$value."'";
    		mysql_query($result_delete) or die(mysql_error());
      	}
    }

 	mysql_close();
    echo "<script language='javascript'>window.location='?module=user&action=user_index'</script>";
}

