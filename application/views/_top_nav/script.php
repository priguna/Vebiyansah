<?php 
$domain = "http://$_SERVER[HTTP_HOST]";
?>

<!-- jQuery -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/jquery/jquery.min.js' ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!-- Select2 -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/select2/js/select2.full.min.js' ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js' ?>"></script>
<!-- InputMask -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/moment/moment.min.js' ?>"></script>
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js' ?>"></script>
<!-- date-range-picker -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/daterangepicker/daterangepicker.js' ?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js' ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/bootstrap-switch/js/bootstrap-switch.min.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo $domain.'/_asset/theme_lte3/dist/js/adminlte.min.js' ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $domain.'/_asset/theme_lte3/dist/js/demo.js' ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
<!-- Toastr -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/toastr/toastr.min.js' ?>"></script>

<!-- HightChart -->
<script src="<?php echo base_url('_asset/graph/highcharts.js') ?>"></script>
<script src="<?php echo base_url('_asset/graph/data.js') ?>"></script>
<script src="<?php echo base_url('_asset/graph/drilldown.js') ?>"></script>
<script src="<?php echo base_url('_asset/graph/exporting.js') ?>"></script>
<script src="<?php echo base_url('_asset/graph/export-data.js') ?>"></script>

<script type="text/javascript">
	$('li').find('.active').parents('li').children('a').addClass('active')
</script>

<script type="text/javascript">
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3500
	});

	function notif(eror, pesan){
		if(eror == 'success'){
			Toast.fire({
				icon: 'success',
				title: pesan
			})
		} else { 
			swalWithBootstrapButtons.fire({
				icon: 'error',
				title: 'Oops...',
				text: pesan,
			})
		}
	}
</script>