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
<!-- overlayScrollbars -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ?>"></script>
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
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js' ?>"></script>
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js' ?>"></script>
<!-- DataTables -->
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js' ?>"></script>
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/datatables-responsive/js/dataTables.responsive.min.js' ?>"></script>
<script src="<?php echo $domain.'/_asset/theme_lte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js' ?>"></script>


<script type="text/javascript">

	$('li').find('.active').parents('li').addClass('menu-open');
	$('li').find('.active').parents('li').children('a').addClass('active');

 // var menu_active = $('li').find('.active').text();
 // $('#home-title').html(menu_active);

</script>

<script type="text/javascript">

	$('#modal-data-xl2').on('shown.bs.modal', function() {
		$(document).off('focusin.modal');
	});

	$('#modal-data-xl').on('shown.bs.modal', function() {
		$(document).off('focusin.modal');
	});

	$('#modal-data-lg').on('shown.bs.modal', function() {
		$(document).off('focusin.modal');
	});

	$('#modal-data-md').on('shown.bs.modal', function() {
		$(document).off('focusin.modal');
	});

	$('#modal-data-profil').on('shown.bs.modal', function() {
		$(document).off('focusin.modal');
	});
	
	function print_rujukan(value)
	{ 
		var data = {
			service_name: 'rujukan',
			noKunjungan: value
		}; 

		$.ajax({
			url: base_url+'data_bpjs/print_service',
			type: 'POST',
			data: data,
			dataType:'json',
			success: function(response)
			{
				if(response.eror == 'success')
				{
					window.frames["print_frame"].document.title = document.title;
					window.frames["print_frame"].document.body.innerHTML = response.data;

					setTimeout(function()
					{
						window.frames["print_frame"].window.focus();
						window.frames["print_frame"].window.print();
					}, 300)
				} 
				else notif(response.eror, response.pesan);
			},
			error: function (xhr, ajaxOptions, thrownError) { 
				console.log(xhr.responseText);
			}
		});
	} 

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3500,
		timerProgressBar: true
	});


	function notif(eror, pesan)
	{
		if(eror == 'success')
		{
			Toast.fire({
				icon: 'success',
				title: pesan
			})
		} else if(eror == 'warning')
		{ 
			swalWithBootstrapButtons.fire({
				icon: 'error',
				title: 'Gagal',
				html: pesan
			})
		} 
		else 
		{ 
			swalWithBootstrapButtons.fire({
				icon: 'error',
				title: 'Gagal',
				text: 'tidak ada pesan'
			})
		}
	}

	function proses_loading()
	{
		Swal.fire({
			html: '<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div><h3>Sedang diproses. Mohon Tunggu</h3>',
			showConfirmButton: false,
			allowOutsideClick: false,
			showCancelButton: true,
			cancelButtonText: 'Batal'
		});
	}

	function change_pcare()
	{
		$.ajax({
			url: base_url+'/pengaturan/lihat',
			type: 'POST',
			dataType:'json',
			success: function(response)
			{
				Swal.fire({
					title: 'Ganti Username & Password Pcare',
					html: '<table width="100%"><tr><td width="100px">Username</td><td> : </td><td align="left"><input type="text" class="swal2-input" name="username_pcare" placeholder="username" value="'+response.bpjs_username_pcare+'" style="margin: 5px;"></td></tr><tr><td width="100px">Password</td><td> : </td><td align="left"><input type="text" class="swal2-input" name="password_pcare" value="'+response.bpjs_password_pcare+'" placeholder="password" style="margin: 5px;"></td></tr></table>',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Ganti',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if(result.value){
						var data = {
							username: $('input[name=username_pcare]').val(),
							password: $('input[name=password_pcare]').val()
						};
						$.ajax({
							url: base_url+'/pengaturan/update_pcare',
							type: 'POST',
							data: data,
							dataType:'json',
							success: function(response)
							{  
								if(response.eror == 'success')
								{
									Swal.fire("Update Berhasil!", "", "success");
								} 
								else notif(response.eror, response.pesan);
							},
							error: function (xhr, ajaxOptions, thrownError) { 
								console.log(xhr.responseText);
							}
						}); 
					} 
				})  
			},
			error: function (xhr, ajaxOptions, thrownError) { 
				console.log(xhr.responseText);
			}
		}); 		
	}

	function change_icare()
	{
		$.ajax({
			url: base_url+'/pengaturan/lihat',
			type: 'POST',
			dataType:'json',
			success: function(response)
			{
				$('.modal').modal('hide');

				Swal.fire({
					title: 'Ganti Username & Password ICARE',
					html: '<table width="100%"><tr><td width="100px">Username</td><td> : </td><td align="left"><input type="text" class="swal2-input" name="username_icare" placeholder="username" value="'+response.bpjs_username_icare+'" style="margin: 5px;"></td></tr><tr><td width="100px">Password</td><td> : </td><td align="left"><input type="text" class="swal2-input" name="password_icare" value="'+response.bpjs_password_icare+'" placeholder="password" style="margin: 5px;"></td></tr></table>',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Ganti',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if(result.value){
						var data = {
							username: $('input[name=username_icare]').val(),
							password: $('input[name=password_icare]').val()
						};
						$.ajax({
							url: base_url+'/pengaturan/update_icare',
							type: 'POST',
							data: data,
							dataType:'json',
							success: function(response)
							{  
								if(response.eror == 'success')
								{
									Swal.fire("Update Berhasil!", "", "success");
								} 
								else notif(response.eror, response.pesan);
							},
							error: function (xhr, ajaxOptions, thrownError) { 
								console.log(xhr.responseText);
							}
						}); 
					} 
				})  
			},
			error: function (xhr, ajaxOptions, thrownError) { 
				console.log(xhr.responseText);
			}
		}); 		
	}

</script>