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
    tahun: $('select[name=tahun]').val(),
    bulan: $('select[name=bulan]').val()
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