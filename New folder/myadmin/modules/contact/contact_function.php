<?php
function contact_index() {
?>
	<div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <h4 class="title">ติดต่อเรา</h4>
                    <p class="category">Here is a subtitle for this table</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover">
                        <thead>
							<tr>
								<th>ข้อมูลผู้ติดต่อ</th>
								<th>ข้อความ</th>
								<th>วันที่</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$RESULT_CONTACT=mysql_query("SELECT * FROM contactus ORDER BY created_at DESC") or die(mysql_error());
							while ($ROW_CONTACT = mysql_fetch_array($RESULT_CONTACT)) { 
							?>
							<tr>
								<td>
									<?php echo $ROW_CONTACT['name']; ?><br>
									<?php echo $ROW_CONTACT['email']; ?><br>
									<?php echo $ROW_CONTACT['phone']; ?>
								</td>
								<td><?php echo $ROW_CONTACT['message']; ?></td>
								<td><?php echo DateThai($ROW_CONTACT['created_at']); ?></td>
							</tr>
							<?php } ?>

						</tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php
}
