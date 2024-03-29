<div id="layoutAuthentication_footer">
	<footer class="py-4 bg-dark mt-auto text-white">
		<div class="container-fluid px-4">
			<div class="d-flex align-items-center justify-content-center small">
				<div>Copyright &copy; My Infly Networks 2022 <b>V 1.1</b></div>
			</div>
		</div>
	</footer>
</div>
</div>

<!-- SweetAlert 2 -->
<script src="<?php echo base_url(); ?>vendor/SweetAlert2/sweetalert2.all.min.js"></script>

<script>
	const switchPendataan = document.getElementById('switch-pendataan');

	const loginUrl = "https://leces.inflydata.net/";
	const barangUrl = "https://intranetleces.inflydata.net/";

	// const loginUrl = "/payment_leces"; // URL relatif ke form login
	// const barangUrl = "/intranet_leces"; // URL relatif ke form barang

	// Periksa apakah URL saat ini adalah "/C_FormBarang"
	if (window.location.pathname === barangUrl) {
		switchPendataan.checked = true; // Mengaktifkan tombol switch
	}

	switchPendataan.addEventListener('change', function() {
		if (this.checked) {
			// Arahkan ke form barang jika switch aktif (on)
			window.location.href = barangUrl;
		} else {
			// Arahkan ke form login jika switch nonaktif (off)
			window.location.href = loginUrl;
		}
	});
</script>



<!-- Alert Gagal -->
<script>
	<?php if ($this->session->flashdata('LoginGagal_icon')) { ?>
		var toastMixin = Swal.mixin({
			toast: true,
			icon: 'success',
			title: 'General Title',
			animation: false,
			position: 'top-right',
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

		toastMixin.fire({
			title: '<?php echo $this->session->flashdata('LoginGagal_title') ?>',
			icon: '<?php echo $this->session->flashdata('LoginGagal_icon') ?>'
		});

	<?php } ?>
</script>

<!-- Login Terlebih Dahulu -->
<script>
	<?php if ($this->session->flashdata('BelumLogin_icon')) { ?>
		var toastMixin = Swal.mixin({
			toast: true,
			icon: 'success',
			title: 'General Title',
			animation: false,
			position: 'top-right',
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

		toastMixin.fire({
			title: '<?php echo $this->session->flashdata('BelumLogin_title') ?>',
			icon: '<?php echo $this->session->flashdata('BelumLogin_icon') ?>'
		});

	<?php } ?>
</script>

<!-- Alert Login -->
<script>
	<?php if ($this->session->flashdata('CheckMikrotik_icon')) { ?>
		Swal.fire("<?php echo $this->session->flashdata('CheckMikrotik_title') ?>", "<?php echo $this->session->flashdata('CheckMikrotik_text') ?>", "<?php echo $this->session->flashdata('CheckMikrotik_icon') ?>");
	<?php } ?>
</script>

<!-- Alert Duplicate Name (Tambah Data) -->
<script>
	<?php if ($this->session->flashdata('Daerah_icon')) { ?>
		Swal.fire(
			"<?php echo $this->session->flashdata('Daerah_title') ?>",
			"<?php echo $this->session->flashdata('Daerah_text') ?>",
			"<?php echo $this->session->flashdata('Daerah_icon') ?>");
	<?php } ?>
</script>

</body>

</html>