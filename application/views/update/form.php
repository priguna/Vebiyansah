<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form role="form" method="POST" id="form-data" action="<?php echo $url_form ?>">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="modal-title"></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">                 
      <div class="form-group">
        <label>Versi <span class="text-red">*</span></label>
        <input type="text" class="form-control form-control-sm" name="versi" placeholder="Enter versi" value="<?php echo $data->versi ?>" required>
      </div>
      <div class="form-group">
        <label>Tanggal <span class="text-red">*</span></label>
       <input type="text" class="form-control form-control-sm" name="tgl" id="date_tgl" data-target="#date_tgl" data-toggle="datetimepicker" value="<?php echo $data->tgl ?>" required/> 
      </div>
      <p class="text-red"> * Wajib diisi</p>  
    </div>
    <div class="modal-footer">
      <input type="hidden" name="id" value="<?php echo $data->id ?>">
      <button type="submit" class="btn btn-primary add_data"><i class="fas fa-save"></i> Simpan</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" class="close"><i class="fas fa-times"></i> Batal</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function(){    
    $('.select2').select2();
  }) 

  $(document).on('mouseup touchend', function (e) {
    var container = $(".bootstrap-datetimepicker-widget");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.hide();
    }
  });

  $('#date_tgl').datetimepicker({    
    focusOnShow: true,
    format: 'Y-MM-DD'
  })

  $('#form-data').submit(function(e){
    e.preventDefault();
    $('.add_data').attr('disabled', true);  
    $.ajax({
      type: $('#form-data').attr('method'),
      url: base_url+''+$('#form-data').attr('action'),
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType:'json',
      success: function(response){
        notif(response.eror,response.pesan);
        if(response.eror == "success"){
          load_tabel(page_curr);
          $('.modal').modal('hide');
        } else $('.add_data').attr('disabled',false);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        $('.add_data').attr('disabled',false);
      }  
    });
  })

</script>
