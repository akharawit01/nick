<?php
function news_index() {
	$RESULT_LIST_NEWS=mysql_query("SELECT * FROM news ORDER BY news_sort ASC, news_id DESC") or die(mysql_error());
?>

	<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">รายการข่าวสาร</h4>
                </div>
                <div class="content">
					<a href="?module=news&action=news_insert_form" class="btn btn-primary col-xs-2"> เพิ่มข่าวสาร </a>
		            	<form method="post" action="?module=news&action=news_bkdleall">
		                <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
		                    <thead>
		                        <tr>
		                            <th>ลำดับ </th>
		                            <th>หัวข้อข่าว </th>
		                            <th width="220">ลำดับ </th>
		                            <th width="210">จัดการ</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	<?php 
		                    	$ct=1;
		                    	while ($ROW_LIST_NEWS = mysql_fetch_array($RESULT_LIST_NEWS)) { 
		                    	?>
		                        <tr>
		                            <td><?php echo $ct++; ?></td>
		                            <td>
										<?php echo $ROW_LIST_NEWS['news_title']; ?>
										<br>
										<small>Created <?php echo $ROW_LIST_NEWS['created_at']; ?></small>
		                            </td>
		                            <td>
		                            	<input type="hidden" value="<?php echo $ROW_LIST_NEWS['news_id']; ?>" name="id[]">
		                            	<input class="form-control border-input" style="line-height: 0px;width:80px;display:inline;" type="number" name="sort[]" value="<?php echo $ROW_LIST_NEWS['news_sort'] ?>">

		                            	<?php
		      							if (empty($ROW_LIST_NEWS['news_display'])||$ROW_LIST_NEWS['news_display']==0) {
		      							?>
		      								<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=news&action=news_hidden&id=<?php echo $ROW_LIST_NEWS['news_id']; ?>&status=1" class="btn btn-primary btn-xs"> แสดง </a>
		      							<?php
		      							}else {
		      							?>
		          							<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=news&action=news_hidden&id=<?php echo $ROW_LIST_NEWS['news_id']; ?>&status=0" class="btn btn-danger btn-xs"> ไม่แสดง </a>
		      							<?php
		      							}
		      							?>
		                            	
		                            </td>
		                            <td class=" last">
		                            	<a href="?module=news&action=news_edit_form&id=<?php echo $ROW_LIST_NEWS['news_id']; ?>" class="btn btn-primary btn-xs">
		                            		<i class="ti-pencil"></i> แก้ไข
		                            	</a>
		                            	<a onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="?module=news&action=news_delete&id=<?php echo $ROW_LIST_NEWS['news_id']; ?>&cover=<?php echo $ROW_LIST_NEWS['news_cover']; ?>" class="btn btn-danger btn-xs"><i class="ti-trash"></i> ลบ </a>
		                            </td>
		                        </tr>
		                        <?php } ?>
		                    </tbody>
		                </table>
		                <br>
		                <table>
		                	<tr>
		                		<td><button type="submit" class="btn btn-success btn-sm" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')">DELETE & SORT</button></td>
		                	</tr>
		                </table>
		            </form>
                </div>
            </div>
        </div>
    </div>

<?php
}

function news_delete(){
  	$RESULT_DELETE_NEWS="DELETE FROM news WHERE news_id='".$_GET['id']."'";
  	mysql_query($RESULT_DELETE_NEWS) or die(mysql_error());
  	@unlink("../upload/pic_news/$_GET[cover]");
  	@unlink("../upload/pic_news/$_GET[gallery]");

	mysql_close();
  	echo "<script language='javascript'>window.location='?module=news&action=news_index'</script>";
}

function news_bkdleall(){
  	if (!empty($_POST['chkall'])) {
    	foreach ($_POST['chkall'] as  $value) {
    		$RESULT_DELETE_NEWS_COVER=mysql_query("SELECT news_cover FROM news WHERE news_id='".$value."'") or die(mysql_error());
    		$ROW_DELETE_NEWS_COVER = mysql_fetch_array($RESULT_DELETE_NEWS_COVER);
    		@unlink("../upload/pic_news/$ROW_DELETE_NEWS_COVER[news_cover]");
    		@unlink("../upload/pic_news/$ROW_DELETE_NEWS_COVER[news_gallery]");
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
	<div class="row">
	    <div class="col-lg-12">
	        <div class="card">
	            <div class="header">
	                <h4 class="title">เพิ่มข่าวสาร</h4>
	            </div>
	            <div class="content">
	            	<?php
                	if (!empty($_GET['message'])) {
                	?>
                		<div class="x_title">
						    <div class="alert alert-info">
						        <button type="button" aria-hidden="true" class="close">×</button>
						        </button>
						        <strong>บันทึกข้อมุลเรียบร้อย!</strong>
						    </div>
						</div>
                	<?php
                	}
                	?>
					<form class="form-horizontal form-label-left" action="?module=news&action=news_insert" method="post" enctype="multipart/form-data" data-parsley-validate>
					    <div class="form-group">
					        <label class="control-label col-md-2 col-sm-2 col-xs-12">หัวข้อข่าว<span class="required"> *</span>
					        </label>
					        <div class="col-md-9 col-sm-9 col-xs-12">
					            <input type="text" name="name" class="form-control col-md-7 col-xs-12 border-input" required="required">
					        </div>
					    </div>
					    
					    <div class="form-group">
					        <label class="control-label col-md-2 col-sm-2 col-xs-12">รายละเอียด<span class="required"> *</span>
					        </label>
					        <div class="col-md-9 col-sm-9 col-xs-12">
					            <textarea id="editor1" name="content"></textarea>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="control-label col-md-2 col-sm-2 col-xs-12">รูปภาพหลัก <span class="required"> *</span>
					        </label>
					        <div class="col-md-9 col-sm-9 col-xs-12">
					            <input type="file" name="cover" required="required">
					            <p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="control-label col-md-2 col-sm-2 col-xs-12">รูปภาพอัลบั้ม <span class="required"> *</span>
					        </label>
					        <div class="col-md-9 col-sm-9 col-xs-12">
					            <input type="file" name="gallery" required="required">
					            <p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
					        </div>
					    </div>

					    <div class="ln_solid"></div>
					    <div class="form-group">
					        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
					        	<button type="submit" class="btn btn-success"> บันทึกข้อมูล </button>
					            <button type="reset" class="btn btn-primary"> ล้างค่า </button>
					        </div>
					    </div>
					</form>
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
	      copy($cover_tmp, "../upload/pic-news/$cover_name");
	    }
	}else {
	    $cover_name="";
	}

	if ($_FILES['gallery']['tmp_name']) {
	    $gallery_name = "1".md5(time()).".".end(explode(".",$_FILES['gallery']['name']));
	    $gallery_tmp = $_FILES['gallery']['tmp_name'];
	    if (!empty($gallery_name)) {
	      copy($gallery_tmp, "../upload/pic-news/$gallery_name");
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
	$RESULT_LIST_NEWS=mysql_query("SELECT * FROM news WHERE news_id='".$_GET['id']."'") or die(mysql_error());
	$ROW_LIST_NEWS = mysql_fetch_array($RESULT_LIST_NEWS);
?>

	<div class="row">
	    <div class="col-lg-12">
	        <div class="card">
	            <div class="header">
	                <h4 class="title">แก้ไขข่าวสาร</h4>
	            </div>
	            <div class="content">
	            	<?php
                	if (!empty($_GET['message'])) {
                	?>
                		<div class="x_title">
						    <div class="alert alert-info">
						        <button type="button" aria-hidden="true" class="close">×</button>
						        </button>
						        <strong>บันทึกข้อมุลเรียบร้อย!</strong>
						    </div>
						</div>
                	<?php
                	}
                	?>
					<form class="form-horizontal form-label-left" action="?module=news&action=news_edit&cover=<?php echo $ROW_LIST_NEWS['news_cover']; ?>&gallery=<?php echo $ROW_LIST_NEWS['news_gallery']; ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
						    <div class="form-group">
						        <label class="control-label col-md-2 col-sm-2 col-xs-12">หัวข้อข่าว<span class="required">*</span>
						        </label>
						        <div class="col-md-9 col-sm-9 col-xs-12">
						        	<input type="hidden" name="id" value="<?php echo $ROW_LIST_NEWS['news_id']; ?>">
						            <input type="text" name="name" class="form-control col-md-7 col-xs-12 border-input" value="<?php echo $ROW_LIST_NEWS['news_title']; ?>" required="required">
						        </div>
						    </div>
					
						    <div class="form-group">
						        <label class="control-label col-md-2 col-sm-2 col-xs-12">รายละเอียด <span class="required">*</span>
						        </label>
						        <div class="col-md-9 col-sm-9 col-xs-12">
						            <textarea id="editor1" name="content"><?php echo $ROW_LIST_NEWS['news_detail']; ?></textarea>
						        </div>
						    </div>
						    
						    <div class="form-group">
						        <label class="control-label col-md-2 col-sm-2 col-xs-12">รูปภาพหลัก <span class="required">*</span>
						        </label>
						        <div class="col-md-9 col-sm-9 col-xs-12">
						            <input type="file" name="cover">
						            <p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
						        </div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-md-2 col-sm-2 col-xs-12">&nbsp;
						        </label>
						        <div class="col-md-9 col-sm-9 col-xs-12">
						            <?php 
			                    	if (!empty($ROW_LIST_NEWS['news_cover'])) {
			                    	?>
										<img width="120" src="../upload/pic_news/<?php echo $ROW_LIST_NEWS['news_cover']; ?>">
			                    	<?php } ?>
						        </div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-md-2 col-sm-2 col-xs-12">รูปภาพอัลบั้ม <span class="required">*</span>
						        </label>
						        <div class="col-md-9 col-sm-9 col-xs-12">
						            <input type="file" name="gallery">
						            <p class="help-block">*กรุณาเลือกภาพที่มีขนาด 1366 x 768.</p>
						        </div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-md-2 col-sm-2 col-xs-12">&nbsp;
						        </label>
						        <div class="col-md-9 col-sm-9 col-xs-12">
						            <?php 
			                    	if (!empty($ROW_LIST_NEWS['news_gallery'])) {
			                    	?>
			                    		<a onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="?module=news&action=news_delete_img&id=<?php echo $ROW_LIST_NEWS['news_id']; ?>&pictype=gallery&cover=<?php echo $ROW_LIST_NEWS['news_gallery']; ?>">
											<img width="120" src="../upload/pic_news/<?php echo $ROW_LIST_NEWS['news_gallery']; ?>">
										</a>
										<p class="help-block">*click at photo to delete.</p>
			                    	<?php } ?>
						        </div>
						    </div>

						    <div class="ln_solid"></div>
						    <div class="form-group">
						        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
						        	<button type="submit" class="btn btn-success"> บันทึกข้อมูล </button>
						        </div>
						    </div>
						</form>
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
			@unlink("../upload/pic_news/$_GET[cover]");
		}elseif ($_GET['pictype']=="gallery") {
			$SQL_UPDATE_PIC="UPDATE news SET news_gallery='' WHERE news_id='".$_GET['id']."'";
			mysql_query($SQL_UPDATE_PIC) or die(mysql_error());
			@unlink("../upload/pic_news/$_GET[cover]");
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
	      copy($cover_tmp, "../upload/pic_news/$cover_name");
	      @unlink("../upload/pic_news/$_GET[cover]");
	    }
	    $sqlCover=",news_cover='".$cover_name."'";
	}else {
	    $sqlCover="";
	}

	if ($_FILES['gallery']['tmp_name']) {
	    $gallery_name = "1".md5(time()).".".end(explode(".",$_FILES['gallery']['name']));
	    $gallery_tmp = $_FILES['gallery']['tmp_name'];
	    if (!empty($gallery_name)) {
	      copy($gallery_tmp, "../upload/pic_news/$gallery_name");
	      @unlink("../upload/pic_news/$_GET[gallery]");
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