  <style>
      .center {
          text-align: center;
      }
  </style>
  <?php if ($this->session->flashdata('error_nik')) { ?>
      <script>
          Swal.fire({
              title: 'Gagal Tambah Admin!',
              text: 'NIK / Username Sudah Ada!',
              icon: 'error'
          });
      </script>
  <?php } ?>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex align-items-center">
                              <h4 class="card-title"><?= $title ?></h4>
                              <?php if (empty($user)) { ?>
                                  <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#usermodal">
                                      <i class="fa fa-plus"></i>
                                      Tambah Admin
                                  </button>
                              <?php } ?>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>No.</th>
                                          <th>Foto</th>
                                          <th>NIK</th>
                                          <th>Username</th>
                                          <th>Nama</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Telepon</th>
                                          <th>Alamat</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($user as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td>
                                                  <img class="myImgx" src='<?php echo base_url("assets/foto/user/"); ?><?= $a->image ?> ' width="100px" height="100px">
                                              </td>
                                              <td><?= $a->nik ?></td>
                                              <td><?= $a->username ?></td>
                                              <td><?= ucwords($a->full_name) ?></td>
                                              <td><?= ucfirst($a->jenis_kelamin) ?></td>
                                              <td><?= $a->tlp ?></td>
                                              <td><?= $a->alamat ?></td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <button data-target="#edit-apk<?= $a->id_user ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>

                                                      <!-- <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#deluser<?= $a->id_user ?>">
                                                          <i class="fa fa-times"></i>
                                                      </button> -->

                                                  </div>
                                              </td>
                                          </tr>

                                          <div class="modal fade" id="deluser<?= $a->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="addNewDonaturLabel">Hapus Kas</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Anda yakin ingin menghapus <?= $a->username ?></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <a href="<?= base_url('admin/del_admin?id_user=') ?><?= $a->id_user ?>" class="btn btn-primary">Hapus</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

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
  <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header no-bd">
                  <h5 class="modal-title">
                      <span class="fw-mediumbold">
                          User</span>
                      <span class="fw-light">
                          Add
                      </span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                  <form class="admin" method="post" action="<?= base_url('admin/insert_admin'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <input hidden type="text" class="form-control" id="id_user" name="id_user" placeholder="id_user" value="<?= set_value('id_user'); ?>">
                          <input hidden type="text" class="form-control" id="level" name="level" placeholder="level" value="1">
                          <input hidden type="text" class="form-control" id="is_active" name="is_active" placeholder="is_active" value="Y">
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>NIK</label>
                                  <input type="text" minlength="16" maxlength="16" onkeypress="return AngkaOnly(event);" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?= set_value('nik'); ?>">
                                  <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Username</label>
                                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                                  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Full name</label>
                                  <input type="text" onkeypress="return HurufOnly(event);" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?= set_value('full_name'); ?>">
                                  <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Gender</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                          <option value="laki-laki" selected>Laki-laki</option>
                                          <option value="perempuan">Perempuan</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Phone</label>
                                  <input type="text" minlength="11" maxlength="15" onkeypress="return AngkaOnly(event);" class="form-control" id="tlp" name="tlp" placeholder="Phone" value="<?= set_value('tlp'); ?>">
                                  <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Image</label>
                                  <input type="file" class="form-control" id="imagefile" name="imagefile" placeholder="Image" value="<?= set_value('image'); ?>">
                                  <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Alamat</label>
                                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <!-- <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Level</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="level" id="level">
                                          <option value="">Pilih Level</option>
                                          <?php
                                            foreach ($user_level as $level) { ?>
                                              <option value="<?= $level->id_level; ?>"><?= $level->nama_level; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Is Active</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="is_active" id="is_active">
                                          <option value=""></option>
                                          <option value="Y">Y</option>
                                          <option value="N">N</option>
                                      </select>
                                  </div>
                              </div>
                          </div> -->
                      </div>
                      <div class="modal-footer no-bd">
                          <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>
  <div class="modal fade" id="edit-apk<?= $a->id_user ?>" tabindex="-1" role="dialog" aria-hidden="true">
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

                  <form action="<?= base_url('admin/update_admin'); ?>" method="post" enctype="multipart/form-data">
                      <div class="row">
                          <input hidden type="text" class="form-control" id="id_user" name="id_user" placeholder="id_user" value="<?= $a->id_user ?>">
                          <input hidden type="text" class="form-control" id="level" name="level" placeholder="level" value="1">
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>NIK</label>
                                  <input type="text" readonly minlength="16" maxlength="16" onkeypress="return AngkaOnly(event);" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?= $a->nik ?>">
                                  <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Username</label>
                                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $a->username ?>">
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
                                  <input type="text" onkeypress="return HurufOnly(event);" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?= $a->full_name ?>">
                                  <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Gender</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="<?= $a->jenis_kelamin ?>">
                                          <option <?php if ($a->jenis_kelamin == 'laki-laki') {
                                                        echo 'selected';
                                                    } ?>>Laki-laki</option>
                                          <option <?php if ($a->jenis_kelamin == 'perempuan') {
                                                        echo 'selected';
                                                    } ?>>Perempuan</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Phone</label>
                                  <input type="text" minlength="11" maxlength="15" onkeypress="return AngkaOnly(event);" class="form-control" id="tlp" name="tlp" placeholder="Phone" value="<?= $a->tlp ?>">
                                  <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Image</label>
                                  <input type="file" class="form-control" id="imagefile" name="imagefile" placeholder="Image" value="<?= $a->image ?>">
                                  <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Alamat</label>
                                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $a->alamat ?>">
                                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Is Active</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="is_active" id="is_active" value="<?= $a->is_active ?>">
                                          <option <?php if ($a->is_active == 'Y') {
                                                        echo 'selected';
                                                    } ?>>Y</option>
                                          <option <?php if ($a->is_active == 'N') {
                                                        echo 'selected';
                                                    } ?>>N</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <!-- <div class="col-md-6 pr-0 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Level</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="level" id="level">
                                                                                  <option value="<?php $a->id_level ?>" selected="selected"></option>
                                                                                  <?php
                                                                                    foreach ($user_level as $level) { ?>
                                                                                      <option <?= ($level->id_level == $a->id_level ? 'selected=""' : '') ?> value="<?= $level->id_level; ?>"><?= $level->nama_level; ?></option>
                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-6 pr-0 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Is Active</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="is_active" id="is_active" value="<?= $a->is_active ?>">
                                                                                  <option value="<?php $a->is_active ?>" selected="selected"></option>
                                                                                  <option value="Y">Y</option>
                                                                                  <option value="N">N</option>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div> -->
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

  <script type="text/javascript">
      $(document).ready(function() {
          $('#datatable').DataTable();
          document.getElementById('tlp').value = "+62";
      });

      function HurufOnly(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
              return true;
          return false;
      }

      function AngkaOnly(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
          return true;
      }
  </script>