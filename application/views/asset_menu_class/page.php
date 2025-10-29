<div class="col-12">
  <div class="card card-primary card-outline" id="content-box-1">
    <div class="card-header">      
      <div class="form-group">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <span class="input-group-text">Level User</span>
          </div>
          <select class="form-control form-control-sm" name="level_id" required onchange="load_tabel()">
            <?php foreach ($select_level_user as $key){  ?>
              <option value="<?php echo $key->id ?>"><?php echo $key->value ?></option>
            <?php } ?>
          </select>
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
  $(document).ready(function(){    
    $('.select2').select2();
  }) 

  <?php $this->load->view(basename(__DIR__).'/_script.js') ?>

</script>