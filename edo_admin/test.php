<?php
require_once 'head.php'; ?>

<body>
	<?php require_once 'aside.php'; ?>
	<div id="right-panel" class="right-panel">
		<?php require_once 'header.php'; ?>
		<div class="content">
			<div class="animated fadeIn">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="medium-12">

									<body>
										<div class="container">
											<fieldset class="form-row d-flex justify-content-between" id="Member">
												<div class="btn-group col-6">
													<input type="radio" id="watch-me-maybe" value="maybe" name="Member" class="btn-check">
													<label for="watch-me-maybe" class="btn btn-outline-primary">นิติบุคคล</label>
												</div>
												<div class="btn-group col-6">
													<input type="radio" id="watch-me" value="yes" name="Member" class="btn-check" checked="checked">
													<label for="watch-me" class="btn btn-outline-success">บุคคล</label>
												</div>
											</fieldset>
										</div>
									</body>
									<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
									<script>
										function showHide(input) {
											var attrVal = $(input).attr('id');
											switch (attrVal) {
												case 'watch-me':
													$('#show-me-2').hide();
													$('#show-me').show();
													break;
												case "watch-me-maybe":
													$('#show-me').hide();
													$('#show-me-2').show();
													break;
												default:
													$('#show-me-2').hide();
													$('#show-me').hide();
													break;
											}
										}
										$(document).ready(function() {
											$('input[type="radio"]').each(function() {
												showHide(this);
											});
											$('input[type="radio"]').click(function() {
												showHide(this);
											});
										});
									</script>
								</div>
							</div>
						</div>
						<div class="card" id="show-me">
							<div class="card-header">
								<strong class="card-title">ออกใบเสร็จสำหรับบุคคล</strong>
							</div>
							<div class="card-body">
								<form method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="edo_name" class="control-label mb-1">โครงการ <span style="color:red;">*</span></label>
												<select name="edo_name" id="edo_name" class="form-control" required>
													<option value="">เลือกโครงการ</option>
													<?php
													require_once 'connection.php';

													try {
														$query = "SELECT edo_name, edo_pro_id, edo_description, edo_objective FROM pro_offline";
														$result = $conn->query($query);

														// สร้างตัวเลือก
														while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
															echo "<option value='" . $row['edo_name'] . "' data-pro-id='" . $row['edo_pro_id'] . "' data-description='" . $row['edo_description'] . "' data-objective='" . $row['edo_objective'] . "'>" . $row['edo_name'] . "</option>";
														}
													} catch (PDOException $e) {
														echo "Query failed: " . $e->getMessage();
													}
													?>
												</select>
											</div>
											<input type="hidden" name="edo_pro_id" id="edo_pro_id">
											<input type="hidden" name="edo_description" id="edo_description">
											<input type="hidden" name="edo_objective" id="edo_objective">
										</div>
										<div class="col-6" id="show-me-2" style="display: none;">
											<!-- ส่วนของนิติบุคคล -->
										</div>
										<script>
											// เมื่อเลือกตัวเลือกใน <select>
											document.getElementById('edo_name').addEventListener('change', function() {
												var selectedOption = this.options[this.selectedIndex];

												// รับค่าจาก data attributes และกำหนดค่าให้กับตัวแปรที่ต้องการ
												document.getElementById('edo_pro_id').value = selectedOption.getAttribute('data-pro-id');
												document.getElementById('edo_description').value = selectedOption.getAttribute('data-description');
												document.getElementById('edo_objective').value = selectedOption.getAttribute('data-objective');
											});

											// เมื่อมีการเปลี่ยนแปลงใน <fieldset>
											document.getElementById('Member').addEventListener('change', function() {
												var radioValue = document.querySelector('input[name="Member"]:checked').value;

												if (radioValue === 'maybe') {
													document.getElementById('show-me').style.display = 'none';
													document.getElementById('show-me-2').style.display = 'block';
												} else {
													document.getElementById('show-me').style.display = 'block';
													document.getElementById('show-me-2').style.display = 'none';

													var selectedOption = document.getElementById('edo_name').options[document.getElementById('edo_name').selectedIndex];
													document.getElementById('edo_pro_id').value = selectedOption.getAttribute('data-pro-id');
													document.getElementById('edo_description').value = selectedOption.getAttribute('data-description');
													document.getElementById('edo_objective').value = selectedOption.getAttribute('data-objective');
												}
											});
										</script>

										<div class="btn-group col-12">
											<button type="submit" class="btn btn-success btn-block">ยืนยันการออกใบเสร็จ(บุคคล)</button>
										</div>
										<?php
										echo '<pre>';
										print_r($_POST);
										echo '</pre>';
										?>
								</form>
							</div>
						</div>
						<div class="card" id="show-me-2">
							<div class="card-header">
								<strong class="card-title">ออกใบเสร็จสำหรับนิติบุคคล</strong>
							</div>
							<div class="card-body">
								<form method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label for="edo_name" class="control-label mb-1">โครงการ <span style="color:red;">*</span></label>
												<select name="edo_name" id="edo_name" class="form-control" required>
													<option value="">เลือกโครงการ</option>
													<?php
													require_once 'connection.php';

													try {
														$query = "SELECT edo_name, edo_pro_id, edo_description, edo_objective FROM pro_offline";
														$result = $conn->query($query);

														// สร้างตัวเลือก
														while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
															echo "<option value='" . $row['edo_name'] . "' data-pro-id='" . $row['edo_pro_id'] . "' data-description='" . $row['edo_description'] . "' data-objective='" . $row['edo_objective'] . "'>" . $row['edo_name'] . "</option>";
														}
													} catch (PDOException $e) {
														echo "Query failed: " . $e->getMessage();
													}
													?>
												</select>
											</div>
											<input type="hidden" name="edo_pro_id" id="edo_pro_id">
											<input type="hidden" name="edo_description" id="edo_description">
											<input type="hidden" name="edo_objective" id="edo_objective">
										</div>

										<script>
											// เมื่อเลือกตัวเลือกใน <select>
											document.getElementById('edo_name').addEventListener('change', function() {
												var selectedOption = this.options[this.selectedIndex];

												// รับค่าจาก data attributes และกำหนดค่าให้กับตัวแปรที่ต้องการ
												document.getElementById('edo_pro_id').value = selectedOption.getAttribute('data-pro-id');
												document.getElementById('edo_description').value = selectedOption.getAttribute('data-description');
												document.getElementById('edo_objective').value = selectedOption.getAttribute('data-objective');
											});

											// เมื่อมีการเปลี่ยนแปลงใน <fieldset>
											document.getElementById('Member').addEventListener('change', function() {
												var radioValue = document.querySelector('input[name="Member"]:checked').value;

												if (radioValue === 'maybe') {
													// กำหนดค่าสำหรับ "นิติบุคคล"
													document.getElementById('edo_pro_id').value = 'นิติบุคคล';
													document.getElementById('edo_description').value = 'รายละเอียดนิติบุคคล';
													document.getElementById('edo_objective').value = 'วัตถุประสงค์นิติบุคคล';
												} else {
													// เมื่อเลือก "บุคคล" กลับไปใช้ค่าจาก <select>
													var selectedOption = document.getElementById('edo_name').options[document.getElementById('edo_name').selectedIndex];
													document.getElementById('edo_pro_id').value = selectedOption.getAttribute('data-pro-id');
													document.getElementById('edo_description').value = selectedOption.getAttribute('data-description');
													document.getElementById('edo_objective').value = selectedOption.getAttribute('data-objective');
												}
											});
										</script>
									</div>
									<hr>
									<div class="btn-group col-12">
										<button type="submit" class="btn btn-primary btn-block">ยืนยันการออกใบเสร็จ(นิติบุคคล)</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/lib/data-table/datatables.min.js"></script>
	<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
	<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
	<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
	<script src="assets/js/lib/data-table/jszip.min.js"></script>
	<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
	<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
	<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
	<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
	<script src="assets/js/init/datatables-init.js"></script>
</body>

</html>