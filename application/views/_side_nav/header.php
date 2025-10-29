<?php

$dashboard = array( 
    'title-menu' => 'Dashboard',
    'icon' => 'fa fa-home',
    'href' => base_url('/dashboard')
);

$i = 0;

foreach ($data as $key)
{ 
  if($key->submenu == 0)
  { 
    $j = 0;
    $k = 0;
    $arrayMenu[$i] = array(
      'title-menu' => $key->judul,
      'target' => $key->target,
      'icon' => $key->icon,
      'href' => base_url($key->url)
    ); 
    $i++;
  } 
  else if($key->submenu == 1)
  {
    $k = 0;
    $arrayMenu[$i-1]['menu'][$j] = array(
      'title-menu' => $key->judul,
      'target' => $key->target,
      'icon' => $key->icon,
      'href' => base_url($key->url)
    );
    $j++;
  } 
  else 
  {    
    $arrayMenu[$i-1]['menu'][$j-1]['child'][$k] = array(
      'title-menu' => $key->judul,
      'target' => $key->target,
      'icon' => $key->icon,
      'href' => base_url($key->url)
    );
    $k++;
  }
}  

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-maroon">
  <!-- Brand Logo -->
  <center>
    <a href="./" class="brand-link">
      <img src="<?php echo base_url($this->session->userdata('url_logo_kecil_'._PREFIX_)) ?>" alt="AdminLTE Logo" class="brand-image" >
      <span class="brand-text"><strong><?php echo str_replace("_"," ",strtoupper($this->session->userdata('singkatan_'._PREFIX_)))  ?></strong></span>
    </a>
  </center>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-1 pb-1 mb-1">

      <table style="width: 100%">
        <tr>
          <td width="30" style="vertical-align: middle;">
            <div class="image">
              <img width="30px" src="<?php echo base_url('_asset/img/avatar.png'); ?>" class="img-circle elevation-2"  alt="User Image">
            </div>
          </td>
          <td>
            <div style="white-space: normal; padding: 5px 0px 10px 10px"> 
              <?php if($this->session->userdata('class_utama_'._PREFIX_) == 'admin'){ ?>
                <a href="#" class="brand-text" data-toggle="modal" data-target="#modal-data" onclick="edit_profil(<?php echo $this->session->userdata('user_id_'._PREFIX_) ?>)"><u><?php echo $this->session->userdata('nama_'._PREFIX_) ?></u></a>
                <br>
                <select class="form-control form-control-sm" name="level_user" required onchange="ganti_user()"> 
                  <option value="" selected hidden disabled></option>
                  <?php foreach ($select_level as $key){ ?>
                    <option value="<?php echo $key->id ?>" <?php if($this->session->userdata('level_id_'._PREFIX_) == $key->id){ echo 'selected'; } ?>><?php echo $key->value ?></option>
                  <?php } ?>                     
                </select>    
              <?php } else { ?>
                <a class="brand-text"><?php echo $this->session->userdata('level_value_'._PREFIX_) ?></a>
              <?php } ?>              
            </div>
          </td>
        </tr>
        <?php if($this->session->userdata('class_utama_'._PREFIX_) != 'admin'){ ?>
          <tr>
            <td colspan="2"><a href="#" class="brand-text" data-toggle="modal" data-target="#modal-data" onclick="edit_profil(<?php echo $this->session->userdata('user_id_'._PREFIX_) ?>)"><u><?php echo $this->session->userdata('nama_'._PREFIX_) ?></u></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <script type="text/javascript">

      function edit_profil(id)
      {
        var data = {id: id};

        $.ajax({
          url: './user/edit',
          type: 'POST',
          data: data,
          success: function(response){    
            $('#modal-view').html(response);
            $('#modal-title').html("Edit Data");
          },
          error: function (xhr, ajaxOptions, thrownError) { 
           console.log(xhr.responseText);
         }
       });
      }

      function ganti_user()
      {
        var data = {level_id: $('select[name=level_user]').val()};

        $.ajax({
          url: './user/ganti',
          type: 'POST',
          data: data,
          dataType:'json',
          success: function(response){            
            if(response.eror == 'success') window.location.href = '<?php echo base_url("login") ?>';
          },
          error: function (xhr, ajaxOptions, thrownError) { 
           console.log(xhr.responseText);
         }
       });
      }

    </script>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="<?php echo $dashboard['href'] ?>" class="nav-link <?php if(current_url() == $dashboard['href']){ echo 'active'; $title_menu =  '<i class="'.$dashboard['icon'].'"></i> | '.$dashboard['title-menu']; } ?>">
            <i class="nav-icon <?php echo $dashboard['icon'] ?>"></i>
            <p style="font-size: 14px">
              <?php echo $dashboard['title-menu']; ?>
            </p>
          </a>
        </li>

        <?php foreach ($arrayMenu as $key){ ?>

          <li class="nav-header"><?php echo strtoupper($key['title-menu']) ?></li>

          <?php foreach ($key['menu'] as $key_2) { ?>

            <li class="nav-item<?php if(isset($key_2['child'])) echo ' has-treeview' ?>">
              <a href="<?php echo $key_2['href'] ?>" class="nav-link <?php if(!isset($key_2['child'])){ if(current_url() == $key_2['href']){ echo 'active'; $title_menu =  '<i class="'.$key_2['icon'].'"></i> | '.$key['title-menu'].' - '.$key_2['title-menu']; } } ?>" <?php if($key_2['target'] == 'New Tab') echo 'target="_blank"' ?>>
                <i class="nav-icon <?php echo $key_2['icon'] ?>"></i>
                <p style="font-size: 14px">
                  <?php echo $key_2['title-menu']; ?>
                  <?php if(isset($key_2['child'])){ ?> <i class="right fas fa-angle-left"></i><?php } ?>
                </p>
              </a>

              <?php if(isset($key_2['child'])){ ?>

                <ul class="nav nav-treeview">

                  <?php foreach ($key_2['child'] as $key_3) { ?>

                    <li class="nav-item">
                      <a href="<?php echo $key_3['href'] ?>" class="nav-link <?php if(current_url() == $key_3['href']){ echo 'active'; $title_menu =  '<i class="'.$key_2['icon'].'"></i> | '.$key_2['title-menu'].' - '.$key_3['title-menu']; } ?>" <?php if($key_3['target'] == 'New Tab') echo 'target="_blank"' ?>>
                        <i class="nav-icon fas fa-genderless"></i>
                        <p style="font-size: 14px">
                          <?php echo $key_3['title-menu']; ?>
                        </p>
                      </a>
                    </li>

                  <?php } ?>

                </ul>

              <?php } ?>

            <?php } ?>

          <?php } ?>

          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="<?php echo base_url('logout') ?>" class="nav-link ">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p style="font-size: 14px">Logout</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <!-- <h1 class="m-0 text-dark" id='home-title'><?php echo $title_menu ?></h1> -->
            <table width="100%">
              <tr>
                <td><h1 class="m-0 text-dark" id='home-title'><?php if(isset($title_menu)) echo $title_menu ?></h1> </td>
                <td style="text-align: right;"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></td>
              </tr>
            </table>  
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->