<?= $this->extend('t-silastri/peng/index'); ?>

<?= $this->section('content'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">DETAIL PROSES PENGADUAN</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="./data" class="btn btn-info btn-rounded waves-effect waves-light">Kembali</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-title">Detail Pengaduan - <?= $data->kategori ?> - <?= $data->nik_aduan ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h4>DATA PEMOHON</h4>
                            <div class="col-lg-6">
                                <label class="col-form-label">Nama Lengkap:</label>
                                <input type="text" class="form-control" value="<?= str_replace('&#039;', "`", str_replace("'", "`", $data->nama)) ?>" readonly />
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">NIK:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-describedby="nik" aria-label="NIK" value="<?= $data->nik ?>" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">KK:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-describedby="kk" aria-label="KK" value="<?= $data->kk ?>" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Tempat Lahir:</label>
                                <input type="text" class="form-control" value="<?= $data->tempat_lahir ?>" readonly />
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Tanggal Lahir:</label>
                                <input type="text" class="form-control" value="<?= $data->tgl_lahir ?>" readonly />
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Jenis Kelamin:</label>
                                <div><?php switch ($data->jenis_kelamin) {
                                            case 'P':
                                                echo '<span class="badge badge-pill badge-soft-primary">Perempuan</span>';
                                                break;
                                            case 'L':
                                                echo '<span class="badge badge-pill badge-soft-primary">Laki-Laki</span>';
                                                break;
                                            default:
                                                echo '-';
                                                break;
                                        } ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Email:</label>
                                <input type="text" class="form-control" value="<?= $data->email ?>" readonly />
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">No Handphone:</label>
                                <input type="text" class="form-control" value="<?= $data->no_hp ?>" readonly />
                            </div>
                        </div>
                        <hr />
                        <div class="row mt-2">
                            <h4>DATA ADUAN</h4>
                            <div class="col-lg-6">
                                <label class="col-form-label">Kode Aduan:</label>
                                <input type="text" class="form-control" value="<?= $data->kode_aduan ?>" readonly />
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Kategori:</label>
                                <input type="text" class="form-control" value="<?= $data->kategori ?>" readonly />
                            </div>

                            <?php if (isset($data->lampiran_1) || isset($data->lampiran_2) || isset($data->lampiran_3) || isset($data->lampiran_4) || isset($data->lampiran_5)) { ?>
                                <div class="col-lg-12 mt-2">
                                    <label class="col-form-label">Lampiran Dokumen:</label>
                                    <br />
                                    <?php if (isset($data->lampiran_1)) { ?>
                                        <?php if ($data->lampiran_1 === null || $data->lampiran_1 === "") { ?>
                                        <?php } else { ?>
                                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_1 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_1 ?>" id="nik">
                                                Lampiran 1
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (isset($data->lampiran_2)) { ?>
                                        <?php if ($data->lampiran_2 === null || $data->lampiran_2 === "") { ?>
                                        <?php } else { ?>
                                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_2 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_2 ?>" id="nik">
                                                Lampiran 2
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (isset($data->lampiran_3)) { ?>
                                        <?php if ($data->lampiran_3 === null || $data->lampiran_3 === "") { ?>
                                        <?php } else { ?>
                                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_3 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_3 ?>" id="nik">
                                                Lampiran 3
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (isset($data->lampiran_4)) { ?>
                                        <?php if ($data->lampiran_4 === null || $data->lampiran_4 === "") { ?>
                                        <?php } else { ?>
                                            <a class="btn btn-secondary btn-sm btn-rounded waves-effect waves-light mr-2 mb-1" target="popup" onclick="window.open('<?= base_url('uploads/aduan') . '/' . $data->lampiran_4 ?>','popup','width=600,height=600'); return false;" href="<?= base_url('uploads/aduan') . '/' . $data->lampiran_4 ?>" id="nik">
                                                Lampiran 4
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <hr />
                        <div class="row mt-2">
                            <?php if ($status_aduan === 'antrian') { ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Progress Pengajuan Pengaduan Anda</h4>

                                            <div class="hori-timeline">
                                                <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->created_at ?></div>
                                                                <h5 class="mb-4">1</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Mengajukan Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list active">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1">...</div>
                                                                <h5 class="mb-4">2</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-repost h1 text-primary down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Disposisi Pengaduan oleh Operator.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">3</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Verifikasi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">4</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Assesment.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">5</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Pengesahan oleh Kepala.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">6</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Pengaduan Selesai.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($status_aduan === 'disposisi') { ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Progress Pengajuan Pengaduan Anda</h4>

                                            <div class="hori-timeline">
                                                <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->created_at ?></div>
                                                                <h5 class="mb-4">1</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Mengajukan Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->date_approve ?></div>
                                                                <h5 class="mb-4">2</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-repost h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Disposisi Pengaduan oleh Operator.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list active">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1">...</div>
                                                                <h5 class="mb-4">3</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-primary down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Verifikasi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">4</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Assesment.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">5</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Pengesahan oleh Kepala.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">6</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Permohonan Layanan Selesai.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($status_aduan === 'proses') { ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Progress Pengajuan Pengaduan Anda</h4>

                                            <div class="hori-timeline">
                                                <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->created_at ?></div>
                                                                <h5 class="mb-4">1</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Mengajukan Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->date_approve ?></div>
                                                                <h5 class="mb-4">2</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-repost h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Disposisi Pengaduan oleh Operator.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->date_proses ?></div>
                                                                <h5 class="mb-4">3</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Verifikasi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list active">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1">...</div>
                                                                <h5 class="mb-4">4</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-primary down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Assesment.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">5</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Pengesahan oleh Kepala.</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">6</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Permohonan Layanan Selesai.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($status_aduan === 'assesment') { ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Progress Pengajuan Pengaduan Anda</h4>

                                            <div class="hori-timeline">
                                                <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->created_at ?></div>
                                                                <h5 class="mb-4">1</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Mengajukan Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->date_approve ?></div>
                                                                <h5 class="mb-4">2</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-repost h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Disposisi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1"><?= $data->updated_at ?></div>
                                                                <h5 class="mb-4">3</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Verifikasi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1"><?= $data->updated_at ?></div>
                                                                <h5 class="mb-4">4</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Assesment.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item event-list active">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1">...</div>
                                                                <h5 class="mb-4">5</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-primary down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Pengesahan Oleh Kepala.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">6</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Permohonan Layanan Selesai.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($status_aduan === 'pengesahan') { ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Progress Pengajuan Pengaduan Anda</h4>

                                            <div class="hori-timeline">
                                                <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->created_at ?></div>
                                                                <h5 class="mb-4">1</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Mengajukan Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->date_approve ?></div>
                                                                <h5 class="mb-4">2</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-repost h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Disposisi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1"><?= $data->updated_at ?></div>
                                                                <h5 class="mb-4">3</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Verifikasi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1"><?= $data->updated_at ?></div>
                                                                <h5 class="mb-4">4</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Pengesahan oleh Kepala.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list active">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1"><?= $data->updated_at ?></div>
                                                                <h5 class="mb-4">5</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>
                                                            <!-- <div class="event-down-icon"> -->
                                                            <!-- <button type="button" onclick="downloadPDF('<?php //echo isset($file_selesai) ? base64_encode($file_selesai->file_dokumen_tte) : '' 
                                                                                                                ?>','<?php //echo $data->kode_permohonan 
                                                                                                                        ?>.pdf')" class="btn btn-primary waves-effect waves-light w-sm">
                                                                    <i class="mdi mdi-download d-block font-size-16"></i> Download
                                                                </button> -->
                                                            <!-- <i class="bx bx-timer h1 text-primary down-arrow-icon"></i> -->
                                                            <!-- </div> -->

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Permohonan Layanan Selesai.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Progress Pengajuan Pengaduan Anda</h4>

                                            <div class="hori-timeline">
                                                <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->created_at ?></div>
                                                                <h5 class="mb-4">1</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Mengajukan Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-primary mb-1"><?= $data->date_approve ?></div>
                                                                <h5 class="mb-4">2</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-repost h1 text-success down-arrow-icon"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Disposisi Pengaduan oleh Operator.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-danger mb-1"><?= $data->date_reject ?></div>
                                                                <h5 class="mb-4">3</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-danger"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Verifikasi Pengaduan oleh Admin.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">4</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Proses Pengesahan oleh Kepala.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item event-list">
                                                        <div>
                                                            <div class="event-date">
                                                                <div class="text-Opacity mb-1">...</div>
                                                                <h5 class="mb-4">5</h5>
                                                            </div>
                                                            <div class="event-down-icon">
                                                                <i class="bx bx-timer h1 text-Opacity"></i>
                                                            </div>

                                                            <div class="mt-3 px-3">
                                                                <p class="text-muted">Permohonan Layanan Selesai.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url() ?>/assets/libs/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/owl.carousel/owl.carousel.min.js"></script>

<script>
    console.log("<?= $data->status_aduan ?>");
    console.log("<?= $status_aduan ?>");

    function downloadPDF(pdf, filename) {
        // const linkSource = `data:application/pdf;base64,${pdf}`;
        const linkSource = `data:application/octet-stream;base64,${pdf}`;
        const downloadLink = document.createElement("a");
        const fileName = filename;
        downloadLink.href = linkSource;
        downloadLink.download = fileName;
        downloadLink.click();
    }

    function ambilId(id) {
        return document.getElementById(id);
    }

    $('#content-detailModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    function initSelect2(event, parrent) {
        $('#' + event).select2({
            dropdownParent: parrent
        });
    }

    $(document).ready(function() {
        $("#timeline-carousel").owlCarousel({
            items: 1,
            loop: !1,
            margin: 0,
            nav: !0,
            navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
            dots: !1,
            responsive: {
                576: {
                    items: 3
                },
                768: {
                    items: 6
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link href="<?= base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.carousel.min.css">

<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/owl.carousel/assets/owl.theme.default.min.css">

<style>
    .preview-image-upload {
        position: relative;
    }

    .preview-image-upload .imagePreviewUpload {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload .btn-remove-preview-image {
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

    .imagePreviewUpload:hover+.btn-remove-preview-image,
    .btn-remove-preview-image:hover {
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