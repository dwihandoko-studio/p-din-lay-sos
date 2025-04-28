<?php if (isset($data)) {
    if ($data->jumlah_signature > 0) { ?>
        <div class="row justify-content-between">
            <!-- <div class="row justify-content-between align-items-center"> -->
            <!--<div class="col-12 col-md-6 order-2 order-lg-1"><iframe title="Inline Frame Example" width="100%" height="700" src="<?= $url . '#toolbar=0' ?>"></iframe></div>-->

            <div class="col-12 col-md-5 order-1 order-lg-2">
                <h1 class="display-3 mb-3">Dokumen Ini Memiliki Tanda Tangan Digital.</h1>

                <div class="mt-4">
                    <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> <?= $data->notes ?></p>
                    <?= ($data->details[0]->info_signer->cert_user_certified) ? '<p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Identitas Penandatangan Terverifikasi.</p>' : '<p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-times-circle mr-2"></i> Identitas Penandatangan Tidak Terverifikasi.</p>' ?>
                    <?= ($data->details[0]->signature_document->signed_in == null || $data->details[0]->signature_document->signed_in == "") ? '<p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-times-circle mr-2"></i> Dokumen Ini Tidak Memiliki Stempel Waktu.</p>' : '<p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Dokumen Ini Memiliki Stempel Waktu.</p>' ?>
                    <?= ($data->details[0]->signature_document->signed_using_tsa) ? '<p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Dokumen Ini Mendukung LTV.</p>' : '<p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-times-circle mr-2"></i> Dokumen Ini Tidak Mendukung LTV.</p>' ?>
                </div>

                <div class="mt-4">
                    <hr>

                    <table width="100%">
                        <tr>
                            <td width="40%" style="font-weight:bold;">Ditandatangani Oleh</td>
                            <td width="5%" style="font-weight:bold;">: </td>
                            <td width="55%" style="font-weight:bold;"><?= ($data->details[0]->info_signer->signer_name) ? $data->details[0]->info_signer->signer_name : '-' ?></td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight:bold;">Lokasi</td>
                            <td width="5%" style="font-weight:bold;">: </td>
                            <td width="55%" style="font-weight:bold;"><?= ($data->details[0]->signature_document->location) ? $data->details[0]->signature_document->location : '-' ?></td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight:bold;">Reason</td>
                            <td width="5%" style="font-weight:bold;">: </td>
                            <td width="55%" style="font-weight:bold;"><?= ($data->details[0]->signature_document->reason) ? $data->details[0]->signature_document->reason : '-' ?></td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight:bold;">Ditandatangani Pada</td>
                            <td width="5%" style="font-weight:bold;">: </td>
                            <td width="55%" style="font-weight:bold;"><?= ($data->details[0]->signature_document->signed_in) ? $data->details[0]->signature_document->signed_in : '-' ?> (lokal)</td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight:bold;">Timestamp</td>
                            <td width="5%" style="font-weight:bold;">: </td>
                            <td width="55%">
                                <span style="font-weight:bold;"><?= ($data->details[0]->signature_document->signed_in) ? $data->details[0]->signature_document->signed_in : '-' ?></span> (TSA) <br>
                                <span style="font-weight:bold; font-size:0.75em">Ketepatan Waktu</span> <br>
                                <span style="font-size:0.75em">detik, milidetik, mikrodetik</span> <br>
                                <span style="font-weight:bold; font-size:0.75em">Diterbitkan Oleh</span> <br>
                                <span class="badge badge-sm badge-primary ml-2">OSD LU Kelas Dua</span> <span class="badge badge-sm badge-primary ml-2">Lembaga Sandi Negara</span> <span class="badge badge-sm badge-primary ml-2">ID</span> <br>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="mt-4">
                    <hr>

                    <h1 class="display-3 mb-3">Sertifikasi</h1>

                    <div class="bd-example">

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h5 class="mb-0">Sertifikasi #1</h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="mt-4">
                                            <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Sertifikat Terpercaya.</p>
                                            <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Sertifikat Tidak Dicabut.</p>
                                            <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Sertifikat Masih Berlaku.</p>
                                        </div>

                                        <div class="mt-4">
                                            <hr>

                                            <table width="100%">
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Serial</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold;">6D23A5B861C67FA8</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Validitas</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em; color:#2ecc71">18-08-2016 12:05 - 18-08-2026 12:05 <i class="fas fa-check-circle mr-2"></i></td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Subject</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">CN=OSD LU Kelas 2,O=Lembaga Sandi Negara,C=ID <br> <span class="badge badge-sm badge-primary ml-2">Self Sign</span></td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Issuer</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">CN=OSD LU Kelas 2,O=Lembaga Sandi Negara,C=ID</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Public Key</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">RSA (2048 bits)</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Algoritma TTD</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">SHA256WITHRSA</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">SHA-1 Fingerprint</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">57:04:D8:81:CE:95:DB:D7:E4:8C:1D:D8:4E:9D:66:9B:95:59:48:A7</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <h5 class="mb-0">Sertifikasi #2</h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="mt-4">
                                            <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Sertifikat Terpercaya.</p>
                                            <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Sertifikat Tidak Dicabut.</p>
                                            <p style="font-weight:bold; color:#2ecc71; "><i class="fas fa-check-circle mr-2"></i> Sertifikat Masih Berlaku.</p>
                                        </div>

                                        <div class="mt-4">
                                            <hr>

                                            <table width="100%">
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Serial</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold;">6D23A5B861C67FA8</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Validitas</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em; color:#2ecc71">18-08-2016 12:05 - 18-08-2026 12:05 <i class="fas fa-check-circle mr-2"></i></td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Subject</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">CN=OSD LU Kelas 2,O=Lembaga Sandi Negara,C=ID <br> <span class="badge badge-sm badge-primary ml-2">Self Sign</span></td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Issuer</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">CN=OSD LU Kelas 2,O=Lembaga Sandi Negara,C=ID</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Public Key</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">RSA (2048 bits)</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">Algoritma TTD</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">SHA256WITHRSA</td>
                                                </tr>
                                                <tr>
                                                    <td width="25%" style="font-weight:bold;">SHA-1 Fingerprint</td>
                                                    <td width="5%" style="font-weight:bold;">: </td>
                                                    <td width="70%" style="font-weight:bold; font-size:0.75em;">57:04:D8:81:CE:95:DB:D7:E4:8C:1D:D8:4E:9D:66:9B:95:59:48:A7</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    <?php } else { ?>
<?php }
}
