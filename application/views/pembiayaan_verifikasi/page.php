<div class="col-12">
  <div class="card card-primary card-outline" id="content-box-1">
    <div class="card-header">
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
    <div class="card-body" id="content-tabel-1">
    </div>
  </div>
</div>

<script type="text/javascript">
  var base_url        = url.protocol+'<?php echo str_replace("http:", "", base_url()); ?>';
  var controller_url  = base_url+'<?php echo $this->uri->segment(1); ?>';
</script>

<script type="text/javascript">

  $(document).on('mouseup touchend', function (e) {
    var container = $(".bootstrap-datetimepicker-widget");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.hide();
    }
  });

  $('#date_tgl').datetimepicker({    
    focusOnShow: true,
    format: 'Y-MM-DD'
  })

  <?php $this->load->view(basename(__DIR__).'/_script.js') ?>

</script>