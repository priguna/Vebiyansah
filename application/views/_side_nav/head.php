<?php 
$domain = "http://$_SERVER[HTTP_HOST]";
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title><?php echo str_replace("_"," ",strtoupper($this->session->userdata('nama_apps_'._PREFIX_))) ." | ". $this->session->userdata('level_value_'._PREFIX_) ?></title>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url($this->session->userdata('url_logo_kecil_'._PREFIX_)) ?>">
    <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/daterangepicker/daterangepicker.css' ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/all.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/brands.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/fontawesome.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/regular.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/solid.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/svg-with-js.min.css' ?>">
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/fontawesome-free/css/v4-shims.min.css' ?>">
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
  <link rel="stylesheet" href="<?php echo $domain.'/_asset/theme_lte3/plugins/toastr/toastr.min.css' ?>"> 
   
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

    #overlay-loading {
      background: #ffffff;
      color: #666666;
      position: fixed;
      height: 100%;
      width: 100%;
      z-index: 5000;
      top: 0;
      left: 0;
      float: left;
      text-align: center;
      padding-top: 15%;
      opacity: .80;
    }

    select {
      font-family: 'FontAwesome'
    }
  </style>

 <script src='_asset/responsivevoice.js'></script>

</head>

<body class="hold-transition layout-fixed sidebar-mini sidebar-collapse accent-maroon text-sm">