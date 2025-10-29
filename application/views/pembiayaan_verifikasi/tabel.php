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
       <th style="text-align: center;">No Rawat</th>
       <th style="text-align: center;">Tanggal Pengajuan</th>
       <th style="text-align: center;">Alamat</th>
       <th style="text-align: center;">Status</th>
       <th style="text-align: center; width: 170px">Aksi</th>
     </tr>
   </thead>
   <tbody>
    <?php $urut = $page; foreach ($data as $key){ $urut++; ?>
      <tr>
        <td style="text-align: center;"><?php echo $urut ?></td>
        <td><?php echo $key->nm_pasien ?></td>
        <td style="text-align: center;"><?php echo $key->umur?></td>
        <td style="text-align: center;"><?php echo $key->no_rawat ?></td>  
        <td style="text-align: center;"><?php echo tgl_convert($key->tgl_pengajuan) ?></td> 
        <td style="text-align: center;"><?php echo $key->alamat ?></td> 
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
            echo '<span class="badge bg-success">Selesai diverifikasi oleh direktur. Menunggu input biaya dari kasir</span>';
          }
          ?>
        </td>    
        <td style="text-align: center;">
            <button class="btn btn-secondary btn-rounded btn-xs" onclick="kirim_ulang('<?php echo $link ?>', '<?php echo $key->no_rawat ?>')"><i class="fas fas fa-paper-plane"></i> Kirim Ulang</button>      
            <button class="btn btn-info btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data-xl" onclick="edit_data('<?php echo $key->id ?>')"><i class="fas fa-edit"></i></button>
          <?php if($key->user_verifikasi_1 == '' || $this->session->userdata('class_'._PREFIX_) == 'admin'){ ?>
            <button class="btn btn-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_data(<?php echo $key->id ?>, '<?php echo $key->nm_pasien ?>', '<?php echo $key->umur." - ".$key->alamat; ?>')"><i class="fas fa-times"></i></button>
          <?php } ?>
        </td>
      </tr> 
    <?php } ?>
  </tbody>
</table>
</div>

<div class="row">
  <div class="col-12 col-sm-6">
    <p>Jumlah Data: <b><?php echo $jml_data ?></b></p>
  </div>
  <div class="col-12 col-sm-6">
    <?php echo $pagination; ?>
  </div>
</div>

<script type="text/javascript">
  var page_curr = base_url+'<?php echo $page_curr ?>';
  $('.pagination').on('click','a',function(e){
   e.preventDefault(); 
   var url_page = $(this).attr('href');
   url_page = url.protocol+''+url_page.replace('http:', '');
   load_tabel(url_page);
 });
</script>