<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header bg-info" style="font-size: 30px;">

        <a href="<?= base_url('dashboard') ?>" class="logo">
            <img src="<?php echo base_url(); ?>assets/foto/logo/logo1.png" alt="navbar brand" style="height: 20px;" class="navbar-brand">
            <span class="brand-text font-weight-light" style="font-weight: 999!important; color: white;">Koperasi</span>
        </a>

        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header bg-info navbar-expand-lg">

        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <?php
                    $id = $this->session->userdata['id_user'];
                    $d = $this->db->query("SELECT * FROM tbl_user WHERE id_user = '$id'")->row();
                    ?>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $d->image; ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $d->image; ?>" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <?php if ($this->session->userdata['id_level'] == 1) { ?>
                                            <h4><?php echo ucwords($d->full_name); ?> - <b>Admin</b></h4>
                                        <?php }
                                        if ($this->session->userdata['id_level'] == 2) { ?>
                                            <h4><?php echo ucwords($d->full_name); ?> - <b>Pegawai</b></h4>
                                        <?php }
                                        if ($this->session->userdata['id_level'] == 3) { ?>
                                            <h4><?php echo ucwords($d->full_name); ?> - <b>Anggota</b></h4>
                                        <?php } ?>
                                        <a href="<?= base_url('profil/') ?>" class="btn btn-xs btn-secondary btn-sm mt-2">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" style="text-align:center" data-toggle="modal" href="#logout"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Modal Logout -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><b>Logout</b></h4>
            </div>
            <div class="modal-body">
                Yakin ingin logout ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a class="btn btn-danger" href="<?= base_url('login/logout'); ?>">Ya</a>
            </div>
        </div>
    </div>
</div>