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
              <td align="left"><b><?php echo $data->nm_pasien ?></b></td>
            </tr>
            <tr>
              <th style="width: 100px">No RM</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $data->no_rkm_medis ?></td>
            </tr>
            <tr>
              <th>Umur</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $data->umur ?></td>
            </tr>
            <tr>
              <th>Jenis kelamin</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php if($data->jk == 'L'){ echo 'Laki-laki'; } else echo 'Perempuan'; ?></td>
            </tr>
            <tr>
              <th>NIK</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $data->no_ktp ?></td>
            </tr>
            <tr>
              <th>Nomor BPJS</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $data->no_peserta ?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo $data->alamat ?></td>
            </tr>
            <tr>
              <th>Nomor rawat</th>
              <td align="center" width="10px">:</td>
              <td align="left"><?php echo  $data->no_rawat ?></td>
            </tr>
          </table>    

          <?php 

          if($this->session->userdata('level_value_'._PREFIX_) == "Administator"){

            $parameter = array(
              'view' => 'pembiayaan_pasien_verifikasi_1',
              'no_rawat' => $data->no_rawat
            );

            $verifikasi_1 = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

            $parameter = array(
              'view' => 'pembiayaan_pasien_verifikasi_2',
              'no_rawat' => $data->no_rawat
            );

            $verifikasi_2 = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

            $parameter = array(
              'view' => 'pembiayaan_pasien_verifikasi_direktur',
              'no_rawat' => $data->no_rawat
            );

            $verifikasi_direktur = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));
            ?>

            <table width="100%" class="table table-sm table-striped table-bordered">
              <thead>
                <tr>
                  <th>Level</th>
                  <th>Link</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Verifikasi Tahap 1</td>
                  <td><a href="<?php echo $verifikasi_1 ?>" target="_blank"><i class="fas fa-link"></i> Link</a></td>
                </tr>
                <tr>
                  <td>Verifikasi Tahap 2</td>
                  <td><a href="<?php echo $verifikasi_2 ?>" target="_blank"><i class="fas fa-link"></i> Link</a></td>
                </tr>
                <tr>
                  <td>Verifikasi Tahap Direktur</td>
                  <td><a href="<?php echo $verifikasi_direktur ?>" target="_blank"><i class="fas fa-link"></i> Link</a></td>
                </tr>
              </tbody>
            </table>
          </div>

        <?php } ?>

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
              <input class="form-check-input" type="checkbox" name="tidak_mampu" id="tidak_mampu" <?php if($data->tidak_mampu == '1') echo 'checked' ?>>
              <label class="form-check-label" for="tidak_mampu">Tidak Mampu</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tidak_punya_bpjs" id="tidak_punya_bpjs" <?php if($data->tidak_punya_bpjs == '1') echo 'checked' ?>>
              <label class="form-check-label" for="tidak_punya_bpjs">Tidak Punya BPJS</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="bpjs_mandiri_off" id="bpjs_mandiri_off" <?php if($data->bpjs_mandiri_off == '1') echo 'checked' ?>>
              <label class="form-check-label" for="bpjs_mandiri_off">BPJS Mandiri Off</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="bpjs_pbi_off" id="bpjs_pbi_off" <?php if($data->bpjs_pbi_off == '1') echo 'checked' ?>>
              <label class="form-check-label" for="bpjs_pbi_off">BPJS PBI Off</label>
            </div>
          </div>   
          <div class="form-group">
            <label>Asal Rujukan <span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-sm" name="asal_rujukan" value="<?php echo $data->asal_rujukan ?>" required>
          </div> 
          <div class="form-group">
            <label>Dokumen Pendukung <a class="btn btn-secondary btn-xs" onclick="tambah_files()"><i class="fas fa-plus"></i> Tambah</a></label>  
            <?php if(isset($files)){ ?>
              <table class="table table-sm">
                <thead>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>                  
                  <?php foreach ($files as $key) { ?>
                    <tr>
                      <td>
                        <input class="form-control form-control-sm" name="keterangan[]" value="<?php echo $key->keterangan ?>">
                      </td>
                      <td style="width: 100px">
                        <input type="hidden" name="files_id[]" value="<?php echo $key->id ?>">
                        <input type="hidden" name="files_url[]" value="<?php echo $key->url ?>">
                        <input type="hidden" class="act_files" name="act_files[]" value="update">
                        <a class="btn btn-info btn-xs" onclick="lihat_foto('<?php echo $key->url ?>')"><i class="fas fa-eye"></i> Lihat</a>
                        <a class="btn btn-danger btn-xs hapus_tr_files"><i class="fas fa-times"></i></a>
                      </td>
                    </tr>                   
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>
            <table width="100%" id="daftar_files"></table>
          </div>
          <table width="100%" class="table table-sm table-striped" >
            <tr>
              <th style="text-align: center">Verikasi Tahap I</th>
            </tr>
          </table>   
          <div class="form-group">
            <label>Estimasi biaya</label>
            <input type="text" class="form-control form-control-sm" name="estimasi_beban_biaya" value="<?php echo $data->estimasi_beban_biaya ?>">
          </div>        
          <table width="100%" class="table table-sm table-striped" >
            <tr>
              <th style="text-align: center">Verikasi Tahap II dan Direktur</th>
            </tr>
          </table>      
          <div class="form-group">
            <label>Jenis Pembiayaan</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="jenis_pembiayaan_1" value="Pembayaran tunggakan BPJS" <?php if($data->jenis_pembiayaan == 'Pembayaran tunggakan BPJS') echo 'checked' ?>>
              <label class="form-check-label" for="jenis_pembiayaan_1">1. Pembayaran tunggakan BPJS</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="jenis_pembiayaan_2" value="Pembebasan biaya 100%" <?php if($data->jenis_pembiayaan == 'Pembebasan biaya 100%') echo 'checked' ?>>
              <label class="form-check-label" for="jenis_pembiayaan_2">2. Pembebasan biaya 100%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="jenis_pembiayaan_3" value="Pembebasan biaya 50%" <?php if($data->jenis_pembiayaan == 'Pembebasan biaya 50%') echo 'checked' ?>>
              <label class="form-check-label" for="jenis_pembiayaan_3">3. Pembebasan biaya 50%</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="jenis_pembiayaan_4" value="Pembebasan biaya lainnya" <?php if($data->jenis_pembiayaan == 'Pembebasan biaya lainnya') echo 'checked' ?>>
              <label class="form-check-label" for="jenis_pembiayaan_4">4. Pembebasan biaya lainnya</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="jenis_pembiayaan_5" value="Pembayaran dari pihak lain" <?php if($data->jenis_pembiayaan == 'Pembayaran dari pihak lain') echo 'checked' ?>>
              <label class="form-check-label" for="jenis_pembiayaan_5">5. Pembayaran dari pihak lain</label>
            </div>
          </div> 
        </div>
      </div>

    </div>
    <div class="modal-footer">  
      <input type="hidden" name="update" value="verifikasi_mpp">
      <input type="hidden" name="id" value="<?php echo $data->id ?>">
      <input type="hidden" name="no_rawat" value="<?php echo  $data->no_rawat ?>">
      <input type="hidden" name="no_rkm_medis" value="<?php echo $data->no_rkm_medis ?>">
      <input type="hidden" name="nm_pasien" value="<?php echo $data->nm_pasien ?>">
      <input type="hidden" name="no_ktp" value="<?php echo $data->no_ktp ?>">
      <input type="hidden" name="jk" value="<?php echo $data->jk ?>">
      <input type="hidden" name="tmp_lahir" value="<?php echo $data->tmp_lahir ?>">
      <input type="hidden" name="tgl_lahir" value="<?php echo $data->tgl_lahir ?>">
      <input type="hidden" name="alamat" value="<?php echo $data->alamat ?>">
      <input type="hidden" name="pekerjaan" value="<?php echo $data->pekerjaan ?>">
      <input type="hidden" name="no_tlp" value="<?php echo $data->no_tlp ?>">
      <input type="hidden" name="umur" value="<?php echo $data->umur ?>">
      <input type="hidden" name="pnd" value="<?php echo $data->pnd ?>">
      <input type="hidden" name="no_peserta" value="<?php echo $data->no_peserta ?>">
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

  document.querySelector('input[name="estimasi_beban_biaya"]').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^\d]/g, '');
    if (value) {
      e.target.value = formatRupiah(value);
    } else {
      e.target.value = '';
    }
  });

  function formatRupiah(angka) {
    let number = parseInt(angka, 10);

    let rupiah = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(number);

    return rupiah;
  }

  function lihat_file(url)
  {
    url = url.replace("./", base_url);

    $('#myLargeModalLabel').html('<i class="ti-eye"></i> | Lihat Dokumen');
    $('#myLargeModalBody').html('<center><img width="800" src="'+url+'"></center>');
  }

  function lihat_foto(url)
  {
    Swal.fire({
      html: '<img width="800" style="box-shadow: 5px 5px 5px 0px" src="'+url+'">',
      width: 900,
      showConfirmButton: false,
      allowOutsideClick: false,
      showCancelButton: true,
      cancelButtonText: 'Close'
    });
  }

  function tambah_files()
  {
    var id = (new Date()).getTime();

    $('#daftar_files').append('<tr><td width="49%"><input class="form-control form-control-sm" name="keterangan[]" placeholder="keterangan"><td width="50%"><input type="hidden" name="files_id[]" value="'+id+'"><input type="hidden" class="act_files" name="act_files[]" value="baru"><input type="hidden" name="url_files[]"><input  style="font-size: 10px" type="file" class="form-control form-control-sm" id="file_files" name="files_'+id+'"></td><td style="width:1%"></td></td><td><a class="btn btn-xs btn-danger hapus_tr_files"><i class="fas fa-times"></i></a></td></tr>');

    bsCustomFileInput.init();
  }

  $('body').on('click', '.hapus_tr_files', function()
  {
    var act_files = $(this).parents('tr').children().find('input.act_files').val();

    if(act_files == 'baru')
    {
      $(this).parents('tr').remove();
    }
    else 
    {
      $(this).attr('disabled', true);
      $(this).parents('tr')[0].style.display = 'none';
      $(this).parents('tr').children().find('input.act_files').val('hapus');
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
