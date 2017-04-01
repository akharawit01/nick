<?php
function product_index() {
	$str="";
	if (!empty($_GET['id'])) {
		$str=" WHERE catagory='".$_GET['id']."'";
	}
	$result_products=mysql_query("SELECT * FROM product ".$str." ORDER BY sort ASC, id DESC") or die(mysql_error());
?>

	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
			<a href="#" class="current">สินค้า</a> 
		</div>
		<h1>สินค้า</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<a href="?module=product&action=product_insert_form" class="btn btn-primary"> เพิ่มสินค้า </a>
				<select onchange="showProtype(this.value)">
					<option value="0" selected>สินค้าทั้งหมด</option>
	            	<?php
	        		$result_catagory=mysql_query("SELECT * FROM catagory WHERE parent='0'") or die(mysql_error());
	        		while ($row_catagory = mysql_fetch_array($result_catagory)) { 
	        		?>
	        			<option value="<?php echo $row_catagory['id']; ?>" <?php echo $row_catagory['id']==@$_GET['id']?"selected":""; ?>>
	        				<?php echo $row_catagory['name']; ?>
	        			</option>
	        			<?php
	        			$result_catagory_ck1=mysql_query("SELECT * FROM catagory WHERE parent='".$row_catagory['id']."'") or die(mysql_error());
	        			$result_num_row1=mysql_num_rows($result_catagory_ck1);
	        			if (!empty($result_num_row1)) {
	        				while ($row_catagory1 = mysql_fetch_array($result_catagory_ck1)) { 
			        		?>
			        			<option value="<?php echo $row_catagory1['id']; ?>" <?php echo $row_catagory['id']==@$_GET['id']?"selected":""; ?>> - <?php echo $row_catagory1['name']; ?></option>
			        		<?php
			        		}
	        			}
					} ?>
	            </select>
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
						<h5>รายการสินค้า</h5>
					</div>
					<div class="widget-content">
						<div class="table-responsive">
							<form method="post" action="?module=product&action=product_bkdleall">
								<table class="table table-bordered data-table">
									<thead>
										<tr>
											<th width="50" class="center">
												<label class="pos-rel">
													<input type="checkbox" class="form-control ckall ace" id="selecctall">
													<span class="lbl"></span>
												</label>
											</th>
											<th width="40">รูปภาพ</th>
											<th>สินค้า </th>
											<th>สี </th>
											<th>การใช้งาน </th>
											<th>ราคา </th>
											<th width="100">ลำดับ - สถานะ</th>
											<th width="50">จัดการ</th>
										</tr>
									</thead>
									<tbody>
									<?php 
			                    	while ($row_products = mysql_fetch_array($result_products)) { 
			                    	?>
			                        <tr>
			                            <td class="center">
											<label class="pos-rel">
												<input type="checkbox" class="checkbox1 form-control ckall ace" name="chkall[]" value="<?php echo $row_products['id']; ?>">
												<span class="lbl"></span>
											</label>
										</td>
										<td><img width="40" src="../uploads/pic_product/<?php echo $row_products['cover']; ?>"></td>
			                            <td>
			                            	
			                            	<small><?php echo $row_products['code']; ?> - </small>
											<?php echo $row_products['name']; ?> (<?php echo $row_products['size']; ?>)
											<br>
											<small>Created <?php echo $row_products['create_time']; ?></small>
			                            </td>
			                            <td>
											<?php echo $row_products['color']; ?>
			                            </td>
			                            <td>
			                            	<?php echo $row_products['usingpro']; ?>
			                            </td>
			                            <td>
			                            	<?php
			                            	if (!empty($row_products['discount'])) {
			                            		$discount=0;
			                            		$discount=($row_products['price']*$row_products['discount'])/100;
			                            		echo number_format($row_products['price']-$discount,2, ',', '.')."<br>";
			                            	?>
												<strike> <?php echo $row_products['price']; ?> </strike>
			                            	<?php
			                            		echo "-".$row_products['discount']."%";
			                            	}else {
			                            		echo $row_products['price'];
			                            	}
			                            	?>
			                            	<?php  ?>
			                            </td>
			                            <td>
			                            	<input type="hidden" value="<?php echo $row_products['id']; ?>" name="id[]">
			                            	<input class="form-control input-sm line-none" type="number" name="sort[]" value="<?php echo $row_products['sort'] ?>">

			                            	<?php
			      							if (empty($row_products['display'])||$row_products['display']==0) {
			      							?>
			      								<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=product&action=product_hidden&id=<?php echo $row_products['id']; ?>&status=1" class="btn btn-danger btn-mini"> ไม่แสดง </a>
			      							<?php
			      							}else {
			      							?>
			          							<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=product&action=product_hidden&id=<?php echo $row_products['id']; ?>&status=0" class="btn btn-primary btn-mini"> แสดง </a>
			      							<?php
			      							}
			      							?>

			      							<?php
			      							if (empty($row_products['display_index'])||$row_products['display_index']==0) {
			      							?>
			      								<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=product&action=product_hidden_index&id=<?php echo $row_products['id']; ?>&status=1" class="btn btn-primary btn-mini"> สินค้าใหม่ </a>
			      							<?php
			      							}else {
			      							?>
			          							<a onclick="return confirm('กรุณายืนยันอีกครั้ง !!!')" href="?module=product&action=product_hidden_index&id=<?php echo $row_products['id']; ?>&status=0" class="btn btn-danger btn-mini"> ยกเลิกสินค้าใหม่ </a>
			      							<?php
			      							}
			      							?>
			                            	
			                            </td>
			                            <td class=" last">
			                            	<div class="pull-right">
												<a class="tip" href="?module=product&action=product_edit_form&id=<?php echo $row_products['id']; ?>" data-original-title="Edit Task"><i class="icon-pencil"></i></a>
												<a class="tip" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="?module=product&action=product_delete&id=<?php echo $row_products['id']; ?>&cover=<?php echo $row_products['cover']; ?>" data-original-title="Delete"><i class="icon-remove"></i></a>
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

    <script>
	function showProtype(str) {
	    window.location='?module=product&action=product_index&id='+str;
	}
	</script>
<?php
}

function product_delete(){
  	$result_delete="DELETE FROM product WHERE id='".$_GET['id']."'";
  	mysql_query($result_delete) or die(mysql_error());
  	@unlink("../uploads/pic_product/$_GET[cover]");

  	$result_delete="DELETE FROM producttag WHERE p_id='".$_GET['id']."'";
  	mysql_query($result_delete) or die(mysql_error());

	mysql_close();
  	echo "<script language='javascript'>window.history.back();</script>";
}

function product_bkdleall(){
	$ct=count(@$_POST['chkall']);
  	if (!empty($ct)) {
    	foreach ($_POST['chkall'] as  $value) {
    		$result_delete_cover=mysql_query("SELECT cover FROM product WHERE id='".$value."'") or die(mysql_error());
    		$row_delete_cover = mysql_fetch_array($result_delete_cover);
    		@unlink("../uploads/pic_product/$row_delete_cover[cover]");

    		$result_delete="DELETE FROM product WHERE id='".$value."'";
  			mysql_query($result_delete) or die(mysql_error());

  			$result_delete="DELETE FROM producttag WHERE p_id='".$value."'";
  			mysql_query($result_delete) or die(mysql_error());
    	}
  	}

  	if (!empty($_POST['id'])) {
		$b=0;
		foreach ($_POST['id'] as  $value) {
		  	$result_sort="UPDATE product SET sort='".$_POST['sort'][$b]."' WHERE id='".$value."'";
		  	mysql_query($result_sort) or die(mysql_error());
			$b++;
		}
	}
	mysql_close();
  	echo "<script language='javascript'>window.history.back();</script>";
}

function product_bkdleall_index(){
  	if (!empty($_POST['chkall'])) {
    	foreach ($_POST['chkall'] as  $value) {
    		$result_delete_cover=mysql_query("SELECT cover FROM product WHERE id='".$value."'") or die(mysql_error());
    		$row_delete_cover = mysql_fetch_array($result_delete_cover);
    		@unlink("../uploads/pic_product/$row_delete_cover[cover]");
    	}
  	}

  	if (!empty($_POST['id'])) {
		$b=0;
		foreach ($_POST['id'] as  $value) {
		  	$result_sort="UPDATE product SET sort_index='".$_POST['sort'][$b]."' WHERE id='".$value."'";
		  	mysql_query($result_sort) or die(mysql_error());
			$b++;
		}
	}
	mysql_close();
  	echo "<script language='javascript'>window.history.back();</script>";
}


function product_hidden() {
	$sql_display="UPDATE product SET display='".$_GET['status']."' WHERE id='".$_GET['id']."'";
	mysql_query($sql_display) or die(mysql_error());
	mysql_close();
	echo "<script language='javascript'>window.history.back();</script>";
}

function product_hidden_index() {
	$sql_display_index="UPDATE product SET display_index='".$_GET['status']."' WHERE id='".$_GET['id']."'";
	mysql_query($sql_display_index) or die(mysql_error());
	mysql_close();
	echo "<script language='javascript'>window.history.back();</script>";
}

function product_insert_form() {
?>
	<div id="content-header">
      	<div id="breadcrumb"> 
      		<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
      		<a href="?module=product&action=product_index" class="tip-bottom" data-original-title="Go to Product"><i class="icon-trophy"></i> รายการสินค้า</a> 
      		<a href="#" class="current">เพิ่มสินค้า</a> 
      	</div>
      	<h1>เพิ่มสินค้า</h1>
 	</div>
  	<div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5>เพิ่มสินค้า</h5>
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
	                 	<form class="form-horizontal form-label-left" action="?module=product&action=product_insert" method="post" enctype="multipart/form-data" data-parsley-validate>
	                      	<div class="control-group">
	                          	<label class="control-label">หมวดหมู่สินค้า* :</label>
	                          	<div class="controls">
	                          		<select name="catagory" class="form-control span11" required="required">
						            	<?php
						        		$result_catagory=mysql_query("SELECT * FROM catagory WHERE parent='0'") or die(mysql_error());
						        		while ($row_catagory = mysql_fetch_array($result_catagory)) { 
						        		?>
						        			<option value="<?php echo $row_catagory['id']; ?>"><?php echo $row_catagory['name']; ?></option>
						        			<?php
						        			$result_catagory_ck1=mysql_query("SELECT * FROM catagory WHERE parent='".$row_catagory['id']."'") or die(mysql_error());
						        			$result_num_row1=mysql_num_rows($result_catagory_ck1);
						        			if (!empty($result_num_row1)) {
						        				while ($row_catagory1 = mysql_fetch_array($result_catagory_ck1)) { 
								        		?>
								        			<option value="<?php echo $row_catagory1['id']; ?>"> - <?php echo $row_catagory1['name']; ?></option>
								        		<?php
								        		}
						        			}
										} ?>
						            </select>
	                          	</div>
	                      	</div>

							<div class="control-group">
	                          	<label class="control-label">แท็ก* :</label>
	                          	<div class="controls">
									<select class="span11" name="tag[]" required="required" multiple>
										<?php
						        		$result_tag=mysql_query("SELECT * FROM tag ORDER BY name ASC") or die(mysql_error());
						        		while ($row_tag = mysql_fetch_array($result_tag)) { 
						        		?>
						        		<option value="<?php echo $row_tag['id']; ?>"><?php echo $row_tag['name']; ?></option>
						        		<?php } ?>
									</select>
								</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รหัสสินค้า* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="code" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ชื่อสินค้า* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="name" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ขนาด* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="size" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ยี่ห้อ* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="branch" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">วัสดุ :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="material">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ผิวหน้า :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="faceskin">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">สี* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="color" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ลวดลาย :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="pattern">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">การใช้งาน* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="usingpro" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ขนาดบรรจุต่อกล่อง* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="packingboxes">
	                          	</div>
	                      	</div>

	                      	<div class="control-group">
	                          	<label class="control-label">รายละเอียดเพิ่มเติม :</label>
	                          	<div class="controls">
	                              	<textarea id="editor1" name="detail"></textarea>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ราคา* :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="price" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ส่วนลด* (%):</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="discount" value="0" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">จำนวน :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="amount" value="0" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">หน่วยนับ* :</label>
	                          	<div class="controls">
									<select class="span11" name="unit" required="required">
										<?php
						        		$result_unit=mysql_query("SELECT * FROM unit ORDER BY name ASC") or die(mysql_error());
						        		while ($row_unit = mysql_fetch_array($result_unit)) { 
						        		?>
						        		<option value="<?php echo $row_unit['id']; ?>"><?php echo $row_unit['name']; ?></option>
						        		<?php } ?>
									</select>
								</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รูปภาพหลัก :</label>
	                          	<div class="controls">
	                              	<input type="file" name="cover" required="required">
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

function product_insert() {
	$code = mysql_real_escape_string($_POST['code']);
	$name = mysql_real_escape_string($_POST['name']);
	$size = mysql_real_escape_string($_POST['size']);
	$branch = mysql_real_escape_string($_POST['branch']);
	$material = mysql_real_escape_string($_POST['material']);
	$faceskin = mysql_real_escape_string($_POST['faceskin']);
	$color = mysql_real_escape_string($_POST['color']);
	$pattern = mysql_real_escape_string($_POST['pattern']);
	$usingpro = mysql_real_escape_string($_POST['usingpro']);
	$packingboxes = mysql_real_escape_string($_POST['packingboxes']);
	$detail = $_POST['detail'];
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$amount = mysql_real_escape_string($_POST['amount']);
	$unit = mysql_real_escape_string($_POST['unit']);


	$sql = "SELECT id FROM product WHERE code='$code'";
    $result = mysql_query($sql) or die(mysql_error());
    $count = mysql_num_rows($result);
    if (!empty($count)) {
    	echo '<script language="javascript">';
		echo 'alert("รหัสสินค้าซ้ำ!")';
		echo '</script>';
    	echo "<script language='javascript'>window.history.back();</script>";
    	exit();
    }

	if ($_FILES['cover']['tmp_name']) {
	    $cover_name = md5(time()).".".end(explode(".",$_FILES['cover']['name']));
	    $cover_tmp = $_FILES['cover']['tmp_name'];
	    if (!empty($cover_name)) {
	      copy($cover_tmp, "../uploads/pic_product/$cover_name");
	    }
	}else {
	    $cover_name="";
	}

	$sql_product="INSERT INTO product VALUES ('',
		'".$code."',
		'".$name."',
		'".$_POST['catagory']."',
		'".$branch."',
		'".$size."',
		'".$material."',
		'".$faceskin."',
		'".$color."',
		'".$pattern."',
		'".$usingpro."',
		'".$packingboxes."',
		'".$detail."',
		'".$cover_name."',
		'".$price."',
		'".$discount."',
		'".$amount."',
		'".$unit."',
		'0','0','0','".date("Y-m-d H:i:s")."')";
	mysql_query($sql_product) or die(mysql_error());


	$sql="";
	$p_id = mysql_insert_id();
	$ct=count(@$_POST['tag']);
	if (!empty($ct)) {
		// print_r($_POST['tag']);
		
		if (count($_POST['tag'])==1) {
			$t_id=$_POST['tag'][0];
			$sql_product="INSERT INTO producttag VALUES ('','$p_id','$t_id')";
			mysql_query($sql_product) or die(mysql_error());
		}else {
			$i=0;
			foreach ($_POST['tag'] as $key => $value) {
				$cmm=($i==0)?'':',';
				$sql.=$cmm."('','$p_id','$value')";
				$i++;
			}
			$sql_product="INSERT INTO producttag VALUES $sql";
			mysql_query($sql_product) or die(mysql_error());
		}
	}
	mysql_close();
	echo "<script language='javascript'>window.location='?module=product&action=product_insert_form&message=true'</script>";
}

function product_edit_form() {
	$result_products=mysql_query("SELECT * FROM product WHERE id='".$_GET['id']."'") or die(mysql_error());
	$row_products = mysql_fetch_array($result_products);
?>

	<div id="content-header">
      	<div id="breadcrumb"> 
      		<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
      		<a href="?module=product&action=product_index" class="tip-bottom" data-original-title="Go to Product"><i class="icon-trophy"></i> รายการสินค้า</a> 
      		<a href="#" class="current">แก้ไขสินค้า</a> 
      	</div>
      	<h1>แก้ไขสินค้า</h1>
 	</div>
  	<div class="container-fluid">
      	<div class="row-fluid">
          	<div class="span12">
          		<div class="widget-box">
              		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
	                  	<h5>แก้ไขสินค้า</h5>
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
	                 	<form class="form-horizontal form-label-left" action="?module=product&action=product_edit&cover=<?php echo $row_products['cover']; ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
	                      	<div class="control-group">
	                      		<input type="hidden" name="id" value="<?php echo $row_products['id']; ?>">
	                          	<label class="control-label">หมวดหมู่สินค้า :</label>
	                          	<div class="controls">
	                          		<select name="catagory" class="form-control span11" required="required">
						            	<?php
						        		$result_catagory=mysql_query("SELECT * FROM catagory WHERE parent='0'") or die(mysql_error());
						        		while ($row_catagory = mysql_fetch_array($result_catagory)) { 
						        		?>
						        			<option value="<?php echo $row_catagory['id']; ?>"><?php echo $row_catagory['name']; ?></option>
						        			<?php
						        			$result_catagory_ck1=mysql_query("SELECT * FROM catagory WHERE parent='".$row_catagory['id']."'") or die(mysql_error());
						        			$result_num_row1=mysql_num_rows($result_catagory_ck1);
						        			if (!empty($result_num_row1)) {
						        				while ($row_catagory1 = mysql_fetch_array($result_catagory_ck1)) { 
								        		?>
								        			<option value="<?php echo $row_catagory1['id']; ?>" <?php echo $row_catagory1['id']==$row_products['id']?"selected":""; ?>> - <?php echo $row_catagory1['name']; ?></option>
								        		<?php
								        		}
						        			}
										} ?>
						            </select>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">แท็ก :</label>
	                          	<div class="controls">
									<select class="span11" name="tag[]" multiple>
										<?php
						        		$result_tag=mysql_query("SELECT * FROM tag ORDER BY name ASC") or die(mysql_error());
						        		while ($row_tag = mysql_fetch_array($result_tag)) {
						        			$result_producttag=mysql_query("SELECT * FROM producttag WHERE p_id='$_GET[id]' AND t_id='$row_tag[id]'") or die(mysql_error());
						        			$numrows = mysql_num_rows($result_producttag);
						        		?>
						        		<option value="<?php echo $row_tag['id']; ?>" <?php echo (!empty($numrows)?'selected':'') ?>><?php echo $row_tag['name']; ?></option>
						        		<?php } ?>
									</select>
								</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รหัสสินค้า :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="code" value="<?php echo $row_products['code']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ชื่อสินค้า :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="name" value="<?php echo $row_products['name']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ขนาด :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="size" value="<?php echo $row_products['size']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ยี่ห้อ :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="branch" value="<?php echo $row_products['branch']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">วัสดุ :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" value="<?php echo $row_products['material']; ?>" name="material">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ผิวหน้า :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" value="<?php echo $row_products['faceskin']; ?>" name="faceskin">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">สี :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="color" value="<?php echo $row_products['color']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ลวดลาย :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="pattern" value="<?php echo $row_products['pattern']; ?>">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">การใช้งาน :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="usingpro" value="<?php echo $row_products['usingpro']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ขนาดบรรจุต่อกล่อง :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="packingboxes" value="<?php echo $row_products['packingboxes']; ?>" required="required">
	                          	</div>
	                      	</div>

	                      	<div class="control-group">
	                          	<label class="control-label">รายละเอียดเพิ่มเติม :</label>
	                          	<div class="controls">
	                              	<textarea id="editor1" name="detail"><?php echo $row_products['detail'] ?></textarea>
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ราคา :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="price" value="<?php echo $row_products['price']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">ส่วนลด :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="discount" value="<?php echo $row_products['discount']; ?>" required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">จำนวน :</label>
	                          	<div class="controls">
	                          		<input type="text" class="span11" name="amount" value="<?php echo $row_products['amount']; ?>"required="required">
	                          	</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">หน่วยนับ :</label>
	                          	<div class="controls">
									<select class="span11" name="unit">
										<?php
						        		$result_unit=mysql_query("SELECT * FROM unit ORDER BY name ASC") or die(mysql_error());
						        		while ($row_unit = mysql_fetch_array($result_unit)) { 
						        		?>
						        		<option value="<?php echo $row_unit['id']; ?>" <?php echo ($row_unit['id']==$row_products['unit']?'selected':'') ?>><?php echo $row_unit['name']; ?></option>
						        		<?php } ?>
									</select>
								</div>
	                      	</div>
	                      	<div class="control-group">
	                          	<label class="control-label">รูปภาพหลัก :</label>
	                          	<div class="controls">
	                          		<?php 
			                    	if (!empty($row_products['cover'])) {
			                    	?>
			                    		<img width="120" src="../uploads/pic_product/<?php echo $row_products['cover']; ?>"><br>
			                    	<?php } ?>
	                              	<input type="file" name="cover">
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

function product_delete_img() {
	if (!empty($_GET['pictype'])) {
		if ($_GET['pictype']=="cover") {
			$sql_delete="UPDATE product SET cover='' WHERE id='".$_GET['id']."'";
			mysql_query($sql_delete) or die(mysql_error());
			@unlink("../uploads/pic_product/$_GET[cover]");
		}elseif ($_GET['pictype']=="gallery") {
			
		}
	}
	mysql_close();
	echo "<script language='javascript'>window.location='?module=product&action=product_edit_form&id=".$_GET['id']."'</script>";
}

function product_edit() {
	$code = mysql_real_escape_string($_POST['code']);
	$name = mysql_real_escape_string($_POST['name']);
	$size = mysql_real_escape_string($_POST['size']);
	$branch = mysql_real_escape_string($_POST['branch']);
	$material = mysql_real_escape_string($_POST['material']);
	$faceskin = mysql_real_escape_string($_POST['faceskin']);
	$color = mysql_real_escape_string($_POST['color']);
	$pattern = mysql_real_escape_string($_POST['pattern']);
	$usingpro = mysql_real_escape_string($_POST['usingpro']);
	$packingboxes = mysql_real_escape_string($_POST['packingboxes']);
	$detail = $_POST['detail'];
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$amount = mysql_real_escape_string($_POST['amount']);
	$unit = mysql_real_escape_string($_POST['unit']);

	$sql = "SELECT id FROM product WHERE code='$code' AND id!='$_POST[id]'";
    $result = mysql_query($sql) or die(mysql_error());
    $count = mysql_num_rows($result);
    if (!empty($count)) {
    	echo '<script language="javascript">';
		echo 'alert("รหัสสินค้าซ้ำ!")';
		echo '</script>';
    	echo "<script language='javascript'>window.history.back();</script>";
    	exit();
    }

	if ($_FILES['cover']['tmp_name']) {
	    $cover_name = md5(time()).".".end(explode(".",$_FILES['cover']['name']));
	    $cover_tmp = $_FILES['cover']['tmp_name'];
	    if (!empty($cover_name)) {
	      	copy($cover_tmp, "../uploads/pic_product/$cover_name");
	     	@unlink("../uploads/pic_product/$_GET[cover]");
	    }
	    $sqlCover=",cover='".$cover_name."'";
	}else {
	    $sqlCover="";
	}


	$SQL_EDIT_PRODUCT="UPDATE product SET code='".$code."',
		name='".$name."',
		catagory='".$_POST['catagory']."',
		branch='".$branch."',
		size='".$size."',
		material='".$material."',
		faceskin='".$faceskin."',
		color='".$color."',
		pattern='".$pattern."',
		usingpro='".$usingpro."',
		packingboxes='".$packingboxes."',
		detail='".$detail."',
		price='".$price."',
		discount='".$discount."',
		amount='".$amount."',
		unit='".$unit."'
		$sqlCover WHERE id='".$_POST['id']."'";
	mysql_query($SQL_EDIT_PRODUCT) or die(mysql_error());



	$result_delete="DELETE FROM producttag WHERE p_id='".@$_POST['id']."'";
  	mysql_query($result_delete) or die(mysql_error());

	$sql="";
	$p_id = $_POST['id'];
	$ct=count(@$_POST['tag']);
	if (!empty($ct)) {
		
		if (count($_POST['tag'])==1) {
			$t_id=$_POST['tag'][0];
			$sql_product="INSERT INTO producttag VALUES ('','$p_id','$t_id')";
			mysql_query($sql_product) or die(mysql_error());
		}else {
			$i=0;
			foreach ($_POST['tag'] as $key => $value) {
				$cmm=($i==0)?'':',';
				$sql.=$cmm."('','$p_id','$value')";
				$i++;
			}
			$sql_product="INSERT INTO producttag VALUES $sql";
			mysql_query($sql_product) or die(mysql_error());
		}
	}

	mysql_close();
	echo "<script language='javascript'>window.location='?module=product&action=product_edit_form&id=".$_POST['id']."&message=true'</script>";
}