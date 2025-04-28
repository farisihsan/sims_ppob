// alert
function showProfileAlert(message, type = 'success') {
    const alertDiv = document.getElementById('profile-alert');
    alertDiv.textContent = message;
    alertDiv.style.display = 'block';
    alertDiv.className = type === 'success' ? 'alert-success' : 'alert-error';
}

//slider promo
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('promo-slider');
    if (!slider) return;

    let scrollAmount = 0;
    const scrollStep = slider.offsetWidth / 2; 
    const maxScroll = slider.scrollWidth - slider.clientWidth;

    function autoScroll() {
        if (scrollAmount < maxScroll) {
            scrollAmount += scrollStep;
        } else {
            scrollAmount = 0; 
        }
        slider.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }

    setInterval(autoScroll, 2000); 
});


// Toggle Saldo
function toggleSaldo() {
    const saldoValue = document.getElementById('saldo-value');
    const toggleBtn = document.getElementById('toggle-saldo');
    const toggleText = document.getElementById('toggle-saldo-text');
    let isHidden = true;
    if (!saldoValue || !toggleBtn || !toggleText) return;
    
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

//logout
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

//modal confirm transaksi
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modaltransaction');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const modalIcon = document.getElementById('modal-icon');
    const modalMsg = document.getElementById('modal-message');
    const modalNominal = document.getElementById('modal-nominal');
    const modalAction = document.getElementById('modal-action');
    const modalBack = document.getElementById('modal-back');
    const nominalInput = document.querySelector('input[name="nominal"]');
    let endpoint = '';
    let label = '';
    let nominalValue = 0;

    document.querySelectorAll('.submit-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            endpoint = btn.dataset.endpoint;
            label = btn.dataset.label;
            nominalValue = nominalInput.value;
            modal.classList.add('show');
            modalIcon.innerHTML = '<span class="icon-wallet"><i class="fa fa-wallet"></i></span>';
            modalMsg.innerHTML = `Anda yakin untuk membayar ${label} sebesar`;
            modalNominal.innerHTML = `<b>Rp${parseInt(nominalValue).toLocaleString('id-ID')}</b> ?`;
            modalAction.style.display = '';
            modalBack.style.display = 'none';
        });
    });

    cancelBtn.addEventListener('click', function() {
        modal.classList.remove('show');
    });

    confirmBtn.addEventListener('click', function() {
        fetch(endpoint, {
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
                modalMsg.innerHTML = `Pembayaran ${label} sebesar`;
                modalNominal.innerHTML = `<b>Rp${parseInt(nominalValue).toLocaleString('id-ID')}</b><br>berhasil!`;
            } else {
                modalIcon.innerHTML = '<span class="icon-cross"><i class="fa fa-times"></i></span>';
                modalMsg.innerHTML = `Pembayaran ${label} sebesar`;
                modalNominal.innerHTML = `<b>Rp${parseInt(nominalValue).toLocaleString('id-ID')}</b><br>gagal`;
            }
        })
        .catch(() => {
            modalAction.style.display = 'none';
            modalBack.style.display = '';
            modalIcon.innerHTML = '<span class="icon-cross"><i class="fa fa-times"></i></span>';
            modalMsg.innerHTML = `Pembayaran ${label} gagal`;
            modalNominal.innerHTML = '';
        });
    });
});

//button topup nominal
document.querySelectorAll('.topup-nominal-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelector('input[name="nominal"]').value = this.dataset.value;
        document.getElementById('topup-submit-btn').disabled = false;
        document.getElementById('topup-submit-btn').classList.add('active');
    });
});

//button show more history transaksi
document.getElementById('show-more-btn').addEventListener('click', function() {
    let btn = this;
    let offset = parseInt(btn.getAttribute('data-offset'));
    let limit = parseInt(btn.getAttribute('data-limit'));

    fetch(`/transaction/more?offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                let container = document.getElementById('transaction-list');
                data.forEach(t => {
                    let html = `
                        <div class="transaction-card">
                            <div class="card-header">
                                <div class="amount-container">
                                    <span class="transaction-amount ${t.transaction_type === 'TOPUP' ? 'amount-plus' : 'amount-minus'}">
                                        ${t.transaction_type === 'TOPUP' ? '+ ' : '- '}Rp${parseInt(t.total_amount).toLocaleString('id-ID')}
                                    </span>
                                </div>
                                <div class="service-name">${t.service_name}</div>
                            </div>
                            <div class="card-body">
                                <div class="transaction-date">
                                    ${new Date(t.created_on).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric'})}
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });
                btn.setAttribute('data-offset', offset + limit);
            } else {
                btn.style.display = 'none'; // Sembunyikan tombol jika data habis
            }
        });
});
