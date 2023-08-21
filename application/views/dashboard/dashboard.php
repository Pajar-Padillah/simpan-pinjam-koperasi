<?php
$ang = $this->Mod_aplikasi->tot_anggota()->row_array();
$pgw = $this->Mod_aplikasi->tot_pegawai()->row_array();
$adm = $this->Mod_aplikasi->tot_admin()->row_array();
$sim = $this->Mod_aplikasi->tot_simpanan()->row_array();
$angsur = $this->Mod_aplikasi->tot_angsuran()->row_array();

$angsur_anggota = $this->Mod_aplikasi->tot_angsuran_ang($this->session->userdata['id_user'])->row_array();
$simpanan_anggota = $this->Mod_aplikasi->tot_simpanan_ang($this->session->userdata['id_user'])->row_array();
// dead($ang);
?>
<?php if ($this->session->userdata['id_level'] == 1) { ?>

    <div class="main-panel">
        <div class="content">
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-secondary bg-info">
                        <div class="card-body ">
                            <?php if (empty($ang['total_ang'])) { ?>
                                <h1>0</h1>
                            <?php } else { ?>
                                <h1><?= $ang['total_ang'] ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Anggota</h5>
                            <div class="pull-right">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body ">
                            <?php if (empty($pgw['total_pgw'])) { ?>
                                <h1>0</h1>
                            <?php } else { ?>
                                <h1><?= $pgw['total_pgw'] ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Ketua</h5>
                            <div class="pull-right">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($adm['total_adm'])) { ?>
                                <h1>0</h1>
                            <?php } else { ?>
                                <h1><?= $adm['total_adm'] ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Admin</h5>
                            <div class="pull-right">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($sim['total_simpanan'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($sim['total_simpanan']) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Simpanan</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($angsur['total_angsuran'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($angsur['total_angsuran']) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Angsuran</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($angsur['total_angsuran'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($angsur['total_angsuran'] / 500 * 100) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Laba</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } elseif ($this->session->userdata['id_level'] == 3) { ?>
    <div class="main-panel">
        <div class="content">
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($angsur_anggota['total_angsuran_ang'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($angsur_anggota['total_angsuran_ang']) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Angsuran</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($simpanan_anggota['total_simpanan_ang'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($simpanan_anggota['total_simpanan_ang']) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Simpanan</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } elseif ($this->session->userdata['id_level'] == 2) { ?>
    <div class="main-panel">
        <div class="content">
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-secondary bg-info">
                        <div class="card-body ">
                            <?php if (empty($ang['total_ang'])) { ?>
                                <h1>0</h1>
                            <?php } else { ?>
                                <h1><?= $ang['total_ang'] ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Anggota</h5>
                            <div class="pull-right">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body ">
                            <?php if (empty($pgw['total_pgw'])) { ?>
                                <h1>0</h1>
                            <?php } else { ?>
                                <h1><?= $pgw['total_pgw'] ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Ketua</h5>
                            <div class="pull-right">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($sim['total_simpanan'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($sim['total_simpanan']) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Simpanan</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-info">
                        <div class="card-body curves-shadow">
                            <?php if (empty($angsur['total_angsuran'])) { ?>
                                <h1>Rp 0</h1>
                            <?php } else { ?>
                                <h1><?= rupiah($angsur['total_angsuran']) ?></h1>
                            <?php } ?>
                            <h5 class="op-8">Total Angsuran</h5>
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>