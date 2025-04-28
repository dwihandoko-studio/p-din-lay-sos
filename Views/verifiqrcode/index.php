<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <title><?= isset($title) ? $title : "HOME" ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="title" content="<?= isset($title) ? $title : "HOME" ?>">
    <meta name="author" content="handokowae.my.id">

    <link rel="icon" href="<?= base_url() ?>/assets/verifi/assets/img/logo.png" type="image/png">

    <link type="text/css" href="<?= base_url() ?>/assets/verifi/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"><!-- Nucleo icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/verifi/assets/vendor/nucleo/css/nucleo.css" type="text/css"><!-- Prism -->
    <link type="text/css" href="<?= base_url() ?>/assets/verifi/assets/vendor/prismjs/themes/prism.css" rel="stylesheet"><!-- Front CSS -->
    <link type="text/css" href="<?= base_url() ?>/assets/verifi/assets/css/front.css" rel="stylesheet">
    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
</head>

<body>
    <main>
        <div class="preloader bg-soft flex-column justify-content-center align-items-center">
            <div class="loader-element"><span class="loader-animated-dot"></span>
                <h4>VERIFI QRCODE</h4>
            </div>
        </div>

        <!-- Hero -->
        <section class="section-header pb-7 pb-lg-11 bg-soft">
            <div class="container loading-get-verifi" id="loading-get-verifi">

            </div>
        </section>

        <footer class="footer section pt-6 pt-md-8 pt-lg-10 pb-3 bg-primary text-white overflow-hidden">
            <div class="pattern pattern-soft top"></div>
            <div class="container">
                <div class="row">
                    <div class="col pb-4 mb-md-0">
                        <div class="d-flex text-center justify-content-center align-items-center">
                            <p class="font-weight-normal mb-0">Copyright © Dinas Sosial Lampung Tengah</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/headroom.js/dist/headroom.min.js"></script><!-- Vendor JS -->
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/nouislider/distribute/nouislider.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/jarallax/dist/jarallax.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/countup.js/dist/countUp.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/vendor/prismjs/prism.js"></script><!-- Place this tag in your head or just before your close body tag. -->
    <script async defer="defer" src="https://buttons.github.io/buttons.js"></script><!-- Impact JS -->
    <script src="<?= base_url() ?>/assets/verifi/assets/js/front.js"></script>
    <script src="<?= base_url() ?>/assets/verifi/assets/js/jquery-block-ui.js"></script>
    <script>
        $(document).ready(function() {
            <?php if (isset($dokumen)) { ?>
                $.ajax({
                    url: BASE_URL + '/verifiqrcodev/validity',
                    type: 'POST',
                    data: {
                        id: "<?= $dokumen->id ?>",
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('div.loading-get-verifi').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(msg) {
                        console.log(msg);
                        $('div.loading-get-verifi').unblock();
                        if (msg.code != 200) {
                            console.log('gagal');
                            // Swal.fire(
                            //   'Gagal!',
                            //   msg.message,
                            //   'warning'
                            // );
                        } else {
                            $('#loading-get-verifi').html(msg.data);
                        }
                    },
                    error: function() {
                        $('div.loading-get-verifi').unblock();
                        console.log('Error');
                        // Swal.fire(
                        //   'Gagal!',
                        //   "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        //   'warning'
                        // );
                    }
                })
            <?php } ?>
        });
    </script>
</body>