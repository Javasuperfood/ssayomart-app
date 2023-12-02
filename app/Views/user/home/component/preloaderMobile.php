<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<?php if ($isMobile) : ?>
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
    </script>
<?php endif; ?>