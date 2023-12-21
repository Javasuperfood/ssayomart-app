<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);

$preloader = (isset($preloader)) ? $preloader : true;
?>
<?php if ($isMobile) : ?>
    <?php if ($preloader) : ?>
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
                    }, 3000);
                }
            });
        </script>
    <?php endif; ?>
    <script>
        function playPreloaderEvent(time = true) {
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
                if (time) {
                    setTimeout(function() {
                        preloader.style.display = 'none';
                    }, 3000);
                }
            }
        }

        function clickSubmitEvent(e) {
            $(e).prop('disabled', true);
            $(e).html('<div class="spinner-border spinner-border-sm mx-2" role="status"><span class="visually-hidden">Loading...</span></div>Loading...');

            $(e).closest('form').submit();
        }
    </script>
<?php endif; ?>