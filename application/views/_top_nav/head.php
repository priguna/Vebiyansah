<?php 
$domain = "http://$_SERVER[HTTP_HOST]";
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title><?php echo SITE_NAME ." | ". $this->session->userdata('level_value_'.APP_NAME) ?></title>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url('_asset/img/logo.png') ?>">

   <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/all.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/font-awesome/css/font-awesome.min.css'; ?>">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' ?>"> -->
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/daterangepicker/daterangepicker.css' ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css' ?>">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/select2/css/select2.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css' ?>">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/dist/css/adminlte.min.css' ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet' ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.css' ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/toastr/toastr.min.css '?>"> 

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

</head>

<body class="layout-top-nav layout-navbar-fixed">