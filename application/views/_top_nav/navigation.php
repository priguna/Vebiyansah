<?php 

$domain = "http://$_SERVER[HTTP_HOST]";

switch ($this->session->userdata('class_'.APP_NAME)) {

  case 'bidan':
  $arrayMenu = array(
    array(
      'title-menu' => 'Home',
      'icon' => 'fa fa-home',
      'href' => base_url('/dashboard')
    ),
    array(
      'title-menu' => 'Data Pasien',
      'icon' => 'fa fa-users',
      'href' => base_url('/data_pasien')
    ),
    array(
      'title-menu' => 'Data Pemeriksaan',
      'icon' => 'fa fa-heartbeat',
      'href' => base_url('/data_pemeriksaan')
    ),
    array(
      'title-menu' => 'Data Jadwal Pemeriksaan',
      'icon' => 'fa fa-user-md',
      'href' => base_url('/data_jadwal_pemeriksaan')
    ),
    array(
      'title-menu' => 'Data Jadwal Obat',
      'icon' => 'fa fa-calendar',
      'href' => base_url('/data_jadwal_obat')
    ),
    array(
      'title-menu' => 'Data Aktifitas Olahraga',
      'icon' => 'fa fa-bicycle',
      'href' => base_url('/data_aktifitas_olahraga')
    )
  );

  break;

}

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
  <div class="container">

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a href="<?php echo base_url() ?>" class="navbar-brand">
      <img src="<?php echo base_url('_asset/img/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <!-- <span class="brand-text font-weight-light"><?php echo SITE_NAME  ?></span> -->
    </a>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">

        <?php foreach ($arrayMenu as $key){

          if(isset($key['child'])){    
            ?>

            <li class="nav-item dropdown">
              <a id="dropdown_laporan" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="nav-icon <?php echo $key['icon'] ?>"></i> <?php echo $key['title-menu']; ?>
              </a>
              <ul aria-labelledby="dropdown_laporan" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">

                <?php foreach ($key['child'] as $key2) { ?>
                  <li class="<?php if(current_url() == $key2['href']){ echo 'active'; $title_menu = $key['title-menu'].' - '.$key2['title-menu']; } ?>"><a href="<?php echo $key2['href'] ?>" class="dropdown-item"><?php echo $key2['title-menu']; ?> </a></li>
                <?php } ?>

              </ul>
            </li>

          <?php } else { ?>

            <li class="nav-item <?php if(current_url() == $key['href']){ echo 'active'; $title_menu = $key['title-menu']; } ?>">
              <a href="<?php echo $key['href'] ?>" class="nav-link">
                <i class="nav-icon <?php echo $key['icon'] ?>"></i> <?php echo $key['title-menu']; ?>
              </a>
            </li>

          <?php }
        } ?>

      </ul>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
            <img src="<?php echo base_url('_asset/img/avatar.png'); ?>" class="img-circle" style="width: 30px">
            <!-- <span><?php echo $this->session->userdata('nama_'.APP_NAME) ?></span> -->
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; height: 130px">
            <a class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url('_asset/img/avatar.png'); ?>" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?php echo $this->session->userdata('nama_'.APP_NAME) ?>
                  </h3>
                  <p class="text-sm"><?php echo $this->session->userdata('username_'.APP_NAME) ?></p>
                  <p class="text-sm">sebagai <?php echo $this->session->userdata('level_value_'.APP_NAME) ?></p>                
                  <p class="text-sm"><?php echo $this->session->userdata('email_'.APP_NAME) ?></p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <div class="row-12" style="margin: 10px">
              <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-data-user" onclick="edit_profil(<?php echo $this->session->userdata('user_id_'.APP_NAME) ?>)">Edit</button>
              <a href="<?php echo base_url('logout') ?>"><button type="button" class="btn btn-sm btn-danger float-sm-right">Sign out</button></a>
            </div>
          </div>
        </div>
      </li>

    </ul>
  </div>
</nav>
<!-- /.navbar -->

<script type="text/javascript">

  function edit_profil(id){
    $('#view-data-user').load('data_user/edit/'+id);
  }

</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark"><?php echo $title_menu ?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->