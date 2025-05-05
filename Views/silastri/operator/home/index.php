<?= $this->extend('t-silastri/operator/index'); ?>

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
                    <h4 class="card-title mb-4 flex-grow-1">STATISTIK PENGADUAN</h4>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Antrian</p>
                                <h4 class="mb-0 statistik-jumlah-antrian-pengaduan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-info", "--bs-transparent"]' dir="ltr" id="total_jumlah_antrian_pengaduan"></div>
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
                                <p class="text-muted fw-medium">Diproses</p>
                                <h4 class="mb-0 statistik-jumlah-diproses-pengaduan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-warning", "--bs-transparent"]' dir="ltr" id="total_jumlah_diproses_pengaduan"></div>
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
                                <p class="text-muted fw-medium">Selesai</p>
                                <h4 class="mb-0 statistik-jumlah-selesai-pengaduan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-success", "--bs-transparent"]' dir="ltr" id="total_jumlah_selesai_pengaduan"></div>
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
                                <p class="text-muted fw-medium">Ditolak</p>
                                <h4 class="mb-0 statistik-jumlah-ditolak-pengaduan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-danger", "--bs-transparent"]' dir="ltr" id="total_jumlah_ditolak_pengaduan"></div>
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
                    <h4 class="card-title mb-4 flex-grow-1">STATISTIK PERMOHONAN</h4>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Antrian</p>
                                <h4 class="mb-0 statistik-jumlah-antrian-permohonan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-info", "--bs-transparent"]' dir="ltr" id="total_jumlah_antrian_permohonan"></div>
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
                                <p class="text-muted fw-medium">Diproses</p>
                                <h4 class="mb-0 statistik-jumlah-diproses-permohonan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-warning", "--bs-transparent"]' dir="ltr" id="total_jumlah_diproses_permohonan"></div>
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
                                <p class="text-muted fw-medium">Selesai</p>
                                <h4 class="mb-0 statistik-jumlah-selesai-permohonan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-success", "--bs-transparent"]' dir="ltr" id="total_jumlah_selesai_permohonan"></div>
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
                                <p class="text-muted fw-medium">Ditolak</p>
                                <h4 class="mb-0 statistik-jumlah-ditolak-permohonan"><i class="fa fa-spinner fa-spin"></i></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div data-colors='["--bs-danger", "--bs-transparent"]' dir="ltr" id="total_jumlah_ditolak_permohonan"></div>
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
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/dashboard-job.init.js"></script>

<script src="<?= base_url() ?>/assets/libs/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/jquery-countdown/jquery.countdown.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/coming-soon.init.js"></script>
<script>
    function loadStatistik() {
        $.ajax({
            url: "./getAllStatistik",
            type: 'GET',
            dataType: 'JSON',
            success: function(resul) {
                console.log(resul);
                if (resul.status !== 200) {
                    // if (resul.status === 401) {
                    //     Swal.fire(
                    //         'PERINGATAN!',
                    //         resul.message,
                    //         'warning'
                    //     ).then((valRes) => {
                    //         reloadPage();
                    //     });
                    // } else {
                    //     // Swal.fire(
                    //     //     'PERINGATAN!',
                    //     //     resul.message,
                    //     //     'warning'
                    //     // );
                    // }
                    $(".statistik-jumlah-antrian-pengaduan").html("-");
                    $(".statistik-jumlah-diproses-pengaduan").html("-");
                    $(".statistik-jumlah-selesai-pengaduan").html("-");
                    $(".statistik-jumlah-ditolak-pengaduan").html("-");

                    $(".statistik-jumlah-antrian-permohonan").html("-");
                    $(".statistik-jumlah-diproses-permohonan").html("-");
                    $(".statistik-jumlah-selesai-permohonan").html("-");
                    $(".statistik-jumlah-ditolak-permohonan").html("-");
                } else {
                    $(".statistik-jumlah-antrian-pengaduan").html(resul.data.jumlah_antrian_pengaduan);
                    $(".statistik-jumlah-diproses-pengaduan").html(resul.data.jumlah_diproses_pengaduan);
                    $(".statistik-jumlah-selesai-pengaduan").html(resul.data.jumlah_selesai_pengaduan);
                    $(".statistik-jumlah-ditolak-pengaduan").html(resul.data.jumlah_ditolak_pengaduan);

                    $(".statistik-jumlah-antrian-permohonan").html(resul.data.jumlah_antrian_permohonan);
                    $(".statistik-jumlah-diproses-permohonan").html(resul.data.jumlah_diproses_permohonan);
                    $(".statistik-jumlah-selesai-permohonan").html(resul.data.jumlah_selesai_permohonan);
                    $(".statistik-jumlah-ditolak-permohonan").html(resul.data.jumlah_ditolak_permohonan);
                }
            },
            error: function(e) {
                console.log(e);
                $(".statistik-jumlah-antrian-pengaduan").html("-");
                $(".statistik-jumlah-diproses-pengaduan").html("-");
                $(".statistik-jumlah-selesai-pengaduan").html("-");
                $(".statistik-jumlah-ditolak-pengaduan").html("-");

                $(".statistik-jumlah-antrian-permohonan").html("-");
                $(".statistik-jumlah-diproses-permohonan").html("-");
                $(".statistik-jumlah-selesai-permohonan").html("-");
                $(".statistik-jumlah-ditolak-permohonan").html("-");
            }
        });
    }

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
                        // Swal.fire(
                        //     'PERINGATAN!',
                        //     resul.message,
                        //     'warning'
                        // );
                    }
                } else {
                    const ulPengaduan = document.querySelector('.datas-pengaduan');
                    for (let index = 0; index < resul.data.length; index++) {
                        // Create a new <li> element
                        const liElement = document.createElement('li');
                        liElement.classList.add('event-list');

                        // Set the inner HTML of the <li> element
                        liElement.innerHTML = `
        <div class="event-timeline-dot">
            <i class="bx bx-right-arrow-circle font-size-18"></i>
        </div>
        <div class="d-flex">
            <div class="flex-shrink-0 me-3">
                <div class="avatar-xs">
                    <div class="avatar-title bg-primary text-primary bg-soft rounded-circle">
                        <i class="${resul.data[index].icon} font-size-14"></i>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div>${resul.data[index].keterangan}
                    <p class="text-muted mb-0">${getTimeAgo(resul.data[index].created_at)}</p>
                </div>
            </div>
        </div>
    `;

                        // Append the <li> element to the <ul> element
                        ulPengaduan.appendChild(liElement);
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
                        // Swal.fire(
                        //     'PERINGATAN!',
                        //     resul.message,
                        //     'warning'
                        // );
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
        loadStatistik();
        var totalJumlahantrianpengaduanColors = getChartColorsArray("total_jumlah_antrian_pengaduan");
        totalJumlahantrianpengaduanColors &&
            ((options = {
                    series: [{
                        name: "Antrian Pengaduan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahantrianpengaduanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_antrian_pengaduan"),
                    options
                )).render());
        var totalJumlahdiprosespengaduanColors = getChartColorsArray("total_jumlah_diproses_pengaduan");
        totalJumlahdiprosespengaduanColors &&
            ((options = {
                    series: [{
                        name: "Diproses Pengaduan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahdiprosespengaduanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_diproses_pengaduan"),
                    options
                )).render());
        var totalJumlahselesaipengaduanColors = getChartColorsArray("total_jumlah_selesai_pengaduan");
        totalJumlahselesaipengaduanColors &&
            ((options = {
                    series: [{
                        name: "Selesai Pengaduan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahselesaipengaduanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_selesai_pengaduan"),
                    options
                )).render());
        var totalJumlahditolakpengaduanColors = getChartColorsArray("total_jumlah_ditolak_pengaduan");
        totalJumlahditolakpengaduanColors &&
            ((options = {
                    series: [{
                        name: "Ditolak Pengaduan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahditolakpengaduanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_ditolak_pengaduan"),
                    options
                )).render());
        var totalJumlahantrianpermohonanColors = getChartColorsArray("total_jumlah_antrian_permohonan");
        totalJumlahantrianpermohonanColors &&
            ((options = {
                    series: [{
                        name: "Antrian Permohonan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahantrianpermohonanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_antrian_permohonan"),
                    options
                )).render());
        var totalJumlahdiprosespermohonanColors = getChartColorsArray("total_jumlah_diproses_permohonan");
        totalJumlahdiprosespermohonanColors &&
            ((options = {
                    series: [{
                        name: "Diproses Permohonan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahdiprosespermohonanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_diproses_permohonan"),
                    options
                )).render());
        var totalJumlahselesaipermohonanColors = getChartColorsArray("total_jumlah_selesai_permohonan");
        totalJumlahselesaipermohonanColors &&
            ((options = {
                    series: [{
                        name: "Selesai Permohonan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahselesaipermohonanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_selesai_permohonan"),
                    options
                )).render());
        var totalJumlahditolakpermohonanColors = getChartColorsArray("total_jumlah_ditolak_permohonan");
        totalJumlahditolakpermohonanColors &&
            ((options = {
                    series: [{
                        name: "Ditolak Permohonan",
                        data: [36, 48, 10, 74, 35, 50, 70, 73]
                    }, ],
                    chart: {
                        width: 130,
                        height: 46,
                        type: "area",
                        sparkline: {
                            enabled: !0
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 1.5
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05,
                            stops: [50, 100, 100, 100],
                        },
                    },
                    tooltip: {
                        fixed: {
                            enabled: !1
                        },
                        x: {
                            show: !1
                        },
                        y: {
                            title: {
                                formatter: function(e) {
                                    return "";
                                },
                            },
                        },
                        marker: {
                            show: !1
                        },
                    },
                    colors: totalJumlahditolakpermohonanColors,
                }),
                (chart = new ApexCharts(
                    document.querySelector("#total_jumlah_ditolak_permohonan"),
                    options
                )).render());
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
</style>
<!-- <link href="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.carousel.min.css"> -->

<!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.theme.default.min.css"> -->
<?= $this->endSection(); ?>