<div class="col-12">
  <div class="card card-primary card-outline" id="content-box-1">
    <div class="card-header">     
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
          <div class="form-group">
            <div class="input-group input-group-sm">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control form-control-sm cari_data" name="keyword" placeholder="cari" /> 
              </div>
            </div>
          </div>
        </div> 
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
          <div class="form-group">
            <button type="button" class="btn btn-success btn-sm float-sm-right" data-toggle="modal" data-target="#modal-data" onclick="tambah_data()"><i class="fas fa-plus"></i> Tambah</button>
          </div>
        </div>
      </div>
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