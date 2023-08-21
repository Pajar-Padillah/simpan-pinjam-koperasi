<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Simpanan</div>
                    </div>
                    <form id="payment-form" method="post" action="<?= base_url('admin/insert_simpanan_anggota'); ?>">
                        <div class="card-body">
                            <div class="row">
                                <input hidden type="number" class="form-control" id="id_user" name="id_user" placeholder="Masukan nik" value="<?= $user['id_user'] ?>">
                                <input hidden type="number" class="form-control" id="nik" name="nik" placeholder="Masukan nik" value="<?= $user['nik'] ?>">
                                <input hidden type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukan full_name" value="<?= $user['full_name'] ?>">
                                <input hidden type="text" class="form-control" id="tlp" name="tlp" placeholder="Masukan tlp" value="<?= $user['tlp'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">

                                <input hidden type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jml" name="jml" placeholder="Masukan Jumlah" value="" onkeyup="nilairupiah(this.value)">
                            </div>
                        </div>

                        <div class="card-action">
                            <button id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                            <a href="<?= base_url('admin/simpanan_anggota') ?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    </div>
</div>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

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
        $('#jumlah').val(hasil);
    }
</script>