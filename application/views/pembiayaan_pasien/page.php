<div class="col-12">
  <div class="card card-primary card-outline" id="content-box-1">
    <div class="card-header">
      <div class="row">  
        <div class="col-12 col-sm-12 col-md-12 col-lg-3">
          <div class="form-group">
            <div class="input-group input-group-sm">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                  </span>
                </div>
                <input type="text" class="form-control form-control-sm float-right" name="range_tgl" id="range_tgl">  
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9">
          <div class="form-group">
            <div class="input-group input-group-sm">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control form-control-sm cari_data" name="keyword" placeholder="cari (minimal 3 karakter)"/> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body" id="content-tabel-1">
    </div>
  </div>
</div>

<script type="text/javascript">
  var base_url        = url.protocol+'<?php echo str_replace("http:", "", base_url()); ?>';
  var controller_url  = base_url+'<?php echo $this->uri->segment(1); ?>';
</script>

<script type="text/javascript">

  $('#range_tgl').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY'
    },
    autoApply: true
  }, function(start, end, label) {
    $('input[name=range_tgl]').val(start.format('DD/MM/YYYY')+' - '+end.format('DD/MM/YYYY'));
    load_tabel();
  });

  <?php $this->load->view(basename(__DIR__).'/_script.js') ?>

</script>