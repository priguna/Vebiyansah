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
      'judul' => $key->judul,
      'url' => $key->url,
      'target' => $key->target,
      'icon' => "fas fa-globe",
    ];
    $i++;
  } 
  else if($key->submenu == 1)
  {
    if(isset($j))
    {
      $k = 0;
      $menu[$i-1]['menu'][$j] = [
        'id' => $key->id,
        'judul' => $key->judul,
        'url' => $key->url,
        'target' => $key->target,
        'icon' => $key->icon,
      ];
      $j++;
    }
  } 
  else
  {
    if(isset($j))
    {
      $menu[$i-1]['menu'][$j-1]['child'][$k] = [
        'id' => $key->id,
        'judul' => $key->judul,
        'url' => $key->url,
        'target' => $key->target,
        'icon' => 'fas fa-genderless'
      ];
      $k++;
    }
  }
}

?>

<link rel="stylesheet" href="./_asset/nestable/jquery.nestable.min.css">

<table class="table table-sm table-bordered" width="100%">
  <tr>
    <th style="text-align: center;">Judul</th>
    <th style="text-align: center; width: 320px">URL</th>
    <th style="text-align: center; width: 150px">target</th>
    <th style="text-align: center; width: 120px">Aksi</th>
  </tr>
</table>

<?php if(isset($menu)){ ?>

  <div class="cf nestable-lists">
    <div class="dd" id="nestable">
      <ol class="dd-list">

        <?php foreach ($menu as $key){ ?>

          <li class="dd-item dd3-item" data-id="<?php echo $key['id'] ?>">  
            <div class="dd-handle dd3-handle"><i class="<?php echo $key['icon'] ?>"></i></div>
            <div class="dd3-content">
              <table width="100%">
                <tr>
                  <td><?php echo $key['judul'] ?> </td>
                  <td width="300"><?php echo $key['url'] ?></td>
                  <td width="100"><?php echo $key['target'] ?></td>
                  <td align="right" width="120">
                    <button type="button" class="btn btn-xs btn-outline-info" data-toggle="modal" data-target="#modal-data" onclick="edit_data(<?php echo $key['id'] ?>)"> <i class="fa fa-edit"> Edit </i></button>
                    <button class="btn btn-outline-warning btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data" data-placement="bottom" title="Salin data" onclick="salin_data(<?php echo $key['id'] ?>)"><i class="fas fa-clone"></i></button>
                    <button class="btn btn-outline-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_data(<?php echo $key['id'] ?>, '<?php echo $key['judul'] ?>', '<?php echo $key['url'] ?>')"><i class="fas fa-times"></i></button>
                  </td>
                </tr>
              </table>          
            </div>

            <?php if(isset($key['menu'])){ ?>

              <ol class="dd-list">

                <?php foreach ($key['menu'] as $key_2){ ?> 

                  <li class="dd-item dd3-item" data-id="<?php echo $key_2['id'] ?>">
                    <div class="dd-handle dd3-handle"><i class="<?php echo $key_2['icon'] ?>"></i></div>
                    <div class="dd3-content">
                      <table width="100%">
                        <tr>
                          <td><?php echo $key_2['judul'] ?> </td>
                          <td width="300"><?php echo $key_2['url'] ?></td>
                          <td width="100"><?php echo $key_2['target'] ?></td>
                          <td align="right" width="120">
                            <button type="button" class="btn btn-xs btn-outline-info" data-toggle="modal" data-target="#modal-data" onclick="edit_data(<?php echo $key_2['id'] ?>)"> <i class="fa fa-edit"> Edit </i></button>
                            <button class="btn btn-outline-warning btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data" data-placement="bottom" title="Salin data" onclick="salin_data(<?php echo $key_2['id'] ?>)"><i class="fas fa-clone"></i></button>
                            <button class="btn btn-outline-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_data(<?php echo $key_2['id'] ?>, '<?php echo $key_2['judul'] ?>', '<?php echo $key_2['url'] ?>')"><i class="fas fa-times"></i></button>
                          </td>
                        </tr>
                      </table>  
                    </div>

                    <?php if(isset($key_2['child'])){ ?>

                      <ol class="dd-list">  

                        <?php foreach ($key_2['child'] as $key_3){ ?> 

                          <li class="dd-item dd3-item" data-id="<?php echo $key_3['id'] ?>"> 
                            <div class="dd-handle dd3-handle"><i class="<?php echo $key_3['icon'] ?>"></i></div>
                            <div class="dd3-content">
                              <table width="100%">
                                <tr>
                                  <td><?php echo $key_3['judul'] ?> </td>
                                  <td width="300"><?php echo $key_3['url'] ?></td>
                                  <td width="100"><?php echo $key_3['target'] ?></td>
                                  <td align="right" width="120">
                                    <button type="button" class="btn btn-xs btn-outline-info" data-toggle="modal" data-target="#modal-data" onclick="edit_data(<?php echo $key_3['id'] ?>)"> <i class="fa fa-edit"> Edit </i></button>
                                    <button class="btn btn-outline-warning btn-rounded btn-xs" data-toggle="modal" data-target="#modal-data" data-placement="bottom" title="Salin data" onclick="salin_data(<?php echo $key_3['id'] ?>)"><i class="fas fa-clone"></i></button>
                                    <button class="btn btn-outline-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_data(<?php echo $key_3['id'] ?>, '<?php echo $key_3['judul'] ?>', '<?php echo $key_3['url'] ?>')"><i class="fas fa-times"></i></button>
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

  <script src="./_asset/nestable/jquery.nestable.min.js"></script>

  <script>

    $(document).ready(function() {

      var updateOutput = function(e) {
        var list = e.length ? e : $(e.target),
        output = list.data('output');
        if(window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize')));
        }
        else {
          output.val('JSON browser support required for this demo.');
        }
      }; 

      $('#nestable').nestable().on('change', updateOutput);

      updateOutput($('#nestable').data('output', $('#nestable-output')));

    });

    $('#nestable-menu').on('click', function(e) {
      var target = $(e.target),
      action = target.data('action');
      if(action === 'expand-all') {
        $('.dd').nestable('expandAll');
      }
      if(action === 'collapse-all') {
        $('.dd').nestable('collapseAll');
      }
      if(action === 'add-item') {
        var newItem = {
          "id": ++lastId,
          "content": "New Item " + lastId,
          "parent_id":2
        };
        $('#nestable').nestable('add', newItem);
      }
      if(action === 'replace-item') {
        var replacedItem = {
          "id": 10,
          "content": "New item 10",
          "children": [
          {
            "id": ++lastId,
            "content": "Item " + lastId,
            "children": [
            {
              "id": ++lastId,
              "content": "Item " + lastId
            }
            ]
          }
          ]
        };
        $('#nestable').nestable('replace', replacedItem);
      }

    });
  </script>

  <?php } ?> 