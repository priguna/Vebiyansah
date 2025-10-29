<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function tgl_convert($date)
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
  else $tgl = '00-00-0000';

  return $tgl;
}

function status($value)
{
  if($value == 'Sudah')
  {
    $result = '<span class="badge bg-success">'.$value.'</span>';
  }
  else $result = '<span class="badge bg-warning">'.$value.'</span>';

  return $result;
}

?>

<div class="table-responsive">
  <table class="table table-sm table-bordered table-striped table-hover">
    <thead>
      <tr>
       <th style="text-align: center; width: 50px">No</th>
       <th style="text-align: center;">Nama</th>
       <th style="text-align: center;">Umur</th>
       <th style="text-align: center;">Alamat</th>
       <th style="text-align: center;">Tanggal Pengajuan</th>
       <th style="text-align: center;">Asal Rujukan</th>
       <th style="text-align: center;">Permasalahan</th>
       <th style="text-align: center;">Identifikasi Permasalahan</th>
       <th style="text-align: center;">Jenis Pembiayaan</th>
       <th style="text-align: center;">Total Biaya</th>
       <th style="text-align: center;">Status</th>
     </tr>
   </thead>
   <tbody>
    <?php $urut = 0; foreach ($data as $key){ $urut++; ?>
      <tr>
        <td style="text-align: center;"><?php echo $urut ?></td>
        <td><?php echo $key->nm_pasien ?></td>
        <td style="text-align: center;"><?php echo $key->umur ?></td> 
        <td style="text-align: center;"><?php echo $key->alamat ?></td> 
        <td style="text-align: center;"><?php echo tgl_convert($key->tgl_pengajuan) ?></td> 
        <td style="text-align: center;"><?php echo $key->asal_rujukan ?></td> 
        <td>
          <?php
          if($key->tidak_mampu == '1'){ echo ' - Tidak Mampu<br>'; }
          if($key->tidak_punya_bpjs == '1'){ echo '- Tidak Punya BPJS<br>'; }
          if($key->bpjs_mandiri_off == '1'){ echo '- BPJS Mandiri Off<br>'; }
          if($key->bpjs_pbi_off == '1'){ echo '- BPJS PBI Off<br>'; }
          ?>
        </td>
        <td style="text-align: center;"><?php echo $key->identifikasi ?></td> 
        <td style="text-align: center;"><?php echo $key->jenis_pembiayaan ?></td> 
        <td style="text-align: center;"><?php echo $key->pembiayaan_kasir ?></td> 
        <td style="text-align: center;">
          <?php if($key->user_verifikasi_1 == '')
          { 
            $link = 'Verifikator Tahap 1';
            echo '<span class="badge bg-warning">Menunggu Verifikator Tahap 1</span>';
          } 
          else if($key->user_verifikasi_2 == '')
          { 
            $link = 'Verifikator Tahap 2';
            echo '<span class="badge bg-warning">Menunggu Verifikator Tahap 2</span>';
          } 
          else if($key->user_verifikasi_direktur == '')
          { 
            $link = 'Direktur';
            echo '<span class="badge bg-warning">Menunggu Verifikasi Direktur</span>';
          } 
          else 
          {
            $link = 'Verifikator MPP';
            echo '<span class="badge bg-success">Selesai diverifikasi</span>';
          }
          ?>
        </td>   
      </tr> 
    <?php } ?>
  </tbody>
</table>
</div>

<div class="row">
  <div class="col-12 col-sm-6">
    <p>Jumlah Data: <b><?php echo $urut ?></b></p>
  </div>
</div>