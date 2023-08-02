<?= $this->extend('t-silastri/peng/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">RIWAYAT PERMOHONAN & PENGADUAN</h4>

                    <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Blog</li>
                        </ol>
                    </div> -->

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Data Riwayat Permohonan</h4>
                        <div data-simplebar="init" style="max-height: 420px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                            <div class="simplebar-content loading-content-data-permohonan" style="padding: 0px;">
                                                <ul class="verti-timeline list-unstyled datas-permohonan" id="datas-permohonan">

                                                </ul>
                                                <div class="text-center mt-4"><a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 504px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar" style="height: 292px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Data Riwayat Pengaduan</h4>
                        <div data-simplebar="init" style="max-height: 420px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" style="height: auto; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                            <div class="simplebar-content loading-content-data-pengaduan" style="padding: 0px;">
                                                <ul class="verti-timeline list-unstyled datas-pengaduan" id="datas-pengaduan">

                                                </ul>
                                                <div class="text-center mt-4"><a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 504px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar" style="height: 292px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content-aktivasiModal" class="modal fade content-aktivasiModal" tabindex="-1" role="dialog" aria-labelledby="content-aktivasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-loading">
            <div class="modal-header">
                <h5 class="modal-title" id="content-aktivasiModalLabel">Aktivasi</h5>
            </div>
            <div class="contentAktivasiBodyModal">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url() ?>/assets/libs/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/jquery-countdown/jquery.countdown.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/coming-soon.init.js"></script>
<script>
    function loadAllPengaduan() {
        $.ajax({
            url: "./getAllPengaduan",
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                $('div.loading-content-data-pengaduan').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.loading-content-data-pengaduan').unblock();
                if (resul.status !== 200) {
                    if (resul.status === 401) {
                        Swal.fire(
                            'PERINGATAN!',
                            resul.message,
                            'warning'
                        ).then((valRes) => {
                            reloadPage();
                        });
                    } else {
                        Swal.fire(
                            'PERINGATAN!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {
                    const ulPengaduan = document.querySelector('.datas-pengaduan');
                    for (let index = 0; index < resul.data.length; index++) {
                        ulPengaduan.appendChild('<li class="event-list">' +
                            '<div class="event-timeline-dot">' +
                            '<i class="' + resul.data[index].icon + ' font-size-18"></i>' +
                            '</div>' +
                            '<div class="d-flex">' +
                            '<div class="flex-shrink-0 me-3">' +
                            '<div class="avatar-xs">' +
                            '<div class="avatar-title bg-primary text-primary bg-soft rounded-circle">' +
                            '<i class="bx bx-revision font-size-14"></i>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="flex-grow-1">' +
                            '<div>' +
                            resul.data[index].keterangan +
                            '<p class="text-muted mb-0">' + getTimeAgo(resul.data[index].created_at) + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</li>');
                    }
                }
            },
            error: function() {
                $('div.loading-content-data-pengaduan').unblock();
                Swal.fire(
                    'Failed!',
                    "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function loadAllPermohonan() {
        $.ajax({
            url: "./getAllPermohonan",
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                $('div.loading-content-data-permohonan').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.loading-content-data-permohonan').unblock();
                if (resul.status !== 200) {
                    if (resul.status === 401) {
                        Swal.fire(
                            'PERINGATAN!',
                            resul.message,
                            'warning'
                        ).then((valRes) => {
                            reloadPage();
                        });
                    } else {
                        Swal.fire(
                            'PERINGATAN!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {
                    const ulPengaduan = document.querySelector('.datas-permohonan');
                    for (let index = 0; index < resul.data.length; index++) {
                        ulPengaduan.appendChild('<li class="event-list">' +
                            '<div class="event-timeline-dot">' +
                            '<i class="' + resul.data[index].icon + ' font-size-18"></i>' +
                            '</div>' +
                            '<div class="d-flex">' +
                            '<div class="flex-shrink-0 me-3">' +
                            '<div class="avatar-xs">' +
                            '<div class="avatar-title bg-primary text-primary bg-soft rounded-circle">' +
                            '<i class="bx bx-revision font-size-14"></i>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="flex-grow-1">' +
                            '<div>' +
                            resul.data[index].keterangan +
                            '<p class="text-muted mb-0">' + getTimeAgo(resul.data[index].created_at) + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</li>');
                    }
                }
            },
            error: function() {
                $('div.loading-content-data-permohonan').unblock();
                Swal.fire(
                    'Failed!',
                    "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    $(document).ready(function() {
        loadAllPengaduan();
        loadAllPermohonan();

        // $("#timeline-carousel").owlCarousel({
        //     items: 1,
        //     loop: !1,
        //     margin: 0,
        //     nav: !0,
        //     navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
        //     dots: !1,
        //     responsive: {
        //         576: {
        //             items: 3
        //         },
        //         768: {
        //             items: 6
        //         }
        //     }
        // });
    });

    function aksiAktivasiWa(event) {
        $.ajax({
            url: './home/getAktivasiWa',
            type: 'POST',
            data: {
                id: 'wa',
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('.aktivasi-button-wa').attr('disabled', true);
                $('div.modal-content-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.modal-content-loading').unblock();
                if (resul.status == 200) {
                    $('.contentAktivasiBodyModal').html(resul.data);
                } else {
                    if (resul.status == 404) {
                        Swal.fire(
                            'PERINGATAN!',
                            resul.message,
                            'warning'
                        ).then((valRes) => {
                            reloadPage(resul.redirrect);
                        })
                    } else {
                        if (resul.status == 401) {
                            Swal.fire(
                                'PERINGATAN!',
                                resul.message,
                                'warning'
                            ).then((valRes) => {
                                reloadPage();
                            })
                        } else {
                            $('.aktivasi-button-wa').attr('disabled', false);
                            Swal.fire(
                                'PERINGATAN!!!',
                                resul.message,
                                'warning'
                            );
                        }
                    }
                }
            },
            error: function(data) {
                $('.aktivasi-button-wa').attr('disabled', false);
                $('div.modal-content-loading').unblock();
                Swal.fire(
                    'PERINGATAN!',
                    "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function getTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const timeDifferenceInSeconds = Math.floor((now - date) / 1000);

        if (timeDifferenceInSeconds < 60) {
            return `${timeDifferenceInSeconds} seconds ago`;
        } else if (timeDifferenceInSeconds < 3600) {
            const minutes = Math.floor(timeDifferenceInSeconds / 60);
            return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
        } else if (timeDifferenceInSeconds < 86400) {
            const hours = Math.floor(timeDifferenceInSeconds / 3600);
            return `${hours} hour${hours > 1 ? 's' : ''} ago`;
        } else if (timeDifferenceInSeconds < 2592000) {
            const days = Math.floor(timeDifferenceInSeconds / 86400);
            return `${days} day${days > 1 ? 's' : ''} ago`;
        } else if (timeDifferenceInSeconds < 31536000) {
            const months = Math.floor(timeDifferenceInSeconds / 2592000);
            return `${months} month${months > 1 ? 's' : ''} ago`;
        } else {
            const years = Math.floor(timeDifferenceInSeconds / 31536000);
            return `${years} year${years > 1 ? 's' : ''} ago`;
        }
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link href="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.carousel.min.css">

<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.theme.default.min.css">
<?= $this->endSection(); ?>