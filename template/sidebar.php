<section id="sidebar">
		<a href="<?= BASE_URL ?>/view/dashboard.php?page=<?= $_SESSION['fk_role'] ?>" class="brand">
			<!-- <i class='bx bxs-smile'></i> -->
            <img src="<?= BASE_URL ?>/img/aps.jpg" alt="" width="60" height="60" style="margin-top:5px;">
			<span class="text" style="margin: auto;width: 70%;"> APS RESERVASI</span>
		</a>

		<ul class="side-menu top">
			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/dashboard.php?page=<?= $_SESSION['fk_role'] ?>">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            
			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'mobil.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addmobil.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updatemobil.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/mobil/mobil.php">
					<i class='bx bxs-car' ></i>
					<span class="text">Data Mobil</span>
				</a>
			</li>

			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'reservasi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addReserv.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updateReserv.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/reservasi/reservasi.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Data Reservasi</span>
				</a>
			</li>

			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'pinjam.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addPinjam.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updatePinjam.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/pinjam/pinjam.php">
					<i class='bx bxs-log-out' ></i>
					<span class="text">Data Pinjam</span>
				</a>
			</li>

			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'kembali.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addKembali.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updateKembali.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/kembali/kembali.php">
					<i class='bx bxs-log-in' ></i>
					<span class="text">Data Kembali</span>
				</a>
			</li>

			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'perbaikan.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addperbaikan.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updateperbaikan.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/perbaikan/perbaikan.php">
					<i class='bx bxs-key ' ></i>
					<span class="text">Data Perbaikan</span>
				</a>
			</li>

			<?php if ($_SESSION['fk_role'] == 'admin') { ?>

			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'kelayakan.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addKelayakan.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updateKelayakan.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/kelayakan/kelayakan.php">
					<i class='bx bxs-badge-check' ></i>
					<span class="text">Data Kelayakan</span>
				</a>
			</li>
			
			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'service.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addservice.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updateservice.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/service/service.php">
					<i class='bx bxs-car-mechanic' ></i>
					<span class="text">Data Service</span>
				</a>
			</li>
			
			
			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'asuransi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addasuransi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updateasuransi.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/asuransi/asuransi.php">
					<i class='bx bxs-ambulance' ></i>
					<span class="text">Data Asuransi</span>
				</a>
			</li>
			
			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'pajak.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addpajak.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updatepajak.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/pajak/pajak.php">
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">Data Pajak</span>
				</a>
			</li>
			
			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'manajemen_user.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'devisi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'adddevisi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updatedevisi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'pegawai.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'addpegawai.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'updatepegawai.php' ? 'active' : ''; ?>">
                <a href="<?= BASE_URL ?>/view/manajemen_user.php">
					<i class='bx bxs-user-pin' ></i>
					<span class="text">Manajemen User</span>
				</a>
			</li>
			

			<li class="<?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>  || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanMobil.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanreserv.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanperbaikan.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanKelayakan.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanAsuransi.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanPajak.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanService.php' ? 'active' : ''; ?> || <?php echo basename($_SERVER['PHP_SELF']) == 'laporanPegawai.php' ? 'active' : ''; ?>">
				<a href="<?= BASE_URL ?>/view/laporan.php">
					<i class='bx bxs-spreadsheet' ></i>
					<span class="text">Laporan</span>
				</a>
			</li>

			<?php } ?>
			<!-- <li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li> -->
		</ul>
		<ul class="side-menu">
			<!-- <li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li> -->
			<li>
				<a href="#" class="logout" data-toggle="modal" data-target="#logoutModal">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>