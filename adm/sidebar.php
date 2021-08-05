<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?p=home" class="brand-link">
        <img src="logo.png" alt="SI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sistem Administrasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="media.php?p=home" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            &nbsp; Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data SPP
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="media.php?p=spp_konfirmasi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sudah Konfirmasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="media.php?p=belum_konfirmasi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum Konfirmasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Daftar Ulang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="media.php?p=dumasuk" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sudah Konfirmasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="media.php?p=dubelum" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum Konfirmasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>