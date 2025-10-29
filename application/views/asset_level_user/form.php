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
      <div class="row">
        <div class="col-md-6 col-12">  
          <div class="form-group">
            <label>ID <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="id" placeholder="Enter id" value="<?php echo $data->id ?>" required>
          </div>                 
          <div class="form-group">
            <label>Nama <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="value" placeholder="Enter name" value="<?php echo $data->value ?>" required>
          </div>
          <div class="form-group">
            <label>Class <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="class" placeholder="Enter class" value="<?php echo $data->class ?>" required>
          </div>
        </div>
        <div class="col-md-6 col-12"> 
          <div class="form-group">
            <label>Navigation <span class="text-red">*</span></label>
            <select class="form-control form-control-sm" name="nav" required> 
              <option value="" selected hidden disabled></option>
              <option value="_side_nav" <?php if($data->nav == '_side_nav') echo 'selected';  ?>>_side_nav</option>
              <option value="_top_nav" <?php if($data->nav == '_top_nav') echo 'selected';  ?>>_top_nav</option>
            </select>    
          </div> 
          <div class="form-group">
            <label>Status <span class="text-red">*</span></label>
            <select class="form-control form-control-sm" name="status" required> 
              <option value="Aktif" <?php if($data->status == 'Aktif'){ echo 'selected'; } ?>>Aktif</option>
              <option value="Tidak Aktif" <?php if($data->status == 'Tidak Aktif'){ echo 'selected'; } ?>>Tidak Aktif</option>
            </select>     
          </div> 
        </div>
      </div>
      <p class="text-red"> * Wajib diisi</p>  
    </div>
    <div class="modal-footer">
      <input type="hidden" name="id_old" value="<?php echo $data->id ?>">
      <button type="submit" class="btn btn-primary add_data"><i class="fas fa-save"></i> Simpan</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" class="close"><i class="fas fa-times"></i> Batal</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function(){    
    $('.select2').select2();
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
        if(response.eror=="success"){
          load_tabel();
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
