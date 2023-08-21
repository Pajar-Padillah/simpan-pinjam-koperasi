<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Data Pinjaman </title>
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

    <h4 align="center" style="margin-top:0px;"><u>Pinjaman</u></h4>
    <b>

    </b>
    <br>
    <h2>Data Pinjaman</h2>
    <table id="datatable" class="display table table-striped table-hover" width="100%" cellspacing="0">
        <thead style="text-align: center;">
            <tr>
                <th>NO</th>
                <th>IMAGE</th>
                <th>NIK</th>
                <th>FULL NAME</th>
                <th>NO PINJAMAN</th>
                <th>JUMLAH</th>
                <th>TANGGAL</th>
                <th>LAMA</th>
                <th>BUNGA</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php
            $no = 1;
            foreach ($cetak_all_pinjaman as $a) { ?>

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
                            <button type="button" class="btn btn-info">DI TERIMA</button>
                        <?php } elseif ($a->status == "T") { ?>
                            <button type="button" class="btn btn-danger">DI TOLAK</button>
                        <?php } elseif ($a->status == "N") { ?>
                            <button type="button" class="btn btn-warning">MENUNGGU</button>
                        <?php  } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>