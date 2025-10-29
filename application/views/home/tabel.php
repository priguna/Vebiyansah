<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css"></style>
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="card card-primary card-outline">
      <div id="chart_1" style="height: 400px;"></div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="card card-warning card-outline">
      <div id="chart_2" style="height: 400px;"></div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="card card-primary card-outline">
      <div id="chart_5" style="height: 400px;"></div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="card card-warning card-outline">
      <div id="chart_6" style="height: 400px;"></div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="card card-success card-outline">
      <div id="chart_3" style="height: 600px;"></div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-12 col-lg-6">
    <div class="card card-danger card-outline">
      <div id="chart_4" style="height: 600px;"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var kabupaten = '';

  if($('select[name=kabupaten]').val() != 'all') kabupaten = $('select[name=kabupaten]').val(); 

  Highcharts.chart('chart_1', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Jumlah anak per jenis kelamin'
    },
    subtitle: {
      text: kabupaten+' Periode '+$('select[name=periode]').val()
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Jumlah anak',
      colorByPoint: true,
      data: [
      <?php foreach ($per_jenis_kelamin as $key) { ?>
        {
          name: '<?php echo $key->jenis_kelamin." (".$key->jml.")" ?>',
          y: <?php echo $key->jml ?>
        }, 
      <?php } ?>
      ]
    }]
  });


  Highcharts.chart('chart_2', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Proporsi anak berdasarkan status (yatim, piatu, yatim-piatu)',
    }, 
    subtitle: {
      text: kabupaten+' Periode '+$('select[name=periode]').val()
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Jumlah anak',
      colorByPoint: true,
      data: [
      <?php foreach ($per_status as $key) { ?>
        {
          name: '<?php echo $key->status." (".$key->jml.")" ?>',
          y: <?php echo $key->jml ?>
        }, 
      <?php } ?>
      ]
    }]
  });

  Highcharts.chart('chart_3', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Jumlah anak per jenis tempat tinggal',
    }, 
    subtitle: {
      text: kabupaten+' Periode '+$('select[name=periode]').val()
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Jumlah anak',
      colorByPoint: true,
      data: [
      <?php foreach ($per_status_alamat_tinggal as $key) { ?>
        {
          name: '<?php echo $key->status_alamat_tinggal." (".$key->jml.")" ?>',
          y: <?php echo $key->jml ?>
        }, 
      <?php } ?>
      ]
    }]
  });

  Highcharts.chart('chart_4', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Jumlah anak berkebutuhan khusus',
    }, 
    subtitle: {
      text: kabupaten+' Periode '+$('select[name=periode]').val()
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Jumlah anak',
      colorByPoint: true,
      data: [
      <?php foreach ($per_anak_berkebutuhan_khusus as $key) { ?>
        {
          name: '<?php echo $key->anak_berkebutuhan_khusus." (".$key->jml.")" ?>',
          y: <?php echo $key->jml ?>
        }, 
      <?php } ?>
      ]
    }]
  });

  Highcharts.chart('chart_5', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Jumlah anak berdasarkan status pengasuh',
    }, 
    subtitle: {
      text: kabupaten+' Periode '+$('select[name=periode]').val()
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Jumlah anak',
      colorByPoint: true,
      data: [
      <?php foreach ($per_status_pengasuh as $key) { ?>
        {
          name: '<?php echo $key->status_pengasuh." (".$key->jml.")" ?>',
          y: <?php echo $key->jml ?>
        }, 
      <?php } ?>
      ]
    }]
  });

  Highcharts.chart('chart_6', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Jumlah anak per kelompok umur',
    }, 
    subtitle: {
      text: kabupaten+' Periode '+$('select[name=periode]').val()
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Jumlah anak',
      colorByPoint: true,
      data: [
      {
        name: '0 - 4 (<?php echo $per_kelompok_umur->umur_0_4 ?>)',
        y: <?php echo $per_kelompok_umur->umur_0_4 ?>
      },
      {
        name: '5 - 9 (<?php echo $per_kelompok_umur->umur_5_9 ?>)',
        y: <?php echo $per_kelompok_umur->umur_5_9 ?>
      },
      {
        name: '10 - 14 (<?php echo $per_kelompok_umur->umur_10_14 ?>)',
        y: <?php echo $per_kelompok_umur->umur_0_4 ?>
      },
      {
        name: '15 - 17 (<?php echo $per_kelompok_umur->umur_15_17 ?>)',
        y: <?php echo $per_kelompok_umur->umur_15_17 ?>
      },
      {
        name: '> 17 (<?php echo $per_kelompok_umur->umur_17 ?>)',
        y: <?php echo $per_kelompok_umur->umur_17 ?>
      }
      ]
    }]
  });
</script>