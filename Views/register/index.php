<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? $title : "Login - Sistem Layanan Sosial Terintegrasi" ?></title>
  <meta content="Portal Layanan Resmi Dinas Sosial Kab. Lampung Tengah" name="description" />
  <meta content="handokowae.my.id" name="author" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="keywords" content="portal, layanan, portal layanan, portal layanan dinsos, dinsos, disdik, lampung, lampung tengah lampung tengah, dinas sosial, dinas Sosial lampung tengah, kabupaten lampung tengah">

  <meta property="og:title" content="Portal Layanan Resmi Dinas Sosial Kab. Lampung Tengah" />
  <meta property="og:url" content="<?= base_url() ?>" />
  <meta property="og:image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />
  <meta property="og:description" content="Portal Layanan Resmi Dinas Sosial Kab. Lampung Tengah" />

  <meta itemprop="name" content="Portal Layanan Resmi Dinas Sosial Kab. Lampung Tengah" />
  <meta itemprop="description" content="Portal Layanan Resmi Dinas Sosial Kab. Lampung Tengah" />
  <meta itemprop="image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />

  <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicon/apple-icon-57x57.png'); ?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicon/apple-icon-60x60.png'); ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('favicon/apple-icon-72x72.png'); ?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicon/apple-icon-76x76.png'); ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('favicon/apple-icon-114x114.png'); ?>">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicon/apple-icon-120x120.png'); ?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicon/apple-icon-144x144.png'); ?>">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('favicon/apple-icon-152x152.png'); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon/apple-icon-180x180.png'); ?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicon/android-icon-192x192.png'); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon/favicon-32x32.png'); ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicon/favicon-96x96.png'); ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon/favicon-16x16.png'); ?>">
  <link rel="manifest" href="<?= base_url('favicon/manifest.json'); ?>">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= base_url('favicon/ms-icon-144x144.png'); ?>">
  <meta name="theme-color" content="#ffffff">
  <link href="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    .gradient-bg {
      background: linear-gradient(-45deg, #e63946, #d62839, #ba181b, #a4161a);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }

    .card-enter {
      opacity: 0;
      transform: translateY(20px);
    }

    .card-enter-active {
      opacity: 1;
      transform: translateY(0);
      transition: all 0.5s ease;
    }

    .input-focus-effect:focus {
      box-shadow: 0 0 0 2px rgba(230, 57, 70, 0.5);
    }

    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .pulse {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }

      100% {
        transform: scale(1);
      }
    }

    .password-toggle {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .password-toggle:hover {
      color: #e63946;
    }
  </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full flex justify-between items-center opacity-20">
      <div class="w-32 h-32 rounded-full bg-red-500 mix-blend-multiply filter blur-xl opacity-70 animate-bounce"></div>
      <div class="w-24 h-24 rounded-full bg-red-400 mix-blend-multiply filter blur-xl opacity-70 animate-bounce animation-delay-200"></div>
      <div class="w-20 h-20 rounded-full bg-red-300 mix-blend-multiply filter blur-xl opacity-70 animate-bounce animation-delay-400"></div>
    </div>
  </div>

  <div class="relative max-w-2xl w-full mx-auto card-enter">
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden border border-white/20 pulse">
      <div class="px-10 py-8">
        <div class="flex justify-center mb-6">
          <div class="bg-red p-4 shadow-lg floating">
            <img src="<?= base_url() ?>/assets/images/lastri.svg" alt="Logo" class="w-50 h-32">
          </div>
        </div>

        <h1 class="text-2xl font-bold text-center text-white mb-2">Registrasi Akun</h1>
        <!-- <p class="text-center text-white/80 mb-8">Sistem Layanan Sosial Terintegrasi - Dinas Sosial Kabupaten Lampung Tengah</p> -->

        <form class="space-y-4" action="/auth/login" method="post">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
              <div>
                <label for="_nama" class="block text-sm font-medium text-white/90 mb-1">Nama Lengkap</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-red-300"></i>
                  </div>
                  <input id="_nama" name="_nama" type="text" required class="input-focus-effect pl-10 w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/50 border border-white/30 focus:outline-none transition duration-300" placeholder="Nama lengkap...">
                </div>
              </div>

              <div>
                <label for="_nik" class="block text-sm font-medium text-white/90 mb-1">NIK</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-id-card text-red-300"></i>
                  </div>
                  <input id="_nik" name="_nik" type="text" required class="input-focus-effect pl-10 w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/50 border border-white/30 focus:outline-none transition duration-300" placeholder="NIK...">
                </div>
              </div>

              <div>
                <label for="_no_hp" class="block text-sm font-medium text-white/90 mb-1">No Handphone</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-phone text-red-300"></i>
                  </div>
                  <input id="_no_hp" name="_no_hp" type="text" required class="input-focus-effect pl-10 w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/50 border border-white/30 focus:outline-none transition duration-300" placeholder="No handphone...">
                </div>
              </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
              <div>
                <label for="_email" class="block text-sm font-medium text-white/90 mb-1">E-mail</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-red-300"></i>
                  </div>
                  <input id="_email" name="_email" type="email" required class="input-focus-effect pl-10 w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/50 border border-white/30 focus:outline-none transition duration-300" placeholder="Email...">
                </div>
              </div>

              <div>
                <label for="_password" class="block text-sm font-medium text-white/90 mb-1">Password</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-red-300"></i>
                  </div>
                  <input id="_password" name="_password" type="password" required class="input-focus-effect pl-10 w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/50 border border-white/30 focus:outline-none transition duration-300" placeholder="Masukan password">
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye password-toggle" id="toggle-password"></i>
                  </div>
                </div>
              </div>

              <div>
                <label for="_re_password" class="block text-sm font-medium text-white/90 mb-1">Ulangi Password</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-red-300"></i>
                  </div>
                  <input id="_re_password" name="_re_password" type="password" required class="input-focus-effect pl-10 w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/50 border border-white/30 focus:outline-none transition duration-300" placeholder="Ulangi password">
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye password-toggle" id="toggle-repassword"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center">
            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-red-500 focus:ring-red-500 border-white/30 rounded">
            <label for="terms" class="ml-2 block text-sm text-white/80">
              Saya menyetujui <a href="#" class="text-white font-medium hover:text-red-200 transition duration-300">syarat dan ketentuan</a>
            </label>
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300 transform hover:scale-105">
              Daftar Sekarang
            </button>
          </div>
        </form>

        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-white/30"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-transparent text-white/80">
                Sudah punya akun?
              </span>
            </div>
          </div>

          <div class="mt-6">
            <a href="./auth" class="w-full inline-flex justify-center py-2 px-4 border border-white/30 rounded-lg shadow-sm bg-white/10 text-sm font-medium text-white hover:bg-white/20 transition duration-300">
              <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke akun Anda
            </a>
          </div>
        </div>
      </div>

      <div class="px-8 py-4 bg-white/5 text-center">
        <p class="text-xs text-white/60">
          © 2024 Dinas Sosial Kabupaten Lampung Tengah. All rights reserved. Version 2.0
        </p>
      </div>
    </div>
  </div>

  <script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add animation class to form elements
      const inputs = document.querySelectorAll('input');
      inputs.forEach((input, index) => {
        input.style.transitionDelay = `${index * 50}ms`;
        input.classList.add('card-enter');
      });

      const button = document.querySelector('button[type="submit"]');
      button.style.transitionDelay = `${inputs.length * 50}ms`;
      button.classList.add('card-enter');

      // Trigger animations
      setTimeout(() => {
        document.querySelectorAll('.card-enter').forEach(el => {
          el.classList.add('card-enter-active');
        });
      }, 100);

      // Password toggle functionality
      const togglePassword = document.getElementById('toggle-password');
      const passwordField = document.getElementById('_password');

      const toggleRepassword = document.getElementById('toggle-repassword');
      const repasswordField = document.getElementById('_re_password');

      togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
        this.classList.toggle('fa-eye');
      });

      toggleRepassword.addEventListener('click', function() {
        const type = repasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        repasswordField.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
        this.classList.toggle('fa-eye');
      });
    });
    <?php if (isset($error)) { ?>
      Swal.fire(
        "Peringatan!",
        '<?= $error ?>',
        "warning"
      );
    <?php } ?>
    $("form").on("submit", function(e) {

      e.preventDefault();
      var dataString = $(this).serialize();
      $.ajax({
        type: "POST",
        url: '/auth/saveregis',
        data: dataString,
        dataType: 'JSON',
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
        success: function(msg) {
          console.log(msg);
          if (msg.status != 200) {
            if (msg.status !== 201) {
              if (msg.status !== 202) {
                Swal.fire(
                  "Gagal!",
                  msg.message,
                  "warning"
                );
              } else {
                Swal.fire(
                  "Warning!",
                  msg.message,
                  "warning"
                ).then((valRes) => {
                  // setTimeout(function() {
                  document.location.href = msg.url;
                  // }, 2000);

                })
              }
            } else {
              Swal.fire(
                'Berhasil!',
                msg.message,
                'success'
              ).then((valRes) => {
                // setTimeout(function() {
                document.location.href = msg.url;
                // }, 2000);
              })
            }
          } else {
            Swal.fire(
              'Berhasil!',
              msg.message,
              'success'
            ).then((valRes) => {
              // setTimeout(function() {
              document.location.href = msg.url;
              // }, 2000);
              // document.location.href = window.location.href + "dashboard";
            })
          }
        },
        error: function(data) {
          console.log(data);
          Swal.fire(
            'Gagal!',
            "Server sedang sibuk, silahkan ulangi beberapa saat lagi.",
            'warning'
          );
        }
      });

    });
  </script>
</body>

</html>