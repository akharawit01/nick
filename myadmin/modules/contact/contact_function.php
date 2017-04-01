<?php
function contact_index() {
?>
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="index.php" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> หน้าหลัก</a> 
			<a href="#" class="current">ติดต่อเรา</a> 
		</div>
		<h1>ติดต่อเรา</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
						<h5>ติดต่อเรา</h5>
					</div>
					<div class="widget-content">
						<div class="table-responsive">
							<form method="post" action="?module=news&action=news_bkdleall">
								<table class="table table-bordered data-table">
									<thead>
										<tr>
											<th width="50">ลำดับ</th>
											<th>ข้อความ</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$i=1;
									$RESULT_CONTACT=mysql_query("SELECT * FROM contactus ORDER BY created_at DESC") or die(mysql_error());
									while ($ROW_CONTACT = mysql_fetch_array($RESULT_CONTACT)) { 
									?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td>
											ชื่อผู้ติดต่อ: <?php echo $ROW_CONTACT['name']; ?><br>
											อีเมล: <?php echo $ROW_CONTACT['email']; ?>
											<h4><?php echo $ROW_CONTACT['subject']; ?></h4>
											<p><?php echo $ROW_CONTACT['message']; ?></p>
											<span>วันที่ <?php echo DateThai($ROW_CONTACT['created_at']); ?></span>
										</td>
									</tr>
									<?php } ?>
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
