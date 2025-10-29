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
    range_tgl: $('input[name=range_tgl]').val(),
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
     console.log(xhr.responseText);
   }
 });
}

function tambah_data(no_rawat)
{  
  var data = {no_rawat: no_rawat};

  $.ajax({
    url: controller_url+'/tambah',
    type: 'POST',
    data: data,
    success: function(response){  
      $('#modal-view-xl').html(response);
      $('#modal-title').html("<i class='fas fa-plus'></i> | Tambah Data");
    },
    error: function (xhr, ajaxOptions, thrownError) { 
      console.log(xhr.responseText);
    }
  });
}