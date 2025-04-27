// Helper untuk menampilkan alert
function showProfileAlert(message, type = 'success') {
    const alertDiv = document.getElementById('profile-alert');
    alertDiv.textContent = message;
    alertDiv.style.display = 'block';
    alertDiv.className = type === 'success' ? 'alert-success' : 'alert-error';
}

// Toggle Saldo
function toggleSaldo() {
    const saldoValue = document.getElementById('saldo-value');
    const toggleBtn = document.getElementById('toggle-saldo');
    const toggleText = document.getElementById('toggle-saldo-text');
    let isHidden = true;
    if (!saldoValue || !toggleBtn || !toggleText) return;
    // Ambil saldo asli dari data attribute
    const saldoAsli = saldoValue.getAttribute('data-saldo');
    toggleBtn.addEventListener('click', function() {
        if (isHidden) {
            saldoValue.textContent = saldoAsli;
            toggleText.textContent = "Sembunyikan Saldo";
        } else {
            saldoValue.textContent = "••••••••";
            toggleText.textContent = "Lihat Saldo";
        }
        isHidden = !isHidden;
    });
}

const apiLogoutUrl = '/logout';

document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.getElementById('logout-btn');
    const modal = document.getElementById('logout-modal');
    const confirmBtn = document.getElementById('confirm-logout');
    const cancelBtn = document.getElementById('cancel-logout');

    if (logoutBtn && modal && confirmBtn && cancelBtn) {
        logoutBtn.addEventListener('click', function() {
            modal.classList.add('show');
        });

        cancelBtn.addEventListener('click', function() {
            modal.classList.remove('show');
        });

        confirmBtn.addEventListener('click', function() {
            fetch('/logout', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            })
            .then(() => {
                window.location.href = '/login';
            })
            .catch(() => {
            alert('Terjadi kesalahan saat logout');
                modal.classList.remove('show');
            });
        });
    }

    toggleSaldo();
});

document.addEventListener('DOMContentLoaded', function() {
    const topupBtn = document.getElementById('topup-submit-btn');
    const modal = document.getElementById('topup-modal');
    const confirmBtn = document.getElementById('confirm-topup');
    const cancelBtn = document.getElementById('cancel-topup');
    const modalIcon = document.getElementById('modal-topup-icon');
    const modalMsg = document.getElementById('modal-topup-message');
    const modalNominal = document.getElementById('modal-topup-nominal');
    const modalAction = document.getElementById('modal-topup-action');
    const modalBack = document.getElementById('modal-topup-back');
    const nominalInput = document.querySelector('input[name=\"nominal\"]');

    let nominalValue = 0;

    if (topupBtn && modal && confirmBtn && cancelBtn) {
        topupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            nominalValue = nominalInput.value;
            // Tampilkan modal konfirmasi
            modal.classList.add('show');
            modalIcon.innerHTML = '<span class=\"icon-wallet\"><i class=\"fa fa-wallet\"></i></span>';
            modalMsg.innerHTML = 'Anda yakin untuk Top Up sebesar';
            modalNominal.innerHTML = '<b>Rp' + parseInt(nominalValue).toLocaleString('id-ID') + '</b> ?';
            modalAction.style.display = '';
            modalBack.style.display = 'none';
        });

        cancelBtn.addEventListener('click', function() {
            modal.classList.remove('show');
        });

        confirmBtn.addEventListener('click', function() {
            // Kirim AJAX ke endpoint topup
            fetch('/topup', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'nominal=' + encodeURIComponent(nominalValue)
            })
            .then(res => res.json())
            .then(res => {
                modalAction.style.display = 'none';
                modalBack.style.display = '';
                if (res.status === 'success') {
                    modalIcon.innerHTML = '<span class=\"icon-check\"><i class=\"fa fa-check\"></i></span>';
                    modalMsg.innerHTML = 'Top Up sebesar';
                    modalNominal.innerHTML = '<b>Rp' + parseInt(nominalValue).toLocaleString('id-ID') + '</b><br>berhasil!';
                } else {
                    modalIcon.innerHTML = '<span class=\"icon-cross\"><i class=\"fa fa-times\"></i></span>';
                    modalMsg.innerHTML = 'Top Up sebesar';
                    modalNominal.innerHTML = '<b>Rp' + parseInt(nominalValue).toLocaleString('id-ID') + '</b><br>gagal';
                }
            })
            .catch(() => {
                modalAction.style.display = 'none';
                modalBack.style.display = '';
                modalIcon.innerHTML = '<span class=\"icon-cross\"><i class=\"fa fa-times\"></i></span>';
                modalMsg.innerHTML = 'Top Up gagal';
                modalNominal.innerHTML = '';
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const pbbBtn = document.getElementById('pbb-submit-btn');
    const modal = document.getElementById('pbb-modal');
    const confirmBtn = document.getElementById('confirm-pbb');
    const cancelBtn = document.getElementById('cancel-pbb');
    const modalIcon = document.getElementById('modal-pbb-icon');
    const modalMsg = document.getElementById('modal-pbb-message');
    const modalNominal = document.getElementById('modal-pbb-nominal');
    const modalAction = document.getElementById('modal-pbb-action');
    const modalBack = document.getElementById('modal-pbb-back');
    const nominalInput = document.querySelector('input[name="nominal"]');

    let nominalValue = 0;

    if (pbbBtn && modal && confirmBtn && cancelBtn) {
        pbbBtn.addEventListener('click', function(e) {
            e.preventDefault();
            nominalValue = nominalInput.value;
            modal.classList.add('show');
            modalIcon.innerHTML = '<span class="icon-wallet"><i class="fa fa-wallet"></i></span>';
            modalMsg.innerHTML = 'Anda yakin untuk membayar PBB sebesar';
            modalNominal.innerHTML = '<b>Rp' + parseInt(nominalValue).toLocaleString('id-ID') + '</b> ?';
            modalAction.style.display = '';
            modalBack.style.display = 'none';
        });

        cancelBtn.addEventListener('click', function() {
            modal.classList.remove('show');
        });

        confirmBtn.addEventListener('click', function() {
            fetch('/pbb', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'nominal=' + encodeURIComponent(nominalValue)
            })
            .then(res => res.json())
            .then(res => {
                modalAction.style.display = 'none';
                modalBack.style.display = '';
                if (res.status === 'success') {
                    modalIcon.innerHTML = '<span class="icon-check"><i class="fa fa-check"></i></span>';
                    modalMsg.innerHTML = 'Pembayaran PBB sebesar';
                    modalNominal.innerHTML = '<b>Rp' + parseInt(nominalValue).toLocaleString('id-ID') + '</b><br>berhasil!';
                } else {
                    modalIcon.innerHTML = '<span class="icon-cross"><i class="fa fa-times"></i></span>';
                    modalMsg.innerHTML = 'Pembayaran PBB sebesar';
                    modalNominal.innerHTML = '<b>Rp' + parseInt(nominalValue).toLocaleString('id-ID') + '</b><br>gagal';
                }
            })
            .catch(() => {
                modalAction.style.display = 'none';
                modalBack.style.display = '';
                modalIcon.innerHTML = '<span class="icon-cross"><i class="fa fa-times"></i></span>';
                modalMsg.innerHTML = 'Pembayaran PBB gagal';
                modalNominal.innerHTML = '';
            });
        });
    }
});

document.querySelectorAll('.topup-nominal-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelector('input[name="nominal"]').value = this.dataset.value;
        document.getElementById('topup-submit-btn').disabled = false;
        document.getElementById('topup-submit-btn').classList.add('active');
    });
});
