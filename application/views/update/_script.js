$(document).ready(function(){
  load_tabel();
})  

$('.cari_data').keyup(function(){ 
  load_tabel();
});

function load_tabel(url_page)
{
  if(url_page == null) var url_page = controller_url+'/tabel';

  var data = {
    level_id: $('select[name=level_id]').val(),
    keyword: $('input[name=keyword]').val()
  };

  $.ajax({
    url: url_page,
    type: 'POST',
    data: data,
    success: function(response){    
      $('#content-tabel-1').html(response);
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
   }
 });
}

function tambah_data()
{
  $.ajax({
    url: controller_url+'/tambah',
    type: 'POST',
    success: function(response){    
      $('#modal-view').html(response);
      $('#modal-title').html("<i class='fas fa-plus'></i> | Tambah Data");
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
   }
 });
}

function edit_data(id)
{
  var data = {id: id};

  $.ajax({
    url: controller_url+'/edit',
    type: 'POST',
    data: data,
    success: function(response){    
      $('#modal-view').html(response);
      $('#modal-title').html("<i class='fas fa-edit'></i> | Edit Data");
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
   }
 });
}

function salin_data(id)
{
  var data = {id: id};

  $.ajax({
    url: controller_url+'/salin',
    type: 'POST',
    data: data,
    success: function(response){    
      $('#modal-view').html(response);
      $('#modal-title').html("<i class='fas fa-clone'></i> | Salin Data");
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
   }
 });
}

function view(id, versi)
{
  var data = {
    id: id,
    versi: versi
  };

  $.ajax({
    url: base_url+'/update_content/',
    type: 'POST',
    data: data,
    success: function(response){    
      $('#modal-view-xl').html(response);
      $('#modal-title').html("<i class='fas fa-file'></i> | View File");
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
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
  var data = {id: id};

  $.ajax({
    url: controller_url+'/delete',
    type: 'POST',
    data: data,
    dataType:'json',
    success: function(response){      
      notif(response.eror,response.pesan);
      load_tabel(page_curr);
    },
    error: function (xhr, ajaxOptions, thrownError) { 
      notif('warning', xhr.responseText);
    }
  });
}

function generate(id)
{
  var data = {id: id};

  $('#modal-view-xl').html("");

  $.ajax({
    url: base_url+'/update_generate/',
    type: 'POST',
    data: data,
    dataType:'json',
    success: function(response)
    {    
      var length = response.length;

      $('#modal-view-xl').load(base_url+'/update_generate/form');

      $('#progress_generate').html('');  

      if(length > 0)
      {
        for (let j = 0; j < length; j++)
        {          
          setTimeout(function()
          {
            execute_generate(j, length, response[j]); 
          }, (j*100));
        }
      }
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
   }
 });
}

function database(id)
{
  var data = {id: id};

  $.ajax({
    url: base_url+'/update_database/',
    type: 'POST',
    data: data,
    success: function(response)
    {
      $('#modal-view-xl').html(response);
    },
    error: function (xhr, ajaxOptions, thrownError) { 
      notif('warning', xhr.responseText);
    }
  });
}

function execute_generate(urut, jml, data)
{
  $.ajax({
    url: base_url+'/update_generate/execute_update_generate',
    data: data,
    type: 'POST',
    success: function(response)
    {  
      $('#data_generate').append('<tr><td>'+(urut+1)+' dari '+jml+'</td>'+response+'</tr>');

      var persen = ((urut+1)/jml*100);
      document.getElementById('progress_generate').style.width = Math.round(persen)+'%';
      document.getElementById('progress_generate_persen').innerHTML = Math.round(persen)+' %';
      
      scrollToBottom();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      notif('warning', xhr.responseText);
    }
  });
}

function scrollToBottom() {
  const scrollableContent = $('.modal-body-2');
  scrollableContent.scrollTop(scrollableContent[0].scrollHeight);
}