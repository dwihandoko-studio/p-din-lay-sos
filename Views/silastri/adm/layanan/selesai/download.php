<?php if (isset($layanans)) { ?>
    <form id="formAddModalData" action="./aksidownload" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">

                    <label for="_layanan" class="form-label">Pilih Layanan:</label>
                    <select class="form-control" id="_layanan" name="_layanan" required>
                        <option value="">--------------------------------------------</option>
                        <?php if (isset($layanans)) { ?>
                            <?php if (count($layanans) > 0) { ?>
                                <?php foreach ($layanans as $key) { ?>
                                    <option value="<?= $key ?>"><?= $key ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <div class="help-block _layanan"></div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="mb-3">
                        <label for="_tgl_awal" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="_tgl_awal" name="_tgl_awal" required>
                        <div class="help-block _tgl_awal"></div>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="mb-3">
                        <label for="_tgl_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="_tgl_akhir" name="_tgl_akhir" required>
                        <div class="help-block _tgl_akhir"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-4">
                        <h5 class="font-size-14 mb-4">Format Download</h5>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" value="pdf" name="_type_file" id="formRadios1">
                            <label class="form-check-label" for="formRadios1">
                                PDF
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="xlsx" name="_type_file" id="formRadios2" checked="">
                            <label class="form-check-label" for="formRadios2">
                                Excel
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Download</button>
        </div>
    </form>

    <script>
        initSelect2("_layanan", ".content-detailModal");

        $("#formAddModalData").on("submit", function(e) {
            e.preventDefault();
            const layanan = document.getElementsByName('_layanan')[0].value;
            const tgl_awal = document.getElementsByName('_tgl_awal')[0].value;
            const tgl_akhir = document.getElementsByName('_tgl_akhir')[0].value;
            var radios = document.getElementsByName('_type_file');
            var selectedValue = "";
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    selectedValue = radios[i].value;
                    break;
                }
            }

            if (layanan === "") {
                Swal.fire(
                    'PERINGATAN!',
                    "Layanan harus dipilih",
                    'warning'
                );
                return;
            }

            if (tgl_awal === "") {
                Swal.fire(
                    'PERINGATAN!',
                    "Tanggal awal tidak boleh kosong",
                    'warning'
                );
                return;
            }

            if (tgl_akhir === "") {
                Swal.fire(
                    'PERINGATAN!',
                    "Tanggal akhir tidak boleh kosong",
                    'warning'
                );
                return;
            }

            const formUpload = new FormData();
            formUpload.append('layanan', layanan);
            formUpload.append('tgl_awal', tgl_awal);
            formUpload.append('tgl_akhir', tgl_akhir);
            formUpload.append('type_file', selectedValue);

            $.ajax({
                url: "./aksidownload",
                type: 'POST',
                data: formUpload,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                beforeSend: function() {
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
                        window.open(resul.url, "_blank");
                        Swal.fire(
                            'SELAMAT!',
                            resul.message,
                            'success'
                        ).then((valRes) => {
                            reloadPage();
                            window.open(resul.url, "_blank");
                            // window.open(resul.url, 'popup', 'width=600,height=600');
                            return false;
                        })
                    }
                },
                error: function(erro) {
                    console.log(erro);
                    $('div.modal-content-loading').unblock();
                    Swal.fire(
                        'PERINGATAN!',
                        "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        });
    </script>
<?php } ?>