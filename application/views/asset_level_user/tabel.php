<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="table-responsive">
  <table class="table table-sm table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th style="text-align: center;width: 50px">No</th>
        <th style="text-align: center;">Nama</th>
        <th style="text-align: center;">Class</th>
        <th style="text-align: center;">Navigation</th>
        <th style="text-align: center;">ID</th>
        <th style="text-align: center; width: 150px">Status</th>
        <th style="text-align: center; width: 130px">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $jml_data = 0; foreach ($data as $key){ $jml_data++; ?>
        <tr>
          <td style="text-align: center;"><?php echo $jml_data ?></td>
          <td><?php echo $key->value; ?></td>
          <td style="text-align: center;"><?php echo $key->class ?></td>
          <td style="text-align: center;"><?php echo $key->nav ?></td>
          <td style="text-align: center;"><?php echo $key->id ?></td>
          <td style="text-align: center;"><?php echo $key->status ?></td>
          <td style="text-align: center;">            
            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-data" onclick="edit_data(<?php echo $key->id ?>)"> <i class="fa fa-edit"> Edit </i></button>
            <button class="btn btn-warning btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data" data-placement="bottom" title="Salin data" onclick="salin_data(<?php echo $key->id ?>)"><i class="fas fa-clone"></i></button>
            <button class="btn btn-danger btn-rounded btn-xs" onclick="hapus_data(<?php echo $key->id ?>, '<?php echo $key->value ?>', '<?php echo $key->class; ?>')"><i class="fas fa-times"></i></button>
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
</div>
