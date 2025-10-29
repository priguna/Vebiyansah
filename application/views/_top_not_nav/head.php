<?php 
$domain = "http://$_SERVER[HTTP_HOST]";
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title><?php echo $this->uri->segment(3); ?></title>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url('_asset/img/logo_kecil.png') ?>">

   <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/all.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/font-awesome/css/font-awesome.min.css'; ?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/dist/css/adminlte.min.css' ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.css' ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet' ?>">
 
   <style>
    input.uppercase{
      text-transform: uppercase;
    }
    
    textarea.uppercase{
      text-transform: uppercase;
    }  

    button.swal2-cancel {
      min-width: 150px;
      -webkit-border-radius: 25rem;
      border-radius: 25rem;
      -webkit-box-shadow: none!important;
      box-shadow: none!important;
      margin: 0 1rem 17px;
    }

    button.swal2-confirm {
      min-width: 150px;
      -webkit-border-radius: 25rem;
      border-radius: 25rem;
      -webkit-box-shadow: none!important;
      box-shadow: none!important;
      margin: 0 1rem 17px;
    }
  </style> 

   <script src='_asset/responsivevoice.js'></script>

</head>
