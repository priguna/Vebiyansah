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
        <div class="col-12 col-sm-12 col-md-12 col-lg-4"> 
          <table width="100%" class="table table-sm table-striped" >
            <tr>
              <th>Nama</th>
              <td align="center" width="10px">:</td>
              <td align="left"><b><?php echo $pasien->nm_pasien ?></b></td>
            </tr>
            <tr>
              <th style="width: 100px">No RM</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->no_rkm_medis ?></td>
            </tr>
            <tr>
              <th>Umur</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->umurdaftar.' '.$pasien->sttsumur ?></td>
            </tr>
            <tr>
              <th>Jenis kelamin</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php if($pasien->jk == 'L'){ echo 'Laki-laki'; } else echo 'Perempuan'; ?></td>
            </tr>
            <tr>
              <th>NIK</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->no_ktp ?></td>
            </tr>
            <tr>
              <th>Nomor BPJS</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->no_peserta ?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->alamat ?></td>
            </tr>
            <tr>
              <th>Nomor rawat</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->no_rawat ?></td>
            </tr>
            <tr>
              <th>Diagnosa</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $pasien->diagnosa ?></td>
            </tr>
          </table> 
        </div>     
        <div class="col-12 col-sm-6 col-md-6 col-lg-8">
          <div class="form-group">
            <label>Tanggal Pengajuan <span style="color: red">*</span></label>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control form-control-sm" name="tgl_pengajuan" id="date_tgl_pengajuan" data-target="#date_tgl_pengajuan" data-toggle="datetimepicker" value="<?php echo $data->tgl_pengajuan ?>" required/>
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i> </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Kelayakan <span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="kelayakan" value="<?php echo $data->kelayakan ?>" required>
          </div>
          <div class="form-group">
            <label>Identifikasi Masalah <span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="identifikasi" value="<?php echo $data->identifikasi ?>" required>
          </div>    
          <div class="form-group">
            <label>Permasalahan</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tidak_mampu" id="tidak_mampu">
              <label class="form-check-label" for="tidak_mampu">Tidak Mampu</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tidak_punya_bpjs" id="tidak_punya_bpjs">
              <label class="form-check-label" for="tidak_punya_bpjs">Tidak Punya BPJS</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="bpjs_mandiri_off" id="bpjs_mandiri_off">
              <label class="form-check-label" for="bpjs_mandiri_off">BPJS Mandiri Off</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="bpjs_pbi_off" id="bpjs_pbi_off">
              <label class="form-check-label" for="bpjs_pbi_off">BPJS PBI Off</label>
            </div>
          </div>   
          <div class="form-group">
            <label>Diagnosa <span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="diagnosa" value="<?php if($data->id == ''){ echo $pasien->diagnosa; } else echo $data->diagnosa ?>" required>
          </div>    
          <div class="form-group">
            <label>Asal Rujukan <span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="asal_rujukan" value="<?php echo $data->asal_rujukan ?>" required>
          </div>      
          <div class="form-group">
            <label>Dokumen Pendukung</label> 
            <a class="btn btn-secondary btn-xs" onclick="tambah_files()"><i class="fas fa-plus"> Tambah</i></a>
            <table width="100%" id="daftar_files"></table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">  
      <input type="hidden" name="no_rawat" value="<?php echo $pasien->no_rawat ?>">
      <input type="hidden" name="no_rkm_medis" value="<?php echo $pasien->no_rkm_medis ?>">
      <input type="hidden" name="nm_pasien" value="<?php echo $pasien->nm_pasien ?>">
      <input type="hidden" name="no_ktp" value="<?php echo $pasien->no_ktp ?>">
      <input type="hidden" name="jk" value="<?php echo $pasien->jk ?>">
      <input type="hidden" name="tmp_lahir" value="<?php echo $pasien->tmp_lahir ?>">
      <input type="hidden" name="tgl_lahir" value="<?php echo $pasien->tgl_lahir ?>">
      <input type="hidden" name="alamat" value="<?php echo $pasien->alamat ?>">
      <input type="hidden" name="pekerjaan" value="<?php echo $pasien->pekerjaan ?>">
      <input type="hidden" name="no_tlp" value="<?php echo $pasien->no_tlp ?>">
      <input type="hidden" name="umur" value="<?php echo $pasien->umur ?>">
      <input type="hidden" name="pnd" value="<?php echo $pasien->pnd ?>">
      <input type="hidden" name="no_peserta" value="<?php echo $pasien->no_peserta ?>">
      <button type="submit" class="btn btn-primary add_data"><i class="fas fa-save"></i> Simpan</button>
      <button type="button" class="btn btn-default " data-dismiss="modal" class="close">Batal</button>
    </div>
  </div>
</form>

<script>
  $(document).ready(function(){    
    $('.select2').select2();
    bsCustomFileInput.init();
  })

  $(document).on('mouseup touchend', function (e) {
    var container = $(".bootstrap-datetimepicker-widget");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.hide();
    }
  });

  $('#date_tgl_pengajuan').datetimepicker({
    focusOnShow: true,
    format: 'Y-MM-DD'
  })

  //------------------------------------------------------------------------------------------------------------------

  function tambah_files()
  {
    var id = (new Date()).getTime();

    $('#daftar_files').append('<tr><td width="49%"><input class="form-control form-control-sm" name="keterangan[]" placeholder="keterangan"><td width="50%"><input type="hidden" name="files_id[]" value="'+id+'"><input type="hidden" class="act_files" name="act_files[]" value="baru"><input type="hidden" name="url_files[]"><input  style="font-size: 10px" type="file" class="form-control form-control-sm" id="file_files" name="files_'+id+'"></td><td style="width:1%"></td></td><td><a class="btn btn-xs btn-danger hapus_tr_files"><i class="fas fa-times"></i></a></td></tr>');

    bsCustomFileInput.init();
  }

  $('body').on('click', '.hapus_tr_files', function()
  {
    var act_files = $(this).parents('div').children().find('input.act_files').val();

    if(act_files == 'baru')
    {
      $(this).parents('tr').remove();
    }
    else 
    {
      $(this).attr('disabled', true);
      $(this).parents('div')[1].style.display = 'none';
      $(this).parents('div').children().find('input.act_files').val('hapus');
    }
  });

  //------------------------------------------------------------------------------------------------------------------


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
        notif(response.eror, response.pesan);
        if(response.eror == "success"){
          load_tabel(page_curr);
          $('.modal').modal('hide');
        } else $('.add_data').attr('disabled',false);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        notif('warning', xhr.responseText);
        $('.add_data').attr('disabled', false);
      }  
    });
  })

</script>
