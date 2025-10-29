<?php 
$domain = "http://$_SERVER[HTTP_HOST]";
?>

<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php $this->load->view("_top_nav/head.php") ?>

<div class="wrapper">

  <!-- navigation -->
  <?php $this->load->view("_top_nav/navigation.php") ?>

  <!-- Main content -->
  <div class="content">
    <div class="container">

      <div class="row" id="body-content">
      </div>

    </div><!-- /.container-fluid -->

    <div class="modal fade" id="modal-data">
      <div class="modal-dialog modal-md">            
        <div id="modal-view"></div>
      </div>          
    </div>

    <div class="modal fade" id="modal-data-user">
      <div class="modal-dialog modal-lg">            
        <div id="view-data-user"></div>
      </div>          
    </div>
    
  </div>
  <!-- /.content -->

  <?php $this->load->view('_top_nav/footer.php') ?>

  <!-- Script -->
  <?php $this->load->view("_top_nav/script.php") ?>

  <script type="text/javascript">

    $('#body-content').load('<?php echo base_url($this->uri->segment(1)); ?>/page');

  </script>

</body>
</html>
