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
                              <a class="btn btn-primary btn-round ml-auto" href="<?= base_url('admin/list_angsuran') ?>">
                                  <i class="fa fa-plus"></i>
                                  Add Angsuran
                              </a>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>NO</th>
                                          <th>NIK</th>
                                          <th>NAMA</th>
                                          <th>NO PEMINJAM</th>
                                          <th>NO ANGSURAN</th>
                                          <th>JUMLAH PINJAMAN</th>
                                          <th>TANGGAL</th>
                                          <th>LAMA</th>
                                          <th>BUNGA</th>
                                          <th>JUMLAH ANGSURAN</th>
                                          <th>ACTION</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($angsuran as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->nik ?></td>
                                              <td><?= $a->full_name ?></td>
                                              <td><?= $a->no_pinjaman ?></td>
                                              <td><?= $a->no_angsuran ?></td>

                                              <td><?= rupiah($a->jumlah) ?></td>
                                              <td><?= $a->tanggal ?></td>
                                              <td><?= $a->lama ?>X</td>
                                              <td><?= $a->bunga ?>%</td>
                                              <td><?= rupiah($a->jumlah_angsuran) ?></td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <a href="<?= base_url('admin/edit_angsuran/') ?><?= $a->id ?>" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </a>
                                                      <a type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#deluser<?= $a->id_user ?>">
                                                          <i class="fa fa-times"></i>
                                                      </a>
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
  <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header no-bd">
                  <h5 class="modal-title">
                      <span class="fw-mediumbold">
                          Anggota</span>
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
                  <form class="pegawai" method="post" action="<?= base_url('admin/insert_pegawai'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <input hidden type="text" class="form-control" id="id_user" name="id_user" placeholder="id_user" value="<?= set_value('id_user'); ?>">
                          <input hidden type="text" class="form-control" id="level" name="level" placeholder="level" value="3">
                          <input hidden type="text" class="form-control" id="is_active" name="is_active" placeholder="is_active" value="Y">
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Nik</label>
                                  <input type="text" class="form-control" id="nik" name="nik" placeholder="Nik" value="<?= set_value('nik'); ?>">
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
                                  <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?= set_value('full_name'); ?>">
                                  <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Telpon</label>
                                  <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Telpon" value="<?= set_value('tlp'); ?>">
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

  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>