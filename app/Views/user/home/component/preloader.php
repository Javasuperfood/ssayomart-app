<div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffffb9;display: flex;justify-content: center;align-items: center; z-index: 9999;">
    <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script>
    // Menunggu halaman selesai dimuat
    window.addEventListener('load', function() {
        // Menghilangkan preloader
        document.getElementById('preloader').style.display = 'none';
    });
</script>