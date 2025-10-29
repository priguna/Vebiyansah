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
            <label>Nama <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="nama" placeholder="Enter name" value="<?php echo $data->nama ?>" required>
          </div>
          <div class="form-group">
            <label>Username <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="username" placeholder="Enter username" value="<?php echo $data->username ?>" required>
          </div>
          <div class="form-group">
            <label>Password <span class="text-red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="password" placeholder="Enter password" value="<?php echo $data->password ?>" required>
          </div>   
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $data->email ?>" placeholder="Enter email">
          </div>   
        </div>
        <div class="col-md-6 col-12"> 
          <div class="form-group">
            <label>Sebagai <span class="text-red">*</span></label>
            <select class="form-control form-control-sm" name="level" required> 
              <option value="" selected hidden disabled></option>
              <?php foreach ($select_level as $key){ 
                if($key->id >= $this->session->userdata('level_id_'._PREFIX_)){  ?>
                  <option value="<?php echo $key->id ?>" <?php if($data->level == $key->id){ echo 'selected'; } ?>><?php echo $key->value ?></option>
                <?php } 
              } ?>                     
            </select>     
          </div>
          <div class="form-group">
            <label>Nomor WhatsApp</label>
            <input type="text" class="form-control form-control-sm" name="nomor_wa" placeholder="Enter nomor wa" value="<?php echo $data->nomor_wa ?>">
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
