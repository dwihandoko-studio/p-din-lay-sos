<?php $uri = current_url(true); ?>
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <!-- <li class="menu-title" key="t-menu">Menu</li> -->
                <li <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "home") ? ' class="mm-active"' : '' ?>>
                    <a href="<?= ($uri->getSegment(2) == "adm" && $uri->getSegment(3) == "home") ? 'javascript: void(0);' : base_url('silastri/pengdat/home') ?>" class="waves-effect <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "home") ? ' mm-active' : '' ?>">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload") ? ' class="mm-active"' : '' ?>>
                    <a href="javascript: void(0);" class="has-arrow waves-effect <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload") ? ' mm-active' : '' ?>">
                        <i class="bx bx-package"></i>
                        <span key="t-uploads">Upload</span>
                    </a>
                    <ul class="sub-menu  <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload") ? ' mm-collapse mm-active' : '' ?>" aria-expanded="false">
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload" && $uri->getSegment(4) == "dtks") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/upload/dtks') ?>" key="t-uploads-dtks">DTKS</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload" && $uri->getSegment(4) == "bltdd") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/upload/bltdd') ?>" key="t-uploads-bltdd">BLT DD</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload" && $uri->getSegment(4) == "p3ke") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/upload/p3ke') ?>" key="t-uploads-p3ke">P3KE</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload" && $uri->getSegment(4) == "padandtks") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/upload/padandtks') ?>" key="t-uploads-padandtks">Padan DTKS</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "upload" && $uri->getSegment(4) == "bpjs") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/upload/bpjs') ?>" key="t-uploads-bpjs">BPJS</a></li>
                    </ul>
                </li>
                <!-- <li <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan") ? ' class="mm-active"' : '' ?>>
                    <a href="javascript: void(0);" class="has-arrow waves-effect <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan") ? ' mm-active' : '' ?>">
                        <i class="bx bx-package"></i>
                        <span key="t-layanans">Layanan</span>
                    </a>
                    <ul class="sub-menu  <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan") ? ' mm-collapse mm-active' : '' ?>" aria-expanded="false">
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan" && $uri->getSegment(4) == "antrian") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/layanan/antrian') ?>" key="t-layanan-antrian">Antrian</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan" && $uri->getSegment(4) == "proses") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/layanan/proses') ?>" key="t-layanan-proses">Diproses</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan" && $uri->getSegment(4) == "selesai") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/layanan/selesai') ?>" key="t-layanan-selesai">Selesai</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "layanan" && $uri->getSegment(4) == "ditolak") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/layanan/ditolak') ?>" key="t-layanan-ditolak">Ditolak</a></li>
                    </ul>
                </li>
                <li <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "pengaduan") ? ' class="mm-active"' : '' ?>>
                    <a href="javascript: void(0);" class="has-arrow waves-effect <?= ($uri->getSegment(2) == "adm" && $uri->getSegment(3) == "pengaduan") ? ' mm-active' : '' ?>">
                        <i class="bx bx-package"></i>
                        <span key="t-pengaduans">Pengaduan</span>
                    </a>
                    <ul class="sub-menu  <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "pengaduan") ? ' mm-collapse mm-active' : '' ?>" aria-expanded="false">
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "pengaduan" && $uri->getSegment(4) == "antrian") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/pengaduan/antrian') ?>" key="t-pengaduan-antrian">Antrian</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "pengaduan" && $uri->getSegment(4) == "selesai") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/pengaduan/selesai') ?>" key="t-pengaduan-selesai">Selesai</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "pengaduan" && $uri->getSegment(4) == "ditolak") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/pengaduan/ditolak') ?>" key="t-pengaduan-ditolak">Ditolak</a></li>
                        <li><a <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "pengaduan" && $uri->getSegment(4) == "asesmenppks") ? ' class="mm-active"' : '' ?> href="<?= base_url('silastri/pengdat/pengaduan/asesmenppks') ?>" key="t-pengaduan-asesmenppks">Assesment PPKS</a></li>
                    </ul>
                </li> -->
                <li <?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "dashboardp3ke") ? ' class="mm-active"' : '' ?>>
                    <a href="<?= ($uri->getSegment(2) == "pengdat" && $uri->getSegment(3) == "dashboardp3ke") ? 'javascript: void(0);' : base_url('silastri/pengdat/dashboardp3ke') ?>" class="waves-effect <?= ($uri->getSegment(2) == "adm" && $uri->getSegment(3) == "dashboardp3ke") ? ' mm-active' : '' ?>">
                        <i class="fas fa-dungeon"></i>
                        <span key="t-dashboards">Dashboard P3KE</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>