$(document).ready(function() {
  $('#province').empty().append('<option value="">เลือก</option>');
  $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'service/ajax.province.php',
      success: function (data) {
          $.each(data, function (key, val) {
              $('#province').append('<option value=' + val.code + '>' + val .name+ '</option>');
          });
          $('#province').select2();
          $('#district').select2();
          $('#subdistrict').select2();
      }
  });

  /****** เลือกจังหวัด *******/
  $('#province').on('change',function(){
      if($('#district').length > 0){
          callDistrict($(this).val(),null);
      }
  });

  /****** เลือกอำเภอ *******/
  $('#district').on('change',function(){
      if($('#subdistrict').length > 0){
          callSubDistrict($(this).val(),null);
      }
  });
});

function callDistrict(proVinceId, selector) {
    $('#district').empty().append('<option value="">เลือก</option>');
    if($('#subdistrict').length > 0){
        $('#subdistrict').empty().append('<option value="">เลือก</option>');
    }

  $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'service/ajax.district.php',
      data: {
          'id': proVinceId
      },
      success: function (data) {
          $.each(data, function (key, val) {
              selected = (val.code == selector) ? 'selected' : '';
              $('#district').append('<option value=' + val.code +' '+ selected + '>' + val .name+ '</option>');
          });
          $('#district').select2();
      }
  });
}

function callSubDistrict(disTrictId, selector ){
  $('#subdistrict').empty().append('<option value="">เลือก</option>');

  $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'service/ajax.subdistrict.php',
      data: {
          'id': disTrictId
      },
      success: function (data) {
          $.each(data, function (key, val) {
            selected = (val.code == selector) ? 'selected' : '';
              $('#subdistrict').append('<option value=' + val.code +' '+ selected + '>' + val .name+ '</option>');
          });
          $('#subdistrict').select2();
      }
  });
}
