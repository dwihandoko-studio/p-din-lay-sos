<?= $this->extend('t-silastri/adm/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">DETAIL PROSES PERMOHONAN LAYANAN</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="./data" class="btn btn-info btn-rounded waves-effect waves-light">Kembali</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-title">Detail Permohonan Layanan - <?= $data->jenis ?> - <?= $data->nik ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                <input type="text" class="form-control" value="<?= getJenisSubLayanan($data->layanan, $data->jenis) ?>" readonly />
                                <!-- <textarea rows="3" class="form-control" readonly><?= getJenisSubLayanan($data->layanan, $data->jenis) ?></textarea> -->
                            </div>
                        </div>
                    </div>
                    <?php if (isset($lks)) { ?>
                        <div class="card mt-0 mb-1">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Data Lembaga</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row mb-2">
                                            <label for="_nama_lembaga" class="col-sm-3 col-form-label">Nama Lembaga</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nama_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_jenis_lembaga" class="col-sm-3 col-form-label">Jenis Lembaga :</label>
                                            <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->jenis_lembaga ?>" readonly />
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_tgl_berdiri" class="col-sm-3 col-form-label">Tanggal Berdiri</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="_nama_lembaga" value="<?= $lks->tgl_berdiri_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nama_notaris" class="col-sm-3 col-form-label">Nama Notaris</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nama_notaris_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_no_tanggal_notaris" class="col-sm-3 col-form-label">No Notaris</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nomor_notaris_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_no_pendaftaran_kemenkumham" class="col-sm-3 col-form-label">Nomor Pendaftaran / Pengesahan Kemenkumham</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nomor_kemenkumham_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_akreditasi_lembaga" class="col-sm-3 col-form-label">Akreditasi Lembaga :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->akreditasi_lembaga ?>" readonly />
                                                <div class="help-block _akreditasi_lembaga"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_no_surat_akreditasi" class="col-sm-3 col-form-label">Nomor Surat Akreditasi (Kosongkan Jika Belum Terakreditasi)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nomor_surat_akreditasi_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_tgl_habis_berlaku_akreditasi" class="col-sm-3 col-form-label">Tanggal Habis Masa Berlaku Akreditasi</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="_nama_lembaga" value="<?= $lks->tgl_expired_akreditasi_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nomor_wajib_pajak" class="col-sm-3 col-form-label">Nomor Pokok Wajib Pajak (NPWP)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->npwp_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_modal_usaha" class="col-sm-3 col-form-label">Modal Usaha (UEP) *tidak wajib</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->modal_usaha_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_status_lembaga" class="col-sm-3 col-form-label">Status Lembaga :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->status_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_lingkup_wilayah_kerja" class="col-sm-3 col-form-label">Lingkup Wilayah Kerja :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->lingkup_wilayah_kerja_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_bidang_kegiatan" class="col-sm-3 col-form-label">Bidang Kegiatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->bidang_kegiatan_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_no_telp_lembaga" class="col-sm-3 col-form-label">No Telp Lembaga</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->no_telp_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_email_lembaga" class="col-sm-3 col-form-label">Email Lembaga</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->email_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row mb-2">
                                            <label for="_alamat_lembaga" class="col-sm-2 col-form-label">Alamat Lembaga</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->alamat_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label class="form-label" for="_rt_lembaga">RT</label>
                                                    <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->rt_lembaga ?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label class="form-label" for="_rw_lembaga">RW</label>
                                                    <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->rw_lembaga ?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_kecamatan_lembaga" class="col-sm-3 col-form-label">Kecamatan (Lembaga) :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->kecamatan_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2 select2-kelurahan-loading">
                                            <label for="_kelurahan_lembaga" class="col-sm-3 col-form-label">Kelurahan (Lembaga) :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->kelurahan_lembaga ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nama_ketua" class="col-sm-3 col-form-label">Nama Pengurus (Ketua)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nama_ketua_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nik_ketua" class="col-sm-3 col-form-label">NIK Pengurus (Ketua)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nik_ketua_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nohp_ketua" class="col-sm-3 col-form-label">Nomor HP Pengurus (Ketua)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nohp_ketua_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nama_sekretaris" class="col-sm-3 col-form-label">Nama Pengurus (Sekretaris)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nama_sekretaris_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nik_sekretaris" class="col-sm-3 col-form-label">NIK Pengurus (Sekretaris)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nik_sekretaris_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nohp_sekretaris" class="col-sm-3 col-form-label">Nomor HP Pengurus (Sekretaris)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nohp_sekretaris_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nama_bendahara" class="col-sm-3 col-form-label">Nama Pengurus (Bendahara)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nama_bendahara_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nik_bendahara" class="col-sm-3 col-form-label">NIK Pengurus (Bendahara)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nik_bendahara_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nohp_bendahara" class="col-sm-3 col-form-label">Nomor HP Pengurus (Bendahara)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->nohp_bendahara_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_jumlah_pengurus" class="col-sm-3 col-form-label">Jumlah Pengurus</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->jumlah_pengurus ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_jumlah_binaan_dalam_lembaga" class="col-sm-3 col-form-label">Jumlah Binaan Dalam Lembaga</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->jumlah_binaan_dalam ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_jumlah_binaan_luar_lembaga" class="col-sm-3 col-form-label">Jumlah Binaan Luar Lembaga</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->jumlah_binaan_luar ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group _koordinat-block">
                                            <label for="_koordinat" class="form-control-label">Koordinat Tempat Lembaga</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="_nama_lembaga" value="<?= $lks->lat_long_lembaga ?>" readonly />
                                            </div>
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
                                            <div class="col-lg-12">
                                                <?php if (isset($lks->lampiran_ktp_ketua)) { ?>
                                                    <?php if ($lks->lampiran_ktp_ketua === null || $lks->lampiran_ktp_ketua === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_ketua ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_ketua ?>" id="nik">
                                                            Lampiran KTP Pengurus (Ketua)
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_ktp_sekretaris)) { ?>
                                                    <?php if ($lks->lampiran_ktp_sekretaris === null || $lks->lampiran_ktp_sekretaris === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_sekretaris ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_sekretaris ?>" id="nik">
                                                            Lampiran KTP Pengurus (Sekretaris)
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_ktp_bendahara)) { ?>
                                                    <?php if ($lks->lampiran_ktp_bendahara === null || $lks->lampiran_ktp_bendahara === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_bendahara ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_ktp_bendahara ?>" id="nik">
                                                            Lampiran KTP Pengurus (Bendahara)
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_akta_notaris)) { ?>
                                                    <?php if ($lks->lampiran_akta_notaris === null || $lks->lampiran_akta_notaris === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_akta_notaris ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_akta_notaris ?>" id="nik">
                                                            Lampiran Akta Notaris Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_kemenkumham)) { ?>
                                                    <?php if ($lks->lampiran_kemenkumham === null || $lks->lampiran_kemenkumham === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_kemenkumham ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_kemenkumham ?>" id="nik">
                                                            Lampiran Kemenkumham Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_adrt)) { ?>
                                                    <?php if ($lks->lampiran_adrt === null || $lks->lampiran_adrt === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_adrt ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_adrt ?>" id="nik">
                                                            Lampiran ADRT Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_domisili)) { ?>
                                                    <?php if ($lks->lampiran_domisili === null || $lks->lampiran_domisili === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_domisili ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_domisili ?>" id="nik">
                                                            Lampiran Domisili Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_akreditasi)) { ?>
                                                    <?php if ($lks->lampiran_akreditasi === null || $lks->lampiran_akreditasi === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_akreditasi ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_akreditasi ?>" id="nik">
                                                            Lampiran Akreditasi Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_struktur_organisasi)) { ?>
                                                    <?php if ($lks->lampiran_struktur_organisasi === null || $lks->lampiran_struktur_organisasi === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_struktur_organisasi ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_struktur_organisasi ?>" id="nik">
                                                            Lampiran Struktur Organisasi Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_npwp)) { ?>
                                                    <?php if ($lks->lampiran_npwp === null || $lks->lampiran_npwp === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_npwp ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_npwp ?>" id="nik">
                                                            Lampiran NPWP Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_foto_lokasi)) { ?>
                                                    <?php if ($lks->lampiran_foto_lokasi === null || $lks->lampiran_foto_lokasi === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_lokasi ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_lokasi ?>" id="nik">
                                                            Lampiran Foto Lokasi Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_foto_usaha)) { ?>
                                                    <?php if ($lks->lampiran_foto_usaha === null || $lks->lampiran_foto_usaha === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_usaha ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_foto_usaha ?>" id="nik">
                                                            Lampiran Foto Usaha Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_logo)) { ?>
                                                    <?php if ($lks->lampiran_logo === null || $lks->lampiran_logo === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_logo ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_logo ?>" id="nik">
                                                            Lampiran Logo Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (isset($lks->lampiran_data_binaan)) { ?>
                                                    <?php if ($lks->lampiran_data_binaan === null || $lks->lampiran_data_binaan === "") { ?>
                                                    <?php } else { ?>
                                                        <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/lks') . '/' . $lks->lampiran_data_binaan ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/lks') . '/' . $lks->lampiran_data_binaan ?>" id="nik">
                                                            Lampiran Data Binaan Lembaga
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="card mt-0 mb-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 justify-content-end">
                                    <button type="button" onclick="actionTolak(this)" class="btn btn-danger waves-effect waves-light">Tolak Permohonan</button>
                                    <button type="button" onclick="actionApproveTemp(this)" class="btn btn-success waves-effect waves-light">Proses Lanjutkan Ke TTE Kadis</button>
                                    <!-- <button type="button" onclick="actionApproveTemp(this)" class="btn btn-success waves-effect waves-light">Lanjutkan Proses</button> -->
                                </div>
                                <div class="col-lg-6">
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
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Modal -->
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
    <div id="content-tolakModal" class="modal fade content-tolakModal" tabindex="-1" role="dialog" aria-labelledby="content-tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-loading-tolak">
                <div class="modal-header">
                    <h5 class="modal-title" id="content-tolakModalLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="contentTolakBodyModal">
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <?= $this->endSection(); ?>

    <?= $this->section('scriptBottom'); ?>
    <script src="<?= base_url() ?>/assets/libs/select2/js/select2.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/dropzone/min/dropzone.min.js"></script>

    <script>
        function actionApproveUpload(e) {
            const nama = '<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>';
            Swal.fire({
                title: 'Apakah anda yakin ingin melanjutkan proses permohonan layanan ini?',
                text: "Lanjutkan proses permohonan layanan : <?= $data->layanan ?> - dari : <?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>",
                showCancelButton: true,
                icon: 'question',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "./generateRekomendasi",
                        type: 'POST',
                        data: {
                            id: '<?= $data->id ?>',
                            nama: nama,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('div.main-content').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(resul) {
                            $('div.main-content').unblock();
                            if (resul.status !== 200) {
                                Swal.fire(
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                );
                            } else {
                                $('#content-detailModalLabel').html('PROSES PERMOHONAN LAYANAN <?= $data->layanan ?> dari ' + nama);
                                $('.contentBodyModal').html(resul.data);
                                $('.content-detailModal').modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                });
                                $('.content-detailModal').modal('show');
                            }
                        },
                        error: function() {
                            $('div.main-content').unblock();
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
                            $('div.main-content').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(resul) {
                            $('div.main-content').unblock();
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
                            $('div.main-content').unblock();
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

        function actionApproveTemp(e) {
            const id = '<?= $data->id ?>';
            const nama = '<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>';
            Swal.fire({
                title: 'Apakah anda yakin ingin melanjutkan permohonan layanan ini ke TTE kepala dinas?',
                text: "Lanjutkan Ke TTE Permohonan : <?= $data->layanan ?> - dari : <?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>",
                showCancelButton: true,
                icon: 'question',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "./generateRekomendasi",
                        type: 'POST',
                        data: {
                            id: id,
                            nama: nama,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            e.disabled = true;
                            $('div.main-content').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(resul) {
                            $('div.main-content').unblock();

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
                            $('div.main-content').unblock();
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

        $('#content-detailModal').on('click', '.btn-remove-preview-image', function(event) {
            $('.imagePreviewUpload').removeAttr('src');
            document.getElementsByName("_file")[0].value = "";
        });

        function initSelect2(event, parrent) {
            $('#' + event).select2({
                dropdownParent: parrent
            });
        }

        $(document).ready(function() {

        });
    </script>
    <?= $this->endSection(); ?>

    <?= $this->section('scriptTop'); ?>
    <link href="<?= base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

    <style>
        .preview-image-upload {
            position: relative;
        }

        .preview-image-upload .imagePreviewUpload {
            max-width: 300px;
            max-height: 300px;
            cursor: pointer;
        }

        .preview-image-upload .btn-remove-preview-image {
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

        .imagePreviewUpload:hover+.btn-remove-preview-image,
        .btn-remove-preview-image:hover {
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