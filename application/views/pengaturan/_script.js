$(document).ready(function(){
  load_tabel();
})  

function load_tabel(url_page)
{
  if(url_page == null) var url_page = controller_url+'/tabel';

  $.ajax({
    url: url_page,
    type: 'POST',
    success: function(response){    
      $('#content-box-1').html(response);
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     console.log(xhr.responseText);
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
     console.log(xhr.responseText);
   }
 });
}

function update_get_from_server(mode, versi)
{
  proses_loading();

  $('#modal-view-xl').html(""); 

  var data = {
    mode: mode,
    versi: versi
  };

  $.ajax({
    url: controller_url+'/update_get_from_server',
    type: 'POST',
    data: data,
    dataType:'json',
    success: function(response)
    {       
      Swal.close(); 

      if(response.eror == 'success')
      { 
        $('#modal-view-xl').load(controller_url+'/form_update_get');     

        var length_content = response.content.length;

        if(length_content > 0)
        {
          for (let j = 0; j < length_content; j++)
          {          
            setTimeout(function()
            {
              execute_content(j, length_content, response.content[j]); 
              $('input[name=jml_content]').val((j*1)+1);
            }, (j*100));
          }
        }

        var length_database = response.database.length;

        if(length_database > 0)
        {
          $('#tabel_database').show();

          for (let i = 0; i < length_database; i++)
          {          
            setTimeout(function()
            {
              execute_database(i, length_database, response.database[i]); 
            }, (length_content*100)+(i*100));
          }
        }

        if(length_content != 0 || length_database != 0 )
        {
          setTimeout(function()
          {
            update_versi(response.versi);
          }, (length_content*100)+(length_database*100));
        }
      }
      else 
      {      
        setTimeout(function()
        {
          $('.modal').modal('hide');
        }, 1000);
        
        notif(response.eror, response.pesan);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) { 
     notif('warning', xhr.responseText);
   }
 });
}

function execute_content(urut, jml, data)
{
  var jml_content = $('input[name=jml_content]').val();

  $.ajax({
    url: controller_url+'/execute_update_content',
    data: data,
    type: 'POST',
    success: function(response)
    {  
      $('#data_content').append('<tr><td>'+(urut+1)+' dari '+jml+'</td>'+response+'</tr>');

      var persen = (jml_content/jml)*100;
      document.getElementById('progress_content').style.width = Math.round(persen)+'%';
      document.getElementById('progress_content_persen').innerHTML = Math.round(persen)+' %';

      scrollToBottom();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      notif('warning', xhr.responseText);
    }
  });
}

function execute_database(urut, jml, data)
{
  $.ajax({
    url: controller_url+'/execute_update_database',
    data: data,
    type: 'POST',
    success: function(response)
    {  
      $('#data_database').append('<tr><td>'+(urut+1)+' dari '+jml+'</td>'+response+'</tr>');

      var persen = ((urut+1)/jml*100);
      document.getElementById('progress_database').style.width = Math.round(persen)+'%';
      document.getElementById('progress_database_persen').innerHTML = Math.round(persen)+' %';

      scrollToBottom();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      notif('warning', xhr.responseText);
    }
  });
}

function update_versi(versi)
{
  var data = {versi: versi};
  
  $.ajax({
    url: controller_url+'/update_versi',
    data: data,
    type: 'POST',
    dataType:'json',
    success: function(response)
    {        
      load_tabel();
      notif(response.eror,response.pesan);
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