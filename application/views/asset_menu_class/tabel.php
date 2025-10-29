<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$i = 0; 
foreach ($data as $key)
{ 
  $id = $key->id;

  if($key->submenu == 0)
  {
    $j = 0;
    $k = 0;
    $menu[$i] = [
      'id' => $key->id,
      'menu_id' => $key->menu_id,
      'judul' => $key->judul,
      'url' => $key->url,
      'target' => $key->target,
      'icon' => "fas fa-globe",
    ];
    $i++;
  } 
  else if($key->submenu == 1)
  {
    $k = 0;
    $menu[$i-1]['menu'][$j] = [
      'id' => $key->id,
      'menu_id' => $key->menu_id,
      'judul' => $key->judul,
      'url' => $key->url,
      'target' => $key->target,
      'icon' => $key->icon,
    ];
    $j++;
  } 
  else
  {
    $menu[$i-1]['menu'][$j-1]['child'][$k] = [
      'id' => $key->id,
      'menu_id' => $key->menu_id,
      'judul' => $key->judul,
      'url' => $key->url,
      'target' => $key->target,
      'icon' => 'fas fa-genderless'
    ];
    $k++;
  }
}

?>

<link rel="stylesheet" href="./_asset/nestable/jquery.nestable.min.css">

<table class="table table-sm table-bordered" width="100%">
  <tr>
    <th style="text-align: center;">Judul</th>
    <th style="text-align: center; width: 320px">URL</th>
    <th style="text-align: center; width: 150px">target</th>
    <th style="text-align: center; width: 100px">
      <input type="checkbox" name="checkbox_menu" onclick="checked_menu('form-menu', this.checked)">
    </th>
  </tr>
</table>

<form role="form" method="POST" id="form-menu" action="<?php echo $url_form ?>">
  <input type="hidden" name="level_id" value="<?php echo $level_id ?>">

  <div class="cf nestable-lists">
    <div class="dd" id="nestable">
      <ol class="dd-list">

        <?php foreach ($menu as $key){ ?>

          <li class="dd-item dd3-item" data-id="<?php echo $key['id'] ?>">  
            <input type="hidden" name="menu_id[]" value="<?php echo $key['menu_id'] ?>">
            <div class="dd-handle dd3-handle"><i class="<?php echo $key['icon'] ?>"></i></div>
            <div class="dd3-content">
              <table width="100%">
                <tr>
                  <td><?php echo $key['judul'] ?> </td>
                  <td width="300"><?php echo $key['url'] ?></td>
                  <td width="100"><?php echo $key['target'] ?></td>                 
                  <td align="left" width="80px">
                    <input type="hidden" name="status_<?php echo $key['menu_id'] ?>" value="<?php if($key['id'] != '') echo '1'; ?>">
                    <input type="checkbox" name="id_<?php echo $key['menu_id'] ?>" <?php if($key['id'] != '') echo 'checked'; ?>>
                  </td>
                </tr>
              </table>          
            </div>

            <?php if(isset($key['menu'])){ ?>

              <ol class="dd-list">

                <?php foreach ($key['menu'] as $key_2){ ?> 

                  <li class="dd-item dd3-item" data-id="<?php echo $key_2['id'] ?>">
                    <input type="hidden" name="menu_id[]" value="<?php echo $key_2['menu_id'] ?>">
                    <div class="dd-handle dd3-handle"><i class="<?php echo $key_2['icon'] ?>"></i></div>
                    <div class="dd3-content">
                      <table width="100%">
                        <tr>
                          <td><?php echo $key_2['judul'] ?> </td>
                          <td width="300"><?php echo $key_2['url'] ?></td>
                          <td width="100"><?php echo $key_2['target'] ?></td>                          
                          <td align="left" width="80px">
                            <input type="hidden" name="status_<?php echo $key_2['menu_id'] ?>" value="<?php if($key_2['id'] != '') echo '1'; ?>">
                            <input type="checkbox" name="id_<?php echo $key_2['menu_id'] ?>" <?php if($key_2['id'] != '') echo 'checked'; ?>>
                          </td>
                        </tr>
                      </table>  
                    </div>

                    <?php if(isset($key_2['child'])){ ?>

                      <ol class="dd-list">  

                        <?php foreach ($key_2['child'] as $key_3){ ?> 

                          <li class="dd-item dd3-item" data-id="<?php echo $key_3['id'] ?>"> 
                            <input type="hidden" name="menu_id[]" value="<?php echo $key_3['menu_id'] ?>">
                            <div class="dd-handle dd3-handle"><i class="<?php echo $key_3['icon'] ?>"></i></div>
                            <div class="dd3-content">
                              <table width="100%">
                                <tr>
                                  <td><?php echo $key_3['judul'] ?> </td>
                                  <td width="300"><?php echo $key_3['url'] ?></td>
                                  <td width="100"><?php echo $key_3['target'] ?></td>                                  
                                  <td align="left" width="80px">
                                    <input type="hidden" name="status_<?php echo $key_3['menu_id'] ?>" value="<?php if($key_3['id'] != '') echo '1'; ?>">
                                    <input type="checkbox" name="id_<?php echo $key_3['menu_id'] ?>" <?php if($key_3['id'] != '') echo 'checked'; ?>>
                                  </td>
                                </tr>
                              </table>  
                            </div>
                          </li>

                        <?php } ?> 

                      </ol>

                    <?php } ?>

                  </li>

                <?php } ?> 

              </ol>

            <?php } ?>

          </li>

        <?php } ?>

      </ol>
    </div>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-xs btn-primary float-sm-right add_data"><i class="fas fa-save"></i> Simpan</button> 
  </div>
</form>

<script src="./_asset/nestable/jquery.nestable.min.js"></script>

<script type="text/javascript">
  function checked_menu(id, value)
  {
    var id = "#"+id+" input:checkbox";

    if(value == true)
    {
      $(id).attr('checked', true);
    } 
    else $(id).attr('checked', false);
  }

  $('#form-menu').submit(function(e){
    e.preventDefault();
    $.ajax({
      type: $('#form-menu').attr('method'),
      url: $('#form-menu').attr('action'),
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      dataType:'json',
      beforeSend: function() {                
        $('.add_data').attr('disabled', true);  
      },
      success: function(response){
        notif(response.eror,response.pesan);
        if(response.eror == "success"){
          load_tabel();
          $('.add_data').attr('disabled',false);
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        $('.add_data').attr('disabled',false);
      }  
    });
  })
</script>