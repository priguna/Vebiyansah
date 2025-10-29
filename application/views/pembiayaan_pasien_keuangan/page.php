<?php

function tgl_convert($date)
{  
  $tgl = '00-00-0000';

  if($date != '')
  {
    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );

    if($date != '0000-00-00' && $date != '')
    {
      $split = explode('-', $date); 
      $tgl = $split[2].' '.$bulan[(int)$split[1]].' '.$split[0];
    } 
  } 

  return $tgl;
}

?>

<!DOCTYPE html>
<html dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon icon -->
  <link rel="icon" type="image/x-icon" href="<?php echo base_url('_asset/img/logo_rsud.png') ?>">
  
  <title><?php echo str_replace("_"," ",strtoupper($this->session->userdata('nama_apps_'._PREFIX_))) ." | ". $this->session->userdata('singkatan_'._PREFIX_) ?></title>

  <!-- Custom CSS -->
  <link href="<?php echo base_url('/_asset/theme_login/style.min.css') ?>" rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.css') ?>">

  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
  </style>

</head>

<body>
  <div class="main-wrapper">
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url('_asset/theme_login/auth-bg.jpg') ?>) no-repeat center center;">
      <div class="auth-box" style="max-width: 80%">
        <div id="loginform">
          <div class="logo">
            <p>
              <span class="db">
                <img src="<?php echo base_url('_asset/img/logo_brebes.png') ?>" alt="logo" style="height: 55px" />
                <img src="<?php echo base_url('_asset/img/logo_rsud.png') ?>" alt="logo" style="height: 55px" />
              </span>
            </p>
            <h4 class="font-medium m-b-20" style="text-transform: uppercase;"><?php echo str_replace("_"," ",strtoupper($this->session->userdata('nama_apps_'._PREFIX_))) ." | ". $this->session->userdata('singkatan_'._PREFIX_) ?></h4>
          </div>
          <!-- Form -->
          <form action="<?php echo base_url($url_form) ?>" method="POST" id="form-data">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <table width="100%" class="table table-sm table-striped">
                  <tr>
                    <th style="width: 115px">Nama</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><b><?php echo $data->nm_pasien ?></b></td>
                  </tr>
                  <tr>
                    <th>No RM</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo $data->no_rkm_medis ?></td>
                  </tr>
                  <tr>
                    <th>Umur</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo $data->umur?></td>
                  </tr>
                  <tr>
                    <th>Jenis kelamin</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php if($data->jk == 'L'){ echo 'Laki-laki'; } else echo 'Perempuan'; ?></td>
                  </tr>
                  <tr>
                    <th>NIK</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo $data->no_ktp ?></td>
                  </tr>
                  <tr>
                    <th>Nomor BPJS</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo $data->no_peserta ?></td>
                  </tr>
                  <tr>
                    <th>Alamat</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo $data->alamat ?></td>
                  </tr>
                  <tr>
                    <th>Nomor rawat</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo $data->no_rawat ?></td>
                  </tr>
                  <tr>
                    <th>Tgl. Pengajuan</th>
                    <td align="center" width="10">:</td>
                    <td align="left"><?php echo tgl_convert($data->tgl_pengajuan) ?></td>
                  </tr>
                </table>  
              </div>
              <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <table width="100%" class="table table-sm table-striped table-bordered">                  
                  <tr>
                    <th colspan="2">Kelayakan</th>
                  </tr>                  
                  <tr>
                    <td colspan="2"><?php if($data->kelayakan != ''){ echo $data->kelayakan; } else echo '-'; ?></td>
                  </tr>                  
                  <tr>
                    <th colspan="2">Identifikasi Masalah</th>
                  </tr>
                  <tr>
                    <td colspan="2"><?php if($data->identifikasi != ''){ echo $data->identifikasi; } else echo '-'; ?></td>
                  </tr>                   
                  <tr>
                    <th colspan="2">Permasalahan</th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <?php 
                      $i = 0;
                      if($data->tidak_mampu == '1'){ $i++; echo '<i class="ti-check"></i> Tidak Mampu<br>'; }
                      if($data->tidak_punya_bpjs == '1'){ $i++; echo '<i class="ti-check"></i> Tidak Punya BPJS<br>'; }
                      if($data->bpjs_mandiri_off == '1'){ $i++; echo '<i class="ti-check"></i> BPJS Mandiri Off<br>'; }
                      if($data->bpjs_pbi_off == '1'){ $i++; echo '<i class="ti-check"></i> BPJS PBI Off<br>'; }
                      if($i == 0) echo '-';
                      ?>
                    </td>
                  </tr>    
                  <tr>           
                    <th colspan="2">Asal Rujukan</th>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo $data->asal_rujukan ?></td>
                  </tr>                
                  <tr>
                    <th colspan="2">Dokumen Pendukung</th>
                  </tr>
                  <?php $i=0; foreach ($files as $key){ $i++;  ?>
                    <tr>
                      <td><?php echo $i.". ".$key->keterangan; ?></td>
                      <td width="70px"><a href="" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="lihat_file('<?php echo $key->url ?>')"><i class="ti-eye"></i> Lihat</a></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="2">
                      <label>Diagnosa : </label><br>
                      <?php $split = explode('; ', $data->diagnosa); foreach ($split as $key) { echo $key.'<br>'; } ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <label>Estimasi biaya :</label><br>    
                      <?php echo $data->estimasi_beban_biaya ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <label>Jenis Pembiayaan :</label><br> 
                      <?php echo str_replace(';', '<br>', $data->jenis_pembiayaan) ?>
                    </td>
                  </tr>  
                  <tr>
                    <td colspan="2">
                      <label>Total Biaya :</label><br>     
                      <?php echo $data->pembiayaan_kasir ?>
                    </td>
                  </tr>    
                  <tr>
                    <td>Lihat Nota</td>
                    <td width="70px"><a href="" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="lihat_file('<?php echo $data->url_nota ?>')"><i class="ti-eye"></i> Lihat</a></td>
                  </tr>                    
                </table>
                <center>
                  <h5>Sudah dilakukan verikasi oleh:</h5>
                  <p><?php echo $data->user_verifikasi_direktur_value ?></p>
                  <h5>Pada Tanggal:</h5>
                  <p><?php $split = explode(' ', $data->tgl_verifikasi_direktur); echo tgl_convert($split[0]).'<br>'.$split[1] ?></p>
                </center>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 95%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" id="myLargeModalBody"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url('/_asset/theme_login/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('/_asset/theme_login/popper.min.js') ?>"></script>
  <script src="<?php echo base_url('/_asset/theme_login/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

  <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    var base_url = '<?php echo base_url(); ?>';
  </script>

  <script type="text/javascript">

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    function lihat_file(url)
    {
      url = url.replace("./", base_url);

      $('#myLargeModalLabel').html('<i class="ti-eye"></i> | Lihat Dokumen');
      $('#myLargeModalBody').html('<center><img width="800" src="'+url+'"></center>');
    }

    var base_url = '<?php echo base_url(); ?>';
    $('#form-data').submit(function(e){
      e.preventDefault();      
      var data = $(this).serialize();
      $('.add_data').attr('disabled', true);
      $.ajax({
        type: $('#form-data').attr('method'),
        url: $('#form-data').attr('action'),
        data: data,
        dataType:'json',
        success: function(response){
          swalWithBootstrapButtons.fire({
            icon: response.eror,
            html: response.pesan
          })
          if(response.eror == 'success') window.location.href = window.location.href;   
        },
        error: function (xhr, ajaxOptions, thrownError) { 
          console.log(xhr.responseText);
          $('.add_data').attr('disabled', false);
        }  
      });
    })

  </script>
</body>

</html>