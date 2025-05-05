<form id="formAddModalData" action="./uploadSaveRppbkks" method="post" enctype="multipart/form-data">
    <input type="hidden" id="_id" name="_id" value="<?= $id ?>" />
    <input type="hidden" id="_nama" name="_nama" value="<?= $nama ?>" />
    <div class="modal-body">
        <div class="row">
            <?php $dataDecJson = json_decode($data->field_tambahan);
            if ($dataDecJson->identitas_ahli_waris == "beda") { ?>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="_kecamatan" class="col-form-label">Kecamatan Surat Keterangan :</label>
                        <select class="form-control select2 kecamatan" id="_kecamatan" name="_kecamatan" style="width: 100%" onchange="changeKecamatan(this)" required>
                            <option value="">&nbsp;</option>
                            <?php if (isset($kecamatans)) {
                                if (count($kecamatans) > 0) {
                                    foreach ($kecamatans as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->kecamatan ?></option>
                            <?php }
                                }
                            } ?>
                        </select>
                        <div class="help-block _kecamatan"></div>
                    </div>
                    <div class="mb-3 select2-kelurahan-loading">
                        <label for="_kelurahan" class="col-form-label">Kelurahan Surat Keterangan :</label>
                        <select class="form-control select2 kelurahan" id="_kelurahan" name="_kelurahan" style="width: 100%" required>
                            <option value="">&nbsp;</option>
                            <?php if (isset($kelurahans)) {
                                if (count($kelurahans) > 0) {
                                    foreach ($kelurahans as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->kelurahan ?></option>
                            <?php }
                                }
                            } ?>
                        </select>
                        <div class="help-block _kelurahan"></div>
                    </div>
                    <div class="mb-3">
                        <label for="_nomor_surat_keterangan" class="form-label">Nomor Surat Keterangan</label>
                        <input type="text" class="form-control nomor_surat_keterangan" id="_nomor_surat_keterangan" name="_nomor_surat_keterangan" placeholder="Nomor Surat Keterangan..." onfocusin="inputFocus(this);" required>
                        <div class="help-block _nomor_surat_keterangan"></div>
                    </div>
                    <div class="mb-3">
                        <label for="_tgl_surat_keterangan" class="form-label">Tanggal Surat Keterangan</label>
                        <input type="date" class="form-control tgl_surat_keterangan" id="_tgl_surat_keterangan" name="_tgl_surat_keterangan" onfocusin="inputFocus(this);" required>
                        <div class="help-block _tgl_surat_keterangan"></div>
                    </div>
                    <div class="mb-3">
                        <label for="_perihal_surat_keterangan" class="form-label">Perihal Surat Keterangan</label>
                        <input type="text" class="form-control perihal_surat_keterangan" id="_perihal_surat_keterangan" name="_perihal_surat_keterangan" placeholder="Perihal surat keterangan..." onfocusin="inputFocus(this);" required>
                        <div class="help-block _perihal_surat_keterangan"></div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="_nama_bank" class="form-label">Nama Bank</label>
                    <input type="text" class="form-control nama_bank" id="_nama_bank" name="_nama_bank" placeholder="Nama Bank..." onfocusin="inputFocus(this);" required>
                    <div class="help-block _nama_bank"></div>
                </div>
                <div class="mb-3">
                    <label for="_unit_bank" class="form-label">Unit Bank</label>
                    <input type="text" class="form-control unit_bank" id="_unit_bank" name="_unit_bank" placeholder="Unit Bank..." onfocusin="inputFocus(this);" required>
                    <div class="help-block _unit_bank"></div>
                </div>
                <div class="mb-3">
                    <label for="_nomor_rekening" class="form-label">Nomor Rekening KPM</label>
                    <input type="text" class="form-control nomor_rekening" id="_nomor_rekening" name="_nomor_rekening" placeholder="Nomor Rekening..." onfocusin="inputFocus(this);" required>
                    <div class="help-block _nomor_rekening"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="_tujuan_tempat" class="form-label">Tujuan Tempat</label>
                    <input type="text" class="form-control tujuan_tempat" id="_tujuan_tempat" name="_tujuan_tempat" placeholder="Tujuan tempat..." onfocusin="inputFocus(this);" required>
                    <div class="help-block _tujuan_tempat"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="col-8">
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
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
    </div>
</form>

<script>
    <?php $dataDecJson = json_decode($data->field_tambahan);
    if ($dataDecJson->identitas_ahli_waris == "beda") { ?>
        initSelect2("_kecamatan", ".content-detailModal");
        initSelect2("_kelurahan", ".content-detailModal");
    <?php } ?>

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
                    $('.kelurahan').html("");
                    $('div.select2-kelurahan-loading').block({
                        message: '<i class="las la-spinner la-spin la-3x la-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resul) {
                    $('div.select2-kelurahan-loading').unblock();
                    if (resul.status == 200) {
                        $('.kelurahan').html(resul.data);
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

    $("#formAddModalData").on("submit", function(e) {
        e.preventDefault();
        const id = document.getElementsByName('_id')[0].value;
        const nama = document.getElementsByName('_nama')[0].value;
        const nama_bank = document.getElementsByName('_nama_bank')[0].value;
        const unit_bank = document.getElementsByName('_unit_bank')[0].value;
        const nomor_rekening = document.getElementsByName('_nomor_rekening')[0].value;
        const tujuan_tempat = document.getElementsByName('_tujuan_tempat')[0].value;

        const formUpload = new FormData();

        <?php $dataDecJson = json_decode($data->field_tambahan);
        if ($dataDecJson->identitas_ahli_waris == "beda") { ?>
            const kecamatan_keterangan = document.getElementsByName('_kecamatan')[0].value;
            const kelurahan_keterangan = document.getElementsByName('_kelurahan')[0].value;
            const nomor_surat_keterangan = document.getElementsByName('_nomor_surat_keterangan')[0].value;
            const tgl_surat_keterangan = document.getElementsByName('_tgl_surat_keterangan')[0].value;
            const perihal_surat_keterangan = document.getElementsByName('_perihal_surat_keterangan')[0].value;
            formUpload.append('kecamatan_keterangan', kecamatan_keterangan);
            formUpload.append('kelurahan_keterangan', kelurahan_keterangan);
            formUpload.append('nomor_surat_keterangan', nomor_surat_keterangan);
            formUpload.append('tgl_surat_keterangan', tgl_surat_keterangan);
            formUpload.append('perihal_surat_keterangan', perihal_surat_keterangan);
        <?php } ?>

        formUpload.append('id', id);
        formUpload.append('nama', nama);
        formUpload.append('nama_bank', nama_bank);
        formUpload.append('unit_bank', unit_bank);
        formUpload.append('nomor_rekening', nomor_rekening);
        formUpload.append('tempat_surat', tujuan_tempat);

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
            url: "./saverppbkks",
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
                $('div.modal-content-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.modal-content-loading').unblock();

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
                        reloadPage(resul.redirrect);
                        // $.ajax({
                        //     url: "./downloadtemp",
                        //     type: 'POST',
                        //     data: {
                        //         id: resul.id,
                        //         nama: nama,
                        //     },
                        //     dataType: 'JSON',
                        //     beforeSend: function() {
                        //         $('div.modal-content-loading').block({
                        //             message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        //         });
                        //     },
                        //     success: function(result) {
                        //         $('div.modal-content-loading').unblock();
                        //         if (result.status !== 200) {
                        //             Swal.fire(
                        //                 'Failed!',
                        //                 result.message,
                        //                 'warning'
                        //             );
                        //         } else {
                        //             Swal.fire(
                        //                 'SELAMAT!',
                        //                 result.message,
                        //                 'success'
                        //             ).then((valRest) => {
                        //                 reloadPage(result.redirrect);
                        //             })
                        //         }
                        //     },
                        //     error: function() {
                        //         $('div.modal-content-loading').unblock();
                        //         Swal.fire(
                        //             'Failed!',
                        //             "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                        //             'warning'
                        //         );
                        //     }
                        // });
                    })
                }
            },
            error: function(erro) {
                console.log(erro);
                // ambilId("status").innerHTML = "Upload Failed";
                ambilId("status").style.color = "red";
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