<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa - E-Voting IPM</title>
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

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-link {
            color: var(--primary);
            border-radius: 8px;
            margin: 0 4px;
            padding: 8px 16px;
        }

        .pagination .page-link:hover {
            background-color: #e5e7eb;
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
                    <p class="text-sm text-blue-100">Manajemen Data Siswa</p>
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
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 fade-in">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Data Siswa</h1>
                <p class="text-gray-600 mt-2">Kelola data siswa yang berpartisipasi dalam voting</p>
            </div>
            <a href="{{ route('students.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl flex items-center transition transform hover:scale-105 mt-4 md:mt-0">
                <i class="fas fa-user-plus mr-2"></i>
                Tambah Siswa
            </a>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-blue-100 p-4 mr-5">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Siswa</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $students->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-green-100 p-4 mr-5">
                        <i class="fas fa-vote-yea text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Sudah Voting</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $votedCount }}</p>
                    </div>
                </div>
            </div>
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-yellow-100 p-4 mr-5">
                        <i class="fas fa-clock text-2xl text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Belum Voting</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $students->total() - $votedCount }}</p>
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
        <!-- Students Table -->
        <div class="stats-card p-0 overflow-hidden fade-in">
            <div class="bg-blue-600 p-6 text-white">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-list-alt mr-3"></i> Daftar Siswa
                </h2>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full table-auto">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">NIS</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Siswa</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status Voting</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($students as $student)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $student->nis }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $student->has_voted ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <i
                                                class="fas {{ $student->has_voted ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                                            {{ $student->has_voted ? 'Sudah Voting' : 'Belum Voting' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('students.edit', $student->id) }}"
                                                class="text-blue-600 hover:text-blue-800 transition flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-800 transition delete-btn flex items-center">
                                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <i class="fas fa-user-slash text-4xl mb-3"></i>
                                            <p class="text-lg font-medium">Tidak ada data siswa</p>
                                            <p class="text-sm mt-1">Silakan tambahkan data siswa terlebih dahulu</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                @if ($students->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $students->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
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
                    text: "Data siswa akan dihapus permanen!",
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
