<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title" id="modal-title"></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">  
    <div class="form-group">
      <table width="100%">
        <tr>
          <td>            
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Direktori
                </span>
              </div>
              <input type="text" class="form-control form-control-sm" name="dir" placeholder="dir" />
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Filename
                </span>
              </div>
              <input type="text" class="form-control form-control-sm" name="filename" placeholder="filename" /> 
            </div>
          </td>
        </tr>
        <tr>
          <td style="width: 90px; text-align: right;">
            <input type="hidden" name="list" value="<?php echo $list ?>">
            <input type="hidden" name="versi" value="<?php echo $versi ?>">
            <button type="button" class="btn btn-primary btn-sm" onclick="simpan_file()"><i class="fas fa-save"></i> Simpan</button>
          </td>
        </tr>
      </table>
    </div>    
    <div class="table-responsive" >
      <table class="table table-sm table-bordered table-striped table-hover tabel-generate">
        <thead>
          <tr>           
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Filename</th>
            <th style="text-align: center;">Direktori</th>
            <th style="text-align: center;">Modified Date</th>
            <th style="text-align: center; width: 50px">Aksi</th>
          </tr>
        </thead>
        <tbody>     
          <?php $urut = 0; foreach ($data as $key){ $urut++; ?>
            <tr>
              <td><?php echo $urut ?></td>
              <td><?php echo $key->filename ?></td>
              <td><?php echo $key->dir ?></td>
              <td><?php echo $key->file_date ?></td>
              <td style="text-align: center;">               
                <button class="btn btn-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_file(<?php echo $key->id ?>, '<?php echo $key->dir ?>', '<?php echo $key->filename ?>')"><i class="fas fa-times"></i></button>
              </td>
            </tr>
          <?php } ?>    
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" class="close"><i class="fas fa-times"></i> Batal</button>
  </div>
</div>

<script type="text/javascript">
  function simpan_file()
  {
    var data = {
      'list' : $('input[name=list]').val(), 
      'versi' : $('input[name=versi]').val(),
      'filename' : $('input[name=filename]').val(), 
      'dir' : $('input[name=dir]').val()
    }

    if(data.filename != '' || data.dir != '')
    {
      $.ajax({
        url: base_url+'/update_content/add',
        type: 'POST',
        data: data,
        dataType:'json',
        success: function(response){      
          notif(response.eror,response.pesan);
          view(data.list, data.versi);
        },
        error: function (xhr, ajaxOptions, thrownError) { 
          notif('warning', xhr.responseText);
        }
      });
    }
    else notif('warning','Input tidak boleh kosong');
  }

  function hapus_file(id, value_1, value_2)
  {
    var capcha = Math.floor((Math.random() * 100));

    Swal.fire({
      title: 'Apakah data ini akan dihapus?',
      html: '<strong>'+value_1+'</strong><br>'+value_2+'<br><br><table width="100%"><tr><td width="150px">Ketik angka <br><b>'+capcha+
      '</b></td><td><input type="text" id="kode" class="swal2-input" placeholder="Kode konfirmasi"></td></tr></table>',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
      preConfirm: () => {
        const kode = Swal.getPopup().querySelector('#kode').value
        if (kode != capcha || !kode) {
          Swal.showValidationMessage('Kode konfirmasi salah')
        }
        return { capcha: kode }
      }
    }).then((result) => {
      if(result.value.capcha){
        delete_file(id);
      } 
    })
  }

  function delete_file(id)
  {  
    var data = {id: id};

    $.ajax({
      url: base_url+'/update_content/delete',
      type: 'POST',
      data: data,
      dataType:'json',
      success: function(response){      
        notif(response.eror,response.pesan);
          view($('input[name=list]').val(), $('input[name=versi]').val());
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        notif('warning', xhr.responseText);
      }
    });
  }
</script>