<div class="col-12">
  <div id="content-box-1">
  </div>
</div>

<script type="text/javascript">
  var base_url        = url.protocol+'<?php echo str_replace("http:", "", base_url()); ?>';
  var controller_url  = base_url+'<?php echo $this->uri->segment(1); ?>';
</script>

<script type="text/javascript">

  <?php $this->load->view(basename(__DIR__).'/_script.js') ?>

</script>