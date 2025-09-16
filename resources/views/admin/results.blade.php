<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Voting - E-Voting IPM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .percentage-bar {
            background-color: var(--primary);
            height: 8px;
            border-radius: 4px;
            transition: width 1s ease-in-out;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }

        .candidate-progress {
            transition: all 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55);
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

        .winner-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--warning);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.4);
            z-index: 10;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Notifikasi Login Success (hidden) -->
    @if (session('login_success'))
        <div class="hidden" id="login-success-message" data-message="{{ session('login_success') }}"></div>
    @endif
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
                    <p class="text-sm text-blue-100">Hasil Voting Ketua IPM</p>
                </div>
            </div>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('admin.results') }}" class="nav-link active text-white flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i> Hasil
                </a>
                <a href="{{ route('students.index') }}"
                    class="nav-link text-white hover:text-blue-200 transition flex items-center">
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
        <div class="text-center mb-10 animate-slide-in">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Hasil Voting Ketua IPM</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Statistik lengkap perolehan suara kandidat dalam
                pemilihan Ketua Ikatan Pelajar Muhammadiyah</p>
        </div>
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-blue-100 p-4 mr-5">
                        <i class="fas fa-vote-yea text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Pemilih</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalVotes }}</p>
                        <div class="mt-2 text-xs text-blue-600 font-medium">
                            <i class="fas fa-users mr-1"></i> Seluruh Siswa
                        </div>
                    </div>
                </div>
            </div>
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-green-100 p-4 mr-5">
                        <i class="fas fa-user-friends text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jumlah Kandidat</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $candidates->count() }}</p>
                        <div class="mt-2 text-xs text-green-600 font-medium">
                            <i class="fas fa-check-circle mr-1"></i> Calon Ketua IPM
                        </div>
                    </div>
                </div>
            </div>
            <div class="stats-card p-6">
                <div class="flex items-center">
                    <div class="rounded-xl bg-purple-100 p-4 mr-5">
                        <i class="fas fa-chart-pie text-2xl text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Rata-rata Suara</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">
                            {{ $totalVotes > 0 ? number_format($totalVotes / $candidates->count(), 1) : 0 }}
                        </p>
                        <div class="mt-2 text-xs text-purple-600 font-medium">
                            <i class="fas fa-calculator mr-1"></i> Per Kandidat
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <!-- Chart Section -->
            <div class="stats-card p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-chart-bar text-blue-600"></i>
                        </div>
                        Statistik Voting
                    </h2>
                    <div class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-medium">
                        <i class="fas fa-live-chart mr-1"></i> REAL-TIME
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="voteChart"></canvas>
                </div>
            </div>
            <!-- Winner Card -->
            @php
                $winner = $candidates->sortByDesc('votes_count')->first();
                $maxVotes = $totalVotes > 0 ? $candidates->max('votes_count') : 1;
            @endphp
            <div class="stats-card p-0 overflow-hidden card-hover">
                @if ($winner && $winner->votes_count > 0)
                    <div class="winner-badge">
                        <i class="fas fa-crown mr-1"></i> PEMENANG SEMENTARA
                    </div>
                @endif
                <div class="bg-blue-600 p-6 text-white">
                    <h2 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-trophy mr-3"></i>
                        @if ($winner && $winner->votes_count > 0)
                            Kandidat Terpopuler
                        @else
                            Belum Ada Pemenang
                        @endif
                    </h2>
                </div>
                <div class="p-6">
                    @if ($winner && $winner->votes_count > 0)
                        <div class="text-center mb-5">
                            <div
                                class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 overflow-hidden border-4 border-blue-100 shadow-lg">
                                <i class="fas fa-user-circle text-5xl text-gray-400 mt-5"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $winner->name }}</h3>
                            <p class="text-gray-600">Kandidat No. {{ $index }}</p>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm font-medium text-gray-600 mb-2">
                                <span>Perolehan Suara</span>
                                <span>{{ $winner->votes_count }} suara
                                    ({{ number_format(($winner->votes_count / $totalVotes) * 100, 1) }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="h-3 rounded-full bg-blue-600"
                                    style="width: {{ ($winner->votes_count / $maxVotes) * 100 }}%">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600">Belum Ada Suara Masuk</h3>
                            <p class="text-gray-500 mt-2">Hasil voting akan ditampilkan di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Detail Perolehan Suara -->
        <div class="stats-card p-6 mb-10">
            <h2 class="text-xl font-semibold mb-5 text-gray-800 flex items-center">
                <div class="bg-green-100 p-2 rounded-lg mr-3">
                    <i class="fas fa-clipboard-list text-green-600"></i>
                </div>
                Detail Perolehan Suara
            </h2>
            <div class="overflow-x-auto rounded-xl shadow-inner">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4">Kandidat</th>
                            <th scope="col" class="px-6 py-4">Suara</th>
                            <th scope="col" class="px-6 py-4">Persentase</th>
                            <th scope="col" class="px-6 py-4">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalVotes = $candidates->sum('votes_count');
                            $maxVotes = $totalVotes > 0 ? $candidates->max('votes_count') : 1;
                        @endphp
                        @foreach ($candidates as $candidate)
                            @php
                                $percentage = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
                                $progressWidth = $totalVotes > 0 ? ($candidate->votes_count / $maxVotes) * 100 : 0;
                                $colors = ['#3B82F6', '#10B981', '#EF4444', '#F59E0B', '#8B5CF6'];
                                $color = $colors[$loop->index % count($colors)];
                            @endphp
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full mr-3"
                                            style="background-color: {{ $color }}"></div>
                                        <div>
                                            <div>{{ $candidate->name }}</div>
                                            <div class="text-xs text-gray-500">Kandidat #{{ $loop->iteration }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold">{{ $candidate->votes_count }}</div>
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    <div class="flex items-center">
                                        {{ number_format($percentage, 1) }}%
                                        @if ($percentage >= 20)
                                            <i class="fas fa-arrow-up text-green-500 ml-2"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="h-2.5 rounded-full candidate-progress"
                                            style="width: {{ $progressWidth }}%; background-color: {{ $color }}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-semibold">
                            <td class="px-6 py-4">Total</td>
                            <td class="px-6 py-4">{{ $totalVotes }}</td>
                            <td class="px-6 py-4">100%</td>
                            <td class="px-6 py-4">
                                <div class="w-full bg-gray-300 rounded-full h-2.5">
                                    <div class="h-2.5 rounded-full bg-gray-600" style="width: 100%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginSuccess = document.getElementById('login-success-message');
            if (loginSuccess) {
                const message = loginSuccess.getAttribute('data-message');
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: message,
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'Lanjutkan',
                    background: '#ffffff',
                    iconColor: '#10B981',
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        title: 'text-xl font-semibold text-gray-800',
                        confirmButton: 'px-5 py-2.5 rounded-xl bg-blue-600 text-white font-medium'
                    }
                });
            }
            const ctx = document.getElementById('voteChart').getContext('2d');
            const candidates = @json($candidates->pluck('name'));
            const votes = @json($candidates->pluck('votes_count'));
            const colors = ['#3B82F6', '#10B981', '#EF4444', '#F59E0B', '#8B5CF6'];
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: candidates,
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: votes,
                        backgroundColor: colors,
                        borderColor: colors.map(color => color.replace(')', ', 0.8)').replace('rgb',
                            'rgba')),
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: colors.map(color => color.replace(')', ', 0.8)')
                            .replace('rgb', 'rgba')),
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    family: "'Poppins', sans-serif",
                                    weight: '500'
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    family: "'Poppins', sans-serif",
                                    weight: '500'
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                family: "'Poppins', sans-serif"
                            },
                            bodyFont: {
                                family: "'Poppins', sans-serif"
                            },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
            // Animate progress bars
            setTimeout(() => {
                document.querySelectorAll('.candidate-progress').forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 300);
                });
            }, 500);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
