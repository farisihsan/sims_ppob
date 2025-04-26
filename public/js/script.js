// Helper untuk menampilkan alert
function showProfileAlert(message, type = 'success') {
    const alertDiv = document.getElementById('profile-alert');
    alertDiv.textContent = message;
    alertDiv.style.display = 'block';
    alertDiv.className = type === 'success' ? 'alert-success' : 'alert-error';
}

// Ambil data profil dari API saat halaman dimuat
// Ganti URL sesuai base_url Anda jika perlu
const apiProfileUrl = '/api/profile';
const apiProfileUpdateUrl = '/api/profile/update';
const apiLogoutUrl = '/api/logout';

document.addEventListener('DOMContentLoaded', function() {
    fetch(apiProfileUrl, {
        method: 'GET',
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 0) {
            // Isi header dan form dengan data user
            document.getElementById('profile-name').textContent = data.user.first_name + ' ' + data.user.last_name;
            document.querySelector('input[name="email"]').value = data.user.email;
            document.querySelector('input[name="first_name"]').value = data.user.first_name;
            document.querySelector('input[name="last_name"]').value = data.user.last_name;
        } else {
            showProfileAlert('Gagal mengambil data profil', 'error');
        }
    })
    .catch(error => {
        showProfileAlert('Terjadi kesalahan saat mengambil data profil', 'error');
    });

    // Handle profile form submission
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch(apiProfileUpdateUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 0) {
                showProfileAlert(data.message, 'success');
                document.getElementById('profile-name').textContent = data.user.first_name + ' ' + data.user.last_name;
            } else {
                showProfileAlert(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showProfileAlert('Terjadi kesalahan saat memperbarui profil', 'error');
        });
    });

    // Handle logout
    document.getElementById('logout-btn').addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            fetch(apiLogoutUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 0) {
                    alert(data.message);
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat logout');
            });
        }
    });
});
