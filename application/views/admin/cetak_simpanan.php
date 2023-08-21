<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Simpanan</title>
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

    <h4 align="center" style="margin-top:0px;"><u>BUKTI SIMPANAN</u></h4>
    <b>

    </b>
    <br>
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead style="text-align: center">
            <tr>
                <th style="text-align: center;">No.</th>
                <th style="text-align: center;">Nama Lengkap</th>
                <th style="text-align: center;">NIK</th>
                <th style="text-align: center;">Jumlah Simpanan</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php
            if (!empty($anggota)) {
                $no = 1;
                foreach ($anggota as $data) {
            ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $no++ ?></td>
                        <td style="text-align: center;"><?php echo $data->full_name ?></td>
                        <td style="text-align: center;"><?php echo $data->nik ?></td>
                        <td style="text-align: center;"><?php echo rupiah($data->jumlah) ?></td>
                        <td style="text-align: center;"><?php echo $data->tanggal_bayar ?></td>
                        <td style="text-align: center;">
                            <?php if ($data->status == 100) { ?>
                                <button type="button" class="btn btn-warning" style="font-size: 10px;">PENDING</button>
                            <?php } elseif ($data->status == 200) { ?>
                                <button type="button" class="btn btn-success" style="font-size: 10px;">SUKSES</button>
                            <?php } elseif ($data->status == 300) { ?>
                                <button type="button" class="btn btn-danger" style="font-size: 10px;">DITOLAK</button>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>




</body>

</html>