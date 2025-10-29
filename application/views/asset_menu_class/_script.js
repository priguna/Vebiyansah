$(document).ready(function(){
  load_tabel();
})  

function load_tabel(url_page)
{
  if(url_page == null) var url_page = controller_url+'/tabel';

  var data = {
    level_id: $('select[name=level_id]').val()
  };

  $.ajax({
    url: url_page,
    type: 'POST',
    data: data,
    success: function(response){    
      $('#content-tabel-1').html(response);
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     console.log(xhr.responseText);
   }
 });
}

function hapus_data(id, value_1, value_2)
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
      delete_data(id);
    } 
  })
}

function delete_data(id)
{  
  $.ajax({
    url: controller_url+'/delete/'+id,
    dataType:'json',
    success: function(response){      
      notif(response.eror,response.pesan);
      load_tabel();
    },
    error: function (xhr, ajaxOptions, thrownError) { 
      console.log(xhr.responseText);
    }
  });
}