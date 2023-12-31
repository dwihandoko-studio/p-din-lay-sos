<?= $this->extend('t-silastri/peng/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Buat Permohonan Izin LKS/LKSA</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-xl-12">
            <form id="formAddData" action="./addSave" method="post" enctype="multipart/form-data">
                <div class="card mb-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Permohonan Izin LKS / LKSA</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control nama" id="_nama" name="_nama" value="<?= $data->fullname ?>" placeholder="Nama lengkap.. " readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nik" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control nama" id="_nik" name="_nik" value="<?= $data->nik ?>" placeholder="NIK.. " readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kk" class="col-sm-3 col-form-label">KK</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control nama" id="_kk" name="_kk" value="<?= $data->kk ?>" placeholder="KK.. " readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control nama" id="_tempat_lahir" name="_tempat_lahir" value="<?= $data->tempat_lahir ?>" placeholder="Tempat lahir.. " readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control nama" id="_tgl_lahir" name="_tgl_lahir" value="<?= $data->tgl_lahir ?>" readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control nama" id="_jenis_kelamin" name="_jenis_kelamin" value="<?= $data->jenis_kelamin === NULL || $data->jenis_kelamin === "" ? '-' : ($data->jenis_kelamin == "L" ? 'Laki-laki' : 'Perempuan') ?>" placeholder="Jenis kelamin.. " readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-0 mb-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Data Lembaga</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_nama_lembaga" class="col-sm-3 col-form-label">Nama Lembaga</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nama_lembaga" name="_nama_lembaga" placeholder="Nama lembaga.. " required />
                                        <div class="help-block _nama_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_jenis_lembaga" class="col-sm-3 col-form-label">Jenis Lembaga :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 jenis_lembaga" id="_jenis_lembaga" name="_jenis_lembaga" style="width: 100%" required>
                                            <option value=""> --- Pilih Jenis Lembaga --- </option>
                                            <option value="LKS"> LKS </option>
                                            <option value="YAYASAN"> YAYASAN </option>
                                        </select>
                                        <div class="help-block _jenis_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_tgl_berdiri" class="col-sm-3 col-form-label">Tanggal Berdiri</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="_tgl_berdiri" name="_tgl_berdiri" required />
                                        <div class="help-block _tgl_berdiri"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nama_notaris" class="col-sm-3 col-form-label">Nama Notaris</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nama_notaris" name="_nama_notaris" placeholder="Nama notaris.. " required />
                                        <div class="help-block _nama_notaris"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_no_tanggal_notaris" class="col-sm-3 col-form-label">Nama Notaris</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_no_tanggal_notaris" name="_no_tanggal_notaris" placeholder="Contoh: 02/27-02/2000 " required />
                                        <div class="help-block _no_tanggal_notaris"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_no_pendaftaran_kemenkumham" class="col-sm-3 col-form-label">Nomor Pendaftaran / Pengesahan Kemenkumham</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_no_pendaftaran_kemenkumham" name="_no_pendaftaran_kemenkumham" placeholder="No pengesahan... " required />
                                        <div class="help-block _no_pendaftaran_kemenkumham"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_akreditasi_lembaga" class="col-sm-3 col-form-label">Akreditasi Lembaga :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 akreditasi_lembaga" id="_akreditasi_lembaga" name="_akreditasi_lembaga" style="width: 100%" required>
                                            <option value=""> --- Pilih Akreditasi Lembaga --- </option>
                                            <option value="A"> A </option>
                                            <option value="B"> B </option>
                                            <option value="C"> C </option>
                                            <option value="D"> D </option>
                                            <option value="Belum Terakreditasi"> Belum Terakreditasi </option>
                                        </select>
                                        <div class="help-block _akreditasi_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_no_surat_akreditasi" class="col-sm-3 col-form-label">Nomor Surat Akreditasi (Kosongkan Jika Belum Terakreditasi)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_no_surat_akreditasi" name="_no_surat_akreditasi" placeholder="No akreditasi... " />
                                        <div class="help-block _no_surat_akreditasi"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_tgl_habis_berlaku_akreditasi" class="col-sm-3 col-form-label">Tanggal Habis Masa Berlaku Akreditasi</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="_tgl_habis_berlaku_akreditasi" name="_tgl_habis_berlaku_akreditasi" />
                                        <div class="help-block _tgl_habis_berlaku_akreditasi"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nomor_wajib_pajak" class="col-sm-3 col-form-label">Nomor Pokok Wajib Pajak (NPWP)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nomor_wajib_pajak" name="_nomor_wajib_pajak" required />
                                        <div class="help-block _nomor_wajib_pajak"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_modal_usaha" class="col-sm-3 col-form-label">Modal Usaha (UEP) *tidak wajib</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="_modal_usaha" name="_modal_usaha" />
                                        <div class="help-block _modal_usaha"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_status_lembaga" class="col-sm-3 col-form-label">Status Lembaga :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 status_lembaga" id="_status_lembaga" name="_status_lembaga" style="width: 100%" required>
                                            <option value=""> --- Pilih Status Lembaga --- </option>
                                            <option value="PUSAT"> PUSAT </option>
                                            <option value="CABANG"> CABANG </option>
                                        </select>
                                        <div class="help-block _status_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_lingkup_wilayah_kerja" class="col-sm-3 col-form-label">Lingkup Wilayah Kerja :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 lingkup_wilayah_kerja" id="_lingkup_wilayah_kerja" name="_lingkup_wilayah_kerja" style="width: 100%" required>
                                            <option value=""> --- Pilih Lingkup Wilayah Kerja --- </option>
                                            <option value="KABUPATEN LAMPUNG TENGAH"> KABUPATEN LAMPUNG TENGAH </option>
                                        </select>
                                        <div class="help-block _lingkup_wilayah_kerja"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_bidang_kegiatan" class="col-sm-3 col-form-label">Bidang Kegiatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_bidang_kegiatan" name="_bidang_kegiatan" required />
                                        <div class="help-block _bidang_kegiatan"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_no_telp_lembaga" class="col-sm-3 col-form-label">No Telp Lembaga</label>
                                    <div class="col-sm-8">
                                        <input type="phone" class="form-control" id="_no_telp_lembaga" name="_no_telp_lembaga" required />
                                        <div class="help-block _no_telp_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_email_lembaga" class="col-sm-3 col-form-label">Email Lembaga</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="_email_lembaga" name="_email_lembaga" required />
                                        <div class="help-block _email_lembaga"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_alamat_lembaga" class="col-sm-2 col-form-label">Alamat Lembaga</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" class="form-control" id="_alamat_lembaga" name="_alamat_lembaga" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div>
                                            <label class="form-label" for="_rt_lembaga">RT</label>
                                            <input class="form-control" id="_rt_lembaga" name="_rt_lembaga" type="text" placeholder="RT" required>
                                            <div class="help-block _rt_lembaga"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <label class="form-label" for="_rw_lembaga">RW</label>
                                            <input class="form-control" id="_rw_lembaga" name="_rw_lembaga" type="text" placeholder="RT" required>
                                            <div class="help-block _rw_lembaga"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kecamatan_lembaga" class="col-sm-3 col-form-label">Kecamatan (Lembaga) :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 kecamatan_lembaga" id="_kecamatan_lembaga" name="_kecamatan_lembaga" style="width: 100%" onchange="changeKecamatan(this)" required>
                                            <option value=""> --- Pilih Kecamatan --- </option>
                                            <?php if (isset($kecamatans)) { ?>
                                                <?php if (count($kecamatans) > 0) { ?>
                                                    <?php foreach ($kecamatans as $key => $value) { ?>
                                                        <option value="<?= $value->id ?>"><?= $value->kecamatan ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block _kecamatan_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kelurahan_lembaga" class="col-sm-3 col-form-label">Kelurahan (Lembaga) :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 kecamatan_lembaga" id="_kelurahan_lembaga" name="_kelurahan_lembaga" style="width: 100%" required>
                                            <option value=""> --- Pilih Kecamatan Dulu --- </option>
                                        </select>
                                        <div class="help-block _kelurahan_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nama_ketua" class="col-sm-3 col-form-label">Nama Pengurus (Ketua)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nama_ketua" name="_nama_ketua" required />
                                        <div class="help-block _nama_ketua"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nik_ketua" class="col-sm-3 col-form-label">NIK Pengurus (Ketua)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nik_ketua" name="_nik_ketua" required />
                                        <div class="help-block _nik_ketua"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nohp_ketua" class="col-sm-3 col-form-label">Nomor HP Pengurus (Ketua)</label>
                                    <div class="col-sm-8">
                                        <input type="phone" class="form-control" id="_nohp_ketua" name="_nohp_ketua" required />
                                        <div class="help-block _nohp_ketua"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nama_sekretaris" class="col-sm-3 col-form-label">Nama Pengurus (Sekretaris)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nama_sekretaris" name="_nama_sekretaris" required />
                                        <div class="help-block _nama_sekretaris"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nik_sekretaris" class="col-sm-3 col-form-label">NIK Pengurus (Sekretaris)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nik_sekretaris" name="_nik_sekretaris" required />
                                        <div class="help-block _nik_sekretaris"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nohp_sekretaris" class="col-sm-3 col-form-label">Nomor HP Pengurus (Sekretaris)</label>
                                    <div class="col-sm-8">
                                        <input type="phone" class="form-control" id="_nohp_sekretaris" name="_nohp_sekretaris" required />
                                        <div class="help-block _nohp_sekretaris"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nama_bendahara" class="col-sm-3 col-form-label">Nama Pengurus (Bendahara)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nama_bendahara" name="_nama_bendahara" required />
                                        <div class="help-block _nama_bendahara"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nik_bendahara" class="col-sm-3 col-form-label">NIK Pengurus (Bendahara)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_nik_bendahara" name="_nik_bendahara" required />
                                        <div class="help-block _nik_bendahara"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nohp_bendahara" class="col-sm-3 col-form-label">Nomor HP Pengurus (Bendahara)</label>
                                    <div class="col-sm-8">
                                        <input type="phone" class="form-control" id="_nohp_bendahara" name="_nohp_bendahara" required />
                                        <div class="help-block _nohp_bendahara"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_jumlah_pengurus" class="col-sm-3 col-form-label">Jumlah Pengurus</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="_jumlah_pengurus" name="_jumlah_pengurus" required />
                                        <div class="help-block _jumlah_pengurus"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_jumlah_binaan_dalam_lembaga" class="col-sm-3 col-form-label">Jumlah Binaan Dalam Lembaga</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="_jumlah_binaan_dalam_lembaga" name="_jumlah_binaan_dalam_lembaga" required />
                                        <div class="help-block _jumlah_binaan_dalam_lembaga"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_jumlah_binaan_luar_lembaga" class="col-sm-3 col-form-label">Jumlah Binaan Luar Lembaga</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="_jumlah_binaan_luar_lembaga" name="_jumlah_binaan_luar_lembaga" required />
                                        <div class="help-block _jumlah_binaan_luar_lembaga"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group _koordinat-block">
                                    <label for="_koordinat" class="form-control-label">Koordinat Tempat Tinggal</label>
                                    <div class="input-group input-group-merge">
                                        <input type="hidden" name="_latitude" id="_latitude">
                                        <input type="hidden" name="_longitude" id="_longitude">
                                        <input type="text" class="form-control koordinat" style="padding-left: 15px;" name="_koordinat" id="_koordinat" onFocus="inputFocus(this);" readonly>
                                        <div class="input-group-append action-location" onmouseover="actionMouseHoverLocation(this)" onmouseout="actionMouseOutHoverLocation(this)" onclick="pickCoordinat()">
                                            <span class="input-group-text action-location-icon" style="background-color: transparent;"><i class="fas fa-map-marker"></i></span>
                                        </div>
                                    </div>

                                    <div class="help-block _koordinat"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-0 mb-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Lampiran Dokumen Permohonan</h4>
                                <p style="margin-bottom: 30px;">Silahkan lampirkan dokumen permohonan (KTP Pengurus, Akta Notaris, Pengesahan Kemenkumham, ADRT, Keterangan Domisili, Akreditasi, Struktur Organisasi, NPWP, Foto Lokasi Tampak Depan, Foto Usaha Ekonomi Produktif, Logo Lembaga, dan File Binaan).</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_ktp_ketua" class="form-label">Lampiran KTP Pengurus (Ketua) : </label>
                                            <input class="form-control" type="file" id="_file_ktp_ketua" name="_file_ktp_ketua" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_ktp_ketua', 'KTP Ketua')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_ktp_ketua" for="_file_ktp_ketua"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_ktp_sekretaris" class="form-label">Lampiran KTP Pengurus (Sekretaris) : </label>
                                            <input class="form-control" type="file" id="_file_ktp_sekretaris" name="_file_ktp_sekretaris" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_ktp_sekretaris', 'KTP Sekretaris')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_ktp_sekretaris" for="_file_ktp_sekretaris"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_ktp_bendahara" class="form-label">Lampiran KTP Pengurus (Bendahara) : </label>
                                            <input class="form-control" type="file" id="_file_ktp_bendahara" name="_file_ktp_bendahara" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_ktp_bendahara', 'KTP Bendahara')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_ktp_bendahara" for="_file_ktp_bendahara"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_akta_notaris" class="form-label">Lampiran Akta Notaris : </label>
                                            <input class="form-control" type="file" id="_file_akta_notaris" name="_file_akta_notaris" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_akta_notaris', 'Akta Notaris')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_akta_notaris" for="_file_akta_notaris"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_pengesahan_kemenkumham" class="form-label">Lampiran Pengesahan Kemenkumham : </label>
                                            <input class="form-control" type="file" id="_file_pengesahan_kemenkumham" name="_file_pengesahan_kemenkumham" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_pengesahan_kemenkumham', 'Pengesahan Kemenkumham')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_pengesahan_kemenkumham" for="_file_pengesahan_kemenkumham"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_adrt" class="form-label">Lampiran ADRT : </label>
                                            <input class="form-control" type="file" id="_file_adrt" name="_file_adrt" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_adrt', 'ADRT')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_adrt" for="_file_adrt"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_keterangan_domisili" class="form-label">Lampiran Keterangan Domisili : </label>
                                            <input class="form-control" type="file" id="_file_keterangan_domisili" name="_file_keterangan_domisili" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_keterangan_domisili', 'Keterangan Domisili')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_keterangan_domisili" for="_file_keterangan_domisili"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_akreditasi" class="form-label">Lampiran Akreditasi : </label>
                                            <input class="form-control" type="file" id="_file_akreditasi" name="_file_akreditasi" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_akreditasi', 'Akreditasi')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb (Jika Ada)</code></p>
                                            <div class="help-block _file_akreditasi" for="_file_akreditasi"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_struktur_organisasi" class="form-label">Lampiran Struktur Organisasi : </label>
                                            <input class="form-control" type="file" id="_file_struktur_organisasi" name="_file_struktur_organisasi" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_struktur_organisasi', 'Struktur Organisasi')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_struktur_organisasi" for="_file_struktur_organisasi"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_npwp" class="form-label">Lampiran NPWP : </label>
                                            <input class="form-control" type="file" id="_file_npwp" name="_file_npwp" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_npwp', 'NPWP')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_npwp" for="_file_npwp"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_foto_lokasi" class="form-label">Lampiran Foto Lokasi : </label>
                                            <input class="form-control" type="file" id="_file_foto_lokasi" name="_file_foto_lokasi" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_foto_lokasi', 'Foto Lokasi')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_foto_lokasi" for="_file_foto_lokasi"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_foto_usaha_ekonomi_produktif" class="form-label">Lampiran Foto Usaha Ekonomi Produktif (UEP) : </label>
                                            <input class="form-control" type="file" id="_file_foto_usaha_ekonomi_produktif" name="_file_foto_usaha_ekonomi_produktif" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_foto_usaha_ekonomi_produktif', 'Foto Usaha Ekonomi Produktif')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb (Jika Ada)</code></p>
                                            <div class="help-block _file_foto_usaha_ekonomi_produktif" for="_file_foto_usaha_ekonomi_produktif"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_logo_lembaga" class="form-label">Lampiran Logo Lembaga : </label>
                                            <input class="form-control" type="file" id="_file_logo_lembaga" name="_file_logo_lembaga" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_logo_lembaga', 'Logo Lembaga')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb (Jika Ada)</code></p>
                                            <div class="help-block _file_logo_lembaga" for="_file_logo_lembaga"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-3">
                                            <label for="_file_data_binaan" class="form-label">Lampiran Data Binaan : </label>
                                            <p class="font-size-11">&nbsp;&nbsp;Template data binaan dapat di download pada : <a class="menu-badge badge-info" href="#">Link Berikut...</a></p>
                                            <input class="form-control" type="file" id="_file_data_binaan" name="_file_data_binaan" onFocus="inputFocus(this);" accept=".xls, .xlsx" onchange="loadFileExcel('_file_data_binaan', 'Data Binaan')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="xls, xlsx">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_data_binaan" for="_file_data_binaan"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-0 mb-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 justify-content-end">
                                <button type="submit" id="save_button" name="save_button" class="btn btn-primary w-md save_button">KIRIM</button>
                            </div>
                            <div class="col-lg-9">
                                <div>
                                    <progress id="progressBar" value="0" max="100" style="width:100%; display: none;"></progress>
                                </div>
                                <div>
                                    <h3 id="status" style="font-size: 15px; margin: 8px auto;"></h3>
                                </div>
                                <div>
                                    <p id="loaded_n_total" style="margin-bottom: 0px;"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="content-aktivasiModal" class="modal fade content-aktivasiModal" tabindex="-1" role="dialog" aria-labelledby="content-aktivasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-aktivasi-loading">
            <div class="modal-header">
                <h5 class="modal-title" id="content-aktivasiModalLabel">TAUTKAN INFO GTK DIGITAL ANDA</h5>
            </div>
            <div class="contentAktivasiBodyModal">
            </div>
        </div>
    </div>
</div>
<div id="content-detailModal" class="modal fade content-detailModal" tabindex="-1" role="dialog" aria-labelledby="content-detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-loading">
            <div class="modal-header">
                <h5 class="modal-title" id="content-detailModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="contentBodyModal">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>

<script>
    $("#formAddData").on("submit", function(e) {
        e.preventDefault();
        const indikator1 = $("input[type='radio'][name='_indikator_1']:checked").val();
        const indikator2 = $("input[type='radio'][name='_indikator_2']:checked").val();
        const indikator3 = $("input[type='radio'][name='_indikator_3']:checked").val();
        const indikator4 = $("input[type='radio'][name='_indikator_4']:checked").val();
        const indikator5 = $("input[type='radio'][name='_indikator_5']:checked").val();
        const indikator6 = $("input[type='radio'][name='_indikator_6']:checked").val();

        const nama = document.getElementsByName('_nama')[0].value;
        const nik = document.getElementsByName('_nik')[0].value;
        const kk = document.getElementsByName('_kk')[0].value;
        const jenis = document.getElementsByName('_jenis')[0].value;
        const keterangan = document.getElementsByName('_jenis_detail')[0].value;

        const fileKtp = document.getElementsByName('_file_ktp')[0].value;
        const fileKk = document.getElementsByName('_file_kk')[0].value;
        const filePernyataan = document.getElementsByName('_file_pernyataan')[0].value;
        const fileFotoRumah = document.getElementsByName('_file_foto_rumah')[0].value;

        if (jenis === "") {
            $("select#_jenis").css("color", "#dc3545");
            $("select#_jenis").css("border-color", "#dc3545");
            $('._jenis-error').html('Silahkan pilih jenis SKTM');

            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih peruntukan SKTM.",
                'warning'
            );
            return false;
        }

        if (indikator1 === undefined || indikator1 === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih isian indikator 1.",
                'warning'
            );
            return;
        }
        if (indikator2 === undefined || indikator2 === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih isian indikator 2.",
                'warning'
            );
            return;
        }
        if (indikator3 === undefined || indikator3 === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih isian indikator 3.",
                'warning'
            );
            return;
        }
        if (indikator4 === undefined || indikator4 === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih isian indikator 4.",
                'warning'
            );
            return;
        }
        if (indikator5 === undefined || indikator5 === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih isian indikator 5.",
                'warning'
            );
            return;
        }
        if (indikator6 === undefined || indikator6 === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih isian indikator 6.",
                'warning'
            );
            return;
        }
        if (fileKtp === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan dokumen KTP.",
                'warning'
            );
            return;
        }
        if (fileKk === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan dokumen KK.",
                'warning'
            );
            return;
        }
        if (filePernyataan === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan dokumen Pernyataan.",
                'warning'
            );
            return;
        }
        if (fileFotoRumah === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan dokumen Foto Rumah.",
                'warning'
            );
            return;
        }

        const formUpload = new FormData();

        const file_ktp = document.getElementsByName('_file_ktp')[0].files[0];
        formUpload.append('_file_ktp', file_ktp);
        const file_kk = document.getElementsByName('_file_kk')[0].files[0];
        formUpload.append('_file_kk', file_kk);
        const file_pernyataan = document.getElementsByName('_file_pernyataan')[0].files[0];
        formUpload.append('_file_pernyataan', file_pernyataan);
        const file_foto_rumah = document.getElementsByName('_file_foto_rumah')[0].files[0];
        formUpload.append('_file_foto_rumah', file_foto_rumah);

        formUpload.append('nama', nama);
        formUpload.append('nik', nik);
        formUpload.append('kk', kk);
        formUpload.append('jenis', jenis);
        formUpload.append('indikator1', indikator1);
        formUpload.append('indikator2', indikator2);
        formUpload.append('indikator3', indikator3);
        formUpload.append('indikator4', indikator4);
        formUpload.append('indikator5', indikator5);
        formUpload.append('indikator6', indikator6);
        formUpload.append('keterangan', keterangan);

        Swal.fire({
            title: 'Apakah anda yakin ingin mengajukan permohonan data ini?',
            text: "Ajukan permohonan : SKTM",
            showCancelButton: true,
            icon: 'question',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ajukan!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    xhr: function() {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                ambilId("loaded_n_total").innerHTML = "Uploaded " + evt.loaded + " bytes of " + evt.total;
                                var percent = (evt.loaded / evt.total) * 100;
                                ambilId("progressBar").value = Math.round(percent);
                                // ambilId("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
                            }
                        }, false);
                        return xhr;
                    },
                    url: "./addSave",
                    type: 'POST',
                    data: formUpload,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    beforeSend: function() {
                        ambilId("progressBar").style.display = "block";
                        // ambilId("status").innerHTML = "Mulai mengupload . . .";
                        ambilId("status").style.color = "blue";
                        ambilId("progressBar").value = 0;
                        ambilId("loaded_n_total").innerHTML = "";
                        $('div.main-content').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(resul) {
                        $('div.main-content').unblock();

                        if (resul.status !== 200) {
                            // ambilId("status").innerHTML = "gagal";
                            ambilId("status").style.color = "red";
                            ambilId("progressBar").value = 0;
                            ambilId("loaded_n_total").innerHTML = "";
                            if (resul.status !== 201) {
                                if (resul.status === 401) {
                                    Swal.fire(
                                        'Failed!',
                                        resul.message,
                                        'warning'
                                    ).then((valRes) => {
                                        reloadPage();
                                    });
                                } else {
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
                                    reloadPage();
                                })
                            }
                        } else {
                            // ambilId("status").innerHTML = resul.message;
                            ambilId("status").style.color = "green";
                            ambilId("progressBar").value = 100;
                            Swal.fire(
                                'SELAMAT!',
                                resul.message,
                                'success'
                            ).then((valRes) => {
                                reloadPage(resul.redirect);
                            })
                        }
                    },
                    error: function(erro) {
                        console.log(erro);
                        // ambilId("status").innerHTML = "Upload Failed";
                        ambilId("status").style.color = "red";
                        $('div.main-content').unblock();
                        Swal.fire(
                            'PERINGATAN!',
                            "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        });

    });

    function changeJenis(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');

        if (event.value === "Lainnya") {
            document.getElementById("_jenis_detail").style.display = "block";
        } else {
            document.getElementById("_jenis_detail").style.display = "none";
        }
    }

    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        $(id).removeAttr('style');
        $('.' + color).html('');
    }

    function inputChange(event) {
        console.log(event.value);
        if (event.value === null || (event.value.length > 0 && event.value !== "")) {
            $(event).removeAttr('style');
        } else {
            $(event).css("color", "#dc3545");
            $(event).css("border-color", "#dc3545");
            // $('.nama_instansi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
    }

    function ambilId(id) {
        return document.getElementById(id);
    }

    $('#formAddData').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    function initSelect2(event, parrent) {
        $('#' + event).select2({
            dropdownParent: parrent
        });
    }

    function removeLampiran(event, preview) {
        $('.imagePreviewUpload' + preview).removeAttr('src');
        document.getElementsByName(event)[0].value = "";
    }

    function loadFile(event, preview) {
        const input = document.getElementsByName(event)[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            var mime_types = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                $('.imagePreviewUpload' + preview).attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type gambar dan pdf yang diizinkan.",
                    'warning'
                );
                return false;
            }

            if (file.size > 2 * 1024 * 1000) {
                input.value = "";
                $('.imagePreviewUpload' + preview).attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
                return false;
            }

            if (file.type === 'application/pdf') {

            } else {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.imagePreviewUpload' + preview).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }

        } else {
            console.log("failed Load");
        }
    }

    $(document).ready(function() {});
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<style>
    .preview-image-upload-ktp {
        position: relative;
    }

    .preview-image-upload-ktp .imagePreviewUploadKtp {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload-ktp .btn-remove-preview-image-ktp {
        display: none;
        position: absolute;
        top: 5px;
        left: 5px;
        background-color: #555;
        color: white;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
    }

    .imagePreviewUploadKtp:hover+.btn-remove-preview-image-ktp,
    .btn-remove-preview-image-ktp:hover {
        display: block;
    }

    .preview-image-upload-kk {
        position: relative;
    }

    .preview-image-upload-kk .imagePreviewUploadKk {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload-kk .btn-remove-preview-image-kk {
        display: none;
        position: absolute;
        top: 5px;
        left: 5px;
        background-color: #555;
        color: white;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
    }

    .imagePreviewUploadKk:hover+.btn-remove-preview-image-kk,
    .btn-remove-preview-image-kk:hover {
        display: block;
    }

    .preview-image-upload-pernyataan {
        position: relative;
    }

    .preview-image-upload-pernyataan .imagePreviewUploadPernyataan {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload-pernyataan .btn-remove-preview-image-pernyataan {
        display: none;
        position: absolute;
        top: 5px;
        left: 5px;
        background-color: #555;
        color: white;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
    }

    .imagePreviewUploadPernyataan:hover+.btn-remove-preview-image-pernyataan,
    .btn-remove-preview-image-pernyataan:hover {
        display: block;
    }

    .preview-image-upload-foto-rumah {
        position: relative;
    }

    .preview-image-upload-foto-rumah .imagePreviewUploadFotoRumah {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload-foto-rumah .btn-remove-preview-image-foto-rumah {
        display: none;
        position: absolute;
        top: 5px;
        left: 5px;
        background-color: #555;
        color: white;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
    }

    .imagePreviewUploadFotoRumah:hover+.btn-remove-preview-image-foto-rumah,
    .btn-remove-preview-image-foto-rumah:hover {
        display: block;
    }

    .ul-custom-style-sub-menu-action {
        list-style: none;
        padding-left: 0.5rem;
        border: 1px solid #ffffff2e;
        padding-top: 0.5rem;
        padding-right: 0.5rem;
        border-radius: 1.5rem;
    }

    .li-custom-style-sub-menu-action {
        border: 1px solid white;
        display: inline-block !important;
        padding: 0.3rem 0.5rem 0rem 0.3rem;
        margin-right: 0.3rem;
        margin-bottom: 0.5rem;
        border-radius: 2rem;
    }

    .custom-style-sub-menu-action {
        font-size: 1em;
        line-height: 1;
        height: 24px;
        color: #f6f6f6;
        display: inline-block;
        position: relative;
        text-align: center;
        font-weight: 500;
        box-sizing: border-box;
        margin-top: -15px;
        vertical-align: -webkit-baseline-middle;
    }
</style>
<?= $this->endSection(); ?>