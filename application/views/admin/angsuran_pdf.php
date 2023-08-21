<!DOCTYPE html>
<html>

<head>
    <title>
        Laporan Angsuran
    </title>
    <base href="<?php echo base_url(); ?>" />
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .border-table th {
            border: 1 solid #000;
            font-weight: bold;
            background-color: #e1e1e1;
        }

        .border-table td {
            border: 1 solid #000;
        }
    </style>
</head>

<body>
    <img src="<?= base_url('assets/foto/logo/kpu-logo.png') ?>" style="position: absolute; width: 70px; height: 70px; margin-top: 10px;">
    <img src="<?= base_url('assets/foto/logo/logo1.png') ?>" style="position: absolute; width: 80px; height: auto; float: right; margin-top: 10px;">
    <table style="width: 110%;">
        <tr>
            <td align="center">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%; font-size:14pt;"><strong><span style="font-family:'Times New Roman';">KOMISI PEMILIHAN UMUM KOTA BANDAR LAMPUNG</span></strong></p>
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%;"><span style="font-family:Arial;">Jl. Pulau Sebesi No.90, Sukarame, Bandar Lampung - 35131 Lampung - Indonesia <br>
                        Telp : (0721)-770074, Email : kpubandarlampungkota@gmail.com
                    </span></p>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <p align="center">
        <b>LAPORAN ANGSURAN</b>
    </p>
    <table class="border-table">
        <tr>
            <th style="text-align: center;">NO</th>
            <th>Nama Lengkap</th>
            <th>No Angsuran</th>
            <th>Jumlah Angsuran</th>
            <th>Nilai</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
        <?php $no = 1;
        foreach ($anggota as $data) : ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++ ?></td>
                <td><?php echo $data->full_name ?></td>
                <td><?php echo $data->no_angsuran ?></td>
                <td><?php echo $data->jumlah_angsuran ?>X</td>
                <td><?php echo rupiah($data->nilai) ?></td>
                <td><?php echo $data->tanggal ?></td>
                <td>
                    <?php if ($data->status == 100) { ?>
                        <button type="button" class="btn btn-warning" style="font-size: 10px;">PENDING</button>
                    <?php } elseif ($data->status == 200) { ?>
                        <button type="button" class="btn btn-success" style="font-size: 10px;">SUKSES</button>
                    <?php } elseif ($data->status == 300) { ?>
                        <button type="button" class="btn btn-danger" style="font-size: 10px;">DITOLAK</button>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <?php
    $e = $this->db->query("SELECT full_name FROM tbl_user WHERE id_level = '2'")->row();
    ?>
    <div style="float:right;">
        <br>
        Bandar Lampung, <?= date('d F Y')  ?>
        <br>Ketua Koperasi <br><br><br>
        <p><u><b><?php echo $e->full_name ?></b></u></p>
    </div>
</body>

</html>