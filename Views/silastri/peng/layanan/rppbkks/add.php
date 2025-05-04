<?= $this->extend('t-silastri/peng/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Buat Permohonan Rekomendasi PPBKKS</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-xl-12">
            <form id="formAddData" action="./addSave" method="post" enctype="multipart/form-data">
                <div class="card mb-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Permohonan Surat Rekomendasi Permohonan Penerbitan Buku Rekening dan Kartu Keluarga Sejahtera</h4>
                        <div class="row">
                        </div>
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
                                    <label for="_nohp" class="col-sm-3 col-form-label">No Handphone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control nama" id="_nohp" name="_nohp" value="<?= $data->no_hp ?>" placeholder="No Handphone.. " readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea rows="2" class="form-control alamat" id="_alamat" name="_alamat" readonly><?= $data->alamat ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="_kecamatan" name="_kecamatan" value="<?= $data->kecamatan ?>" readonly />
                                        <input type="text" class="form-control kecamatan" id="_nama_kecamatan" name="_nama_kecamatan" value="<?= getNamaKecamatan($data->kecamatan) ?>" readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kampung" class="col-sm-3 col-form-label">Kampung</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="_kampung" name="_kampung" value="<?= $data->kelurahan ?>" readonly />
                                        <input type="text" class="form-control kampung" id="_nama_kampung" name="_nama_kampung" value="<?= getNamaKelurahan($data->kelurahan) ?>" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card mt-0 mb-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row mb-2">
                                    <label for="_no_rekening" class="col-sm-3 col-form-label">No Rekening</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control no_rekening" id="_no_rekening" name="_no_rekening" placeholder="No Rekening.. " required />
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="card mt-0 mb-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Identitas Subject Layanan</h4>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-1">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="_identitas_pemohon" value="sama" id="_identitas_subject" onchange="changePemohon(this)" checked="">
                                                <label class="form-check-label" for="_identitas_subject">
                                                    Diri Sendiri
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="_identitas_pemohon" value="beda" onchange="changePemohon(this)" id="_identitas_subject_lain">
                                                <label class="form-check-label" for="_identitas_subject_lain">
                                                    Ahli Waris (Dalam Satu Kartu Keluarga)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 data-ahli_waris" id="data-ahli_waris" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row mb-2">
                                            <label for="_nama_ahli_waris" class="col-sm-3 col-form-label">Nama Lengkap Ahli Waris</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control nama_ahli_waris" id="_nama_ahli_waris" name="_nama_ahli_waris" placeholder="Nama lengkap yang diadukan.. " />
                                                <div class="help-block _nama_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nik_ahli_waris" class="col-sm-3 col-form-label">NIK Ahli Waris</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control nik_ahli_waris" id="_nik_ahli_waris" name="_nik_ahli_waris" placeholder="NIK yang diadukan.. " />
                                                <div class="help-block _nik_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_tempat_lahir_ahli_waris" class="col-sm-3 col-form-label">Tempat Lahir Ahli Waris</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control tempat_lahir_ahli_waris" id="_tempat_lahir_ahli_waris" name="_tempat_lahir_ahli_waris" placeholder="tempat lahir ahli waris.. " />
                                                <div class="help-block _tempat_lahir_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_tanggal_lahir_ahli_waris" class="col-sm-3 col-form-label">Tanggal Lahir Ahli Waris</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control tanggal_lahir_ahli_waris" id="_tanggal_lahir_ahli_waris" name="_tanggal_lahir_ahli_waris" />
                                                <div class="help-block _tanggal_lahir_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_nohp_ahli_waris" class="col-sm-3 col-form-label">No Handphone Ahli Waris</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control nohp_ahli_waris" id="_nohp_ahli_waris" name="_nohp_ahli_waris" placeholder="No Handphone yang diadukan.. " />
                                                <div class="help-block _nohp_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 mt-2">
                                            <label for="_hubungan_ahli_waris" class="col-sm-3 col-form-label">Hubungan dengan Pemilik Rekening :</label>
                                            <div class="col-sm-8 mt-2">
                                                <select class="form-control select2 hubungan_ahli_waris" id="_hubungan_ahli_waris" name="_hubungan_ahli_waris" style="width: 100%" onchange="changeHubungan(this)">
                                                    <option value=""> --- Pilih Hubungan ---</option>
                                                    <option value="Suami/Istri">Suami/Istri</option>
                                                    <option value="Anah">Anak</option>
                                                    <option value="Ayah/Ibu">Ayah/Ibu</option>
                                                </select>
                                                <div class="help-block _hubungan_ahli_waris"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row mb-2">
                                            <label for="_alamat_ahli_waris" class="col-sm-3 col-form-label">Alamat Ahli Waris</label>
                                            <div class="col-sm-9">
                                                <textarea rows="3" class="form-control alamat_ahli_waris" id="_alamat_ahli_waris" name="_alamat_ahli_waris"></textarea>
                                                <div class="help-block _alamat_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_kecamatan_ahli_waris" class="col-sm-3 col-form-label">Kecamatan (Ahli Waris) :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2 kecamatan_ahli_waris" id="_kecamatan_ahli_waris" name="_kecamatan_ahli_waris" style="width: 100%" onchange="changeKecamatan(this)">
                                                    <option value=""> --- Pilih Kecamatan --- </option>
                                                    <?php if (isset($kecamatans)) { ?>
                                                        <?php if (count($kecamatans) > 0) { ?>
                                                            <?php foreach ($kecamatans as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->kecamatan ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block _kecamatan_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 select2-kelurahan-loading">
                                            <label for="_kelurahan_ahli_waris" class="col-sm-3 col-form-label">Kelurahan (Ahli Waris) :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2 kelurahan_ahli_waris" id="_kelurahan_ahli_waris" name="_kelurahan_ahli_waris" style="width: 100%">
                                                    <option value=""> --- Pilih Kecamatan Dulu --- </option>
                                                </select>
                                                <div class="help-block _kelurahan_ahli_waris"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="_keterangan" class="col-sm-3 col-form-label">Keterangan :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2 keterangan" id="_keterangan" name="_keterangan" style="width: 100%" onchange="changeKeterangan(this)">
                                                    <option value=""> --- Pilih Keterangan ---</option>
                                                    <?php if (isset($jeniss)) {
                                                        if (count($jeniss) > 0) {
                                                            foreach ($jeniss as $key => $value) { ?>
                                                                <option value="<?= $value ?>"><?= $value ?></option>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </select>
                                                <div class="help-block _keterangan"></div>
                                            </div>
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
                            <div class="col-lg-12">
                                <h4>Lampiran Screenshoot Detail Data DTKS/SIKS-NG</h4>
                                <p style="margin-bottom: 30px;">Silahkan lampirkan dokumen screenshoot detail data DTKS/SIKS-NG.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-3">
                                            <label for="_file_screenshoot" class="form-label">Lampiran dokumen pengahli_waris 1: </label>
                                            <input class="form-control" type="file" id="_file_screenshoot" name="_file_screenshoot" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_screenshoot', 'Lampiran Dokumen Screenshoot')" required>
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_screenshoot" for="_file_screenshoot"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4>Lampiran KTP</h4>
                                <p style="margin-bottom: 30px;">Silahkan lampirkan dokumen KTP.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-3">
                                            <label for="_file_ktp" class="form-label">Lampiran dokumen KTP: </label>
                                            <input class="form-control" type="file" id="_file_ktp" name="_file_ktp" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_ktp', 'Lampiran Dokumen KTP')" required>
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_ktp" for="_file_ktp"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4>Lampiran Kartu Keluarga</h4>
                                <p style="margin-bottom: 30px;">Silahkan lampirkan dokumen kartu keluarga.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-3">
                                            <label for="_file_kk" class="form-label">Lampiran dokumen kartu keluarga: </label>
                                            <input class="form-control" type="file" id="_file_kk" name="_file_kk" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_kk', 'Lampiran Dokumen Kartu Keluarga')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_kk" for="_file_kk"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 lampiran-ahli_waris" id="lampiran-ahli_waris" style="display: none;">
                                <h4>Lampiran Surat Keterangan Merantau / Meninggal Dari Kampung / Kelurahan</h4>
                                <p style="margin-bottom: 30px;">Silahkan lampirkan dokumen surat keterangan merantau / meninggal dari kampung / kelurahan.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-3">
                                            <label for="_file_surat_keterangan" class="form-label">Lampiran Surat Keterangan: </label>
                                            <input class="form-control" type="file" id="_file_surat_keterangan" name="_file_surat_keterangan" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_surat_keterangan', 'Lampiran Dokumen Surat Keterangan')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_surat_keterangan" for="_file_surat_keterangan"></div>
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
<script src="<?= base_url() ?>/assets/libs/select2/js/select2.min.js"></script>

<script>
    initSelect2("_keterangan", ".page-content");
    initSelect2("_kecamatan_ahli_waris", ".page-content");
    initSelect2("_kelurahan_ahli_waris", ".page-content");

    $("#formAddData").on("submit", function(e) {
        e.preventDefault();
        const identitasahli_waris = $("input[type='radio'][name='_identitas_pemohon']:checked").val();

        const nama = document.getElementsByName('_nama')[0].value;
        const nik = document.getElementsByName('_nik')[0].value;
        const nohp = document.getElementsByName('_nohp')[0].value;
        const alamat = document.getElementsByName('_alamat')[0].value;
        const nama_kecamatan = document.getElementsByName('_kecamatan')[0].value;
        const nama_kampung = document.getElementsByName('_kampung')[0].value;

        let nama_ahli_waris = document.getElementsByName('_nama_ahli_waris')[0].value;
        let nik_ahli_waris = document.getElementsByName('_nik_ahli_waris')[0].value;
        let tempat_lahir_ahli_waris = document.getElementsByName('_tempat_lahir_ahli_waris')[0].value;
        let tanggal_lahir_ahli_waris = document.getElementsByName('_tanggal_lahir_ahli_waris')[0].value;
        let nohp_ahli_waris = document.getElementsByName('_nohp_ahli_waris')[0].value;
        let alamat_ahli_waris = document.getElementsByName('_alamat_ahli_waris')[0].value;
        let kecamatan_ahli_waris = document.getElementsByName('_kecamatan_ahli_waris')[0].value;
        let kelurahan_ahli_waris = document.getElementsByName('_kelurahan_ahli_waris')[0].value;
        let hubungan_ahli_waris = document.getElementsByName('_hubungan_ahli_waris')[0].value;

        const keterangan = document.getElementsByName('_keterangan')[0].value;

        const fileSs = document.getElementsByName('_file_screenshoot')[0].value;
        const fileKtp = document.getElementsByName('_file_ktp')[0].value;
        const fileKk = document.getElementsByName('_file_kk')[0].value;
        const fileSuratKeterangan = document.getElementsByName('_file_surat_keterangan')[0].value;

        if (identitasahli_waris === "beda") {
            if (nama_ahli_waris === "") {
                $("input#_nama_ahli_waris").css("color", "#dc3545");
                $("input#_nama_ahli_waris").css("border-color", "#dc3545");
                $('._nama_ahli_waris').html('Silahkan masukkan nama ahli waris');
                return;
            }
            if (nik_ahli_waris === "") {
                $("input#_nik_ahli_waris").css("color", "#dc3545");
                $("input#_nik_ahli_waris").css("border-color", "#dc3545");
                $('._nik_ahli_waris').html('Silahkan masukkan NIK ahli waris');
                return;
            }
            if (tempat_lahir_ahli_waris === "") {
                $("input#_tempat_lahir_ahli_waris").css("color", "#dc3545");
                $("input#_tempat_lahir_ahli_waris").css("border-color", "#dc3545");
                $('._tempat_lahir_ahli_waris').html('Silahkan masukkan tempat lahir ahli waris');
                return;
            }
            if (tanggal_lahir_ahli_waris === "") {
                $("input#_tanggal_lahir_ahli_waris").css("color", "#dc3545");
                $("input#_tanggal_lahir_ahli_waris").css("border-color", "#dc3545");
                $('._tanggal_lahir_ahli_waris').html('Silahkan masukkan tanggal lahir ahli waris');
                return;
            }
            if (nohp_ahli_waris === "") {
                $("input#_nohp_ahli_waris").css("color", "#dc3545");
                $("input#_nohp_ahli_waris").css("border-color", "#dc3545");
                $('._nohp_ahli_waris').html('Silahkan masukkan no handphone ahli waris');
                return;
            }

            if (hubungan_ahli_waris === "") {
                $("select#_hubungan_ahli_waris").css("color", "#dc3545");
                $("select#_hubungan_ahli_waris").css("border-color", "#dc3545");
                $('._hubungan_ahli_waris-error').html('Silahkan pilih hubungan');

                Swal.fire(
                    'Peringatan..!!',
                    "Silahkan pilih hubungan.",
                    'warning'
                );
                return false;
            }

            if (keterangan === "") {
                $("select#_keterangan").css("color", "#dc3545");
                $("select#_keterangan").css("border-color", "#dc3545");
                $('._keterangan-error').html('Silahkan pilih keterangan');

                Swal.fire(
                    'Peringatan..!!',
                    "Silahkan pilih keterangan.",
                    'warning'
                );
                return false;
            }

            if (alamat_ahli_waris === "") {
                $("input#_alamat_ahli_waris").css("color", "#dc3545");
                $("input#_alamat_ahli_waris").css("border-color", "#dc3545");
                $('._alamat_ahli_waris').html('Silahkan masukkan alamat ahli waris');
                return;
            }
            if (kecamatan_ahli_waris === "") {
                $("select#_kecamatan_ahli_waris").css("color", "#dc3545");
                $("select#_kecamatan_ahli_waris").css("border-color", "#dc3545");
                $('._kecamatan_ahli_waris').html('Silahkan pilih kecamatan ahli waris');
                return;
            }
            if (kelurahan_ahli_waris === "") {
                $("select#_kelurahan_ahli_waris").css("color", "#dc3545");
                $("select#_kelurahan_ahli_waris").css("border-color", "#dc3545");
                $('._kelurahan_ahli_waris').html('Silahkan pilih kelurahan ahli waris');
                return;
            }
            if (fileSuratKeterangan === "") {
                $('._file_surat_keterangan-error').html('Silahkan lampirkan surat keterangan');

                Swal.fire(
                    'Peringatan..!!',
                    "Silahkan lampirkan surat keterangan.",
                    'warning'
                );
                return false;
            }
        } else {
            nama_ahli_waris = nama;
            nik_ahli_waris = nik;
            nohp_ahli_waris = nohp;
            alamat_ahli_waris = alamat;
            kecamatan_ahli_waris = nama_kecamatan;
            kelurahan_ahli_waris = nama_kampung;
        }

        if (fileSs === "") {
            $('._file_screenshoot-error').html('Silahkan lampirkan screenshoot data detail DTKS / SIKS-NG');

            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan screenshoot data detail DTKS / SIKS-NG.",
                'warning'
            );
            return false;
        }

        if (fileKtp === "") {
            $('._file_ktp-error').html('Silahkan lampirkan KTP');

            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan KTP.",
                'warning'
            );
            return false;
        }
        if (fileKk === "") {
            $('._file_kk-error').html('Silahkan lampirkan Kartu Keluarga');

            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan Keluarga.",
                'warning'
            );
            return false;
        }

        const formUpload = new FormData();

        const file_screenshoot = document.getElementsByName('_file_screenshoot')[0].files[0];
        formUpload.append('_file_screenshoot', file_screenshoot);

        const file_ktp = document.getElementsByName('_file_ktp')[0].files[0];
        formUpload.append('_file_ktp', file_ktp);

        const file_kk = document.getElementsByName('_file_kk')[0].files[0];
        formUpload.append('_file_kk', file_kk);

        if (fileSuratKeterangan !== "") {
            const file_surat = document.getElementsByName('_file_surat')[0].files[0];
            formUpload.append('_file_surat', file_surat);
        }

        formUpload.append('nama', nama);
        formUpload.append('nik', nik);
        formUpload.append('nohp', nohp);
        formUpload.append('alamat', alamat);
        formUpload.append('kecamatan', nama_kecamatan);
        formUpload.append('kelurahan', nama_kampung);
        formUpload.append('nama_ahli_waris', nama_ahli_waris);
        formUpload.append('nik_ahli_waris', nik_ahli_waris);
        formUpload.append('tempat_lahir_ahli_waris', tempat_lahir_ahli_waris);
        formUpload.append('tanggal_lahir_ahli_waris', tanggal_lahir_ahli_waris);
        formUpload.append('hubungan_ahli_waris', hubungan_ahli_waris);
        formUpload.append('nohp_ahli_waris', nohp_ahli_waris);
        formUpload.append('alamat_ahli_waris', alamat_ahli_waris);
        formUpload.append('kecamatan_ahli_waris', kecamatan_ahli_waris);
        formUpload.append('kelurahan_ahli_waris', kelurahan_ahli_waris);
        formUpload.append('keterangan', keterangan);
        formUpload.append('identitas_ahli_waris', identitasahli_waris);

        Swal.fire({
            title: 'Apakah anda yakin ingin mengirim permohonan ini?',
            text: "Kirim Permohonan RPPBKKS : " + kategori,
            showCancelButton: true,
            icon: 'question',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim!'
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

    function changeKecamatan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');

        if (event.value !== "") {
            $.ajax({
                url: './getKelurahan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kelurahan_ahli_waris').html("");
                    $('div.select2-kelurahan-loading').block({
                        message: '<i class="las la-spinner la-spin la-3x la-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resul) {
                    $('div.select2-kelurahan-loading').unblock();
                    if (resul.status == 200) {
                        $('.kelurahan_ahli_waris').html(resul.data);
                    } else {
                        if (resul.status == 401) {
                            Swal.fire(
                                'PERINGATAN!',
                                resul.message,
                                'warning'
                            ).then((valRes) => {
                                reloadPage(resul.redirrect);
                            })
                        } else {
                            Swal.fire(
                                'PERINGATAN!!!',
                                resul.message,
                                'warning'
                            );
                        }
                    }
                },
                error: function(data) {
                    $('div.select2-kelurahan-loading').unblock();
                    Swal.fire(
                        'PERINGATAN!',
                        "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        }
    }

    function changeJenis(event) {
        const color = $(event).attr('name');

        $(event).removeAttr('style');
        $('.' + color).html('');

        if (event.value === "Lainnya") {
            document.getElementById("_keterangan_detail").style.display = "block";
        } else {
            document.getElementById("_keterangan_detail").style.display = "none";
        }
    }

    function changePemohon(event) {
        const color = $(event).attr('name');
        const vPengadu = $("input[type='radio'][name='" + color + "']:checked").val();

        $('.data-ahli_waris').removeAttr('style');
        $('.lampiran-ahli_waris').removeAttr('style');

        if (vPengadu === "sama") {
            document.getElementById("data-ahli_waris").style.display = "none";
            document.getElementById("lampiran-ahli_waris").style.display = "none";
        } else {
            document.getElementById("data-ahli_waris").style.display = "block";
            document.getElementById("lampiran-ahli_waris").style.display = "block";
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

            if (file.size > (5 * 1024 * 1000)) {
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
<link href="<?= base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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