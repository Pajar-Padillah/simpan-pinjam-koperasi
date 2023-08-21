<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Invoice Simpanan</title>
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <style>
        table {
            border-collapse: collapse;
        }

        thead>tr {
            background-color: #0070C0;
            color: #f1f1f1;
        }

        thead>tr>th {
            background-color: #0070C0;
            color: #fff;
            padding: 10px;
            border-color: #fff;
        }

        th,
        td {
            padding: 2px;
        }

        th {
            color: #222;
        }

        body {
            font-family: Calibri;
        }
    </style>
</head>

<body onload="window.print();">
    <?php
    $id = $this->session->userdata['id_user'];
    $d = $this->db->query("SELECT * FROM tbl_user WHERE id_user = '$id'")->row();
    ?>


    <h4 align="center" style="margin-top:0px;"><u>INVOICE SIMPANAN</u></h4>
    <b>

    </b>
    <br>
    <h2>Data Simpanan</h2>
    <?php
    $no = 0;
    foreach ($simpanan_anggota as $a) :
        $no++;
        $jml = $a->jumlah;
    ?>
        <table>
            <h3><b>KEPADA</b></h3>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= ucwords($d->full_name); ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $d->nik; ?></td>
            </tr>
        </table>
        <br><br>
        <p>Pembayaran dilakukan dengan cara mentransfer biaya ke rekening berikut :</p>
        <table>
            <tr>
                <td>No. Rekening</td>
                <td>:</td>
                <td>5794 0100 8443 503</td>
            </tr>
            <tr>
                <td>Bank</td>
                <td>:</td>
                <td>BRI</td>
            </tr>
            <tr>
                <td>Atas Nama</td>
                <td>:</td>
                <td>Koperasi KPU Bandar Lampung</td>
            </tr>
            <tr>
                <td>Jumlah Bayar</td>
                <td>:</td>
                <td><?= rupiah($jml); ?></td>
            </tr>
        </table>
    <?php endforeach; ?>
</body>

</html>