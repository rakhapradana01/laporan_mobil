<aside class="main-sidebar sidebar-dark-primary elevation-6">

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->

            <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <hr>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                    <div class="sidebar-brand-icon">
                        <img src="<?= BASE_URL ?>/img/aps.jpg" alt="" width="70" height="70">
                    </div>
                    <div class="sidebar-brand-text mx-3">APS RESERVASI</div>
                </a>
                <hr>
                <!-- Divider -->
                <!-- <hr class="sidebar-divider my-0"> -->
                <!-- <hr> -->

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/view/dashboard.php?page=<?= $_SESSION['fk_role'] ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <!-- Divider -->
                <!-- <hr class="sidebar-divider"> -->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-car"></i>
                        <span>Data Mobil</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= BASE_URL ?>/view/mobil/mobil.php">List Mobil</a>
                        </div>
                    </div>
                </li>
                <!-- <hr class="sidebar-divider"> -->
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Reservasi</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">RESERVASI</h6>
                            <a class="collapse-item" href="<?= BASE_URL ?>/view/reservasi/reservasi.php">List Reservasi</a>
                            <a class="collapse-item" href="<?= BASE_URL ?>/view/reservasi/addReserv.php">Tambah Reservasi</a>
                        </div>
                </li>
                
                <!-- <hr class="sidebar-divider"> -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTiga" aria-expanded="true" aria-controls="collapseTiga">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Perbaikan</span>
                    </a>
                    <div id="collapseTiga" class="collapse" aria-labelledby="headingTiga" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= BASE_URL ?>/view/perbaikan/perbaikan.php">List perbaikan</a>
                            <!-- <a class="collapse-item" href="addPerbaikan.php">Tambah Perbaikan</a> -->
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                if ($_SESSION['fk_role'] == 'admin') {
                    echo '
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelayakan" aria-expanded="true" aria-controls="collapseKelayakan">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Kelayakan</span>
                    </a>
                    <div id="collapseKelayakan" class="collapse" aria-labelledby="headingTiga" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="' . BASE_URL . '/view/kelayakan/kelayakan.php">List Kelayakan</a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseService" aria-expanded="true" aria-controls="collapseService">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Service</span>
                    </a>
                    <div id="collapseService" class="collapse" aria-labelledby="headingTiga" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="' . BASE_URL . '/view/service/service.php">service</a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAsuransi" aria-expanded="true" aria-controls="collapseAsuransi">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Asuransi</span>
                    </a>
                    <div id="collapseAsuransi" class="collapse" aria-labelledby="headingTiga" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="' . BASE_URL . '/view/asuransi/asuransi.php">List asuransi</a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePajak" aria-expanded="true" aria-controls="collapsePajak">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Pajak</span>
                    </a>
                    <div id="collapsePajak" class="collapse" aria-labelledby="headingTiga" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="' . BASE_URL . '/view/pajak/pajak.php">pajak</a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            </div>
                        </div>
                    </div>
                </li>';
                } else {
                    echo '';
                }
                ?>
                <!-- Divider -->
                <!-- <hr class="sidebar-divider"> -->
                <!-- Nav Item - Pages Collapse Menu -->
                <?php
                if ($_SESSION['fk_role'] == 'admin') {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                        aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Manajemen User</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Management User</h6>
                            <a class="collapse-item" href="' . BASE_URL . '/view/devisi/devisi.php">Data Devisi</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/pegawai/pegawai.php">Data Pegawai</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/user/user.php">Role</a>
                </li>';
                } else {
                    echo '';
                }
                ?>
                <?php
                if ($_SESSION['fk_role'] == 'admin') {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true"
                        aria-controls="collapsePages2">
                        <i class="fas fa-fw fa-file-pdf"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Laporan filter</h6>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanAsuransi.php">Laporan Asuransi</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanreserv.php">Laporan Reservasi</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanMobil.php">Laporan Mobil</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanperbaikan.php">Laporan Perbaikan</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanPajak.php">Laporan Pajak</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanKelayakan.php">Laporan Kelayakan</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanPegawai.php">Laporan Pegawai</a>
                            <a class="collapse-item" href="' . BASE_URL . '/view/laporan/laporanService.php">Laporan Service</a>
                </li>';
                } else {
                    echo '';
                }
                ?>


                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>