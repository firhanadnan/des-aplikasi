        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="noprint">
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a class="has-arrow" href="./" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <?php
                        if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3){ ?>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Aktifitas Surat</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="?page=tsm">Surat masuk</a></li>
                                <li><a href="?page=tsk">Surat Keluar</a></li>
                            </ul>
                        <?php
                            }
                        ?>    
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-email-open-outline"></i><span class="hide-menu">Agenda Surat</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="?page=asm">Surat masuk</a></li>
                                <li><a href="?page=ask">Surat Keluar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-folder-image"></i><span class="hide-menu">Galeri Surat</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="?page=gsm">Surat masuk</a></li>
                                <li><a href="?page=gsk">Surat Keluar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=ref" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">Klasifikasi Surat</span></a>
                        </li>
                        <?php
                            if($_SESSION['admin'] == 1){ ?>
                                <li>
                                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Pengaturan</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="?page=sett&sub=usr">User</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="?page=sett&sub=back">Backup Database</a></li>
                                        <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                                    </ul>
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
    </div>