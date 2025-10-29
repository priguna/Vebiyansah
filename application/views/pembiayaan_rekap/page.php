<div class="col-12">
  <div class="card card-primary card-outline" id="content-box-1">
    <div class="card-header">
      <div class="row">        
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
          <div class="form-group">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Tahun</span>
              </div>
              <select class="form-control form-control-sm" name="tahun" onchange="load_tabel()">
                <?php foreach ($select_tahun as $key){ ?>
                  <option value="<?php echo $key->id ?>" <?php if(date('Y') == $key->id) echo 'selected' ?>><?php echo $key->value ?></option>
                <?php } ?>
              </select>
            </div>         
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
          <div class="form-group">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Bulan</span>
              </div>
              <select class="form-control form-control-sm" name="bulan" onchange="load_tabel()">
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
        </div>
      </div>
    </div>
    <div class="card-body" id="content-tabel-1">
    </div>         
    <div class="col-12">
     <div style="text-align: right; padding-bottom: 10px">
       <button class="btn btn-sm btn-primary" onclick="downloadExcel()">
         <i class='fas fa-download'></i> Download Excel
       </button>
     </div>
   </div>
 </div>
</div>

<script type="text/javascript">
  var base_url        = url.protocol+'<?php echo str_replace("http:", "", base_url()); ?>';
  var controller_url  = base_url+'<?php echo $this->uri->segment(1); ?>';
</script>

<script type="text/javascript">

  $(document).on('mouseup touchend', function (e) {
    var container = $(".bootstrap-datetimepicker-widget");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.hide();
    }
  });

  $('#date_tgl').datetimepicker({    
    focusOnShow: true,
    format: 'Y-MM-DD'
  })

  <?php $this->load->view(basename(__DIR__).'/_script.js') ?>
</script>

 <!-- SheetJS Library untuk export Excel -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script type="text/javascript">

  function downloadExcel() {
    // Ambil tabel yang akan di-export
    const table = document.querySelector('.table-rekap');
    
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
    
    let fileName = `Rekap_${tahun}`;
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