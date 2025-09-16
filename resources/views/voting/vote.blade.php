<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kandidat - E-Voting IPM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
        }

        .candidate-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid transparent;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: #3B82F6;
        }

        .candidate-image {
            height: 280px;
            transition: all 0.3s ease;
        }

        .candidate-card:hover .candidate-image {
            transform: scale(1.05);
        }

        .vote-btn {
            background-color: #3B82F6;
            transition: all 0.3s ease;
        }

        .vote-btn:hover {
            background-color: #2563EB;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
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
    </style>
</head>

<body class="min-h-screen py-8">
    <!-- Navigation -->
    {{-- <nav class="bg-blue-600 text-white px-6 py-4 shadow-lg mb-8">
        <div class="container mx-auto flex justify-between items-center max-w-6xl">
            <div class="flex items-center space-x-3">
                <div class="bg-white/20 p-2 rounded-xl">
                    <i class="fas fa-vote-yea text-2xl text-white"></i>
                </div>
                <div>
                    <span class="self-center text-2xl font-bold whitespace-nowrap text-white">E-VOTING IPM</span>
                    <p class="text-sm text-blue-100">Pilih Kandidat Ketua IPM</p>
                </div>
            </div>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('voting.index') }}" class="nav-link active text-white flex items-center">
                    <i class="fas fa-vote-yea mr-2"></i> Voting
                </a>
                <a href="{{ route('admin.login') }}"
                    class="nav-link text-white hover:text-blue-200 transition flex items-center">
                    <i class="fas fa-user-shield mr-2"></i> Admin
                </a>
            </div>
        </div>
    </nav> --}}

    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-700 mb-3">E-VOTING KETUA IPM</h1>
            <p class="text-gray-600 text-lg">Gunakan hak pilih Anda dengan bijak untuk masa depan organisasi yang lebih
                baik</p>
            <div class="mt-6 bg-white rounded-lg shadow-sm p-4 inline-flex items-center">
                <i class="fas fa-id-card h-6 w-6 text-blue-500 mr-2"></i>
                <span class="text-gray-700">NIS: <strong>{{ session('verified_nis') }}</strong></span>
            </div>
        </div>
        <!-- Alert Info -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-8">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle h-5 w-5 text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>Penting:</strong> Pilihan Anda bersifat rahasia dan tidak dapat diubah setelah
                        dikonfirmasi. Pastikan Anda memilih dengan hati-hati.
                    </p>
                </div>
            </div>
        </div>
        <!-- Candidate Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($candidates as $candidate)
                <div class="candidate-card bg-white rounded-xl overflow-hidden">
                    <!-- Candidate Image -->
                    <div class="relative">
                        <div class="candidate-image w-full bg-gray-200 flex items-center justify-center"
                            style="height: 400px; cursor: pointer;"
                            onclick="confirmVote('{{ $candidate->name }}', '{{ $candidate->id }}', '{{ $candidate->photo ? asset('storage/' . $candidate->photo) : '' }}')">
                            @if ($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->name }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user-circle text-8xl text-blue-300"></i>
                                </div>
                            @endif
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            Kandidat {{ $loop->iteration }}
                        </div>
                    </div>
                    <!-- Candidate Info -->
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900">{{ $candidate->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Klik foto untuk memilih</p>

                        <!-- Hidden form for submission -->
                        <form action="{{ route('voting.vote') }}" method="POST" id="form-{{ $candidate->id }}"
                            class="candidate-form">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Footer Info -->
        <div class="mt-12 text-center text-gray-500 text-sm">
            <p>© 2025 E-Voting IPM. Hak Cipta Dilindungi.</p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script>
        function confirmVote(candidateName, candidateId, photo) {
            // Tampilkan modal konfirmasi dengan foto kandidat
            let imageHtml = '';

            Swal.fire({
                title: `Pilih ${candidateName}?`,
                html: `
            <div class="text-center">
                ${imageHtml}
                <p class="text-gray-600 mt-2">Anda tidak dapat mengubah pilihan setelah dikonfirmasi!</p>
            </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, pilih ini!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                background: '#ffffff',
                iconColor: '#3B82F6',
                width: '500px',
                customClass: {
                    title: 'text-xl font-semibold text-gray-800',
                    confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg',
                    cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById(`form-${candidateId}`).submit();
                }
            });
        }

        // Tambahkan efek ketika halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.candidate-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200 * index);
            });
        });
    </script>
</body>

</html>