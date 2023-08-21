<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Angsuran <?= $angsuran->full_name ?></h4>
                                <a href="<?= base_url('admin/list_angsuran') ?>" class="btn btn-primary btn-round ml-auto">
                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                    Kembali
                                </a>
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
                                            <th>Bukti Bayar</th>
                                            <th>Status</th>
                                            <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                                <th>Action</th>
                                            <?php  } ?>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        $no = 1;
                                        foreach ($riwayat_angsuran as $a) { ?>

                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $a->no_angsuran ?></td>
                                                <td><?= $a->jumlah_angsuran ?>X</td>
                                                <td><?= rupiah($a->nilai) ?></td>
                                                <td><?php if ($a->bukti_bayar == null) { ?>
                                                        <span class="badge badge-warning" style="color: white; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span>
                                                    <?php } elseif ($a->bukti_bayar == !null) { ?>
                                                        <span class="badge badge-info">
                                                            <a href="<?= base_url() ?>assets/foto/bukti/<?= $a->bukti_bayar ?>" style="font-size: 12px; color: white;" target="_blank"><i class="fa fa-eye"></i> Lihat Bukti</a>
                                                        </span> <?php } ?>
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
                                                <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                                    <td>
                                                        <?php if ($a->status == "300") { ?>
                                                            <div class="form-button-action">
                                                                <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_angsuran/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        <?php } elseif ($a->status == "100") { ?>
                                                            <div class="form-button-action">
                                                                <button data-target="#accangsuran<?= $a->id ?>" type="button" data-toggle="modal" title="Terima Data" class="btn btn-link btn-info btn-lg" data-original-title="Edit Task">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                                <a href="#tolakangsuran<?= $a->id ?>" data-toggle="modal" class="btn btn-link btn-warning btn-lg"><i class="fa fa-minus"></i></a>
                                                            </div>
                                                        <?php } elseif ($a->status == "200") { ?>
                                                            <div class="form-button-action">
                                                                <a href="<?= base_url('admin/cetak_perangsuran/' . $a->id) ?>" target="_blank" class="btn btn-link btn-primary btn-lg"><i class="fa fa-print"></i></a>
                                                                <div class="form-button-action">
                                                                    <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_angsuran/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                        <?php  } ?>
                                                    </td>
                                                <?php  } ?>
                                            </tr>
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="accangsuran<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Terima Angsuran</span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Terima Data Angsuran ke <?= $a->jumlah_angsuran ?>X ?
                                                            <form action="<?= base_url('admin/acc_angsuran/200'); ?>" method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                    <input type="hidden" name="id_pinjaman" value="<?= $a->id_pinjaman ?>" />
                                                                </div>
                                                                <div class="modal-footer no-bd">
                                                                    <button type="submit" id="addRowButton" class="btn btn-primary">Terima</button>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="tolakangsuran<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Tolak Angsuran</span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tolak Data Angsuran ke <?= $a->jumlah_angsuran ?>X ?
                                                            <form action="<?= base_url('admin/acc_angsuran/300'); ?>" method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                    <input type="hidden" name="id_pinjaman" value="<?= $a->id_pinjaman ?>" />
                                                                </div>
                                                                <div class="modal-footer no-bd">
                                                                    <button type="submit" id="addRowButton" class="btn btn-primary">Tolak</button>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
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
                <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Angsuran</div>
                        </div>
                        <form id="form_spp" name="form_spp" class="angsuran" method="post" action="<?= base_url('admin/insert_angsuran'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <input type="text" hidden class="form-control" id="no_pinjaman" name="no_pinjaman" value="<?= $pinjaman->no_pinjaman ?>" placeholder="Masukan No pinjaman">
                                    <input type="text" hidden class="form-control" id="id_user" name="id_user" value="<?= $pinjaman->id_user ?>" placeholder="Masukan No pinjaman">
                                    <input type="text" hidden class="form-control" id="id_pinjaman" name="id_pinjaman" value="<?= $pinjaman->id ?>" placeholder="Masukan No pinjaman">
                                    <input type="text" hidden class="form-control" id="full_name" value="<?= $pinjaman->full_name ?>" placeholder="Masukan No pinjaman">
                                    <input type="hidden" name="result_type" id="result-type" value="">
                                    <input type="hidden" name="result_data" id="result-data" value="">
                                    <div class="col-md-12 col-lg-12">
                                        <label>Lama</label>
                                        <select class="bootstrap-select strings selectpicker form-control" title="Jumlah Angsuran" name="jumlah_angsuran[]" id="jumlah_angsuran" data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple required>
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
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="nilai" name="nilai" value="" placeholder="Masukan Jumlah" readonly>
                                            <small id="emailHelp2" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <button id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                                <a href="<?= base_url('admin/list_angsuran') ?>" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
<script>
    var lm = $('#la').val();
    for (let i = 1; i <= lm; i++) {
        let data = [i];
        data.forEach(entry => {
            $("select option:contains( " + entry + ")").attr("disabled", "disabled");
        });
    }
</script>
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
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