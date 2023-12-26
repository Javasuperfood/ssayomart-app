<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $this->renderSection('title') ?></title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logo.png" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/auth.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <?= $this->include('user/home/component/preloader.php'); ?>
  <main role="main" class="container">
    <?= $this->renderSection('main') ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <?= $this->renderSection('pageScripts') ?>
  <script>
    const passwordField = document.querySelector('input[name="password"]');
    const togglePassword = document.getElementById('togglePassword');
    const passwordConfirmField = document.querySelector('input[name="password_confirm"]');
    const togglePassword2 = document.getElementById('togglePassword2');

    togglePassword.addEventListener('click', function() {
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        togglePassword.classList.remove('bi-eye-slash');
        togglePassword.classList.add('bi-eye');
      } else {
        passwordField.type = 'password';
        togglePassword.classList.remove('bi-eye');
        togglePassword.classList.add('bi-eye-slash');
      }
    });

    togglePassword2.addEventListener('click', function() {
      if (passwordConfirmField.type === 'password') {
        passwordConfirmField.type = 'text';
        togglePassword2.classList.remove('bi-eye-slash');
        togglePassword2.classList.add('bi-eye');
      } else {
        passwordConfirmField.type = 'password';
        togglePassword2.classList.remove('bi-eye');
        togglePassword2.classList.add('bi-eye-slash');
      }
    });

    function buttonGoogle() {
      var preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.style.position = 'fixed';
        preloader.style.top = '0';
        preloader.style.left = '0';
        preloader.style.width = '100%';
        preloader.style.height = '100%';
        preloader.style.backgroundColor = '#ffffffb9';
        preloader.style.display = 'flex';
        preloader.style.justifyContent = 'center';
        preloader.style.alignItems = 'center';
        preloader.style.zIndex = '9999';
      }
    }

    function buttonApple() {
      var preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.style.position = 'fixed';
        preloader.style.top = '0';
        preloader.style.left = '0';
        preloader.style.width = '100%';
        preloader.style.height = '100%';
        preloader.style.backgroundColor = '#ffffffb9';
        preloader.style.display = 'flex';
        preloader.style.justifyContent = 'center';
        preloader.style.alignItems = 'center';
        preloader.style.zIndex = '9999';
      }
    }
    // Menunggu halaman selesai dimuat
    window.addEventListener('load', function() {
      // Menghilangkan preloader
      document.getElementById('preloader').style.display = 'none';
    });
  </script>
  <script>
    $('a').click(function() {
      var preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.style.position = 'fixed';
        preloader.style.top = '0';
        preloader.style.left = '0';
        preloader.style.width = '100%';
        preloader.style.height = '100%';
        preloader.style.display = 'flex';
        preloader.style.justifyContent = 'center';
        preloader.style.alignItems = 'center';
        preloader.style.zIndex = '9999';

        // Set a timeout to hide the preloader after 5 seconds
        setTimeout(function() {
          preloader.style.display = 'none';
        }, 5000);
      }
    });

    function playPreloaderEvent() {
      console.log('register');
      var preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.style.position = 'fixed';
        preloader.style.top = '0';
        preloader.style.left = '0';
        preloader.style.width = '100%';
        preloader.style.height = '100%';
        preloader.style.display = 'flex';
        preloader.style.justifyContent = 'center';
        preloader.style.alignItems = 'center';
        preloader.style.zIndex = '9999';

        // Set a timeout to hide the preloader after 5 seconds
        setTimeout(function() {
          preloader.style.display = 'none';
        }, 5000);
      }
    }

    function clickSubmitEvent(e) {
      $(e).prop('disabled', true);
      $(e).html('<div class="spinner-border spinner-border-sm mx-2" role="status"><span class="visually-hidden">Loading...</span></div>Loading...');

      $(e).closest('form').submit();
    }
  </script>
</body>

</html>