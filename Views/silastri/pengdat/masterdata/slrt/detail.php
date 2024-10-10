<?php if (isset($data)) { ?>
    <?php $orang = $data[0]; ?>
    <div class="modal-body">
        <div class="row">
            <h2>DATA KEPALA KELUARGA</h2>
            <div class="col-lg-6">
                <label class="col-form-label">Nama Lengkap:</label>
                <input type="text" class="form-control" value="<?= str_replace('&#039;', "`", str_replace("'", "`", $orang->nama)) ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">NIK:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nik" aria-label="NIK" value="<?= $orang->nik ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">No KK:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nohp" aria-label="NO HP" value="<?= $orang->no_kk ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Tanggal Lahir:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nohp" aria-label="NO HP" value="<?= $orang->tgl_lahir ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jenis Kelamin:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nohp" aria-label="NO HP" value="<?= $orang->jk ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Status Kawin:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nohp" aria-label="NO HP" value="<?= $orang->status_kawin ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Padan Siak:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="nohp" aria-label="NO HP" value="<?= $orang->padan_siak ?>" readonly />
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Alamat:</label>
                <textarea class="form-control" readonly><?= $orang->alamat ?></textarea>
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kecamatan:</label>
                <input type="text" class="form-control" value="<?= getNamaKecamatan($orang->kecamatan) ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kampung:</label>
                <input type="text" class="form-control" value="<?= getNamaKelurahan($orang->kampung) ?>" readonly />
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <h2>DATA KELUARGA</h2>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Hubungan Keluarga</th>
                                <th>Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key => $value) { ?>
                                <?php if ($key != 0) { ?>
                                    <tr>
                                        <th scope="row"><?= $key ?></th>
                                        <td><?= $value->nik ?></td>
                                        <td><?= $value->nama ?></td>
                                        <td><?= $value->jk ?></td>
                                        <td><?= $value->hubungan_keluarga ?></td>
                                        <td><?= $value->pekerjaan ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if (isset($data->lampiran_aduan_1)) { ?>
                <div class="col-lg-12 mt-2">
                    <label class="col-form-label">Lampiran Aduan:</label>
                    <br />
                    <?php if (isset($data->lampiran_aduan_1)) { ?>
                        <?php if ($data->lampiran_aduan_1 === null || $data->lampiran_aduan_1 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_1 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_1 ?>" id="nik">
                                Dokumen Pengaduan 1
                            </a> &nbsp;&nbsp;
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_aduan_2)) { ?>
                        <?php if ($data->lampiran_aduan_2 === null || $data->lampiran_aduan_2 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_2 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_2 ?>" id="nik">
                                Dokumen Pengaduan 2
                            </a>&nbsp;&nbsp;
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_aduan_3)) { ?>
                        <?php if ($data->lampiran_aduan_3 === null || $data->lampiran_aduan_3 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_3 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_3 ?>" id="nik">
                                Dokumen Pengaduan 3
                            </a>&nbsp;&nbsp;
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_aduan_4)) { ?>
                        <?php if ($data->lampiran_aduan_4 === null || $data->lampiran_aduan_4 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_4 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_4 ?>" id="nik">
                                Dokumen Pengaduan 4
                            </a>&nbsp;&nbsp;
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_aduan_5)) { ?>
                        <?php if ($data->lampiran_aduan_5 === null || $data->lampiran_aduan_5 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_5 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_aduan_5 ?>" id="nik">
                                Dokumen Pengaduan 5
                            </a>&nbsp;&nbsp;
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    </div>
<?php } ?>