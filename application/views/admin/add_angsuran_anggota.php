<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<?php if ($this->session->flashdata('error_input')) { ?>
    <script>
        swal({
            title: "Gagal Uploud!",
            text: "File Bukti Gagal di Uploud!",
            icon: "error"
        });
    </script>
<?php } ?>
<?php if ($this->session->flashdata('error_angsuran')) { ?>
    <script>
        swal({
            title: "Gagal Tambah Angsuran!",
            text: "Angsuran Sudah Ada!",
            icon: "error"
        });
    </script>
<?php } ?>
<?php if ($this->session->flashdata('success_uploud')) { ?>
    <script>
        swal({
            title: "Berhasil Uploud!",
            text: "File Bukti Angsuran Berhasil di Uploud! Silahkan menunggu bendahara umum untuk menyetujui angsuran anda!",
            icon: "success"
        });
    </script>
<?php } ?>
<?php if ($this->session->flashdata('load_bukti_bayar')) { ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Tambah angsuran berhasil, Silahkan unduh invoice angsuran dan uploud bukti pembayaran!',
            icon: 'success',
        });
    </script>
<?php } ?>
<div class="main-panel" style="height: 800px;">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Angsuran <?= $pinjaman->full_name ?></h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>No. Angsuran</th>
                                            <th>Jumlah</th>
                                            <th>Nilai</th>
                                            <th>Invoice</th>
                                            <th>Bukti Bayar</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center">
                                        <?php
                                        $no = 1;
                                        foreach ($riwayat_angsuran as $a) { ?>

                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $a->no_angsuran ?></td>
                                                <td><?= $a->jumlah_angsuran ?>X</td>
                                                <td><?= rupiah($a->nilai) ?></td>
                                                <td>
                                                    <span class="badge badge-primary">
                                                        <a href="<?= base_url('admin/cetak_invoice_angsuran/' . $a->id . '') ?>" style="color: white; font-size: 12px;" class="" target="_blank">
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
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= base_url('admin/cetak_perangsuran/' . $a->id) ?>" target="_blank" class="btn btn-link btn-primary btn-lg"><i class="fa fa-print"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?
                                                            </h5>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Angsuran</div>
                        </div>
                        <form id="payment-form" method="post" action="<?= base_url() ?>admin/insert_angsuran_anggota" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="text" hidden class="form-control" id="no_pinjaman" name="no_pinjaman" value="<?= $pinjaman->no_pinjaman ?>" placeholder="Masukan No pinjaman">
                                    <input type="text" hidden class="form-control" id="id_user" name="id_user" value="<?= $pinjaman->id_user ?>" placeholder="Masukan No pinjaman">
                                    <input type="text" hidden class="form-control" id="id_pinjaman" name="id_pinjaman" value="<?= $pinjaman->id ?>" placeholder="Masukan No pinjaman">
                                    <input type="text" hidden class="form-control" id="full_name" value="<?= $pinjaman->full_name ?>" placeholder="Masukan No Angsuran">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <label>Lama Angsuran</label>
                                <select class="bootstrap-select strings selectpicker form-control" title="Angsuran ke" name="jumlah_angsuran" id="jumlah_angsuran" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" required>
                                    <?php
                                    for ($i = 1; $i <= $parm_lama['lama']; $i++) { ?>
                                        <option value=" <?php echo $i ?>"> <?php echo $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="text" hidden class="form-control" id="la" name="la" value="<?= $jum_lama['total'] ?>" placeholder="Masukan No pinjaman">
                            <input type="text" hidden class="form-control" id="jumlah" name="jumlah" value="<?= $pinjaman->jumlah ?>" placeholder="Masukan No pinjaman">
                            <input type="text" hidden class="form-control" id="bunga" name="bunga" value="<?= $pinjaman->bunga ?>" placeholder="Masukan No pinjaman">
                            <input type="text" hidden class="form-control" id="lama" name="lama" value="<?= $pinjaman->lama ?>" placeholder="Masukan No pinjaman">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="jumlah">Angsuran Perbulan</label>
                                    <input type="number" class="form-control" id="nilai" name="nilai" value="" placeholder="" readonly>
                                    <small id="emailHelp2" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="card-action">
                                <button id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                                <a href="<?= base_url('admin/angsuran_anggota') ?>" class="btn btn-danger">Kembali</a>
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
<!-- Modal Uploud Bukti Bayar -->
<?php foreach ($riwayat_angsuran as $a) { ?>
    <div class="modal fade" id="bukti<?= $a->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Uploud Bukti Pembayaran Angsuran
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?= base_url() ?>admin/uploud_bukti_angsuran" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" value="<?= $a->id ?>" />
                                <input type="hidden" name="id_pinjaman" value="<?= $a->id_pinjaman ?>" />
                                <p>Uploud Bukti Pembayaran Angsuran ke <?= $a->jumlah_angsuran ?> anda disini!</i></b></p>
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

<!-- <script>
    var lm = $('#la').val();
    for (let i = 1; i <= lm; i++) {
        let data = [i];
        data.forEach(entry => {
            $("select option:contains( " + entry + ")").attr("disabled", "disabled");
        });
    }
</script> -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
<script>
    $(document).ready(function() {
        $('#jumlah_angsuran').change(function() {
            var jumlah_angsuran = $('#jumlah_angsuran').val();
            var jumlah = $('#jumlah').val();
            var bunga = $('#bunga').val();
            var lama = $('#lama').val();
            var total = parseInt(jumlah) / 100 * parseInt(bunga);
            var hasil = parseInt(total) / parseInt(lama)
            var hastot = (parseInt(jumlah) / parseInt(lama)) + parseInt(hasil)
            var b1 = Math.ceil(hastot);
            $("#nilai").val(b1);
        })
    })
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>