<div class="col-12">
  <div class="card card-primary card-outline" id="content-box-1">
    <div class="card-header">
      <table width="100%">
        <tr>
          <td align="right">
            <form role="form" method="POST" id="form-menu" action="<?php echo $url_form ?>">
              <textarea name="data" hidden id="nestable-output"></textarea>
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan Urutan</button>
            </form>
          </td>
          <td width="90">
            <button type="button" class="btn btn-success btn-sm float-sm-right" data-toggle="modal" data-target="#modal-data" onclick="tambah_data()"><i class="fas fa-plus"></i> Tambah</button>
          </td>
        </tr>
      </table> 
    </div>
    <div class="card-body" id="content-tabel-1">
    </div>
  </div>

  <div class="card card-default" id="content-box-2">
    <div id="content-tabel-2">
    </div>                
  </div>
</div>

<script type="text/javascript">
  var base_url        = url.protocol+'<?php echo str_replace("http:", "", base_url()); ?>';
  var controller_url  = base_url+'<?php echo $this->uri->segment(1); ?>';
</script>

<script type="text/javascript">

  <?php $this->load->view(basename(__DIR__).'/_script.js') ?>

</script>