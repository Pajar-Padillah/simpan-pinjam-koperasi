<div class="main-panel">

    <div class="content">
        <div class="page-inner">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ajukan Pinjaman</div>
                    </div>
                    <form class="simpanan" method="post" action="<?= base_url('admin/insert_ajukan_pinjaman'); ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                <input type="number" hidden class="form-control" id="id_user" name="id_user" placeholder="" value="<?= $id_user['id_user'] ?>">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                                        <small id="emailHelp2" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Lama Pinjaman</label>

                                        <select class="form-control" name="lama" id="lama">
                                            <option disabled selected value>Pilih Lama Pinjaman</option>
                                            <option value="6">6X</option>
                                            <option value="10">10X</option>
                                            <option value="12">12X</option>
                                            <option value="18">18X</option>
                                            <option value="24">24X</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            <a href="<?= base_url('admin/pinjaman_anggota') ?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>