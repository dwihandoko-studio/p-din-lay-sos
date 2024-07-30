<?= $this->extend('t-silastri/adm/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- <div class="row mb-4">
            <div class="col-lg-12">
                <div class="d-flex align-items-center">
                    <img src="<?= base_url() ?>/assets/images/users/avatar-1.jpg" alt="" class="avatar-sm rounded">
                    <div class="ms-3 flex-grow-1">
                        <h5 class="mb-2 card-title">Hello, Henry Franklin</h5>
                        <p class="text-muted mb-0">Ready to jump back in?</p>
                    </div>
                    <div>
                        <a href="javascript:void(0);" class="btn btn-primary"><i class="bx bx-plus align-middle"></i> Add New Jobs</a>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex">
                    <h4 class="card-title mb-4 flex-grow-1">STATISTIK P3KE</h4>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">P3KE Keluarga</p>
                                <h4 class="mb-0 total_p3ke_keluarga" id="total_p3ke_keluarga"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-primary", "--bs-transparent"]' dir="ltr" id="total_p3ke_keluarga_charts"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-body border-top py-3">
                        <p class="mb-0"> <span class="badge badge-soft-info me-1"><i class="bx bx-trending-up align-bottom me-1"></i> 0%</span> Increase last month</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">P3KE Individu</p>
                                <h4 class="mb-0 total_p3ke_individu" id="total_p3ke_individu"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-info", "--bs-transparent"]' dir="ltr" id="total_p3ke_individu_charts"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-body border-top py-3">
                        <p class="mb-0"> <span class="badge badge-soft-success me-1"><i class="bx bx-trending-up align-bottom me-1"></i> 24.07%</span> Increase last month</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">P3KE Sudah Verval</p>
                                <h4 class="mb-0 total_p3ke_sudah_verval" id="total_p3ke_sudah_verval"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-success", "--bs-transparent"]' dir="ltr" id="total_p3ke_sudah_verval_charts"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-body border-top py-3">
                        <p class="mb-0"> <span class="badge badge-soft-danger me-1"><i class="bx bx-trending-down align-bottom me-1"></i> 20.63%</span> Decrease last month</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">P3KE Belum Verval</p>
                                <h4 class="mb-0 total_p3ke_belum_verval" id="total_p3ke_belum_verval"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-danger", "--bs-transparent"]' dir="ltr" id="total_p3ke_belum_verval_charts"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-body border-top py-3">
                        <p class="mb-0"> <span class="badge badge-soft-danger me-1"><i class="bx bx-trending-down align-bottom me-1"></i> 20.63%</span> Decrease last month</p>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex">
                    <h4 class="card-title mb-4 flex-grow-1">INFOGRAFIS</h4>
                    <!-- <div>
                        <a href="#" class="btn btn-primary btn-sm">View All <i class="bx bx-right-arrow-alt"></i></a>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3">
                <a href="javascript:actionDetail('rekap_p3ke_perkecamatan');">
                    <div class="card menu_button_p3ke" style="min-height: 172px;">
                        <div class="card-body p-4">
                            <div class="text-center mb-3">
                                <img src="<?= base_url() ?>/assets/icon_silastri/rekap-pengaduan-wilayah.png" alt="" class="avatar-sm">
                                <span class="text-body">
                                    <h5 class="mt-4 mb-2 font-size-15 text-body">Rekap P3KE Per-Kecamatan</h5>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="javascript:actionDetail('rekap_p3ke_perkecamatan');">
                    <div class="card menu_button_p3ke" style="min-height: 172px;">
                        <div class="card-body p-4">
                            <div class="text-center mb-3">
                                <img src="<?= base_url() ?>/assets/icon_silastri/rekap-approve.png" alt="" class="avatar-sm">
                                <h5 class="mt-4 mb-2 font-size-15">Rekap P3KE Sudah Verval dan Belum Verval</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-air-minum.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Air Minum</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-bahan-bakar.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Bahan Bakar Memasak</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-disabilitas.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Disabilitas</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-ijazah.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Ijazah</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-jenis-dinding.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Jenis Dinding</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-kepemilikan-tempat.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Kepemilikan Tempat</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-partisipasi-sekolah.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Partisipasi Sekolah</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-pekerjaan.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Pekerjaan</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-pendidikan.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Pendidikan</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-penyakit-kronis.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Penyakit Kronis</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-status-kawin.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Status Perkawinan</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="min-height: 172px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <img src="<?= base_url() ?>/assets/icon_silastri/profil-sumber-penerangan.png" alt="" class="avatar-sm">
                            <a href="#" class="text-body">
                                <h5 class="mt-4 mb-2 font-size-15">Sumber Penerangan</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="content-statistikModal" class="modal fade content-statistikModal" tabindex="-1" role="dialog" aria-labelledby="content-statistikModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-loading">
            <div class="modal-header">
                <h5 class="modal-title" id="content-statistikModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="content-statistikBodyModal">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/dashboard-job.init.js"></script>

<script src="<?= base_url() ?>/assets/libs/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/jquery-countdown/jquery.countdown.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/coming-soon.init.js"></script>
<script>
    function actionDetail(event) {
        $.ajax({
            url: "./detailStatistik",
            type: 'POST',
            data: {
                id: event,
            },
            dataType: "json",
            beforeSend: function() {
                Swal.fire({
                    title: 'Sedang Loading . . .',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            complete: function() {},
            success: function(response) {
                if (response.status == 200) {
                    Swal.close();
                    $('#content-statistikModalLabel').html(response.title);
                    $('.content-statistikBodyModal').html(response.data);
                    $('.content-statistikModal').modal({
                        backdrop: 'static',
                        keyboard: false,
                    });
                    $('.content-statistikModal').modal('show');
                } else {
                    Swal.fire(
                        'Failed!',
                        response.message,
                        'warning'
                    );
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire(
                    'Failed!',
                    "gagal mengambil data (" + xhr.status.toString + ")",
                    'warning'
                );
            }

        });
    }

    function getStatistikTop() {
        $.ajax({
            url: "./statistik",
            type: 'POST',
            data: {
                id: 'get',
            },
            dataType: 'JSON',
            beforeSend: function() {},
            success: function(resul) {
                if (resul.status !== 200) {
                    $('.total_p3ke_keluarga').html("0");
                    $('.total_p3ke_individu').html("0");
                    $('.total_p3ke_sudah_verval').html("0");
                    $('.total_p3ke_belum_verval').html("0");
                } else {
                    $('.total_p3ke_keluarga').html(resul.data.total_keluarga.toLocaleString());
                    $('.total_p3ke_individu').html(resul.data.total_individu.toLocaleString());
                    $('.total_p3ke_sudah_verval').html(resul.data.total_sudah_verval.toLocaleString());
                    $('.total_p3ke_belum_verval').html(resul.data.total_belum_verval.toLocaleString());
                }
            }
        });
    }

    $(document).ready(function() {
        getStatistikTop();
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<style>
    ._sorot-mouse:hover {
        background-color: #c3cbe4;
    }

    ._sorot-mouse:hover ._color-h-hover {
        color: #000 !important;
    }

    ._sorot-mouse:hover ._color-p-hover {
        color: #202022 !important;
    }

    .menu_button_p3ke {
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .menu_button_p3ke:hover {
        background-color: #2a3042;
        color: #fff;
    }

    .menu_button_p3ke:hover h5 {
        color: #fff !important;
        /* Add !important to override other styles */
        transition: color 0.3s;
    }

    .menu_button_p3ke h5 {
        transition: color 0.3s;
    }
</style>
<!-- <link href="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.carousel.min.css"> -->

<!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.theme.default.min.css"> -->
<?= $this->endSection(); ?>