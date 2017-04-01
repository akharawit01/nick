<?php
function news_index() {
  $result_news=mysql_query("SELECT * FROM news ORDER BY news_sort ASC, news_id DESC") or die(mysql_error());
?>
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
			<a href="#" class="current">รายการข่าวสาร</a> 
		</div>
		<h1>รายการข่าวสาร</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<a href="?module=news&action=news_insert_form" class="btn btn-primary"> เพิ่มข่าวสาร </a>
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
						<h5>รายการข่าวสาร</h5>
					</div>
					<div class="widget-content">
						<div class="table-responsive">
							<form method="post" action="?module=news&action=news_bkdleall">
								<table class="table table-bordered data-table">
									<thead>
										<tr>
											<th width="50" class="center">
												<label class="pos-rel">
													<input type="checkbox" class="form-control ckall ace" id="selecctall">
													<span class="lbl"></span>
												</label>
											</th>
											<th width="60">รูปหลัก</th>
											<th>หัวข้อข่าว </th>
											<th width="150">ลำดับ - สถานะ</th>
											<th width="50">จัดการ</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$ct=1;
									while ($row_news = mysql_fetch_array($result_news)) { 
									?>
									<tr>
										<td class="center">
											<label class="pos-rel">
												<input type="checkbox" class="checkbox1 form-control ckall ace" name="chkall[]" value="<?php echo $row_news['news_id']; ?>">
												<span class="lbl"></span>
											</label>
										</td>
										<td><img width="60" src="../uploads/pic_news/<?php echo $row_news['news_cover']; ?>"></td>
										<td>
											<?php echo $row_news['news_title']; ?>
											<br>
											<small>Created <?php echo $row_news['created_at']; ?></small>
										</td>
										<td>
											<input type="hidden" value="<?php echo $row_news['news_id']; ?>" name="id[]">
											<input class="form-control border-input" type="number" name="sort[]" value="<?php echo $row_news['news_sort'] ?>">

											<?php
											if (empty($row_news['news_display'])||$row_news['news_display']==0) {
											?>
												<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=news&action=news_hidden&id=<?php echo $row_news['news_id']; ?>&status=1" class="btn btn-danger btn-mini"> ไม่แสดง </a>
											<?php
											}else {
											?>
												<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=news&action=news_hidden&id=<?php echo $row_news['news_id']; ?>&status=0" class="btn btn-primary btn-mini"> แสดง </a>
											<?php
											}
											?>

										</td>
										<td>
											<div class="pull-right">
												<a class="tip" href="?module=news&action=news_edit_form&id=<?php echo $row_news['news_id']; ?>" data-original-title="Edit Task"><i class="icon-pencil"></i></a>
												<a class="tip" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="?module=news&action=news_delete&id=<?php echo $row_news['news_id']; ?>&cover=<?php echo $row_news['news_cover']; ?>&gallery=<?php echo $row_news['news_gallery']; ?>" data-original-title="Delete"><i class="icon-remove"></i></a>
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

function news_delete() {
    $RESULT_DELETE_NEWS="DELETE FROM news WHERE news_id='".$_GET['id']."'";
    mysql_query($RESULT_DELETE_NEWS) or die(mysql_error());
    @unlink("../uploads/pic_news/$_GET[cover]");
    @unlink("../uploads/pic_news/$_GET[gallery]");

 	mysql_close();
    echo "<script language='javascript'>window.location='?module=news&action=news_index'</script>";
}

function news_bkdleall() {
	$ct=count(@$_POST['chkall']);
    if (!empty($ct)) {
      	foreach ($_POST['chkall'] as  $value) {	
	        $RESULT_DELETE_NEWS_COVER=mysql_query("SELECT news_cover FROM news WHERE news_id='".$value."'") or die(mysql_error());
	        $ROW_DELETE_NEWS_COVER = mysql_fetch_array($RESULT_DELETE_NEWS_COVER);
	        @unlink("../uploads/pic_news/$ROW_DELETE_NEWS_COVER[news_cover]");
	        @unlink("../uploads/pic_news/$ROW_DELETE_NEWS_COVER[news_gallery]");

	        $RESULT_DELETE_NEWS="DELETE FROM news WHERE news_id='".$value."'";
    		mysql_query($RESULT_DELETE_NEWS) or die(mysql_error());
      	}
    }

    if (!empty($_POST['id'])) {
	    $b=0;
	    foreach ($_POST['id'] as  $value) {
	        $RESULT_SORT_NEWS="UPDATE news SET news_sort='".$_POST['sort'][$b]."' WHERE news_id='".$value."'";
	        mysql_query($RESULT_SORT_NEWS) or die(mysql_error());
	      	$b++;
	    }
  	}
 	mysql_close();
    echo "<script language='javascript'>window.location='?module=news&action=news_index'</script>";
}


function news_hidden() {
	$SQL_DISPLAY_NEWS="UPDATE news SET news_display='".$_GET['status']."' WHERE news_id='".$_GET['id']."'";
	mysql_query($SQL_DISPLAY_NEWS) or die(mysql_error());
	mysql_close();
	echo "<script language='javascript'>window.location='?module=news&action=news_index'</script>";
}

function news_insert_form() {
?>
  	<div id="content-header">
      	<div id="breadcrumb"> 
      		<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
      		<a href="?module=news&action=news_index" class="tip-bottom" data-original-title="Go to News"><i class="icon-bullhorn"></i> รายการข่าวสาร</a> 
      		<a href="#" class="current">รายการข่าวสาร</a> 
      	</div>
      	<h1>เพิ่มข่าวสาร</h1>
 	</div>
  	<div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5>เพิ่มข่าวสาร</h5>
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
	                 	<form class="form-horizontal form-label-left" action="?module=news&action=news_insert" method="post" enctype="multipart/form-data" data-parsley-validate>
	                      	<div class="control-group">
	                          	<label class="control-label">หัวข้อข่าว :</label>
	                          	<div class="controls">
	                              	<input type="text" class="span11" name="name" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รายละเอียด :</label>
	                          	<div class="controls">
	                              	<textarea id="editor1" name="content"></textarea>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รูปภาพหลัก :</label>
	                          	<div class="controls">
	                              	<input type="file" name="cover" required="required">
	                        		<p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รูปภาพอัลบั้ม :</label>
	                          	<div class="controls">
	                              	<input type="file" name="gallery" required="required">
	                        		<p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
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

function news_insert() {
 	$name = mysql_real_escape_string($_POST['name']);
  	$content = $_POST['content'];

  	if ($_FILES['cover']['tmp_name']) {
		$cover_name = md5(time()).".".end(explode(".",$_FILES['cover']['name']));
		$cover_tmp = $_FILES['cover']['tmp_name'];
		if (!empty($cover_name)) {
			copy($cover_tmp, "../uploads/pic_news/$cover_name");
		}
  	}else {
      	$cover_name="";
  	}

  	if ($_FILES['gallery']['tmp_name']) {
		$gallery_name = "1".md5(time()).".".end(explode(".",$_FILES['gallery']['name']));
		$gallery_tmp = $_FILES['gallery']['tmp_name'];
		if (!empty($gallery_name)) {
			copy($gallery_tmp, "../uploads/pic_news/$gallery_name");
		}
  	}else {
      	$gallery_name="";
  	}

 	$SQL_INSERT_NEWS="INSERT INTO news VALUES ('',
	    '".$name."',
	    '".$content."',
	    '".$cover_name."',
	    '".$gallery_name."',
	    '0','0','".date("Y-m-d H:i:s")."')";
  	mysql_query($SQL_INSERT_NEWS) or die(mysql_error());

  	mysql_close();
  	echo "<script language='javascript'>window.location='?module=news&action=news_insert_form&message=true'</script>";
}

function news_edit_form() {
 	$result_news=mysql_query("SELECT * FROM news WHERE news_id='".$_GET['id']."'") or die(mysql_error());
  	$row_news = mysql_fetch_array($result_news);
?>
	<div id="content-header">
      	<div id="breadcrumb"> 
      		<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
      		<a href="?module=news&action=news_index" class="tip-bottom" data-original-title="Go to News"><i class="icon-bullhorn"></i> รายการข่าวสาร</a> 
      		<a href="#" class="current">แก้ไขข่าวสาร</a> 
      	</div>
      	<h1>แก้ไขข่าวสาร</h1>
 	</div>
  	<div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5>แก้ไขข่าวสาร</h5>
	              	</div>
	              	<?php
	                if (!empty($_GET['message'])) {
	                ?>
	                <div class="x_title">
		                <div class="alert alert-info">
		                    <button type="button" aria-hidden="true" class="close">×</button>
		                    <strong>แก้ไขข้อมุลเรียบร้อย!</strong>
		                </div>
	            	</div>
					<?php
					}
					?>
	              	<div class="widget-content nopadding">
	                 	<form class="form-horizontal form-label-left" action="?module=news&action=news_edit&cover=<?php echo $row_news['news_cover']; ?>&gallery=<?php echo $row_news['news_gallery']; ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
	                      	<div class="control-group">
	                          	<label class="control-label">หัวข้อข่าว :</label>
	                          	<div class="controls">
	                          		<input type="hidden" name="id" value="<?php echo $row_news['news_id']; ?>">
	                              	<input type="text" class="span11" name="name" value="<?php echo $row_news['news_title']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รายละเอียด :</label>
	                          	<div class="controls">
	                              	<textarea id="editor1" name="content"><?php echo $row_news['news_detail']; ?></textarea>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รูปภาพหลัก :</label>
	                          	<div class="controls">
	                          		<?php 
			                        if (!empty($row_news['news_cover'])) {
			                        ?>
			                			<img width="120" src="../uploads/pic_news/<?php echo $row_news['news_cover']; ?>"><br>
			                        <?php } ?>
	                              	<input type="file" name="cover">
	                        		<p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รูปภาพอัลบั้ม :</label>
	                          	<div class="controls">
	                          		<?php 
			                        if (!empty($row_news['news_gallery'])) {
			                        ?>
			                          	<a onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="?module=news&action=news_delete_img&id=<?php echo $row_news['news_id']; ?>&pictype=gallery&cover=<?php echo $row_news['news_gallery']; ?>">
						                  	<img width="120" src="../uploads/pic_news/<?php echo $row_news['news_gallery']; ?>"><br>
						               	</a>
						                <p class="help-block">*คลิกเพื่อทำการลบรูปภาพ.</p>
			                        <?php } ?>
	                              	<input type="file" name="gallery">
	                        		<p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
	                          	</div>
	                      	</div>
	                      	<div class="form-actions">
	                          	<button type="submit" class="btn btn-success"> แก้ไขข้อมูลข้อมูล </button>
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

function news_delete_img() {
	if (!empty($_GET['pictype'])) {
		if ($_GET['pictype']=="cover") {
			$SQL_UPDATE_PIC="UPDATE news SET news_cover='' WHERE news_id='".$_GET['id']."'";
			mysql_query($SQL_UPDATE_PIC) or die(mysql_error());
			@unlink("../uploads/pic_news/$_GET[cover]");
		}elseif ($_GET['pictype']=="gallery") {
		$SQL_UPDATE_PIC="UPDATE news SET news_gallery='' WHERE news_id='".$_GET['id']."'";
			mysql_query($SQL_UPDATE_PIC) or die(mysql_error());
			@unlink("../uploads/pic_news/$_GET[cover]");
		}
	}
	mysql_close();
	echo "<script language='javascript'>window.location='?module=news&action=news_edit_form&id=".$_GET['id']."'</script>";
}

function news_edit() {
	$name = mysql_real_escape_string($_POST['name']);
	$content = $_POST['content'];

	if ($_FILES['cover']['tmp_name']) {
		$cover_name = md5(time()).".".end(explode(".",$_FILES['cover']['name']));
		$cover_tmp = $_FILES['cover']['tmp_name'];
		if (!empty($cover_name)) {
			copy($cover_tmp, "../uploads/pic_news/$cover_name");
			@unlink("../uploads/pic_news/$_GET[cover]");
		}
		$sqlCover=",news_cover='".$cover_name."'";
	}else {
		$sqlCover="";
	}

	if ($_FILES['gallery']['tmp_name']) {
		$gallery_name = "1".md5(time()).".".end(explode(".",$_FILES['gallery']['name']));
		$gallery_tmp = $_FILES['gallery']['tmp_name'];
		if (!empty($gallery_name)) {
			copy($gallery_tmp, "../uploads/pic_news/$gallery_name");
			@unlink("../uploads/pic_news/$_GET[gallery]");
		}
		$sqlGallery=",news_gallery='".$gallery_name."'";
	}else {
		$sqlGallery="";
	}

	$SQL_EDIT_NEWS="UPDATE news SET news_title='".$name."',
		news_detail='".$content."'
		$sqlCover $sqlGallery WHERE news_id='".$_POST['id']."'";
	mysql_query($SQL_EDIT_NEWS) or die(mysql_error());
	mysql_close();
	echo "<script language='javascript'>window.location='?module=news&action=news_edit_form&id=".$_POST['id']."&message=true'</script>";
}