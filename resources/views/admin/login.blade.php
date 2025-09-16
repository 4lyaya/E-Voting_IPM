<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - E-Voting IPM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .admin-login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
            transition: all 0.3s ease;
        }

        .admin-login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .admin-input-field {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .admin-input-field:focus {
            border-color: #1e40af;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
        }

        .admin-login-btn {
            background-color: #1e40af;
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
        }

        .admin-login-btn:hover {
            background-color: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
        }

        .admin-pulse {
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

        .admin-floating-icon {
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

        .security-badge {
            position: relative;
            overflow: hidden;
        }

        .security-badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-color: rgba(255, 255, 255, 0.2);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }
    </style>
</head>

<body>
    <div class="admin-login-card">
        <div class="p-8">
            <!-- Header dengan ikon keamanan -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-5">
                    <div class="security-badge bg-blue-100 p-5 rounded-2xl inline-flex admin-floating-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-blue-700 mb-2">ADMIN PANEL</h1>
                <p class="text-gray-600">E-Voting IPM - Akses Terbatas</p>
            </div>
            <!-- Alert Notifikasi (akan disembunyikan dan digantikan SweetAlert) -->
            @if (session('error'))
                <div class="hidden" id="flash-message" data-type="error" data-message="{{ session('error') }}"></div>
            @endif
            <!-- Form Login -->
            <form action="{{ route('admin.login.post') }}" method="POST" id="adminLoginForm">
                @csrf
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="username" name="username" class="admin-input-field pl-10 w-full"
                            placeholder="Masukkan username admin" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" class="admin-input-field pl-10 w-full"
                            placeholder="Masukkan password admin" required>
                    </div>
                </div>
                <button type="submit"
                    class="admin-login-btn w-full text-white font-medium text-sm px-5 py-2.5 text-center admin-pulse"
                    id="adminSubmitBtn">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Masuk sebagai Admin
                </button>
            </form>
            <!-- Informasi Keamanan -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-start text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zm7-10a1 1 0 01.967.744L14.146 7.2 17 8.134a1 1 0 010 1.732l-2.854 1.134-1.18 2.56a1 1 0 01-1.933 0L9.854 12.2 7 11.266a1 1 0 010-1.732l2.854-1.134 1.18-2.56A1 1 0 0112 2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Akses terbatas untuk administrator sistem yang berwenang. Semua aktivitas dicatat dan
                        dipantau.</span>
                </div>
            </div>
        </div>
        <!-- Footer Copyright -->
        <div class="bg-gray-50 px-8 py-4 text-center">
            <p class="text-xs text-gray-500">© 2023 E-Voting IPM. Hak Cipta Dilindungi. <span
                    class="font-semibold">Akses Admin</span></p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usernameInput = document.getElementById('username');
            setTimeout(() => {
                usernameInput.focus();
            }, 500);
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                const type = flashMessage.getAttribute('data-type');
                const message = flashMessage.getAttribute('data-message');
                if (type === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Akses Ditolak',
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
            const form = document.getElementById('adminLoginForm');
            const submitBtn = document.getElementById('adminSubmitBtn');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const usernameValue = document.getElementById('username').value;
                const passwordValue = document.getElementById('password').value;
                if (!usernameValue || !passwordValue) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Tidak Lengkap',
                        text: 'Silakan masukkan username dan password Anda',
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
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memverifikasi Akses...
                `;
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        });
    </script>
</body>

</html>
