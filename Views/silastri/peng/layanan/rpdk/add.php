<?= $this->extend('t-silastri/peng/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Buat Permohonan Rekomendasi Penerbitan Dokumen Kependudukan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-xl-12">
            <form id="formAddData" action="./addSave" method="post" enctype="multipart/form-data">
                <div class="card mb-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Permohonan Surat Rekomendasi Penerbitan Dokumen Kependudukan Bagi Warga Binaan LKS/LKSA</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Data Pemohon</h4>
                            </div>
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
                                    <label for="_no_hp" class="col-sm-3 col-form-label">No HP.</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_no_hp" name="_no_hp" value="<?= $data->no_hp ?>" placeholder="No handphone.. " readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_kecamatan" name="_kecamatan" value="<?= getNamaKecamatan($data->kecamatan) ?>" placeholder="Kecamatan.. " readonly />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_kelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="_kelurahan" name="_kelurahan" value="<?= getNamaKelurahan($data->kelurahan) ?>" placeholder="Kelurahan.. " readonly />
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
                                <h4>Data yang Diajukan</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_nama_lembaga" class="form-label">Nama LKS / LKSA</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="_nama_lembaga" name="_nama_lembaga" placeholder="Nama Lembaga.. " required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_nama_pimpinan" class="form-label">Nama pimpinan LKS / LKSA</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="_nama_pimpinan" name="_nama_pimpinan" placeholder="Nama pimpinan.. " required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_no_surat_permohonan_lks" class="form-label">No Surat Permohonan LKS / LKSA</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="_no_surat_permohonan_lks" name="_no_surat_permohonan_lks" placeholder="No surat permohonan.. " required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_tgl_surat_permohonan_lks" class="form-label">Tanggal Surat Permohonan LKS / LKSA</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="_tgl_surat_permohonan_lks" name="_tgl_surat_permohonan_lks" required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_no_izin_lks" class="form-label">No Izin LKS / LKSA</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="_no_izin_lks" name="_no_izin_lks" placeholder="No Izin LKS / LKSA.. " required />
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2 mb-2">
                                    <label class="form-label">Kecamatan:</label>
                                    <select class="form-control select2 kecamatan_domisili" onchange="changeKecamatanDomisili(this)" id="_kecamatan_domisili" name="_kecamatan_domisili" style="width: 100%">
                                        <option value=""> --- Pilih Kecamatan --- </option>
                                        <?php if (isset($kecamatans)) { ?>
                                            <?php if (count($kecamatans) > 0) { ?>
                                                <?php foreach ($kecamatans as $key => $value) { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->kecamatan ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block _kecamatan_domisili"></div>
                                </div>
                                <div class="col-lg-12 mt-2 mb-2 select2-kelurahan-domisili-loading">
                                    <label class="form-label">Kelurahan:</label>
                                    <select class="form-control select2 kelurahan_domisili" id="_kelurahan_domisili" name="_kelurahan_domisili" style="width: 100%">
                                        <option value=""> --- Pilih Kelurahan --- </option>
                                        <?php if (isset($kelurahans)) { ?>
                                            <?php if (count($kelurahans) > 0) { ?>
                                                <?php foreach ($kelurahans as $key => $value) { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->kelurahan ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block _kelurahan_domisili"></div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_alamat" class="form-label">Alamat</label>
                                    <div class="col-sm-12">
                                        <textarea rows="5" class="form-control" id="_alamat" name="_alamat" placeholder="Alamat..." required></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <label for="_nama_ppks" class="form-label">Nama PPKS</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="_nama_ppks" name="_nama_ppks" placeholder="Nama PPKS.. " required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_tempat_lahir_ppks" class="form-label">Tempat Lahir PPKS</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="_tempat_lahir_ppks" name="_tempat_lahir_ppks" placeholder="Tempat lahir PPKS.. " required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="_tanggal_lahir_ppks" class="form-label">Tanggal Lahir PPKS</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="_tanggal_lahir_ppks" name="_tanggal_lahir_ppks" placeholder="Tanggal lahir PPKS.. " required />
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2 mt-2">
                                    <label for="group_ppks" class="form-label">Group PPKS:</label>
                                    <select class="form-control select2 select2-table group_ppks"
                                        id="_group_ppks"
                                        name="_group_ppks"
                                        style="width: 100%"
                                        onchange="changeGroupPpks(this)"
                                        aria-label="Pilih Group PPKS" required>
                                        <option value=""> --- Pilih Group PPKS --- </option>
                                        <?php if (isset($group_ppks)) { ?>
                                            <?php if (count($group_ppks) > 0) { ?>
                                                <?php foreach ($group_ppks as $key => $value) { ?>
                                                    <option value="<?= $value->group_id ?>"><?= $value->group_name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block help-block-ppks" role="alert"></div>
                                </div>
                                <div class="col-lg-12 mb-2 mt-2">
                                    <label for="kategori_ppks" class="form-label">Kategori PPKS:</label>
                                    <select class="form-control select2 select2-table kategori_ppks"
                                        id="_kategori_ppks"
                                        name="_kategori_ppks"
                                        style="width: 100%"
                                        aria-label="Pilih Kategori PPKS" required>
                                        <option value=""> --- Pilih Kategori PPKS --- </option>
                                    </select>
                                    <div class="help-block help-block-ppks" role="alert"></div>
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
                                    <label for="_jenis" class="col-sm-3 col-form-label">Jenis Rekomendasi PBI :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 pekerjaan" id="_jenis" name="_jenis" style="width: 100%" onchange="changeJenis(this)">
                                            <option value=""> --- Pilih Rekomendasi PBI ---</option>
                                            <?php if (isset($jeniss)) {
                                                if (count($jeniss) > 0) {
                                                    foreach ($jeniss as $key => $value) { ?>
                                                        <option value="<?= $value ?>"><?= $value ?></option>
                                            <?php }
                                                }
                                            } ?>
                                        </select>
                                        <textarea rows="3" style="display: none; margin-top: 10px;" id="_jenis_detail" name="_jenis_detail" class="form-control" placeholder="Masukan keterangan peruntukan SKTM.."></textarea>
                                        <div class="help-block _jenis"></div>
                                        <div class="help-block _jenis_detail"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="card mt-0 mb-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Lampiran Dokumen Permohonan</h4>
                                <p style="margin-bottom: 30px;">Silahkan lampirkan dokumen permohonan (Surat usulan dari LKS/LKSA, Foto PPKS, Dokumen Lainnya).</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_foto_ppks" class="form-label">Lampiran Foto PPKS : </label>
                                            <input class="form-control" type="file" id="_file_foto_ppks" name="_file_foto_ppks" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_foto_ppks', 'Foto')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_foto_ppks" for="_file_foto_ppks"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="preview-image-upload-foto">
                                                <img class="imagePreviewUploadFoto" id="imagePreviewUploadFoto" />
                                                <button onclick="removeLampiran('_file_foto_ppks', 'Foto')" type="button" class="btn-remove-preview-image-ktp">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_surat_usulan" class="form-label">Lampiran Surat Usulan dari LKS / LKSA : </label>
                                            <input class="form-control" type="file" id="_file_surat_usulan" name="_file_surat_usulan" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_surat_usulan', 'Surat')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_surat_usulan" for="_file_surat_usulan"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="preview-image-upload-surat">
                                                <img class="imagePreviewUploadSurat" id="imagePreviewUploadSurat" />
                                                <button onclick="removeLampiran('_file_surat_usulan', 'Surat')" type="button" class="btn-remove-preview-image-kk">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label for="_file_doc_lain" class="form-label">Lampiran Dokumen Lainnya : </label>
                                            <!-- <p class="font-size-11">&nbsp;&nbsp;Template surat pernyataan miskin dapat di download pada : <a class="menu-badge badge-info" href="#">Link Berikut...</a></p> -->
                                            <input class="form-control" type="file" id="_file_doc_lain" name="_file_doc_lain" onFocus="inputFocus(this);" accept="image/*,application/pdf" onchange="loadFile('_file_doc_lain', 'Dokumen Lainnya')">
                                            <p class="font-size-11">Format : <code data-toggle="tooltip" data-placement="bottom" title="jpg, png, jpeg, pdf">Files</code> and Maximum File Size <code>2 Mb</code></p>
                                            <div class="help-block _file_doc_lain" for="_file_doc_lain"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="preview-image-upload-lain">
                                                <img class="imagePreviewUploadLain" id="imagePreviewUploadLain" />
                                                <button onclick="removeLampiran('_file_doc_lain', 'Dokumen Lainnya')" type="button" class="btn-remove-preview-image-pernyataan">Remove</button>
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
        // const indikator1 = $("input[type='radio'][name='_indikator_1']:checked").val();
        // const indikator2 = $("input[type='radio'][name='_indikator_2']:checked").val();
        // const indikator3 = $("input[type='radio'][name='_indikator_3']:checked").val();
        // const indikator4 = $("input[type='radio'][name='_indikator_4']:checked").val();
        // const indikator5 = $("input[type='radio'][name='_indikator_5']:checked").val();
        // const indikator6 = $("input[type='radio'][name='_indikator_6']:checked").val();

        const nama = document.getElementsByName('_nama')[0].value;
        const nik = document.getElementsByName('_nik')[0].value;
        const kk = document.getElementsByName('_kk')[0].value;

        const nama_ppks = document.getElementsByName('_nama_ppks')[0].value;
        const tempat_lahir_ppks = document.getElementsByName('_tempat_lahir_ppks')[0].value;
        const tanggal_lahir_ppks = document.getElementsByName('_tanggal_lahir_ppks')[0].value;
        const nama_lembaga = document.getElementsByName('_nama_lembaga')[0].value;
        const nama_pimpinan = document.getElementsByName('_nama_pimpinan')[0].value;
        const no_surat_permohonan_lks = document.getElementsByName('_no_surat_permohonan_lks')[0].value;
        const tgl_surat_permohonan_lks = document.getElementsByName('_tgl_surat_permohonan_lks')[0].value;
        const no_izin_lks = document.getElementsByName('_no_izin_lks')[0].value;
        const kecamatan_domisili = document.getElementsByName('_kecamatan_domisili')[0].value;
        const kelurahan_domisili = document.getElementsByName('_kelurahan_domisili')[0].value;
        const alamat = document.getElementsByName('_alamat')[0].value;
        const kategori_ppks = document.getElementsByName('_kategori_ppks')[0].value;

        const fileFoto = document.getElementsByName('_file_foto_ppks')[0].value;
        const fileSurat = document.getElementsByName('_file_surat_usulan')[0].value;
        const fileLain = document.getElementsByName('_file_doc_lain')[0].value;

        if (nama_ppks === undefined || nama_ppks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan nama ppks.",
                'warning'
            );
            return;
        }
        if (tempat_lahir_ppks === undefined || tempat_lahir_ppks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan tempat lahir ppks.",
                'warning'
            );
            return;
        }
        if (tanggal_lahir_ppks === undefined || tanggal_lahir_ppks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan tanggal lahir ppks.",
                'warning'
            );
            return;
        }
        if (nama_lembaga === undefined || nama_lembaga === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan nama lembaga.",
                'warning'
            );
            return;
        }
        if (nama_pimpinan === undefined || nama_pimpinan === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan nama pimpinan.",
                'warning'
            );
            return;
        }
        if (no_izin_lks === undefined || no_izin_lks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan no izin lks.",
                'warning'
            );
            return;
        }
        if (no_surat_permohonan_lks === undefined || no_surat_permohonan_lks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan no surat permohonan.",
                'warning'
            );
            return;
        }
        if (tgl_surat_permohonan_lks === undefined || tgl_surat_permohonan_lks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukan tanggal surat permohonan.",
                'warning'
            );
            return;
        }
        if (kecamatan_domisili === undefined || kecamatan_domisili === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih kecamatan.",
                'warning'
            );
            return;
        }
        if (kelurahan_domisili === undefined || kelurahan_domisili === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih kelurahan.",
                'warning'
            );
            return;
        }
        if (alamat === undefined || alamat === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan masukkan alamat.",
                'warning'
            );
            return;
        }
        if (kategori_ppks === undefined || kategori_ppks === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan pilih kategori ppks.",
                'warning'
            );
            return;
        }
        if (fileFoto === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan Foto PPKS.",
                'warning'
            );
            return;
        }
        if (fileSurat === "") {
            Swal.fire(
                'Peringatan..!!',
                "Silahkan lampirkan surat usulan dari LKS / LKSA.",
                'warning'
            );
            return;
        }

        const formUpload = new FormData();

        const file_foto = document.getElementsByName('_file_foto_ppks')[0].files[0];
        formUpload.append('_file_foto', file_foto);
        const file_surat = document.getElementsByName('_file_surat_usulan')[0].files[0];
        formUpload.append('_file_surat', file_surat);
        if (fileLain !== "") {
            const file_lain = document.getElementsByName('_file_doc_lain')[0].files[0];
            formUpload.append('_file_lain', file_lain);
        }

        formUpload.append('nama', nama);
        formUpload.append('nik', nik);
        formUpload.append('kk', kk);
        formUpload.append('nama_ppks', nama_ppks);
        formUpload.append('tempat_lahir_ppks', tempat_lahir_ppks);
        formUpload.append('tanggal_lahir_ppks', tanggal_lahir_ppks);
        formUpload.append('nama_lembaga', nama_lembaga);
        formUpload.append('nama_pimpinan', nama_pimpinan);
        formUpload.append('no_izin_lks', no_izin_lks);
        formUpload.append('no_surat_permohonan_lks', no_surat_permohonan_lks);
        formUpload.append('tgl_surat_permohonan_lks', tgl_surat_permohonan_lks);
        formUpload.append('kecamatan', kecamatan_domisili);
        formUpload.append('kelurahan', kelurahan_domisili);
        formUpload.append('alamat', alamat);
        formUpload.append('kategori_ppks', kategori_ppks);

        Swal.fire({
            title: 'Apakah anda yakin ingin mengajukan permohonan data ini?',
            text: "Ajukan permohonan : Rekomendasi Penerbitan Dokumen Kependudukan",
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

    function changeGroupPpks(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');

        const loadingText = 'Memuat data...';
        $('.kategori_ppks').html(`<option>${loadingText}</option>`);
        $('.kategori_ppks').prop('disabled', true);

        if (event.value !== "") {
            $.ajax({
                url: './getKategoriPpks',
                type: 'POST',
                data: {
                    group_id: event.value,
                },
                dataType: 'JSON',
                // beforeSend: function() {
                //     $('.kelurahan_lembaga').html("");
                //     $('div.select2-kelurahan-loading').block({
                //         message: '<i class="las la-spinner la-spin la-3x la-fw"></i><span class="sr-only">Loading...</span>'
                //     });
                // },
                success: function(response) {
                    let options = '<option value=""> --- Pilih Kategori PPKS --- </option>';

                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(item) {
                            options += `<option value="${item.id}">${item.sub_jenis}</option>`;
                        });
                    }

                    $('.kategori_ppks').html(options);
                    $('.kategori_ppks').prop('disabled', false);
                    $('.kategori_ppks').trigger('change');
                },
                error: function(data) {
                    $('.kategori_ppks').html('<option value=""> --- Pilih Kategori PPKS --- </option>');
                    $('.kategori_ppks').prop('disabled', false);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal mengambil data kategori PPKS',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    }

    function changeKecamatanDomisili(event) {
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
                    $('.kelurahan_domisili').html("");
                    $('div.select2-kelurahan-domisili-loading').block({
                        message: '<i class="las la-spinner la-spin la-3x la-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resul) {
                    $('div.select2-kelurahan-domisili-loading').unblock();
                    if (resul.status == 200) {
                        $('.kelurahan_domisili').html(resul.data);
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
                    $('div.select2-kelurahan-domisili-loading').unblock();
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