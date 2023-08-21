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
                            <div class="ml-auto">
                                <?php if ($this->session->userdata['id_level'] == 3) { ?>
                                    <button class="btn btn-primary btn-round " data-toggle="modal" data-target="#pinjaman">
                                        <i class="fa fa-plus"></i>
                                        Add Pinjaman
                                    </button>
                                <?php }
                                if ($this->session->userdata['id_level'] == 2) { ?>
                                    <a href="<?= base_url('admin/cetak_all_pinjaman') ?>" target="_blank" class="btn btn-danger btn-round" style="text-align: right;">
                                        <i class="fa fa-file-pdf-o"></i>
                                        PDF
                                    </a>
                                <?php } ?>
                            </div>
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
                                        <th>Nama</th>
                                        <th>No. Pinjaman</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Lama</th>
                                        <th>Bunga</th>
                                        <th>Status</th>
                                        <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($pinjaman as $a) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <img class="myImgx" src='<?php echo base_url("assets/foto/user/"); ?><?= $a->image ?> ' width="100px" height="100px">
                                            </td>
                                            <td><?= $a->nik ?></td>

                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->no_pinjaman ?></td>
                                            <td><?= rupiah($a->jumlah) ?></td>
                                            <td><?= $a->tanggal ?></td>
                                            <td><?= $a->lama ?>X</td>
                                            <td><?= $a->bunga ?>%</td>
                                            <td><?php if ($a->status == "Y") { ?>
                                                    <span class="badge badge-success" style="color: white; font-size: 12px;"><i class="fas fa-check"></i> Diterima</span>
                                                <?php } elseif ($a->status == "T") { ?>
                                                    <a href="#alasan<?= $a->id ?>" data-toggle="modal"> <span class="badge badge-danger" style="color: white; font-size: 12px;"><i class="fas fa-times"></i> Ditolak</span>
                                                    </a>
                                                <?php } elseif ($a->status == "N") { ?>
                                                    <span class="badge badge-warning" style="color: white; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span>
                                                <?php  } ?>
                                            </td>
                                            <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                                <td>
                                                    <?php if ($a->status == "T") { ?>
                                                        <div class="form-button-action">
                                                            <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                                                <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_pinjaman/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } elseif ($a->status == "N") { ?>
                                                        <div class="form-button-action">
                                                            <button data-target="#terima-pinjaman<?= $a->id ?>" type="button" data-toggle="modal" title="Terima Data" class="btn btn-link btn-info btn-lg" data-original-title="Edit Task">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                            <button data-target="#tolak-pinjaman<?= $a->id ?>" type="button" data-toggle="modal" title="Tolak Data" class="btn btn-link btn-warning btn-lg" data-original-title="Edit Task">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <!-- <a href="" onclick="tolakconfirm('<?php echo site_url('admin/tolak_pinjaman/' . $a->id) ?>')" class="btn btn-link btn-warning btn-lg"><i class="fa fa-minus"></i></a> -->
                                                        </div>
                                                    <?php } elseif ($a->status == "Y") { ?>
                                                        <div class="form-button-action">
                                                            <a href="<?= base_url('admin/cetak_pinjaman/' . $a->id) ?>" target="_blank" class="btn btn-link btn-danger btn-lg" style="text-align: right;">
                                                                <i class="fa fa-file-pdf-o"></i>
                                                            </a>
                                                            <div class="form-button-action">
                                                                <?php if ($this->session->userdata['id_level'] == 2) { ?>
                                                                    <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_pinjaman/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php  } ?>
                                                </td>
                                            <?php } ?>

                                        </tr>
                                        <div class="modal fade" id="edit-pinjaman<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Edit</span>
                                                            <span class="fw-light">
                                                                Anggota
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('admin/update_pinjaman'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama</label>
                                                                        <div class="col-sm-12 kosong">
                                                                            <select class="form-control" name="id_user" id="id_user">
                                                                                <option value="">Pilih Nama</option>
                                                                                <?php
                                                                                foreach ($nama as $nm) { ?>
                                                                                    <option <?= ($nm->id_user == $a->id_user ? 'selected=""' : '') ?> value="<?= $nm->id_user; ?>">
                                                                                        <?= $nm->full_name; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>No Pinjaman</label>
                                                                        <input type="text" class="form-control" id="no_pinjaman" name="no_pinjaman" placeholder="No Pinjaman" value="<?= $a->no_pinjaman ?>">
                                                                        <?= form_error('no_pinjaman', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 ">
                                                                    <div class="form-group form-group-default">
                                                                        <input type="number" class="form-control jumlahadd" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="">
                                                                        <label>Jumlah</label>
                                                                        <input type="number" class="form-control" onkeyup="nilairupiah(this.value)" id="jml" name="jml" placeholder="Masukan Jumlah" value="<?= $a->jumlah ?>" readonly>
                                                                        <?= form_error('Masukan jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 pr-0 ">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Lama Pinjaman</label>
                                                                        <div class="col-sm-12 kosong">
                                                                            <select class="form-control" name="lama" id="lama">
                                                                                <option value="">Pilih Lama Pinjaman
                                                                                </option>
                                                                                <?php
                                                                                foreach ($lama as $nm) { ?>
                                                                                    <option <?= ($nm == $a->lama ? 'selected=""' : '') ?> value="<?= $nm; ?>"><?= $nm; ?>X
                                                                                    </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Bunga Pinjaman</label>
                                                                        <input type="number" class="form-control" id="bunga" name="bunga" placeholder="Bunga" value="<?= $a->bunga ?>">
                                                                        <?= form_error('bunga', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                                    <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="alasan<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  no-bd">
                                                        <h5 class="modal-title">Alasan Pinjaman Ditolak</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group form-group-default">
                                                                    <label><b>ALASAN</b> </label>
                                                                    <p><?= ucfirst($a->alasan) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="terima-pinjaman<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Terima</span>
                                                            <span class="fw-light">
                                                                Pinjaman
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('admin/terima_pinjaman'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Bunga Pinjaman</label>
                                                                        <input type="number" class="form-control" id="bunga" name="bunga" placeholder="Bunga" value="<?= $a->bunga ?>">
                                                                        <?= form_error('bunga', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>
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
                                        <div class="modal fade" id="tolak-pinjaman<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Tolak Pinjaman</span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('admin/tolak_pinjaman'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Alasan Tolak Pinjaman</label>
                                                                        <textarea name="alasan" rows="2" class="form-control" required="required"></textarea>
                                                                    </div>
                                                                </div>
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
        </div>
    </div>
</div>
<div class="modal fade" id="pinjaman" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Pinjaman</span>
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
                <form class="pinjaman" method="post" action="<?= base_url('admin/insert_pinjaman'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <div class="col-sm-12 kosong">
                                    <select class="form-control" name="id_user" id="id_user">
                                        <option value="">Pilih Nama</option>
                                        <?php
                                        foreach ($nama as $nm) { ?>
                                            <option value="<?= $nm->id_user; ?>"><?= $nm->full_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group form-group-default">
                                <input hidden type="text" class="form-control jumlahadd" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" onkeyup="nilairupiah(this.value)" id="jml" name="jml" placeholder="Masukan Jumlah" value="<?= set_value('jml'); ?>">
                                <?= form_error('Masukan jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0 ">
                            <div class="form-group form-group-default">
                                <label>Lama Pinjaman</label>
                                <div class="col-sm-12 kosong">
                                    <select class="form-control" name="lama" id="lama">
                                        <option value=""></option>
                                        <option value="6">6X</option>
                                        <option value="10">10X</option>
                                        <option value="12">12X</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                <label>Bunga Pinjaman</label>
                                <input type="number" class="form-control" id="bunga" name="bunga" placeholder="Bunga" value="<?= set_value('bunga'); ?>">
                                <?= form_error('bunga', '<small class="text-danger pl-3">', '</small>'); ?>
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
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function tolakconfirm(url) {
        $('#btn-tolak').attr('href', url);
        $('#tolakmodal').modal();
    }
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<script type="text/javascript">
    var rupiah = document.getElementById('jml');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
    }
</script>
<script>
    function nilairupiah(nilai) {
        // var explode = nilai.split(" ");
        var hasil = parseInt(nilai.replace(/,.*|[^0-9]/g, ''), 10);
        // console.log(hasil);
        $('.jumlahadd').val(hasil);
    }
</script>