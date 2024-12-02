<!DOCTYPE html>

<html>

<head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="<?= base_url(''); ?>/favicon/favicon.ico">
    <title>BUKTI DAFTAR LAYANAN <?= $data->layanan ?></title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            margin: 20px;
        }
    </style>
    <script type="text/javascript">
        function printpage() {
            window.print();
        }
    </script>
</head>

<body topmargin="0" leftmargin="0" onload="printpage()">
    <div style=" border: 2px dashed #cbd4dd;">
        <div style="max-width: 100%; padding-top: 12px; padding-bottom: 5px; padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tr>
                    <td colspan="5" width="10%" style="border:none;">
                        <img class="img" src="<?= base_url('favicon/android-icon-144x144.png') ?>" ec="H" style="width: 30mm; background-color: white; color: black;">
                    </td>
                    <td style="text-align: center;">
                        <span style="margin-top: 8px; font-size: 20px;">KARTU TANDA DAFTAR LAYANAN</span><br>
                        <span style="margin-top: 8px; font-size: 18px;">DINAS SOSIAL</span><br>
                        <span style="margin-top: 8px; font-size: 18px;">KABUPATEN LAMPUNG TENGAH</span><br>
                        <span style="margin-top: 8px; font-size: 16;">PROVINSI LAMPUNG</span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- kolom atas -->
        <div style="max-width: 100%; padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tbody>
                    <tr>
                        <td width="35%" align="" style="padding-left: 10px;">Kode Permohonan</td>
                        <td width="5%" align="center">:</td>
                        <td width="60%" align="left"><?= $data->kode_permohonan ?></td>
                        <td rowspan="7" style="border: none" width="10%">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Nama Lengkap</td>
                        <td align="center">:</td>
                        <td align="left"><?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">NIK</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->nik ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Tempat Lahir</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->tempat_lahir ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Tanggal Lahir</td>
                        <td align="center">:</td>
                        <td align="left"><?= tgl_indo2($data->tgl_lahir) ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Jenis Kelamin</td>
                        <td align="center">:</td>
                        <td align="left"><?= ($data->jenis_kelamin == 'L') ? "Laki-Laki" : "Perempuan"; ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">No Handphone</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->no_hp ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Email</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->email ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="max-width: 100%; padding-top: 5px; padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tbody>
                    <tr>
                        <td colspan="5" align="left">&nbsp;&nbsp;&nbsp;<b>Daftar Layanan</b></td>
                        <td rowspan="6" style="border: none" width="10%">
                            <img class="img" src="http://192.168.33.16:8020/generate?data=<?= base_url() ?>/verifiqrcode?token=<?= $data->id ?>" ec="H" style="width: 25mm; background-color: white; color: black;">
                        </td>
                    </tr>
                    <tr>
                        <td width="5%"></td>
                        <td width="30%" align="">Kode Permohonan</td>
                        <td width="5%" align="center">:</td>
                        <td width="60%" align="left">
                            <span class="badge badge-info"><?= $data->kode_permohonan ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="">Nama Layanan</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->layanan ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="">Jenis Layanan</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->jenis ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>