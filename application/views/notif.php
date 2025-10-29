<?php 
$icon = '';
switch ($eror) {
  case 'success':
  $icon = '<i class="icon fa fa-check"></i>';
  break;
  case 'warning':
  $icon = '<i class="icon fa fa-exclamation"></i>';
  break;  
}
?>

<div class="modal-dialog">
  <div class="alert alert-<?php echo $eror ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><?php echo "$icon $pesan" ?></h4>
</div>