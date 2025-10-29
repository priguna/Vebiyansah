<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<!-- Head -->
<?php $this->load->view(basename(__DIR__).'/head.php') ?>

<div class="wrapper">

  <!-- header -->
  <?php $this->load->view(basename(__DIR__).'/header', $menu);  ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->

      <div class="row" id="body-content">   
      </div>

    </div><!-- /.container-fluid -->


    <div class="modal fade" id="modal-data-xl">
      <div class="modal-dialog modal-xl">            
        <div id="modal-view-xl"></div>
      </div>          
    </div>

    <div class="modal fade" id="modal-data-xl2">
      <div class="modal-dialog modal-xl2" style="max-width: 98%">            
        <div id="modal-view-xl2"></div>
      </div>          
    </div>

    <div class="modal fade" id="modal-data">
      <div class="modal-dialog modal-lg">            
        <div id="modal-view"></div>
      </div>          
    </div>

    <div class="modal fade" id="modal-data-md">
      <div class="modal-dialog modal-md">            
        <div id="modal-view-md"></div>
      </div>          
    </div>

    <div class="modal fade" id="modal-data-profil">
      <div class="modal-dialog modal-lg">            
        <div id="view-data-profil"></div>
      </div>          
    </div>

    <iframe id="printing-frame" name="print_frame" src="about:blank" style="display: none; height: 14cm"></iframe>

  </section>
  <!-- /.content -->

  <!-- footer -->
  <?php $this->load->view(basename(__DIR__).'/footer.php') ?>

</div>
<!-- ./wrapper -->

<!-- Script -->
<?php $this->load->view(basename(__DIR__).'/script.php') ?>

<script type="text/javascript">

  var url = window.location;

  var url_page = url.protocol+'<?php echo str_replace("http:", "", base_url($this->uri->segment(1))); ?>/page';

  $.ajax({
    url: url_page,
    type: 'POST',
    success: function(response)
    {    
      $('#body-content').html(response);
    },
    error: function (xhr, ajaxOptions, thrownError) { 
      notif('warning', xhr.responseText);
    }
  });
  
</script>

</body>
</html>