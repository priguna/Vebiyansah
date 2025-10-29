<?php 
$domain = "http://$_SERVER[HTTP_HOST]";
?>

<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php $this->load->view("_top_not_nav/head.php") ?>

<div class="wrapper">

  <!-- Main content -->
  <div class="content">

    <div class="row" id="body-content" style="">
    </div>
    
  </div>
  <!-- /.content -->
</div>

  <!-- Script -->
  <?php $this->load->view("_top_not_nav/script.php") ?>

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
