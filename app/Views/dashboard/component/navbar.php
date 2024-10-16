<head>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
</head>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown" id="notificationDropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                <!-- Badge merah untuk jumlah notifikasi -->
                <span class="badge badge-secondary navbar-badge" id="notificationCount">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificationList">
                <!-- Konten notifikasi akan diisi melalui JavaScript -->
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <div class="nav-link">
            <a class="d-flex align-items-center mt-3" href="<?= base_url() ?>dashboard/panduan/panduan-aplikasi">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Baca Panduan Aplikasi disini</span>
            </a>
        </div>

        <div class="topbar-divider d-none d-sm-block"></div>

        <style>
            .nav-link a:hover {
                text-decoration: none;
            }
        </style>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= auth()->user()->fullname; ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/pic/<?= auth()->user()->img ?>" class="img-fluid" alt="">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url(); ?>" target="__blank">
                    <i class="fas fa-share fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pergi ke Aplikasi
                </a>
                <a class="dropdown-item" href="<?= base_url(); ?>dashboard/profil/profile-admin/<?= auth()->user()->id; ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Sunting Akun
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                </a>
            </div>
        </li>

    </ul>

</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var csrfName = '<?= csrf_token() ?>';

        function fetchUnreadCount() {
            $.ajax({
                url: '/dashboard/notifications/unread-count',
                method: 'GET',
                success: function(data) {
                    $('#notificationCount').text(data.count);
                    if (data.count > 0) {
                        $('#notificationCount').addClass('badge-danger').removeClass('badge-secondary');
                    } else {
                        $('#notificationCount').removeClass('badge-danger').addClass('badge-secondary');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Gagal mengambil count notifikasi:', textStatus, errorThrown);
                }
            });
        }

        // Fungsi untuk mengambil daftar notifikasi
        function fetchNotifications() {
            $.ajax({
                url: '/dashboard/notifications',
                method: 'GET',
                success: function(data) {
                    var notificationList = $('#notificationList');
                    notificationList.empty();

                    var notificationsToShow = data.notifications.slice(0, 10);

                    if (notificationsToShow.length > 0) {
                        notificationList.append(`
                                                <div class="dropdown-header d-flex justify-content-between align-items-center">
                                                    <span>${notificationsToShow.length} dari ${data.notifications.length} Notifikasi</span>
                                                    <span><a href="#" class="dropdown-item" id="markAllRead">Tandai Telah Dibaca</a></span>
                                                </div>
                        `);
                        notificationList.append('<div class="dropdown-divider"></div>');

                        // Loop hanya untuk 10 notifikasi pertama
                        notificationsToShow.forEach(function(notification) {
                            var item = $('<a href="#" class="dropdown-item d-flex justify-content-between align-items-center"></a>');
                            var messageContent = $('<span></span>').text(notification.message + ' - ' + notification.created_at);

                            // Jika notifikasi belum dibaca, tambahkan badge biru
                            if (!notification.is_read) {
                                messageContent.css('font-weight', 'bold');
                                var badge = $('<span class="badge bg-primary ms-2">New</span>');
                                item.append(messageContent).append(badge);
                            } else {
                                item.append(messageContent);
                            }

                            // Menandai notifikasi sebagai terbaca saat diklik
                            item.on('click', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    url: '/dashboard/notifications/mark-as-read/' + notification.id,
                                    method: 'POST',
                                    data: {
                                        [csrfName]: csrfToken
                                    },
                                    success: function(res) {
                                        if (res.status === 'success') {
                                            csrfToken = res.newToken;
                                            $('meta[name="csrf-token"]').attr('content', csrfToken);
                                            fetchUnreadCount();
                                            fetchNotifications();
                                        } else {
                                            alert(res.message || 'Gagal menandai notifikasi sebagai terbaca.');
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        alert('Terjadi kesalahan saat menandai notifikasi.');
                                    }
                                });
                            });

                            notificationList.append(item);
                            notificationList.append('<div class="dropdown-divider"></div>');
                        });

                        // Tombol untuk menandai semua notifikasi sebagai terbaca
                        notificationList.append('<a href="#" class="dropdown-item text-center">Lihat Semua Notifikasi</a>');
                    } else {
                        notificationList.append('<span class="dropdown-header">0 Notifikasi</span>');
                        notificationList.append('<div class="dropdown-divider"></div>');
                        notificationList.append('<a href="#" class="dropdown-item">Tidak ada notifikasi</a>');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Gagal mengambil daftar notifikasi:', textStatus, errorThrown);
                }
            });
        }


        // Mengambil jumlah notifikasi saat halaman dimuat dan setiap 30 detik
        fetchUnreadCount();
        setInterval(function() {
            fetchUnreadCount();
        }, 30000);

        // Mengambil notifikasi saat dropdown dibuka
        $('#notificationDropdown').on('click', function() {
            fetchNotifications();
        });

        // Menangani klik pada "Mark All Read"
        $(document).on('click', '#markAllRead', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/dashboard/notifications/mark-all-as-read',
                method: 'POST',
                data: {
                    [csrfName]: csrfToken
                },
                success: function(res) {
                    if (res.status === 'success') {
                        csrfToken = res.newToken;
                        $('meta[name="csrf-token"]').attr('content', csrfToken);
                        fetchUnreadCount();
                        fetchNotifications();
                        alert('Semua notifikasi telah ditandai sebagai terbaca.');
                    } else {
                        alert(res.message || 'Gagal menandai semua notifikasi sebagai terbaca.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Terjadi kesalahan saat menandai semua notifikasi.');
                }
            });
        });
    });
</script>