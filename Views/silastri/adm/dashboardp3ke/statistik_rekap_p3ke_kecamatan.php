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
                            <p class="mb-0">
                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                single-origin coffee squid. Exercitation +1 labore velit, blog
                                sartorial PBR leggings next level wes anderson artisan four loko
                                farm-to-table craft beer twee. Qui photo booth letterpress,
                                commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                aesthetic magna delectus.
                            </p>
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

<?php } ?>