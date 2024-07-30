<?php if (isset($data)) { ?>
    <style>
        .text-right {
            text-align: right;
        }
    </style>
    <div class="modal-body">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#datatab" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="far fa-file-text"></i></span>
                                <span class="d-none d-sm-block"><i class="far fa-file-text"></i>DATA</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#grafiktab" role="tab" aria-selected="false" tabindex="-1">
                                <span class="d-block d-sm-none"><i class="fa fa-bar-chart"></i></span>
                                <span class="d-none d-sm-block"><i class="fa fa-bar-chart"></i>GRAFIK</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active show" id="datatab" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kecamatan</th>
                                            <th style="text-align: center;">Jumlah</th>
                                            <th style="text-align: center;">Prosentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($data)) { ?>
                                            <?php $totalData = isset($total_data) ? $total_data : 0; ?>
                                            <?php foreach ($data as $key => $value) { ?>
                                                <tr>
                                                    <th scope="row"><?= $key + 1 ?></th>
                                                    <td><?= htmlspecialchars($value->kecamatan) ?></td>
                                                    <td class="text-right"><?= number_format($value->jumlah_perkecamatan) ?></td>
                                                    <td class="text-right"><?= number_format(($value->jumlah_perkecamatan / $totalData) * 100, 2) ?>%</td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="4" style="text-align: center;">Tidak ada data</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="grafiktab" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Rekapitulasi Data P3KE Per-Kecamatan</h4>
                                    <div style="width: 80%; margin: auto;">
                                        <canvas id="bar_p3ke"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    </div>
    <script src="<?= base_url() ?>/assets/libs/chart.js/chart.umd.js"></script>
    <script>
        <?php
        $dataNya = [
            'labels' => array_map(function ($item) {
                return $item->kecamatan;
            }, $data),
            'datasets' => [
                [
                    'label' => 'Data P3KE Per Kecamatan',
                    'data' => array_map(function ($item) {
                        return $item->jumlah_perkecamatan;
                    }, $data),
                    'backgroundColor' => '--bs-success-rgb, 0.8',
                    'borderColor' => '--bs-success-rgb, 0.8',
                    'hoverBackgroundColor' => '--bs-success',
                    'hoverBorderColor' => '--bs-success',
                    'borderWidth' => 1
                ]
            ]
        ];

        $chartData = json_encode($dataNya);
        ?>
        // Ambil data JSON yang dikirim dari controller
        var chartData = <?= $chartData ?>;

        // Buat chart
        var ctx = document.getElementById('bar_p3ke').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?php } ?>