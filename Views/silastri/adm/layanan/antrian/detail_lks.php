<?php if (isset($data)) { ?>
    <div class="modal-body">
        <div class="row">
            <h2>DATA PEMOHON</h2>
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
            <h2>DATA PERMOHONAN</h2>
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

            <?php if (isset($data->lampiran_ktp)) { ?>
                <div class="col-lg-12 mt-2">
                    <label class="col-form-label">Lampiran Dokumen:</label>
                    <br />
                    <?php if (isset($data->lampiran_ktp)) { ?>
                        <?php if ($data->lampiran_ktp === null || $data->lampiran_ktp === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/sktm') . '/' . $data->lampiran_ktp ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/sktm') . '/' . $data->lampiran_ktp ?>" id="nik">
                                KTP
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_kk)) { ?>
                        <?php if ($data->lampiran_kk === null || $data->lampiran_kk === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/sktm') . '/' . $data->lampiran_kk ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/sktm') . '/' . $data->lampiran_kk ?>" id="nik">
                                Kartu Keluarga
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_pernyataan)) { ?>
                        <?php if ($data->lampiran_pernyataan === null || $data->lampiran_pernyataan === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/sktm') . '/' . $data->lampiran_pernyataan ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/sktm') . '/' . $data->lampiran_pernyataan ?>" id="nik">
                                Pernyataan
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_foto_rumah)) { ?>
                        <?php if ($data->lampiran_foto_rumah === null || $data->lampiran_foto_rumah === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/sktm') . '/' . $data->lampiran_foto_rumah ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/sktm') . '/' . $data->lampiran_foto_rumah ?>" id="nik">
                                Foto Rumah
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <hr />
        <div class="row mt-2">
            <h2>DATA LKS / LKSA</h2>
            <div class="col-lg-6">
                <label class="col-form-label">Nama Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nama_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jenis Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->jenis_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Tanggal Berdiri Lembaga:</label>
                <input type="text" class="form-control" value="<?= tgl_indo($lks->tgl_berdiri_lembaga) ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Nama Notaris Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nama_notaris_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Nomor Akta Notaris Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nomor_notaris_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Nomor Kemenkumham Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nomor_kemenkumham_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Akreditasi Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->akreditasi_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Nomor Akreditasi Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nomor_surat_akreditasi_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">NPWP Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->npwp_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Modal Usaha Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->modal_usaha_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Status Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->status_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Lingkup Wilayah Kerja Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->lingkup_wilayah_kerja_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Bidang Kegiatan Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->bidang_kegiatan_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">No Telepon Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->no_telp_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Email Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->email_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Koordinat Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->lat_long_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Alamat Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->alamat_lembaga ?>" readonly />
            </div>
            <div class="col-lg-3">
                <label class="col-form-label">RT Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->rt_lembaga ?>" readonly />
            </div>
            <div class="col-lg-3">
                <label class="col-form-label">RW Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->rw_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kelurahan Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->rw_lembaga ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kecamatan Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->rw_lembaga ?>" readonly />
            </div>
            <h4>DATA PENGURUS</h4>
            <div class="col-lg-4">
                <label class="col-form-label">Nama Ketua Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nama_ketua_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">NIK Ketua Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nik_ketua_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">No HP Ketua Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nohp_ketua_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">Nama Sekretaris Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nama_sekretaris_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">NIK Sekretaris Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nik_sekretaris_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">No HP Sekretaris Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nohp_sekretaris_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">Nama Bendahara Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nama_bendahara_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">NIK Bendahara Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nik_bendahara_pengurus ?>" readonly />
            </div>
            <div class="col-lg-4">
                <label class="col-form-label">No HP Bendahara Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->nohp_bendahara_pengurus ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jumlah Pengurus Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->jumlah_pengurus ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jumlah Binaan Dalam Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->jumlah_binaan_dalam ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jumlah Binaan Luar Lembaga:</label>
                <input type="text" class="form-control" value="<?= $lks->jumlah_binaan_luar ?>" readonly />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12 mt-2">
                <label class="col-form-label">Lampiran Dokumen Lembaga:</label>
                <br />
                <?php if (isset($lks->lampiran_ktp_ketua)) { ?>
                    <?php if ($lks->lampiran_ktp_ketua === null || $lks->lampiran_ktp_ketua === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_ketua ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_ketua ?>" id="nik">
                            KTP Ketua
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_ktp_sekretaris)) { ?>
                    <?php if ($lks->lampiran_ktp_sekretaris === null || $lks->lampiran_ktp_sekretaris === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_sekretaris ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_sekretaris ?>" id="nik">
                            KTP Sekretaris
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_ktp_bendahara)) { ?>
                    <?php if ($lks->lampiran_ktp_bendahara === null || $lks->lampiran_ktp_bendahara === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_bendahara ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_bendahara ?>" id="nik">
                            KTP Bendahara
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_akta_notaris)) { ?>
                    <?php if ($lks->lampiran_akta_notaris === null || $lks->lampiran_akta_notaris === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_akta_notaris ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_akta_notaris ?>" id="nik">
                            Akta Notaris
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_kemenkumham)) { ?>
                    <?php if ($lks->lampiran_kemenkumham === null || $lks->lampiran_kemenkumham === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_kemenkumham ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_kemenkumham ?>" id="nik">
                            Kemenkumham
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_adrt)) { ?>
                    <?php if ($lks->lampiran_adrt === null || $lks->lampiran_adrt === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_adrt ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_adrt ?>" id="nik">
                            ADRT
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_domisili)) { ?>
                    <?php if ($lks->lampiran_domisili === null || $lks->lampiran_domisili === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_domisili ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_domisili ?>" id="nik">
                            Domisili
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_akreditasi)) { ?>
                    <?php if ($lks->lampiran_akreditasi === null || $lks->lampiran_akreditasi === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_akreditasi ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_akreditasi ?>" id="nik">
                            Akreditasi
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_struktur_organisasi)) { ?>
                    <?php if ($lks->lampiran_struktur_organisasi === null || $lks->lampiran_struktur_organisasi === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_struktur_organisasi ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_struktur_organisasi ?>" id="nik">
                            Struktur Organisasi
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_npwp)) { ?>
                    <?php if ($lks->lampiran_npwp === null || $lks->lampiran_npwp === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_npwp ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_npwp ?>" id="nik">
                            NPWP
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_foto_lokasi)) { ?>
                    <?php if ($lks->lampiran_foto_lokasi === null || $lks->lampiran_foto_lokasi === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_lokasi ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_lokasi ?>" id="nik">
                            Foto Lokasi
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_foto_usaha)) { ?>
                    <?php if ($lks->lampiran_foto_usaha === null || $lks->lampiran_foto_usaha === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_usaha ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_usaha ?>" id="nik">
                            Foto Usaha
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_logo)) { ?>
                    <?php if ($lks->lampiran_logo === null || $lks->lampiran_logo === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_logo ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_logo ?>" id="nik">
                            Logo Lembaga
                        </a>
                    <?php } ?>
                <?php } ?>
                <?php if (isset($lks->lampiran_data_binaan)) { ?>
                    <?php if ($lks->lampiran_data_binaan === null || $lks->lampiran_data_binaan === "") { ?>
                    <?php } else { ?>
                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_data_binaan ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_data_binaan ?>" id="nik">
                            Data Binaan
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="actionTolak(this)" class="btn btn-danger waves-effect waves-light">Tolak Permohonan</button>
            <button type="button" onclick="actionApprove(this)" class="btn btn-success waves-effect waves-light">Proses Permohonan</button>
        </div>
        <script>
            function actionTolak(e) {
                const nama = '<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>';
                Swal.fire({
                    title: 'Apakah anda yakin ingin menolak permohonan layanan ini?',
                    text: "Tolak permohonan layanan : <?= $data->layanan ?> - dari : <?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>",
                    showCancelButton: true,
                    icon: 'question',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tolak!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "./formtolak",
                            type: 'POST',
                            data: {
                                id: '<?= $data->id ?>',
                                nama: nama,
                            },
                            dataType: 'JSON',
                            beforeSend: function() {
                                $('div.modal-content-loading').block({
                                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                                });
                            },
                            success: function(resul) {
                                $('div.modal-content-loading').unblock();
                                if (resul.status !== 200) {
                                    Swal.fire(
                                        'Failed!',
                                        resul.message,
                                        'warning'
                                    );
                                } else {
                                    $('#content-tolakModalLabel').html('TOLAK PERMOHONAN LAYANAN <?= $data->layanan ?> dari ' + nama);
                                    $('.contentTolakBodyModal').html(resul.data);
                                    $('.content-tolakModal').modal({
                                        backdrop: 'static',
                                        keyboard: false,
                                    });
                                    $('.content-tolakModal').modal('show');
                                }
                            },
                            error: function() {
                                $('div.modal-content-loading').unblock();
                                Swal.fire(
                                    'Failed!',
                                    "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                                    'warning'
                                );
                            }
                        });
                    }
                })
            }

            function simpanTolak(e) {
                const id = '<?= $data->id ?>';
                const nama = '<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>';
                const keterangan = document.getElementsByName('_keterangan_tolak')[0].value;

                $.ajax({
                    url: "./tolak",
                    type: 'POST',
                    data: {
                        id: id,
                        nama: nama,
                        keterangan: keterangan,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        e.disabled = true;
                        $('div.modal-content-loading').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(resul) {
                        $('div.modal-content-loading').unblock();

                        if (resul.status !== 200) {
                            if (resul.status !== 201) {
                                if (resul.status === 401) {
                                    Swal.fire(
                                        'Failed!',
                                        resul.message,
                                        'warning'
                                    ).then((valRes) => {
                                        reloadPage(resul.redirrect);
                                    });
                                } else {
                                    e.disabled = false;
                                    Swal.fire(
                                        'GAGAL!',
                                        resul.message,
                                        'warning'
                                    );
                                }
                            } else {
                                Swal.fire(
                                    'Peringatan!',
                                    resul.message,
                                    'success'
                                ).then((valRes) => {
                                    reloadPage(resul.redirrect);
                                })
                            }
                        } else {
                            Swal.fire(
                                'SELAMAT!',
                                resul.message,
                                'success'
                            ).then((valRes) => {
                                reloadPage(resul.redirrect);
                            })
                        }
                    },
                    error: function(erro) {
                        console.log(erro);
                        // e.attr('disabled', false);
                        e.disabled = false
                        $('div.modal-content-loading').unblock();
                        Swal.fire(
                            'PERINGATAN!',
                            "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            };

            function actionApprove(e) {
                const id = '<?= $data->id ?>';
                const nama = '<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>';
                Swal.fire({
                    title: 'Apakah anda yakin ingin memproses permohonan layanan ini?',
                    text: "Proses Layanan : <?= $data->layanan ?> - dari : <?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>",
                    showCancelButton: true,
                    icon: 'question',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Proses!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "./proses",
                            type: 'POST',
                            data: {
                                id: id,
                                nama: nama,
                            },
                            dataType: 'JSON',
                            beforeSend: function() {
                                e.disabled = true;
                                $('div.modal-content-loading').block({
                                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                                });
                            },
                            success: function(resul) {
                                $('div.modal-content-loading').unblock();

                                if (resul.status !== 200) {
                                    if (resul.status === 401) {
                                        Swal.fire(
                                            'Failed!',
                                            resul.message,
                                            'warning'
                                        ).then((valRes) => {
                                            reloadPage();
                                        });
                                    } else {
                                        e.disabled = false;
                                        Swal.fire(
                                            'GAGAL!',
                                            resul.message,
                                            'warning'
                                        );
                                    }
                                } else {
                                    Swal.fire(
                                        'SELAMAT!',
                                        resul.message,
                                        'success'
                                    ).then((valRes) => {
                                        reloadPage(resul.redirrect);
                                    })
                                }
                            },
                            error: function(erro) {
                                console.log(erro);
                                // e.attr('disabled', false);
                                e.disabled = false
                                $('div.modal-content-loading').unblock();
                                Swal.fire(
                                    'PERINGATAN!',
                                    "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                                    'warning'
                                );
                            }
                        });
                    }
                })
            };
        </script>
    <?php } ?>