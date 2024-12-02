<?php ob_start();
// $siswa = json_decode($data->details);
?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/bootstrap.min.css">
<link rel="shortcut icon" href="<?= base_url(''); ?>/favicon/favicon.ico">

<!DOCTYPE html>

<html>

<head>
    <title>BUKTI DAFTAR LAYANAN <?= $data->layanan ?></title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div style="border: 2px  dashed #cbd4dd;">
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
                            <img class="img" src="http://192.168.33.16:8020/generate?data=<?= base_url() ?>/verifiqrcode?token=<?= $data->id ?>" ec="H" style="width: 30mm; background-color: white; color: black;">
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

</body>

</html>
<?php
$html = ob_get_clean();
require_once "require_once(/var/www/vendor/autoload.php)";

$tanggalLnya = date('Y');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('PENDAFTARAN', 'portrait');
$dompdf->render();
$dompdf->stream("DAFTAR_LAYANAN_" . $data->kode_permohonan . ".pdf", array("Attachment" => false));
exit(0);
?>