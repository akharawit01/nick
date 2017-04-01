<?php
function tag_index() {
?>
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
			<a href="#" class="current">รายการแท็ก</a> 
		</div>
		<h1>รายการแท็ก</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span6">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
						<h5>รายการแท็ก</h5>
					</div>
					<div class="widget-content">
						<div class="alert alert-danger ">
		                    <span><b> *</b> คลิกที่รายการเพื่อแก้ไข หรือลบ</span>
		                </div>
						<ul class="tree">
			        		<?php
			        		$result_tag=mysql_query("SELECT * FROM tag ORDER BY name ASC") or die(mysql_error());
			        		while ($row_tag = mysql_fetch_array($result_tag)) { 
			        		?>
			        		<li><a href="?module=tag&action=tag_index&id=<?php echo $row_tag['id']; ?>"><?php echo $row_tag['name']; ?></a></li>
			        		<?php } ?>
			        	</ul>
					</div>
				</div>
			</div>
			<div class="span6">
				<?php
				if (!empty($_GET['id'])) {
				$RESULT_EDIT_CATAGORY=mysql_query("SELECT * FROM tag WHERE id='".$_GET['id']."'") or die(mysql_error());
			    $ROW_EDIT_CATAGORY = mysql_fetch_array($RESULT_EDIT_CATAGORY);
				?>
					<div class="widget-box">
						<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
							<h5>แก้ไขแท็ก</h5>
						</div>
						<div class="widget-content">
							<?php
		                    if (!empty($_GET['message'])) {
		                    ?>
	                            <div class="alert alert-success alert-dismissible fade in" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	                                </button>
	                                <strong>บันทึกข้อมุลเรียบร้อย!</strong>
	                            </div>
		                    <?php
		                    }
		                    ?>
				        	<form method="post" action="?module=tag&action=tag_edit" data-parsley-validate>
							    <div class="form-group">
							        <label>ชื่อแท็ก</label>
							        <input type="hidden" class="form-control border-input" name="id" value="<?php echo $ROW_EDIT_CATAGORY['id']; ?>" required="required">
							        <input type="text" class="form-control span11" name="name" value="<?php echo $ROW_EDIT_CATAGORY['name']; ?>" required="required">
							    </div>
							    <button type="submit" class="btn btn-info btn-md">แก้ไขแท็ก</button>
							    <a href="?module=tag&action=tag_delete&id=<?php echo $ROW_EDIT_CATAGORY['id']; ?>" class="btn btn-danger btn-md">ลบแท็ก</a>
							    <a href="?module=tag&action=tag_index" class="btn btn-warning btn-md">ยกเลิก</a>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php
				}else {
				?>
					<div class="widget-box">
						<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
							<h5>เพิ่มแท็ก</h5>
						</div>
						<div class="widget-content">
							<?php
		                    if (!empty($_GET['message'])) {
		                    ?>
	                            <div class="alert alert-success alert-dismissible fade in" role="alert">
	                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	                                </button>
	                                <strong>บันทึกข้อมุลเรียบร้อย!</strong>
	                            </div>
		                    <?php
		                    }
		                    ?>
				        	<form method="post" action="?module=tag&action=tag_insert" data-parsley-validate>
							    <div class="form-group">
							        <label>ชื่อแท็ก</label>
							        <input type="text" class="form-control span11" name="name" required="required">
							    </div>
							    <button type="submit" class="btn btn-info btn-md">บันทึกแท็ก</button>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
<?php
}

function tag_insert() {
    $tag_name = mysql_real_escape_string($_POST['name']);
 
    $sql_tag="INSERT INTO tag VALUES ('','".$tag_name."')";
    mysql_query($sql_tag) or die(mysql_error());
    mysql_close();
    echo "<script language='javascript'>window.location='?module=tag&action=tag_index&message=true'</script>";
}

function tag_edit() {
    $tag_name = mysql_real_escape_string($_POST['name']);
 
    $sql_update="UPDATE tag SET name='".$tag_name."' WHERE id='".$_POST['id']."'";
    mysql_query($sql_update) or die(mysql_error());
    mysql_close();
    echo "<script language='javascript'>window.location='?module=tag&action=tag_index&id=".$_POST['id']."&message=true'</script>";
}

function tag_delete(){
	$result_delete="DELETE FROM tag WHERE id='".$_GET['id']."'";
    mysql_query($result_delete) or die(mysql_error());

    $result_delete="DELETE FROM producttag WHERE t_id='".$_GET['id']."'";
  	mysql_query($result_delete) or die(mysql_error());

    mysql_close();
    echo "<script language='javascript'>window.location='?module=tag&action=tag_index'</script>";
}