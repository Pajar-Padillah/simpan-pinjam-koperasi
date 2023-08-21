<style>
    h4 {
        color: white;
    }
</style>
<div class="main-panel">
    <div class="content">
        <br>
        <!-- <button type="button" id="cek_angsuran" class="btn btn-warning">Cek Angsuran</button> -->
        <br>
        <br>
        <div class="row">

            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-body" class="hed">
                        <label for="" class="hed">
                            <h4>NIK:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="nik" name="nik" value="<?= $angsuran->nik ?>" placeholder="NIK">
                        <br>
                        <label for="" class="hed">
                            <h4>NAMA:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="username" name="username" value="<?= $angsuran->full_name ?>" placeholder="USERNAME">
                        <br>
                        <label for="" class="hed">
                            <h4>JUMLAH:</h4>
                        </label>
                        <input hidden type="button" class="btn btn-info" id="jumlah" name="jumlah" value="<?= $angsuran->jumlah ?>" placeholder="JUMLAH">
                        <input type="button" class="btn btn-info" id="j" name="j" value="<?= rupiah($angsuran->jumlah) ?>" placeholder="JUMLAH">
                        <br>
                        <label for="" class="hed">
                            <h4>LAMA:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="lama" name="lama" value="<?= $angsuran->lama ?>X" placeholder="LAMA">
                        <br>
                        <label for="" class="hed">
                            <h4>BUNGA:</h4>
                        </label>
                        <?php
                        #
                        # Menambah 6 Bulan dari Tanggal di PHP by SmartDevTala
                        #
                        $tgl = date('Y-m-d', strtotime('next month'));
                        ?>
                        <input type="button" class="btn btn-info" id="bunga" name="bunga" value="<?= $angsuran->bunga ?>%" placeholder="LAMA"><br>
                        <label for="" class="hed">
                            <h4>Angsuran Berikutnya:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="ang_ber" name="ang_ber" value="<?= $tgl  ?>" placeholder="LAMA">
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card card-info">
                    <div class="card-body" class="hed">
                        <label for="">
                            <h4>TOTAL BUNGA:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="tot_bunga" name="tot_bunga" value="" placeholder="TOTAL BUNGA">
                        <br>
                        <label for="">
                            <h4>ANGSURAN PERBULAN:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="tot_angsuran" name="tot_angsuran" value="" placeholder="TOTAL BUNGA">
                        <br>
                        <label for="">
                            <h4>DIBAYAR:</h4>
                        </label>
                        <?php if (empty($angsuran->total_angsuran)) { ?>
                            <input type="button" class="btn btn-info" id="tot_dibayar" name="tot_dibayar" value="-" placeholder="TOTAL BUNGA">
                        <?php } else { ?>
                            <input type="button" class="btn btn-info" id="tot_dibayar" name="tot_dibayar" value="<?= rupiah($angsuran->total_angsuran) ?>" placeholder="TOTAL BUNGA">
                        <?php } ?>
                        <input hidden type="button" class="btn btn-info" id="tot_dib" name="tot_dib" value="<?= $angsuran->total_angsuran ?>" placeholder="TOTAL BUNGA">
                        <br>
                        <label for="">
                            <h4>HARUS DIBAYAR:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="lunas" name="lunas" value="" placeholder="TOTAL BUNGA"><br> <label for="">
                            <h4>Sisa:</h4>
                        </label>
                        <input type="button" class="btn btn-info" id="sisa" name="sisa" value="" placeholder="TOTAL SISA">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var jumlah_angsuran = $('#jumlah_angsuran').val();
        var jumlah = $('#jumlah').val();
        var bunga = $('#bunga').val();
        var lama = $('#lama').val();
        var s = $('#tot_dib').val();
        var total = parseInt(jumlah) / 100 * parseInt(bunga);
        let nf = new Intl.NumberFormat('en-US');
        var tot = nf.format(total); // "1,234,567,890"
        $("#tot_bunga").val("Rp." + tot);
        var hasil = parseInt(total) / parseInt(lama);
        var hastot = (parseInt(jumlah) / parseInt(lama)) + parseInt(hasil);
        var b2 = Math.ceil(hastot);
        var tot_b2 = nf.format(b2); // "1,234,567,890"
        $("#tot_angsuran").val("Rp." + tot_b2);
        var b1 = Math.ceil(hastot);
        $("#nilai").val(b1);
        var lunas = parseInt(jumlah) + parseInt(total);
        var tot_lunas = nf.format(lunas); // "1,234,567,890"
        $("#lunas").val("Rp." + tot_lunas);
        var sis = parseInt(lunas) - parseInt(s);
        $("#sisa").val("Rp." + nf.format(sis));

        // console.log(sis);

    })
</script>