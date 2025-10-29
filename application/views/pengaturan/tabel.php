<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form role="form" method="POST" id="form-data_1" action="<?php echo $url_form_1 ?>">
  <div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-tabs-aplikasi-tab" data-toggle="pill" href="#custom-tabs-aplikasi" role="tab" aria-controls="custom-tabs-aplikasi" aria-selected="true">Aplikasi</a>
        </li>
      </ul>
    </div>
    <div class="card-body" id="content-tabel-1"> 
      <div class="tab-content" id="custom-tabs-four-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-aplikasi" role="tabpanel" aria-labelledby="custom-tabs-aplikasi-tab">
          <div class="row">
            <div class="col-md-6 col-12">                  
              <div class="form-group">
                <label>Nama <span class="text-red">*</span></label>
                <input type="text" class="form-control form-control-sm" name="nama" placeholder="Enter name" value="<?php echo $data->nama ?>" required>
              </div>
              <div class="form-group">
                <label>Singkatan <span class="text-red">*</span></label>
                <input type="text" class="form-control form-control-sm" name="singkatan" placeholder="Enter singkatan" value="<?php echo $data->singkatan ?>" required>
              </div>
              <div class="form-group">
                <label>Perusahaan <span class="text-red">*</span></label>
                <input type="text" class="form-control form-control-sm" name="perusahaan" placeholder="Enter perusahaan" value="<?php echo $data->perusahaan ?>" required>
              </div>  
              <div class="form-group">
                <label>No. Telp</label>
                <input type="text" class="form-control form-control-sm" name="no_telp" value="<?php echo $data->no_telp ?>" placeholder="Enter no telp.">
              </div>  
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control form-control-sm" name="alamat" rows="2"><?php echo $data->alamat ?></textarea>
              </div> 
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control form-control-sm" name="email" value="<?php echo $data->email ?>" placeholder="Enter email">
              </div> 
              <div class="form-group">
                <label>Footer</label>
                <input type="footer" class="form-control form-control-sm" name="footer" value="<?php echo $data->footer ?>" placeholder="Enter footer">
              </div> 
             <div class="form-group">
                <label>Versi Aplikasi</label>
                <div class="input-group input-group-sm">                  
                  <input type="text" class="form-control form-control-sm" name="versi" value="<?php echo $data->versi ?>" readonly>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-data-xl" data-backdrop="static" data-keyboard="false" onclick="update_get_from_server('all', <?php echo $data->versi ?>)"><i class='fas fa-download'></i> Update All</button>                      
                    <button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class='fas fa-file'></i> Update File</button>
                    <ul class="dropdown-menu" style="">
                      <li class="dropdown-item"><a class="btn" data-toggle="modal" data-target="#modal-data-xl" data-backdrop="static" data-keyboard="false" onclick="update_get_from_server('file_all', <?php echo $data->versi ?>)">Semua</a></li>
                      <li class="dropdown-item"><a class="btn"  data-toggle="modal" data-target="#modal-data-xl" data-backdrop="static" data-keyboard="false" onclick="update_get_from_server('file_last', <?php echo $data->versi ?>)">Terbaru</a></li>
                    </ul>
                    <?php if($this->session->userdata('class_'._PREFIX_) == 'admin'){  ?>
                      <button type="button" class="btn btn-info btn-flat" onclick="backup_database()"><i class='fas fa-database'></i> 
                      Backup Database</button>
                    <?php } ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12"> 
              <div class="form-group">
                <label for="customFile">Logo Kecil</label>
                <div class="custom-file">
                  <input type="hidden" name="url_logo_kecil" value="<?php echo $data->url_logo_kecil ?>">
                  <input type="file" class="custom-file-input" id="logo_kecil" name="logo_kecil">
                  <label class="custom-file-label" for="logo_kecil">Choose file</label>
                </div>
              </div>
              <img width="100" src="<?php echo base_url($data->url_logo_kecil) ?>">
              <div class="form-group">
                <label for="customFile">Logo Besar</label>
                <div class="custom-file">
                  <input type="hidden" name="url_logo_besar" value="<?php echo $data->url_logo_besar ?>">
                  <input type="file" class="custom-file-input" id="logo_besar" name="logo_besar">
                  <label class="custom-file-label" for="logo_besar">Choose file</label>
                </div>
              </div>
              <img width="200" src="<?php echo base_url($data->url_logo_besar) ?>">
            </div>
          </div>
          <p class="text-red"> * Wajib diisi</p>  
        </div>
      </div>
    </div>

    <div class="card-footer">
      <div style="text-align: right; width: 100%">
        <button type="submit" class="btn btn-primary add_data"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</form>

<script>
  $(document).ready(function(){    
    $('.select2').select2();
    bsCustomFileInput.init();
  })

  $('#form-data_1').submit(function(e){
    e.preventDefault();
    $('.add_data').attr('disabled', true);  
    $.ajax({
      type: $('#form-data_1').attr('method'),
      url: base_url+''+$('#form-data_1').attr('action'),
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType:'json',
      success: function(response){
        notif(response.eror,response.pesan);
        $('.add_data').attr('disabled',false);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        $('.add_data').attr('disabled',false);
      }  
    });
  })
</script>
