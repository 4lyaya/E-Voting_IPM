<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting IPM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1e40af;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .input-field:focus {
            border-color: #1e40af;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
        }

        .login-btn {
            background-color: #1e40af;
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
        }

        .login-btn:hover {
            background-color: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
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

        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
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
    </style>
</head>

<body>
    <div class="login-card">
        <div class="p-8">
            <!-- Header dengan ikon -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-5">
                    <div class="bg-blue-100 p-5 rounded-2xl inline-flex floating-icon">
                        <i class="fas fa-file-vote text-6xl text-blue-700"></i>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-blue-700 mb-2">E-VOTING IPM</h1>
                <p class="text-gray-600">Masukkan NIS Anda untuk memulai voting</p>
            </div>
            <!-- Alert Notifikasi (akan disembunyikan dan digantikan SweetAlert) -->
            @if (session('success') || session('error'))
                <div class="hidden" id="flash-message" data-type="{{ session('success') ? 'success' : 'error' }}"
                    data-message="{{ session('success') ?? session('error') }}"></div>
            @endif
            <!-- Form Login -->
            <form action="{{ route('voting.verifyNis') }}" method="POST" id="nisForm">
                @csrf
                <div class="mb-6">
                    <label for="nis" class="block mb-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-id-card mr-2 text-blue-600"></i>Nomor Induk Siswa (NIS)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-hashtag h-5 w-5 text-gray-400"></i>
                        </div>
                        <input type="text" id="nis" name="nis" class="input-field pl-10 w-full"
                            placeholder="Masukkan NIS Anda" required>
                    </div>
                    <p class="mt-2 text-xs text-gray-500"><i class="fas fa-info-circle mr-1"></i>Contoh: 20230001</p>
                </div>
                <button type="submit"
                    class="login-btn w-full text-white font-medium text-sm px-5 py-2.5 text-center pulse"
                    id="submitBtn">
                    <i class="fas fa-arrow-right mr-2"></i>Lanjutkan Voting
                </button>
            </form>
            <!-- Informasi Footer -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-star w-4 h-4 mr-2 text-blue-600"></i>
                    <span>Setiap suara menentukan masa depan organisasi</span>
                </div>
            </div>
        </div>
        <!-- Footer Copyright -->
        <div class="bg-gray-50 px-8 py-4 text-center">
            <p class="text-xs text-gray-500">© 2023 E-Voting IPM. Hak Cipta Dilindungi.</p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nisInput = document.getElementById('nis');
            setTimeout(() => {
                nisInput.focus();
            }, 500);
            // Validasi input NIS (hanya angka)
            nisInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            // Tampilkan SweetAlert jika ada flash message
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                const type = flashMessage.getAttribute('data-type');
                const message = flashMessage.getAttribute('data-message');
                if (type === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: message,
                        confirmButtonColor: '#1e40af',
                        confirmButtonText: 'OK',
                        background: '#ffffff',
                        iconColor: '#10B981',
                        customClass: {
                            title: 'text-xl font-semibold text-gray-800',
                            confirmButton: 'px-5 py-2 rounded-lg bg-blue-700 text-white'
                        }
                    });
                } else if (type === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: message,
                        confirmButtonColor: '#1e40af',
                        confirmButtonText: 'Coba Lagi',
                        background: '#ffffff',
                        iconColor: '#EF4444',
                        customClass: {
                            title: 'text-xl font-semibold text-gray-800',
                            confirmButton: 'px-5 py-2 rounded-lg bg-blue-700 text-white'
                        }
                    });
                }
            }
            // SweetAlert konfirmasi sebelum submit form
            const form = document.getElementById('nisForm');
            const submitBtn = document.getElementById('submitBtn');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const nisValue = document.getElementById('nis').value;
                if (!nisValue) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'NIS Kosong',
                        text: 'Silakan masukkan NIS Anda terlebih dahulu',
                        confirmButtonColor: '#1e40af',
                        confirmButtonText: 'OK',
                        background: '#ffffff',
                        iconColor: '#F59E0B',
                        customClass: {
                            title: 'text-xl font-semibold text-gray-800',
                            confirmButton: 'px-5 py-2 rounded-lg bg-blue-700 text-white'
                        }
                    });
                    return;
                }
                // Tampilkan loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin mr-2"></i>Memverifikasi...
                `;
                // Lakukan submit form setelah 1 detik (simulasi proses)
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        });
    </script>
</body>

</html>
