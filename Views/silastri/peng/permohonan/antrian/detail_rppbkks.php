<?php if (isset($data)) { ?>
    <div class="modal-body">
        <div class="row">
            <h4>DATA PEMOHON</h4>
            <div class="col-lg-6">
                <label class="col-form-label">Nama Lengkap:</label>
                <input type="text" class="form-control" value="<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">NIK:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nik" aria-label="NIK" value="<?= $data->nik ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">KK:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="kk" aria-label="KK" value="<?= $data->kk ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Tempat Lahir:</label>
                <input type="text" class="form-control" value="<?= $data->tempat_lahir ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Tanggal Lahir:</label>
                <input type="text" class="form-control" value="<?= $data->tgl_lahir ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jenis Kelamin:</label>
                <div><?php switch ($data->jenis_kelamin) {
                            case 'P':
                                echo '<span class="badge badge-pill badge-soft-primary">Perempuan</span>';
                                break;
                            case 'L':
                                echo '<span class="badge badge-pill badge-soft-primary">Laki-Laki</span>';
                                break;
                            default:
                                echo '-';
                                break;
                        } ?>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Email:</label>
                <input type="text" class="form-control" value="<?= $data->email ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">No Handphone:</label>
                <input type="text" class="form-control" value="<?= $data->no_hp ?>" readonly />
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <h4>DATA PERMOHONAN</h4>
            <div class="col-lg-6">
                <label class="col-form-label">Kode Permohonan:</label>
                <input type="text" class="form-control" value="<?= $data->kode_permohonan ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Layanan:</label>
                <input type="text" class="form-control" value="<?= $data->layanan ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jenis:</label>
                <textarea rows="3" class="form-control" readonly><?= getJenisSubLayanan($data->layanan, $data->jenis) ?></textarea>
            </div>
            <?php if (isset($data->field_tambahan)) {
                $dataDecJson = json_decode($data->field_tambahan);
            ?>
                <div class="col-lg-6">
                    <label class="col-form-label">Nama Lengkap:</label>
                    <input type="text" class="form-control" value="<?= $dataDecJson->nama_pemohon ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">NIK:</label>
                    <input type="text" class="form-control" value="<?= $dataDecJson->nik_pemohon ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">KK:</label>
                    <input type="text" class="form-control" value="<?= $dataDecJson->kk_pemohon ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">Tempat Lahir:</label>
                    <input type="text" class="form-control" value="<?= $dataDecJson->tempat_lahir_pemohon ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">Tanggal Lahir:</label>
                    <input type="text" class="form-control" value="<?= $dataDecJson->tgl_lahir_pemohon ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">Alamat:</label>
                    <input type="text" class="form-control" value="<?= $dataDecJson->alamat_pemohon ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">Kecamatan:</label>
                    <input type="text" class="form-control" value="<?= getNamaKecamatan($dataDecJson->kecamatan_pemohon) ?>" readonly />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label">Kelurahan:</label>
                    <input type="text" class="form-control" value="<?= getNamaKelurahan($dataDecJson->kelurahan_pemohon) ?>" readonly />
                </div>
                <?php if ($dataDecJson->identitas_ahli_waris == "beda") { ?>
                    <div class="col-lg-6">
                        <label class="col-form-label">Nama Lengkap Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->nama_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">NIK Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->nik_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">KK Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->kk_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Tempat Lahir Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->tempat_lahir_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Tanggal Lahir Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->tgl_lahir_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Alamat Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->alamat_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Kecamatan Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= getNamaKecamatan($dataDecJson->kecamatan_ahli_waris) ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Kelurahan Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= getNamaKelurahan($dataDecJson->kelurahan_ahli_waris) ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Hubungan Ahli Waris:</label>
                        <input type="text" class="form-control" value="<?= $dataDecJson->hubungan_ahli_waris ?>" readonly />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label">Keterangan:</label>
                        <input type="text" class="form-control" value="<?= isset($dataDecJson->keterangan) ? $dataDecJson->keterangan : "-" ?>" readonly />
                    </div>
                <?php } ?>
            <?php } ?>
            <?php if (isset($data->lampiran_ktp)) { ?>
                <div class="col-lg-12 mt-2">
                    <label class="col-form-label">Lampiran Dokumen:</label>
                    <br />
                    <?php if (isset($data->lampiran_ktp)) { ?>
                        <?php if ($data->lampiran_ktp === null || $data->lampiran_ktp === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_ktp ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_ktp ?>" id="nik">
                                KTP
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_kk)) { ?>
                        <?php if ($data->lampiran_kk === null || $data->lampiran_kk === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_kk ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_kk ?>" id="nik">
                                Kartu Keluarga
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_pernyataan)) { ?>
                        <?php if ($data->lampiran_pernyataan === null || $data->lampiran_pernyataan === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_pernyataan ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_pernyataan ?>" id="nik">
                                Screenshoot DTKS
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_foto_rumah)) { ?>
                        <?php if ($data->lampiran_foto_rumah === null || $data->lampiran_foto_rumah === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_foto_rumah ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads') . '/' . strtolower($data->layanan) . '/' . $data->lampiran_foto_rumah ?>" id="nik">
                                Surat Keterangan
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
        <a href="<?= base_url('silastri/peng/permohonan/antrian/printPdf') . '?id=' . $data->id ?>" target="_blank" class="btn btn-primary waves-effect">Download / Print</a>
    </div>
<?php } ?>