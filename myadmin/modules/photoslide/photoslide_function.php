<?php
function photoslide_index() {
?>
	

	<div id="content-header">
	    <div id="breadcrumb"> <a href="main.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> <a href="#" class="current">ภาพสไลด์โชว์</a> </div>
	    <h1>ภาพสไลด์โชว์</h1>
	</div>
	<div class="container-fluid">
	    <div class="row-fluid">
	        <div class="span12">
	            <div class="widget-box">
	                <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
	                    <h5>เพิ่มภาพสไลด์โชว์</h5>
	                </div>
	                <div class="widget-content">
	                	<form method="post" action="?module=photoslide&action=photoslide_insert" enctype="multipart/form-data" data-parsley-validate>
				            <div class="modal-body">
								<div class="control-group">
								    <label class="control-label">เพิ่มรูปภาพสไลด์โชว์ (* ขนาด 1500 x 786)</label>
								    <div class="controls">
								        <input type="file" name="photo[]" accept="image/jpeg, image/png" multiple="" required="required">
								    </div>
								</div>
				                <button type="submit" class="btn btn-primary btn-sm">บันทึกข้อมูล</button>
				            </div>
				        </form>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row-fluid">
	        <div class="span12">
	            <div class="widget-box">
	                <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
	                    <h5>ภาพสไลด์โชว์</h5>
	                </div>
	                <div class="widget-content">
	                	<div class="table-responsive">
							<form method="post" action="?module=photoslide&action=photoslide_bkdleall">
								<table class="table table-bordered data-table">
									<thead>
										<tr>
											<th width="50" class="center">
												<label class="pos-rel">
													<input type="checkbox" class="form-control ckall ace" id="selecctall">
													<span class="lbl"></span>
												</label>
											</th>
											<th>รูปภาพ</th>
											<th width="150">ลำดับ - สถานะ</th>
											<th width="50">&nbsp;</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$result_photoslide=mysql_query("SELECT * FROM photoslide ORDER BY sort ASC,id DESC") or die(mysql_error());
										while ($row_photoslide = mysql_fetch_array($result_photoslide)) { 
										?>
										<tr>
											<td class="center">
												<label class="pos-rel">
													<input type="checkbox" class="checkbox1 form-control ckall ace" name="chkall[]" value="<?php echo $row_photoslide['id']; ?>">
													<span class="lbl"></span>
												</label>
											</td>
											<td>
												<img src="../uploads/pic_photoslide/<?php echo $row_photoslide['name']; ?>" width="100">
											</td>
											<td>
												<input type="hidden" value="<?php echo $row_photoslide['id']; ?>" name="id[]">
				                            	<input class="form-control line-none" type="number" name="sort[]" value="<?php echo $row_photoslide['sort'] ?>">

				                            	<?php
				      							if (empty($row_photoslide['display'])||$row_photoslide['display']==0) {
				      							?>
				      								<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=photoslide&action=photoslide_hidden&id=<?php echo $row_photoslide['id']; ?>&status=1" class="btn btn-danger btn-mini"> ไม่แสดง </a>
				      							<?php
				      							}else {
				      							?>
				          							<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=photoslide&action=photoslide_hidden&id=<?php echo $row_photoslide['id']; ?>&status=0" class="btn btn-primary btn-mini"> แสดง </a>
				      							<?php
				      							}
				      							?>

											</td>
											<td>
												<div class="pull-right"> 
													<a  onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')"  class="tip" href="?module=photoslide&action=photoslide_delete&id=<?php echo $row_photoslide['id']; ?>" data-original-title="Delete"><i class="icon-remove"></i></a> 
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

function photoslide_insert(){
	if ($_FILES['photo']['name'][0]!="") {
		$photo_pic = $_FILES['photo']['name'];
		$photo_tmp = $_FILES['photo']['tmp_name'];
		$sql="";
		$i=0;
		$date=date("Y-m-d");
		foreach ($photo_pic as $key => $value) {
		  	$pic = $key.md5(microtime()).".".end(explode(".",$value));
		  	copy($photo_tmp[$i], "../uploads/pic_photoslide/$pic");
		  	$i == 0 ? $st="" : $st=",";
		  	$sql .= "$st('','".$pic."','0','0','".$date."')";
		  	$i++;
		}
		$strSQL="INSERT INTO photoslide VALUES $sql";
		mysql_query($strSQL) or die(mysql_error());
		mysql_close();
	}
	echo "<script language='javascript'>window.location='?module=photoslide&action=photoslide_index'</script>";
}

function photoslide_hidden() {
	$SQL_DISPLAY_PHOTOSLIDE="UPDATE photoslide SET display='".$_GET['status']."' WHERE id='".$_GET['id']."'";
	mysql_query($SQL_DISPLAY_PHOTOSLIDE) or die(mysql_error());
	mysql_close();
	echo "<script language='javascript'>window.location='?module=photoslide&action=photoslide_index'</script>";
}

function photoslide_bkdleall(){
  	if (!empty($_POST['chkall'])) {
    	foreach ($_POST['chkall'] as  $value) {
    		$RESULT_DELETE_PHOTOSLIDE=mysql_query("SELECT name FROM photoslide WHERE id='".$value."'") or die(mysql_error());
    		$ROW_DELETE_PHOTOSLIDE = mysql_fetch_array($RESULT_DELETE_PHOTOSLIDE);
    		@unlink("../uploads/pic_photoslide/$ROW_DELETE_PHOTOSLIDE[name]");

      		$RESULT_DELETE_PHOTOSLIDE="DELETE FROM photoslide WHERE id='".$value."'";
      		mysql_query($RESULT_DELETE_PHOTOSLIDE) or die(mysql_error());
    	}
  	}

  	if (!empty($_POST['id'])) {
		$b=0;
		foreach ($_POST['id'] as  $value) {
		  	$RESULT_SORT_PHOTOSLIDE="UPDATE photoslide SET sort='".$_POST['sort'][$b]."' WHERE id='".$value."'";
		  	mysql_query($RESULT_SORT_PHOTOSLIDE) or die(mysql_error());
			$b++;
		}
	}
	mysql_close();
  	echo "<script language='javascript'>window.location='?module=photoslide&action=photoslide_index'</script>";
}

function photoslide_delete(){

	$RESULT_DELETE_PHOTOSLIDE=mysql_query("SELECT name FROM photoslide WHERE id='".$_GET['id']."'") or die(mysql_error());
	$ROW_DELETE_PHOTOSLIDE = mysql_fetch_array($RESULT_DELETE_PHOTOSLIDE);
	@unlink("../uploads/pic_photoslide/$ROW_DELETE_PHOTOSLIDE[name]");

  	$RESULT_DELETE_PHOTOSLIDE="DELETE FROM photoslide WHERE id='".$_GET['id']."'";
  	mysql_query($RESULT_DELETE_PHOTOSLIDE) or die(mysql_error());

	mysql_close();
	echo "<script language='javascript'>alert('ลบข้อมูล เสร็จสมบูรณ์!');</script>";
  	echo "<script language='javascript'>window.location='?module=photoslide&action=photoslide_index'</script>";
}