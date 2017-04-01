<?php
function catagory_index() {
?>
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
			<a href="#" class="current">ประเภทสินค้า</a> 
		</div>
		<h1>ประเภทสินค้า</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span6">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
						<h5>ประเภทสินค้า</h5>
					</div>
					<div class="widget-content">
						<div class="alert alert-danger ">
		                    <span><b> *</b> คลิกที่รายการเพื่อแก้ไข หรือลบ</span>
		                </div>
						<ul class="tree">
			        		<?php
			        		$RESULT_LIST_CATAGORY=mysql_query("SELECT * FROM catagory WHERE parent='0'") or die(mysql_error());
			        		while ($ROW_LIST_CATAGORY = mysql_fetch_array($RESULT_LIST_CATAGORY)) { 
			        		?>
			        		<li><a href="?module=catagory&action=catagory_index&id=<?php echo $ROW_LIST_CATAGORY['id']; ?>"><?php echo $ROW_LIST_CATAGORY['name']; ?></a>

			        			<?php
			        			$RESULT_LIST_CATAGORY_CK1=mysql_query("SELECT * FROM catagory WHERE parent='".$ROW_LIST_CATAGORY['id']."'") or die(mysql_error());
			        			$RESULT_NUM_ROWS1=mysql_num_rows($RESULT_LIST_CATAGORY_CK1);
			        			if (!empty($RESULT_NUM_ROWS1)) {
			        			?>
			        				<ul>
			        					<?php
						        		$RESULT_LIST_CATAGORY1=mysql_query("SELECT * FROM catagory WHERE parent='".$ROW_LIST_CATAGORY['id']."'") or die(mysql_error());
						        		while ($ROW_LIST_CATAGORY1 = mysql_fetch_array($RESULT_LIST_CATAGORY1)) { 
						        		?>
						        			<li><a href="?module=catagory&action=catagory_index&id=<?php echo $ROW_LIST_CATAGORY1['id']; ?>"><?php echo $ROW_LIST_CATAGORY1['name']; ?></a></li>
						        		<?php
						        		}
						        		?>
			        				</ul>
			        			<?php
			        			}
			        			?>

			        		</li>
			        		<?php } ?>
			        	</ul>
					</div>
				</div>
			</div>
			<div class="span6">
				<?php
				if (!empty($_GET['id'])) {
				$RESULT_EDIT_CATAGORY=mysql_query("SELECT * FROM catagory WHERE id='".$_GET['id']."'") or die(mysql_error());
			    $ROW_EDIT_CATAGORY = mysql_fetch_array($RESULT_EDIT_CATAGORY);
				?>
					<div class="widget-box">
						<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
							<h5>แก้ไขประเภท</h5>
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
				        	<form method="post" action="?module=catagory&action=catagory_edit" data-parsley-validate>
							    <div class="form-group">
							        <label>ชื่อประเภท</label>
							        <input type="hidden" class="form-control border-input" name="id" value="<?php echo $ROW_EDIT_CATAGORY['id']; ?>" required="required">
							        <input type="text" class="form-control span11" name="name" value="<?php echo $ROW_EDIT_CATAGORY['name']; ?>" required="required">
							    </div>
							    <button type="submit" class="btn btn-info btn-md">แก้ไขประเภท</button>
							    <a href="?module=catagory&action=catagory_delete&id=<?php echo $ROW_EDIT_CATAGORY['id']; ?>" class="btn btn-danger btn-md">ลบประเภท</a>
							    <a href="?module=catagory&action=catagory_index" class="btn btn-warning btn-md">ยกเลิก</a>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>

					<?php
			        if (empty($ROW_EDIT_CATAGORY['parent'])) {
			      	?>
			      	<div class="widget-box">
						<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
							<h5>เพิ่มประเภทย่อย</h5>
						</div>
						<div class="widget-content">
							<form method="post" action="?module=catagory&action=catagory_insert" data-parsley-validate>
							    <div class="form-group">
							        <label>ชื่อประเภทย่อย</label>
							        <input type="hidden" class="form-control border-input" name="parent" value="<?php echo $ROW_EDIT_CATAGORY['id']; ?>" required="required">
							        <input type="text" class="form-control span11" name="name" required="required">
							    </div>
							    <button type="submit" class="btn btn-info btn-md">บันทึกประเภท</button>
							    <a href="?module=catagory&action=catagory_index" class="btn btn-warning btn-md">ยกเลิก</a>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
			      	<?php
			        }
			        ?>

				<?php
				}else {
				?>
					<div class="widget-box">
						<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
							<h5>เพิ่มประเภท</h5>
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
				        	<form method="post" action="?module=catagory&action=catagory_insert" data-parsley-validate>
							    <div class="form-group">
							        <label>ชื่อประเภท</label>
							        <input type="text" class="form-control span11" name="name" required="required">
							    </div>
							    <button type="submit" class="btn btn-info btn-md">บันทึกประเภท</button>
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

function catagory_insert() {
    $catagory_name = mysql_real_escape_string($_POST['name']);
    $catagory_parent = 0;
    if (!empty($_POST['parent'])) {
    	$catagory_parent = mysql_real_escape_string($_POST['parent']);
    }
 
    $SQL_INSERT_CATAGORY="INSERT INTO catagory VALUES ('',
    	'".$catagory_parent."',
        '".$catagory_name."',
        '".date("Y-m-d H:i:s")."',
        '".date("Y-m-d H:i:s")."')";

    mysql_query($SQL_INSERT_CATAGORY) or die(mysql_error());

    mysql_close();
    if (!empty($catagory_parent)) {
    	echo "<script language='javascript'>window.location='?module=catagory&action=catagory_index&id=$catagory_parent&message=true'</script>";
    }else {
    	echo "<script language='javascript'>window.location='?module=catagory&action=catagory_index&message=true'</script>";
    }
}

function catagory_edit() {
    $catagory_name = mysql_real_escape_string($_POST['name']);
 
    $SQL_EDIT_CATAGORY="UPDATE catagory SET name='".$catagory_name."' WHERE id='".$_POST['id']."'";
    mysql_query($SQL_EDIT_CATAGORY) or die(mysql_error());
  
    mysql_close();
    echo "<script language='javascript'>window.location='?module=catagory&action=catagory_index&id=".$_POST['id']."&message=true'</script>";
}

function catagory_delete(){


	$RESULT_DELETE_CATAGORY="DELETE FROM catagory WHERE id='".$_GET['id']."'";
    mysql_query($RESULT_DELETE_CATAGORY) or die(mysql_error());

	$RESULT_LIST_CATAGORY_CK=mysql_query("SELECT * FROM catagory WHERE parent='".$_GET['id']."'") or die(mysql_error());
	$RESULT_NUM_ROWS=mysql_num_rows($RESULT_LIST_CATAGORY_CK);
	if (!empty($RESULT_NUM_ROWS)) {
		$RESULT_LIST_CATAGORY=mysql_query("SELECT * FROM catagory WHERE parent='".$_GET['id']."'") or die(mysql_error());
		while ($ROW_LIST_CATAGORY = mysql_fetch_array($RESULT_LIST_CATAGORY)) { 
			$RESULT_DELETE_CATAGORY="DELETE FROM catagory WHERE id='".$ROW_LIST_CATAGORY['id']."'";
    		mysql_query($RESULT_DELETE_CATAGORY) or die(mysql_error());

    		$RESULT_LIST_CATAGORY_CK1=mysql_query("SELECT * FROM catagory WHERE parent='".$ROW_LIST_CATAGORY['id']."'") or die(mysql_error());
			$RESULT_NUM_ROWS1=mysql_num_rows($RESULT_LIST_CATAGORY_CK1);
			if (!empty($RESULT_NUM_ROWS1)) {
				$RESULT_LIST_CATAGORY1=mysql_query("SELECT * FROM catagory WHERE parent='".$ROW_LIST_CATAGORY['id']."'") or die(mysql_error());
				while ($ROW_LIST_CATAGORY1 = mysql_fetch_array($RESULT_LIST_CATAGORY1)) { 
					$RESULT_DELETE_CATAGORY="DELETE FROM catagory WHERE id='".$ROW_LIST_CATAGORY1['id']."'";
		    		mysql_query($RESULT_DELETE_CATAGORY) or die(mysql_error());

		    		
				}
			}

		}
	}


    


    mysql_close();
    echo "<script language='javascript'>window.location='?module=catagory&action=catagory_index'</script>";
}