document.addEventListener('DOMContentLoaded', function() {
    const togglerButton = document.getElementById('togglerButton');
    const body = document.body;

    if (togglerButton && body) {
        
        togglerButton.addEventListener('click', function() {
            // Toggle kelas pada body untuk mengontrol SEMUA layout
            body.classList.toggle('sidebar-collapsed');
        });

        // Inisialisasi state saat halaman pertama kali dimuat
        // Jika lebar layar 768px atau kurang, otomatis ciutkan sidebar
        if (window.innerWidth <= 768) {
             body.classList.add('sidebar-collapsed');
        }
    }
});