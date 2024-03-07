<aside id="sidebar-left" class="sidebar-left">
    
    <div class="sidebar-header">

        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="nav-active">
                        <a href="index.php?page=home">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-cubes" aria-hidden="true"></i>
                            <span>Project</span>
                        </a>
                        <ul class="nav nav-children ">
                            <li>
                                <a href="index.php?page=project_baru">
                                        Add Project
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=project_active">
                                        Project List
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=project_list">
                                        Search Project
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li class="nav-parent <?php if ($_GET['page'] == "icon" || $_GET['page'] == "icon"): ?>nav-expanded <?php endif ?>">
                        <a>
                            <i class="fa fa-dropbox" aria-hidden="true"></i>
                            <span>ICON PLUS</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="index.php?page=serpo">
                                       SERPO
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=Iconnet">
                                        Iconnet
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav">
                        <a href="index.php?page=Telkom Akses">
                            <i class="fa fa-codepen" aria-hidden="true"></i>
                            <span>Telkom Akses</span>
                        </a>
                        
                    </li>
                    <li class="nav-parent <?php if ($_GET['page'] == "task_add" || $_GET['page'] == "activity_add"): ?>nav-expanded <?php endif ?>">
                        <a>
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Pengeluaran Project</span>
                        </a>
                        <ul class="nav nav-children">
                            
                            <li>
                                <a href="index.php?page=pengeluaran">
                                        Pengeluaran Project
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=serpo_exp">
                                        Pengeluaran Serpo
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=iconnet_exp">
                                        Pengeluaran Iconnet
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=telkomakses_exp">
                                        Pengeluaran Telkom Akses
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav <?php if ($_GET['page'] == "penjualan"): ?>nav-expanded <?php endif ?>">
                        <a href="index.php?page=penjualan">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-parent <?php if (in_array('report', explode('_', $_GET['page']))): ?>nav-expanded <?php endif ?>">
                        <a>
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="index.php?page=report_list&type=material">
                                        Material
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=report_list&type=tools">
                                        Peralatan
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=report_list&type=ops">
                                        Operasional
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=report_list&type=others">
                                        Lain-lain
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-parent <?php if (strpos(str_replace('_', ' ', $_GET['page']),'user') !== false): ?>nav-expanded <?php endif ?>">
                        <a>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Pengguna</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="./index.php?page=user_baru">
                                        Tambah User
                                </a>
                            </li>
                            <li>
                                <a href="./index.php?page=users_list">
                                        Daftar Pengguna
                                </a>
                            </li>
                        </ul>
                    </li>


                </ul>
            </nav>

            <hr class="separator" />

        </div>

    </div>

</aside>