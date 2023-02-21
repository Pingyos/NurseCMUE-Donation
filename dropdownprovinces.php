<?php
require_once('conajax.php');
$sql_provinces = "SELECT * FROM provinces";
$query = mysqli_query($con, $sql_provinces);
?>
<div class="col-lg-6 col-6 mt-2">
    <select class="form-control" name="provinces" id="provinces" required>
        <option value="" selected disabled>จังหวัด*</option>
        <?php foreach ($query as $value) { ?>
            <option value="<?= $value['id'] ?>"><?= $value['name_th'] ?></option>
        <?php } ?>
    </select>
</div>

<div class="col-lg-6 col-6 mt-2">
    <select class="form-control" name="amphures" id="amphures" required>
        <option selected disabled>อำเภอ*</option>
    </select>
</div>

<div class="col-lg-6 col-6 mt-2">
    <select class="form-control" name="districts" id="districts" required>
        <option selected disabled>ตำบล*</option>
    </select>
</div>

<div class="col-lg-6 col-6 mt-2">
    <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
</div>

<?php require_once('script.php');?>