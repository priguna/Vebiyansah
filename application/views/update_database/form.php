<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title"><i class='fas fa-database'></i> | Database</h4>
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
                  <i class="fas fa-plus"></i>
                </span>
              </div>
              <input type="text" class="form-control form-control-sm" name="query" placeholder="query" />
            </div>
          </td>
          <td style="width: 90px; text-align: right;">
            <button type="button" class="btn btn-primary btn-sm" onclick="simpan_query()"><i class="fas fa-save"></i> Simpan</button>
          </td>
        </tr>
      </table>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-striped table-hover">
        <thead>
          <tr>      
            <th style="text-align: center; width: 50px">No</th>
            <th style="text-align: center;">Query</th>
            <th style="text-align: center; width: 50px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $urut = 0; foreach ($data as $key){ $urut++; ?>
            <tr>
              <td style="text-align: center;"><?php echo $urut ?></td>
              <td style="text-align: center;"><?php echo $key->query ?></td>
              <td style="text-align: center;">               
                <button class="btn btn-danger btn-rounded btn-xs" data-placement="bottom" title="Hapus data" onclick="hapus_query(<?php echo $key->id ?>, 'Query:', '<?php echo base64_encode($key->query) ?>')"><i class="fas fa-times"></i></button>
              </td>
            </tr> 
          <?php } ?>
        </tbody>
      </table>
    </div>    
  </div>
  <div class="modal-footer">
    <input type="hidden" name="list" value="<?php echo $list ?>">
    <button type="button" class="btn btn-default" data-dismiss="modal" class="close"><i class="fas fa-times"></i> Batal</button>
  </div>
</div>

<script type="text/javascript">
  function simpan_query()
  {
    var data = {
      'list' : $('input[name=list]').val(), 
      'query' : $('input[name=query]').val()
    }

    if(data.query != '')
    {
      $.ajax({
        url: base_url+'update_database/add',
        type: 'POST',
        data: data,
        dataType:'json',
        success: function(response){      
          notif(response.eror,response.pesan);
          database($('input[name=list]').val());
        },
        error: function (xhr, ajaxOptions, thrownError) { 
          notif('warning', xhr.responseText);
        }
      });
    }
    else notif('warning','Query tidak boleh kosong');
  }

  function hapus_query(id, value_1, value_2)
  {
    var capcha = Math.floor((Math.random() * 100));

    Swal.fire({
      title: 'Apakah data ini akan dihapus?',
      html: '<strong>'+value_1+'</strong><br>'+atob(value_2)+'<br><br><table width="100%"><tr><td width="150px">Ketik angka <br><b>'+capcha+
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
        delete_query(id);
      } 
    })
  }

  function delete_query(id)
  {  
    var data = {id: id};

    $.ajax({
      url: base_url+'update_database/delete',
      type: 'POST',
      data: data,
      dataType:'json',
      success: function(response){      
        notif(response.eror,response.pesan);
        database($('input[name=list]').val());
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        notif('warning', xhr.responseText);
      }
    });
  }
</script>