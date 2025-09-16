<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kandidat - E-Voting IPM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .stats-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary);
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
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

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .candidate-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
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
                    <p class="text-sm text-blue-100">Manajemen Kandidat</p>
                </div>
            </div>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('admin.results') }}"
                    class="nav-link text-white hover:text-blue-200 transition flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i> Hasil
                </a>
                <a href="{{ route('students.index') }}"
                    class="nav-link text-white hover:text-blue-200 transition flex items-center">
                    <i class="fas fa-users mr-2"></i> Siswa
                </a>
                <a href="{{ route('candidates.index') }}" class="nav-link active text-white flex items-center">
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
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 fade-in">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Kandidat</h1>
                <p class="text-gray-600 mt-2">Kelola data kandidat Ketua IPM</p>
            </div>
            <a href="{{ route('candidates.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl flex items-center transition transform hover:scale-105 mt-4 md:mt-0">
                <i class="fas fa-user-plus mr-2"></i>
                Tambah Kandidat
            </a>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-blue-100 p-4 mr-5">
                        <i class="fas fa-user-check text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Kandidat</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $candidates->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-purple-100 p-4 mr-5">
                        <i class="fas fa-vote-yea text-2xl text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Suara</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalVotes }}</p>
                    </div>
                </div>
            </div>
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-green-100 p-4 mr-5">
                        <i class="fas fa-chart-line text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Rata-rata Suara</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">
                            {{ $candidates->total() > 0 ? number_format($totalVotes / $candidates->total(), 1) : 0 }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Notifications -->
        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg fade-in flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div
                class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg fade-in flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <!-- Candidates Grid -->
        <div class="stats-card p-0 overflow-hidden fade-in">
            <div class="bg-blue-600 p-6 text-white">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-users mr-3"></i> Daftar Kandidat
                </h2>
            </div>
            @if ($candidates->count() > 0)
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($candidates as $candidate)
                        <div
                            class="candidate-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                            <!-- Photo -->
                            <div class="h-48 bg-gray-200 overflow-hidden">
                                @if ($candidate->photo)
                                    <img src="{{ asset('storage/' . $candidate->photo) }}"
                                        alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-user-circle text-6xl text-blue-400"></i>
                                    </div>
                                @endif
                            </div>
                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $candidate->name }}</h3>
                                <div class="mb-3">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-1 flex items-center">
                                        <i class="fas fa-eye mr-2 text-blue-500"></i> Visi:
                                    </h4>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $candidate->vision }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-1 flex items-center">
                                        <i class="fas fa-bullseye mr-2 text-blue-500"></i> Misi:
                                    </h4>
                                    <p class="text-sm text-gray-600 line-clamp-3">{{ $candidate->mission }}</p>
                                </div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full flex items-center">
                                        <i class="fas fa-vote-yea mr-1"></i>
                                        {{ $candidate->votes_count }} Suara
                                    </span>
                                    @if ($candidate->votes_count > 0)
                                        <span class="text-xs font-medium text-gray-500">
                                            {{ $totalVotes > 0 ? number_format(($candidate->votes_count / $totalVotes) * 100, 1) : 0 }}%
                                        </span>
                                    @endif
                                </div>
                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('candidates.edit', $candidate->id) }}"
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-xl transition flex items-center justify-center">
                                        <i class="fas fa-edit mr-1 text-sm"></i> Edit
                                    </a>
                                    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST"
                                        class="flex-1 delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-xl transition flex items-center justify-center delete-btn">
                                            <i class="fas fa-trash-alt mr-1 text-sm"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                @if ($candidates->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $candidates->links('vendor.pagination.custom') }}
                    </div>
                @endif
            @else
                <div class="p-12 text-center">
                    <div class="flex flex-col items-center justify-center text-gray-400">
                        <i class="fas fa-user-slash text-5xl mb-4"></i>
                        <p class="text-lg font-medium">Belum ada kandidat</p>
                        <p class="text-sm mt-2 mb-5">Silakan tambahkan kandidat untuk memulai voting</p>
                        <a href="{{ route('candidates.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl flex items-center transition">
                            <i class="fas fa-user-plus mr-2"></i>
                            Tambah Kandidat
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script>
        // Konfirmasi hapus dengan SweetAlert2
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data kandidat akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        title: 'text-lg font-semibold text-gray-800',
                        confirmButton: 'px-4 py-2 rounded-lg bg-blue-600',
                        cancelButton: 'px-4 py-2 rounded-lg bg-gray-500 text-white'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
