<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
	<table id="bootstrap-data-table" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ลำดับ</th>
				<th>ชื่อ-นามสกุล</th>
				<th>โครงการ</th>
				<th>จำนวนเงิน</th>
				<th>วันที่ออก</th>
				<th>รายละเอียดใบเสร็จ</th>
			</tr>
		</thead>
		<tbody>
			<?php
			require_once 'connection.php';
			$stmt = $conn->prepare("SELECT * FROM receipt_offline ORDER BY id DESC");
			$stmt->execute();
			$result = $stmt->fetchAll();

			foreach ($result as $t1) {
			?>
				<tr>
					<td><?= $t1['id']; ?></td>
					<td><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></td>
					<td><?= $t1['edo_name']; ?></td>
					<td><?= $t1['rec_money']; ?></td>
					<td><?= $t1['rec_date_out']; ?></td>
					<td>
						<a href="pdf_maker_offline.php?id=<?= $t1['id']; ?>&ACTION=VIEW" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"> ใบเสร็จ</i></a>
						<a href="" class="btn btn-warning btn-sm"><i class="fa fa-pencil"> แก้ไข</i></a>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>