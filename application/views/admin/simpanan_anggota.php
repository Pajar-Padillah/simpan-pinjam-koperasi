  <style>
      .center {
          text-align: center;
      }
  </style>
  <?php if ($this->session->flashdata('load_bukti_bayar')) { ?>
      <script>
          Swal.fire({
              title: 'Berhasil!',
              text: 'Tambah simpanan berhasil, Silahkan unduh invoice angsuran dan uploud bukti pembayaran!',
              icon: 'success',
          });
      </script>
  <?php } ?>
  <?php if ($this->session->flashdata('success_uploud')) { ?>
      <script>
          swal({
              title: "Berhasil Uploud!",
              text: "File Bukti Simpanan Berhasil di Uploud! Silahkan menunggu bendahara umum untuk menyetujui angsuran anda!",
              icon: "success"
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

                              <a href="<?= base_url('admin/add_simpanan_anggota') ?>" class="btn btn-success btn-round ml-auto">
                                  <i class="fas fa-plus"></i>
                                  Tambah Simpanan
                              </a>
                              <a href="<?= base_url('admin/cetak_simpanan_anggota') ?>" target="_blank" class="btn btn-danger btn-round" style="text-align: right;">
                                  <i class="fa fa-file-pdf-o"></i>
                                  PDF
                              </a>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>No.</th>
                                          <th>NIK</th>
                                          <th>Jumlah</th>
                                          <th>Tanggal</th>
                                          <th>Invoice</th>
                                          <th>Bukti Bayar</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($simpanan_anggota as $a) { ?>
                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->nik ?></td>
                                              <td><?= rupiah($a->jumlah) ?></td>
                                              <td><?= $a->tanggal_bayar ?></td>
                                              <td>
                                                  <span class="badge badge-primary">
                                                      <a href="<?= base_url('admin/cetak_invoice_simpanan/' . $a->id . '') ?>" style="color: white; font-size: 12px;" class="" target="_blank">
                                                          <i class="fa fa-download"></i>
                                                          Download
                                                      </a>
                                                  </span>
                                              </td>
                                              <td><?php if ($a->bukti_bayar == null) { ?>
                                                      <span class="badge badge-warning">
                                                          <a href="" style="font-size: 12px; color: white;" data-toggle="modal" data-target="#bukti<?= $a->id ?>">
                                                              <i class="fas fa-upload"></i> Upload
                                                          </a>
                                                      </span>
                                                  <?php } elseif ($a->bukti_bayar == !null) { ?>
                                                      <span class="badge badge-info">
                                                          <a href="<?= base_url() ?>assets/foto/bukti/<?= $a->bukti_bayar ?>" style="font-size: 12px; color: white;" target="_blank"><i class="fa fa-eye"></i> Lihat Bukti</a>
                                                      </span>
                                                  <?php } ?>
                                              </td>
                                              <td><?php if ($a->status == 100) { ?>
                                                      <span class="badge badge-warning" style="color: white; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span>
                                                  <?php }
                                                    if ($a->status == 200) { ?>
                                                      <span class="badge badge-success" style="color: white; font-size: 12px;"><i class="fas fa-check"></i> Sukses</span>
                                                  <?php } elseif ($a->status == 300) {  ?>
                                                      <span class="badge badge-danger" style="color: white; font-size: 12px;"><i class="fas fa-times"></i> Ditolak</span>
                                                  <?php }  ?>
                                              </td>
                                              <!-- <td>
                                                  <div class="form-button-action">
                                                      <a href="<?= base_url('admin/cetak_persimpanan/' . $a->id) ?>" class="btn btn-link btn-primary btn-lg"><i class="fa fa-print"></i></a>
                                              </td> -->
                                          </tr>
                                          <div class="modal fade" id="edit-apk<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header no-bd">
                                                          <h5 class="modal-title">
                                                              <span class="fw-mediumbold">
                                                                  Detail </span>
                                                              <span class="fw-light">
                                                                  Simpanan
                                                              </span>
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">

                                                          <form action="<?= base_url('admin/update_simpanan'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                  <input hidden type="text" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $a->nik ?>">
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Jumlah</label>
                                                                          <input type="text" class="form-control jml" id="jumlah" name="jumlah" placeholder="jumlah" value="<?= $a->jumlah ?>">
                                                                          <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">Data yang dihapus tidak akan bisa
                                                          dikembalikan.</div>
                                                      <div class="modal-footer">
                                                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                          <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <?php } ?>
                                  </tbody>
                              </table>
                              <div class="box-header">
                                  <button class="btn btn-success"><b>Total Simpanan Wajib Anda :
                                          <?php if (empty($jml['jumlah'])) { ?>
                                              Rp 0
                                          <?php } else { ?>
                                              <?php echo (rupiah($jml['jumlah'], 2, ',', '.')) ?>
                                          <?php } ?>
                                      </b></button>
                                  <h3 class="label label-success"> </h3>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal Uploud Bukti Bayar -->
  <?php foreach ($simpanan_anggota as $a) { ?>
      <div class="modal fade" id="bukti<?= $a->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Uploud Bukti Pembayaran Simpanan
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <form action="<?= base_url() ?>admin/uploud_bukti_simpanan" method="post" enctype="multipart/form-data">
                          <div class="row">
                              <div class="col-md-12">
                                  <input type="hidden" name="id" value="<?= $a->id ?>" />
                                  <p>Uploud Bukti Pembayaran Simpanan anda disini!</i></b></p>
                                  <div class="form-group">
                                      <label for="exampleFormControlTextarea1">File Bukti</label>
                                      <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar" required>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                              <button type="submit" class="btn btn-success ripple save-category">Simpan</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  <?php } ?>
  <script>
      function deleteConfirm(url) {
          $('#btn-delete').attr('href', url);
          $('#deleteModal').modal();
      }
  </script>

  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>