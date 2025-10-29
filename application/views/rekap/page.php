<?php

function tgl_convert($date)
{  
  $tgl = '00-00-0000';

  if($date != '')
  {
    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );

    if($date != '0000-00-00' && $date != '')
    {
      $split = explode('-', $date); 
      $tgl = $split[2].' '.$bulan[(int)$split[1]].' '.$split[0];
    } 
  } 

  return $tgl;
}

?>

<!DOCTYPE html>
<html dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon icon -->
  <link rel="icon" type="image/x-icon" href="<?php echo base_url('_asset/img/logo_rsud.png') ?>">
  
  <title>REKAP</title>

  <!-- Custom CSS -->
  <link href="<?php echo base_url('/_asset/theme_login/style.min.css') ?>" rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.css') ?>">

  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    .btn-download {
      margin-bottom: 15px;
      background-color: #28a745;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 4px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    
    .btn-download:hover {
      background-color: #218838;
    }
    
    .download-container {
      text-align: right;
      margin-bottom: 10px;
    }
  </style>

</head>

<body>
  <div class="main-wrapper">
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url('_asset/theme_login/auth-bg.jpg') ?>) no-repeat center center;">
      <div class="auth-box" style="max-width: 80%">
        <div id="loginform">
          <div class="logo">
            <p>
              <span class="db">
                <img src="<?php echo base_url('_asset/img/logo_brebes.png') ?>" alt="logo" style="height: 55px" />
                <img src="<?php echo base_url('_asset/img/logo_rsud.png') ?>" alt="logo" style="height: 55px" />
              </span>
            </p>
            <h4 class="font-medium m-b-20" style="text-transform: uppercase;">REKAP</h4>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Tahun</span>
                </div>
                <select class="form-control form-control-md" name="tahun" onchange="load_tabel()">
                  <?php foreach ($select_tahun as $key){ ?>
                    <option value="<?php echo $key->id ?>" <?php if(date('Y') == $key->id) echo 'selected' ?>><?php echo $key->value ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Bulan</span>
                </div>
                <select class="form-control form-control-md" name="bulan" onchange="load_tabel()">
                 <option value="all">Semua</option>
                 <option value="1" <?php if(date('m') == '01') echo 'selected' ?>>Januari</option>
                 <option value="2" <?php if(date('m') == '02') echo 'selected' ?>>Februari</option>
                 <option value="3" <?php if(date('m') == '03') echo 'selected' ?>>Maret</option>
                 <option value="4" <?php if(date('m') == '04') echo 'selected' ?>>April</option>
                 <option value="5" <?php if(date('m') == '05') echo 'selected' ?>>Mei</option>
                 <option value="6" <?php if(date('m') == '06') echo 'selected' ?>>Juni</option>
                 <option value="7" <?php if(date('m') == '07') echo 'selected' ?>>Juli</option>
                 <option value="8" <?php if(date('m') == '08') echo 'selected' ?>>Agustus</option>
                 <option value="9" <?php if(date('m') == '09') echo 'selected' ?>>September</option>
                 <option value="10" <?php if(date('m') == '10') echo 'selected' ?>>Oktober</option>
                 <option value="11" <?php if(date('m') == '12') echo 'selected' ?>>November</option>
                 <option value="12" <?php if(date('m') == '12') echo 'selected' ?>>Desember</option>
               </select>
             </div>
           </div>
           <div class="col-12" id="content-tabel-1">
           </div>           
           <div class="col-12">
             <div class="download-container">
               <button class="btn-download" onclick="downloadExcel()">
                 <i class='bx bx-download'></i> Download Excel
               </button>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>

 <script src="<?php echo base_url('/_asset/theme_login/jquery.min.js') ?>"></script>
 <script src="<?php echo base_url('/_asset/theme_login/popper.min.js') ?>"></script>
 <script src="<?php echo base_url('/_asset/theme_login/bootstrap.min.js') ?>"></script>
 <script src="<?php echo base_url('/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
 <!-- SheetJS Library untuk export Excel -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

 <script type="text/javascript">
  $(document).ready(function(){
    load_tabel();
  })  

  $('[data-toggle="tooltip"]').tooltip();
  $(".preloader").fadeOut();

  var url = window.location;

  var base_url        = url.protocol+'<?php echo str_replace("http:", "", base_url()); ?>';
  var controller_url  = base_url+'<?php echo $this->uri->segment(1); ?>';

  function load_tabel(url_page)
  {
    if(url_page == null) var url_page = controller_url+'/page';

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

  function downloadExcel() {
    // Ambil tabel yang akan di-export
    const table = document.querySelector('table');
    
    if (!table) {
      Swal.fire({
        icon: 'warning',
        title: 'Tidak ada data',
        text: 'Tidak ada tabel yang dapat diunduh'
      });
      return;
    }

    // Buat workbook dan worksheet
    const wb = XLSX.utils.book_new();
    
    // Konversi tabel HTML ke worksheet
    const ws = XLSX.utils.table_to_sheet(table);
    
    // Tambahkan worksheet ke workbook
    XLSX.utils.book_append_sheet(wb, ws, "Rekap Data");
    
    // Generate nama file berdasarkan filter
    const tahun = $('select[name=tahun]').val();
    const bulan = $('select[name=bulan]').val();
    const namaBulan = $('select[name=bulan] option:selected').text();
    
    let fileName = `Rekap__${tahun}`;
    if (bulan !== 'all') {
      fileName += `_${namaBulan}`;
    }
    fileName += '.xlsx';
    
    // Download file
    XLSX.writeFile(wb, fileName);
    
    // Optional: Tampilkan notifikasi sukses
    Swal.fire({
      icon: 'success',
      title: 'Download Berhasil',
      text: `File ${fileName} berhasil diunduh`,
      timer: 2000,
      showConfirmButton: false
    });
  }
</script>
</body>

</html>