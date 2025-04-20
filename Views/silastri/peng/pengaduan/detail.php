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
            <h2>DATA PENGADUAN</h2>
            <div class="col-lg-6">
                <label class="col-form-label">Kode Aduan:</label>
                <input type="text" class="form-control" value="<?= $data->kode_aduan ?>" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kategori:</label>
                <input type="text" class="form-control" value="<?= $data->kategori ?>" readonly />
            </div>
            <!-- <div class="col-lg-6">
                <label class="col-form-label">Jenis:</label>
                <textarea rows="3" class="form-control" readonly><?php //echo $data->jenis 
                                                                    ?></textarea>
            </div> -->

            <?php if (isset($data->lampiran_1) || isset($data->lampiran_2) || isset($data->lampiran_3)  || isset($data->lampiran_4)  || isset($data->lampiran_5)) { ?>
                <div class="col-lg-12 mt-2">
                    <label class="col-form-label">Lampiran Dokumen:</label>
                    <br />
                    <?php if (isset($data->lampiran_1)) { ?>
                        <?php if ($data->lampiran_1 === null || $data->lampiran_1 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_1 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_1 ?>" id="nik">
                                Lampiran 1
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_2)) { ?>
                        <?php if ($data->lampiran_2 === null || $data->lampiran_2 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_2 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_2 ?>" id="nik">
                                Lampiran 2
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_3)) { ?>
                        <?php if ($data->lampiran_3 === null || $data->lampiran_3 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_3 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_3 ?>" id="nik">
                                Lampiran 3
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_4)) { ?>
                        <?php if ($data->lampiran_4 === null || $data->lampiran_4 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_4 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_4 ?>" id="nik">
                                Lampiran 4
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isset($data->lampiran_5)) { ?>
                        <?php if ($data->lampiran_5 === null || $data->lampiran_5 === "") { ?>
                        <?php } else { ?>
                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_5 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_5 ?>" id="nik">
                                Lampiran 5
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
        <a href="<?= base_url('silastri/peng/pengaduan/printPdf') . '?id=' . $data->id ?>" target="_blank" class="btn btn-primary waves-effect">Download / Print</a>
    </div>
<?php } ?>