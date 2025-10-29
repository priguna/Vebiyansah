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
            <label>Judul <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="judul" placeholder="Enter judul" value="<?php echo $data->judul ?>" required>
          </div>           
          <div class="form-group">
            <label>URL <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="url" placeholder="Enter url" value="<?php echo $data->url ?>" required>
          </div>                    
          <div class="form-group">
            <div class="form-group" id="icon">
              <label>Icon</label> 
              <div class="input-group input-group-sm">                  
                <input type="text" class="form-control" name="icon" onclick="get_icon()" data-toggle="modal" data-target="#modal-data-md" value="<?php echo $data->icon ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i id="i-icon" class="<?php echo $data->icon ?>"></i></span>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="form-group">
            <label>Target <span class="text-red">*</span></label>
            <select class="form-control form-control-sm" name="target" required> 
              <option value="-" <?php if($data->target == '-'){ echo 'selected'; } ?>>-</option>
              <option value="New Tab" <?php if($data->target == 'New Tab'){ echo 'selected'; } ?>>New Tab</option>
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
      dataType:'json',
      beforeSend: function() {                
        $('.add_data').attr('disabled', true);  
      },
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
