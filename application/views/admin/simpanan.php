<style>
    .center {
        text-align: center;
    }
</style>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"><?= $title ?></h4>
                            <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                <a href="<?= base_url('admin/print_allsimpanan') ?>" target="_blank" class="btn btn-primary btn-round ml-auto">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Cetak
                                </a> <?php } ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($anggota as $a) { ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <img class="myImgx" src='<?php echo base_url("assets/foto/user/"); ?><?= $a->image ?> ' width="100px" height="100px">
                                            </td>
                                            <td><?= $a->nik ?></td>

                                            <td><?= ucwords($a->full_name) ?></td>
                                            <td><?= ucfirst($a->jenis_kelamin) ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <span class="badge badge-success">
                                                        <?php if ($this->session->userdata['id_level'] == 1) { ?>
                                                            <a href="<?= base_url('admin/detail_simpanan/' . $a->id_user . '') ?>" style="font-size: 12px; color: white;">
                                                                <i class="fas fa-eye"></i> Lihat Simpanan
                                                            </a>
                                                        <?php }
                                                        if ($this->session->userdata['id_level'] == 2) {  ?>
                                                            <a href="<?= base_url('admin/detail_simpanan/' . $a->id_user . '') ?>" style="font-size: 12px; color: white;">
                                                                <i class="fas fa-edit"></i> Kelola Simpanan
                                                            </a>
                                                        <?php } ?>

                                                    </span>
                                                    <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                                        <span class="badge badge-primary">
                                                            <a href="<?= base_url('admin/print_simpanan/' . $a->id_user . '') ?>" style="font-size: 12px; color: white;" target="_blank">
                                                                <i class="fas fa-print"></i> Cetak
                                                            </a>
                                                        </span>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>