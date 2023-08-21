<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary">PROFIL PENGGUNA</h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div>
        <br>
        <br>
        <!-- row untuk jadi satu baris card -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 ">
                <div class="card shadow-lg border-info mb-3" style="max-width: 100%;">
                    <div class="row no-gutters">
                        <div class="col-md-4 ">
                            <img src=<?= base_url('assets/foto/user/') . $tbl_user['image']; ?> class="card-img " alt="profile">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align:center; color:blue"><b>PROFIL SAYA</b></h5> <br>
                                <p class="card-text">NIK : <?= $tbl_user['nik']; ?></p>
                                <p class="card-text">Nama : <?= ucwords($tbl_user['full_name']); ?></p>
                                <p class="card-text">Username : <?= $tbl_user['username']; ?></p>
                                <p class="card-text">Alamat : <?= $tbl_user['alamat']; ?></p>
                                <p class="card-text">Jenis Kelamin : <?= ucfirst($tbl_user['jenis_kelamin']); ?></p>
                                <p class="card-text">No HP : <?= $tbl_user['tlp']; ?></p>
                                <!-- <p class="card-text"><small class="text-muted">Member sejak <?= date('d F Y', $tbl_user['data_created']); ?> </small></p> -->
                            </div>
                            <!-- <a href="<?= base_url('profil/edit'); ?>" class="btn btn-sm btn-info float-right mr-2"><i class="fas fa-user-edit"> Edit Profil </i></a> -->

                            <!-- <?php echo anchor('profil/dtl_anggota/' . $tbl_user['id_user'], '<input type=reset class="btn btn-info float-right mr-3 mb-3" value=\'Info\'>'); ?> -->
                            <a href="#edit-profil<?= $tbl_user['id_user'] ?>" style="color:black;" data-toggle="modal" class="btn btn-sm btn-info float-right mr-2 mb-2"><i class="fas fa-user-edit"></i> Edit Profil</a>

                            <a href="<?= base_url('dashboard') ?>" style="color:black;" class="btn btn-sm btn-danger float-right mr-2 mb-2">
                                <i class="fas fa-arrow-alt-circle-right"></i> Kembali</a>

                            <div class="modal fade" id="edit-profil<?= $tbl_user['id_user'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    Edit</span>
                                                <span class="fw-light">
                                                    User
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="<?= base_url('profil/edit'); ?>" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <input hidden type="text" class="form-control" id="id_user" name="id_user" placeholder="id_user" value="<?= $tbl_user['id_user'] ?>">
                                                    <input hidden type="text" class="form-control" id="is_active" name="is_active" placeholder="is_active" value="<?= $tbl_user['is_active'] ?>">
                                                    <?php if ($this->session->userdata['id_level'] == 1) { ?>
                                                        <input hidden type="text" class="form-control" id="level" name="level" placeholder="level" value="1">
                                                    <?php }
                                                    if ($this->session->userdata['id_level'] == 2) { ?>
                                                        <input hidden type="text" class="form-control" id="level" name="level" placeholder="level" value="2">
                                                    <?php }
                                                    if ($this->session->userdata['id_level'] == 3) { ?>
                                                        <input hidden type="text" class="form-control" id="level" name="level" placeholder="level" value="3">
                                                    <?php } ?>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>NIK</label>
                                                            <input type="text" readonly minlength="16" maxlength="16" onkeypress="return AngkaOnly(event);" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?= $tbl_user['nik'] ?>">
                                                            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $tbl_user['username'] ?>">
                                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Full name</label>
                                                            <input type="text" onkeypress="return HurufOnly(event);" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?= $tbl_user['full_name'] ?>">
                                                            <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0 ">
                                                        <div class="form-group form-group-default">
                                                            <label>Gender</label>
                                                            <div class="col-sm-12 kosong">
                                                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="<?= $tbl_user['jenis_kelamin'] ?>">
                                                                    <option <?php if ($tbl_user['jenis_kelamin'] == 'laki-laki') {
                                                                                echo 'selected';
                                                                            } ?>>Laki-laki</option>
                                                                    <option <?php if ($tbl_user['jenis_kelamin'] == 'perempuan') {
                                                                                echo 'selected';
                                                                            } ?>>Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input type="text" minlength="11" maxlength="13" onkeypress="return AngkaOnly(event);" class="form-control" id="tlp" name="tlp" placeholder="Phone" value="<?= $tbl_user['tlp'] ?>">
                                                            <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Image</label>
                                                            <input type="file" class="form-control" id="imagefile" name="imagefile" placeholder="Image" value="<?= $tbl_user['image'] ?>">
                                                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Alamat</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $tbl_user['alamat'] ?>">
                                                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- /.end raw card -->

    </div>
    <!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->