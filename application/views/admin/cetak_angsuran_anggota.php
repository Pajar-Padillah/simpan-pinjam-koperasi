<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Angsuran </title>
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

    <h4 align="center" style="margin-top:0px;"><u>BUKTI ANGSURAN</u></h4>
    <b>

    </b>
    <br>
    <h2>Data Angsuran</h2>
    <table id="datatable" class="display table table-striped table-hover" width="100%" cellspacing="0">
        <thead style="text-align: center;">
            <tr>
                <th>NO</th>
                <th>NO ANGSURAN</th>
                <th>JUMLAH</th>
                <th>NILAI</th>
                <th>STATUS</th>
                <!-- <th>Pembayaran</th> -->
                <!-- <th>NO Virtual</th> -->
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php
            $no = 1;
            foreach ($riwayat_angsuran as $a) { ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a->no_angsuran ?></td>
                    <td><?= $a->jumlah_angsuran ?>X</td>
                    <td><?= rupiah($a->nilai) ?></td>
                    <td><?php if ($a->status == 100) { ?>
                            <button type="button" class="btn btn-danger" style="font-size: 10px;">PENDING</button>
                        <?php } elseif ($a->status == 200) { ?>
                            <button type="button" class="btn btn-success" style="font-size: 10px;">SUKSES</button>
                        <?php } elseif ($a->status == 300) { ?>
                            <button type="button" class="btn btn-success" style="font-size: 10px;">DITOLAK</button>
                        <?php } ?>
                    </td>
                    <!-- <td><?php echo ($a->status == '200' ? 'Lunas' : ($a->status == '100' ? 'Lunas' : 'Pending')) ?></td> -->
                    <!-- <td><?= $a->metode_pembayaran ?></td> -->
                    <!-- <td><?= $a->no_virtual ?></td> -->
                </tr>
            <?php } ?>
        </tbody>
    </table>








</body>

</html>