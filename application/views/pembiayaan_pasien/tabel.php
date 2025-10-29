<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        <th style="text-align: center;">Tanggal Reg</th>
        <th style="text-align: center;">Poliklinik</th>
        <th style="text-align: center;">Nomor RM</th>
        <th style="text-align: center;">Status</th>
        <th style="text-align: center;">Diagnosa</th>
        <th style="text-align: center;">Kamar</th>
        <th style="text-align: center; width: 100px">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $urut = $page; foreach ($data as $key){ $urut++; ?>
        <tr>
          <td style="text-align: center;"><?php echo $urut ?></td>
          <td><?php echo $key->nm_pasien.'<br>('.$key->no_rawat.')'; ?></td>
          <td style="text-align: center;"><?php echo $key->umurdaftar.' '.$key->sttsumur ?></td>
          <td style="text-align: center;"><?php echo $key->tgl_registrasi ?></td>  
          <td style="text-align: center;"><?php echo $key->nm_poli.'<br>DPJP. '.$key->nm_dokter ?></td>       
          <td style="text-align: center;"><?php echo $key->no_rkm_medis ?></td>  
          <td style="text-align: center;"><?php echo $key->status_lanjut ?></td> 
          <td style="text-align: center;"><?php echo $key->diagnosa ?></td> 
          <td style="text-align: center;"><?php echo $key->kamar ?></td> 
          <td style="text-align: center;">
            <button class="btn btn-info btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data-xl" onclick="tambah_data('<?php echo $key->no_rawat ?>')"><i class="fas fa-plus"></i> Tambah</button>
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