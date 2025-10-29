<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="table-responsive">
  <table class="table table-sm table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 50px">No</th>
        <th style="text-align: center;">Nama</th>
        <th style="text-align: center;">Username</th>
        <th style="text-align: center;">Nomor WhatsApp</th>
        <th style="text-align: center;">Sebagai</th>
        <th style="text-align: center; width: 150px">Status</th>
        <th style="text-align: center; width: 130px">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $urut = $page; foreach ($data as $key){ $urut++; ?>
        <tr>
          <td style="text-align: center;"><?php echo $urut ?></td>
          <td><?php echo $key->nama ?></td>
          <td style="text-align: center;"><?php echo $key->username ?></td> 
          <td style="text-align: center;"><?php echo $key->nomor_wa ?></td>          
          <td style="text-align: center;"><?php echo $key->level_value ?></td>     
          <td style="text-align: center;"><?php echo $key->status ?></td>
          <td style="text-align: center;">
            <button class="btn btn-info btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data" onclick="edit_data(<?php echo $key->id ?>)"><i class="fas fa-edit"></i> Edit</button>
            <button class="btn btn-warning btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data" data-placement="bottom" title="Salin data" onclick="salin_data(<?php echo $key->id ?>)"><i class="fas fa-clone"></i></button>
            <button class="btn btn-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_data(<?php echo $key->id ?>, '<?php echo $key->nama ?>', '<?php echo $key->username." - ".$key->level_value; ?>')"><i class="fas fa-times"></i></button>
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