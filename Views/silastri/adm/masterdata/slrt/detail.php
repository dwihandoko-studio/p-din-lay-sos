<?php if (isset($data)) { ?>
    <?php $orang = $data[0]; ?>
    <div class="modal-body">
        <!-- <div class="table-responsive">
            <table id="data-datatables" class="table table-hover nowrap w-100">
                <thead>
                    <tr>
                        <th data-orderable="false">#</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No KK</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Status Perkawinan</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Alamat</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Kampung</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>Pendidikan</th>
                        <th>Lembaga Pendidikan</th>
                        <th>Permasalahan Terkait Pendidikan</th>
                        <th>Jenis PPKS</th>
                        <th>Sub Jenis PPKS</th>
                        <th>Kelompok Sasaran SPM</th>
                        <th>Status Dalam Keluarga</th>
                        <th>Tinggal Di dalam Keluarga</th>
                        <th>Tinggal Di luar Keluarga</th>
                        <th>DTKS</th>
                        <th>Status P3KE</th>
                        <th>Gambaran Kasus</th>
                        <th>Permasalahan terkait Ekonomi Keluarga</th>
                        <th>Pekerjaan Kepala Rumah Tangga</th>
                        <th>Asset Bergerak Tabung Gas 5,5 Kg atau Lebih</th>
                        <th>Asset Bergerak Lemari Es/Kulkas</th>
                        <th>Asset Bergerak Emas Perhiasan (min 10 Gram)</th>
                        <th>Asset Bergerak Sepeda</th>
                        <th>Asset Bergerak Sepeda Motor</th>
                        <th>Asset Bergerak Sepeda Mobil</th>
                        <th>Asset Bergerak Sepeda Perahu</th>
                        <th>Asset Bergerak Sepeda Perahu Motor</th>
                        <th>Asset Bergerak Sepeda Perahu Motor</th>
                    </tr>
                </thead>
            </table>
        </div> -->

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
        <hr />
        <div class="row mt-2">
            <h2>KONDISI SOSIAL</h2>
            <div class="col-lg-6">
                <label class="col-form-label">Jenis PPKS:</label>
                <input type="text" class="form-control" value="Disabilitas Fisik" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Sub Jenis PPKS:</label>
                <input type="text" class="form-control" value="Rungu, Wicara dan Fisik" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kelompok Sasaran SPM:</label>
                <input type="text" class="form-control" value="Amputasi" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Status Dalam Keluarga/ Hubungan Dengan Kepala Rumah Tangga:</label>
                <input type="text" class="form-control" value="Kepala Keluarga" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Tinggal Di Dalam Keluarga:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Tinggal Di Luar Keluarga:</label>
                <input type="text" class="form-control" value="Tidak" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">DTKS:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">P3KE:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Gambaran Kasus:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <!-- <div class="col-lg-12">
                <p>
                <ol>
                    <li>Jenis PPKS: <?= count($assesments) > 0 ? getNameKategoriPPKS($assesments[0]->kategori_ppks) . "(" . $assesments[0]->nik_orang_assesment . ")" : "-" ?></li>
                </ol>
                </p>
            </div> -->
        </div>
        <hr />
        <div class="row mt-2">
            <h2>KONDISI PEREKONOMIAN</h2>
            <div class="col-lg-6">
                <label class="col-form-label">Permasalahan Terkait Perekonomian Keluarga:</label>
                <input type="text" class="form-control" value="Disabilitas Fisik" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Pekerjaan Kepala Rumah Tangga:</label>
                <input type="text" class="form-control" value="Rungu, Wicara dan Fisik" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Tabung Gas 5,5 Kg atau lebih:</label>
                <input type="text" class="form-control" value="Amputasi" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Lemari es/kulkas:</label>
                <input type="text" class="form-control" value="Kepala Keluarga" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Emas/ perhiasan (min.10 gram):</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Sepeda:</label>
                <input type="text" class="form-control" value="Tidak" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Sepeda Motor:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Mobil:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Perahu:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Bergerak Perahu Motor:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Tak Bergerak Lahan (selain yang ditempati):</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Aset Tak Bergerak Rumah/ bangunan di tempat lain:</label>
                <input type="text" class="form-control" value="Ya" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Kepemilikan Ternak:</label>
                <input type="text" class="form-control" value="Sapi" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Jumlah kepemilikan hewan ternak (ekor):</label>
                <input type="text" class="form-control" value="1" readonly />
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <h2>KONDISI KESEHATAN</h2>
            <div class="col-lg-6">
                <label class="col-form-label">Kondisi gizi anak dari pemeriksaan 3 bulan terakhir mengacu pada catatan/ buku kontrol:</label>
                <input type="text" class="form-control" value="Disabilitas Fisik" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Keluhan kesehatan kronis/ menahun:</label>
                <input type="text" class="form-control" value="Rungu, Wicara dan Fisik" readonly />
            </div>
            <div class="col-lg-6">
                <label class="col-form-label">Permasalahan terkait kesehatan:</label>
                <input type="text" class="form-control" value="Amputasi" readonly />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    </div>
<?php } ?>