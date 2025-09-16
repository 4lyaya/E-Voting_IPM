<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa - E-Voting IPM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #8b5cf6;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --light: #f8fafc;
            --dark: #1e293b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
        }

        .admin-nav {
            background-color: var(--primary);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            transition: all 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: white;
            border-radius: 3px;
            transition: width 0.3s;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="admin-nav px-6 py-4 shadow-lg">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="flex items-center space-x-3">
                <div class="bg-white/20 p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <span class="self-center text-2xl font-bold whitespace-nowrap text-white">Dashboard Admin</span>
                    <p class="text-sm text-blue-100">Tambah Siswa Baru</p>
                </div>
            </div>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('admin.results') }}"
                    class="nav-link text-white hover:text-blue-200 transition flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i> Hasil
                </a>
                <a href="{{ route('students.index') }}" class="nav-link active text-white flex items-center">
                    <i class="fas fa-users mr-2"></i> Siswa
                </a>
                <a href="{{ route('candidates.index') }}"
                    class="nav-link text-white hover:text-blue-200 transition flex items-center">
                    <i class="fas fa-user-check mr-2"></i> Kandidat
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-white/20 hover:bg-white/30 text-white font-medium rounded-xl px-5 py-2.5 flex items-center transition-all duration-300 shadow hover:shadow-md">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <!-- Header -->
        <div class="mb-8 fade-in">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Siswa Baru</h1>
            <p class="text-gray-600 mt-1">Isi form berikut untuk menambahkan siswa baru</p>
        </div>
        <!-- Form -->
        <div class="form-card p-8 fade-in">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="nis" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-id-card mr-2 text-blue-600"></i>NIS
                    </label>
                    <input type="text" id="nis" name="nis" value="{{ old('nis') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-input transition"
                        placeholder="Masukkan NIS" required>
                    @error('nis')
                        <p class="text-red-500 text-xs mt-1"><i
                                class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Nama Siswa
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-input transition"
                        placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1"><i
                                class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                <!-- Actions -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('students.index') }}"
                        class="px-5 py-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition transform hover:scale-105 flex items-center">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
