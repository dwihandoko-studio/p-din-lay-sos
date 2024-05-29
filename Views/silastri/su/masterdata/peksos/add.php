<form id="formAddModalData" action="./addSave" method="post" enctype="multipart/form-data">
    <div class="modal-body loading-get-data">
        <div class="row">
            <div class="col-lg-6">
                <label for="_nik" class="col-form-label">NIK:</label>
                <input type="number" class="form-control nip" id="_nik" name="_nik" placeholder="NIK..." onfocusin="inputFocus(this);" required />
                <div class="help-block _nik"></div>
            </div>
            <div class="col-lg-6">
                <label for="_nip" class="col-form-label">NIP:</label>
                <input type="text" class="form-control nip" id="_nip" name="_nip" placeholder="NIP..." onfocusin="inputFocus(this);" required />
                <div class="help-block _nip"></div>
            </div>
            <div class="col-lg-6">
                <label for="_fullname" class="col-form-label">Nama Lengkap:</label>
                <input type="text" class="form-control fullname" id="_fullname" name="_fullname" placeholder="Fullname..." onfocusin="inputFocus(this);" required />
                <div class="help-block _fullname"></div>
            </div>
            <div class="col-lg-6">
                <label for="_jabatan" class="col-form-label">Jabatan:</label>
                <input type="text" class="form-control jabatan" id="_jabatan" name="_jabatan" placeholder="Jabatan..." onfocusin="inputFocus(this);" required />
                <div class="help-block _jabatan"></div>
            </div>
            <div class="col-lg-6">
                <label for="_pangkat_golongan" class="col-form-label">Pangkat Golongan:</label>
                <input type="text" class="form-control pangkat_golongan" id="_pangkat_golongan" name="_pangkat_golongan" placeholder="Pangkat golongan..." onfocusin="inputFocus(this);" required />
                <div class="help-block _pangkat_golongan"></div>
            </div>
            <div class="col-lg-6">
                <label for="_jenis" class="col-form-label">Jenis:</label>
                <input type="text" class="form-control jenis" id="_jenis" name="_jenis" placeholder="Jenis..." onfocusin="inputFocus(this);" required />
                <div class="help-block _jenis"></div>
            </div>
            <div class="col-lg-6">
                <label for="_email" class="col-form-label">E-mail:</label>
                <input type="email" class="form-control email" id="_email" name="_email" placeholder="E-mail..." onfocusin="inputFocus(this);" required />
                <div class="help-block _email"></div>
            </div>
            <div class="col-lg-6">
                <label for="_nohp" class="col-form-label">No Handphone:</label>
                <input type="tel" class="form-control nohp" id="_nohp" name="_nohp" placeholder="+62..." onfocusin="inputFocus(this);" required />
                <div class="help-block _nohp"></div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="row mb-2">
                    <label for="_kecamatan" class="col-sm-3 col-form-label">Kecamatan :</label>
                    <div class="col-sm-8">
                        <select class="form-control select2 kecamatan" id="_kecamatan" name="_kecamatan" style="width: 100%" onchange="changeKecamatan(this)" required>
                            <option value=""> --- Pilih Kecamatan --- </option>
                            <?php if (isset($kecamatans)) { ?>
                                <?php if (count($kecamatans) > 0) { ?>
                                    <?php foreach ($kecamatans as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->kecamatan ?></option>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div class="help-block _kecamatan"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="row mb-2 select2-kelurahan-loading">
                    <label for="_kelurahan" class="col-sm-3 col-form-label">Kelurahan :</label>
                    <div class="col-sm-8">
                        <select class="form-control select2 kelurahan" id="_kelurahan" name="_kelurahan" style="width: 100%" required>
                            <option value=""> --- Pilih Kecamatan Dulu --- </option>
                        </select>
                        <div class="help-block _kelurahan"></div>
                    </div>
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
    initSelect2("_kecamatan", ".content-detailModal");
    initSelect2("_kelurahan", ".content-detailModal");

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
        const fullname = document.getElementsByName('_fullname')[0].value;
        const nik = document.getElementsByName('_nik')[0].value;
        const email = document.getElementsByName('_email')[0].value;
        const nohp = document.getElementsByName('_nohp')[0].value;
        const fileName = document.getElementsByName('_file')[0].value;
        const role = document.getElementsByName('_role')[0].value;
        const wilayah = document.getElementsByName('_wilayah')[0].value;

        let status;
        if ($('#status_publikasi').is(":checked")) {
            status = "1";
        } else {
            status = "0";
        }

        if (role === "") {
            $("select#_role").css("color", "#dc3545");
            $("select#_role").css("border-color", "#dc3545");
            $('._role').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">Silahkan pilih Role Pengguna terlebih dahulu.</li></ul>');
            return false;
        }

        if (wilayah === "") {
            $("select#_wilayah").css("color", "#dc3545");
            $("select#_wilayah").css("border-color", "#dc3545");
            $('._wilayah').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">Silahkan pilih Wilayah Pengguna terlebih dahulu.</li></ul>');
            return false;
        }

        if (fullname === "") {
            $("input#_fullname").css("color", "#dc3545");
            $("input#_fullname").css("border-color", "#dc3545");
            $('._fullname').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">Fullname tidak boleh kosong.</li></ul>');
            return false;
        }

        if (fullname.length < 3) {
            $("input#_fullname").css("color", "#dc3545");
            $("input#_fullname").css("border-color", "#dc3545");
            $('._fullname').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">Fullname minimal 3 karakter.</li></ul>');
            return false;
        }

        if (nik === "") {
            $("input#_nik").css("color", "#dc3545");
            $("input#_nik").css("border-color", "#dc3545");
            $('._nik').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">NIK tidak boleh kosong. Jika belum mempunya NIP silahkan isi dengan tanda (-). </li></ul>');
            return false;
        }

        if (email === "") {
            $("input#_email").css("color", "#dc3545");
            $("input#_email").css("border-color", "#dc3545");
            $('._email').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">Email tidak boleh kosong.</li></ul>');
            return false;
        }

        if (nohp === "") {
            $("input#_nohp").css("color", "#dc3545");
            $("input#_nohp").css("border-color", "#dc3545");
            $('._nohp').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">No Handphone tidak boleh kosong.</li></ul>');
            return false;
        }

        if (nohp.length < 9) {
            $("input#_nohp").css("color", "#dc3545");
            $("input#_nohp").css("border-color", "#dc3545");
            $('._nohp').html('<ul role="alert" style="color: #dc3545; list-style-type:none; padding-inline-start: 10px;"><li style="color: #dc3545;">No Handphone minimal 9 karakter.</li></ul>');
            return false;
        }

        if (fileName === "") {
            Swal.fire(
                "Peringatan!",
                "Foto pengguna belum dipilih.",
                "warning"
            );
            return true;
        }

        const formUpload = new FormData();
        const file = document.getElementsByName('_file')[0].files[0];
        formUpload.append('file', file);
        formUpload.append('nama', fullname);
        formUpload.append('nik', nik);
        formUpload.append('email', email);
        formUpload.append('nohp', nohp);
        formUpload.append('status', status);
        formUpload.append('role', role);
        formUpload.append('wilayah', wilayah);

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
                $('div.modal-content-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.modal-content-loading').unblock();

                if (resul.status !== 200) {
                    ambilId("status").innerHTML = "";
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
                    ambilId("status").innerHTML = "";
                    ambilId("status").style.color = "green";
                    ambilId("progressBar").value = 100;
                    Swal.fire(
                        'SELAMAT!',
                        resul.message,
                        'success'
                    ).then((valRes) => {
                        reloadPage();
                    })
                }
            },
            error: function(erro) {
                console.log(erro);
                ambilId("status").innerHTML = "";
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