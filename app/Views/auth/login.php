<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Halaman login Website Satuan Pengawas Internal Politeknik Negeri Sriwijaya (SPI POLSRI). Akses akun Anda untuk mengelola data dan informasi akademik.">

    <title>Login - SPI POLSRI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary-blue': '#1e40af',
                        'secondary-blue': '#3b82f6',
                    },
                },
            }
        }
    </script>
    <style>
        .transition-transform-opacity {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        .input-focus-border {
            transition: border-color 0.3s ease-in-out;
        }

        .input-focus-border:focus {
            border-color: #3b82f6;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">
    <div class="flex flex-col md:flex-row min-h-screen">

        <!-- Kolom Kiri: Gambar Latar Belakang -->
        <div class="relative w-full md:w-1/2 bg-cover bg-center hidden md:block" style="background-image: url('/images/image3.jpg');">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-10">
                <div class="text-white">
                    <h2 class="text-4xl font-bold drop-shadow-lg">SPI POLSRI</h2>
                    <p class="mt-2 text-lg font-light drop-shadow">Selamat datang! Masuk untuk mengakses portal akses website.</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-red-600/70 via-blue-800/50 to-slate-700/30 z-10"></div>
            </div>
        </div>

        <!-- Kolom Kanan: Formulir Login -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-6 md:p-12 lg:p-16 relative">

            <a href="/" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition duration-150">
                <svg class="w-8 h-8 md:w-10 md:h-10 p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>

            <a href="/" class="inline-flex items-center space-x-4 group p-5 border border-gray-200 bg-white rounded-lg shadow-sm mb-6">
                <img src="<?= base_url('images/polsri.png') ?>" alt="Logo POLSRI"
                    class="h-16 sm:h-20 transition-all duration-300 drop-shadow-sm">
                <div class="text-black font-bold text-left -space-y-1.5">
                    <div class="text-xl sm:text-xxl tracking-wide">SATUAN</div>
                    <div class="text-xl sm:text-xxl tracking-wide">PENGAWASAN</div>
                    <div class="text-xl sm:text-xxl tracking-wide">INTERNAL</div>
                </div>
            </a>
            <div class="w-full max-w-lg bg-white rounded-2xl md:shadow-lg p-8 sm:p-10 transition-transform-opacity hover:scale-105">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-extrabold text-primary-blue">LOGIN</h1>
                    <p class="text-gray-500 mt-2">Masukkan kredensial Anda untuk melanjutkan.</p>
                </div>

                <!-- Formulir Login -->
                <form action="/login" method="post">
                    <input type="hidden" name="csrf_token" value="your_csrf_token_here">

                    <div class="mb-5">
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username atau Email</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus-border transition duration-150" placeholder="Masukkan username atau email Anda" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus-border transition duration-150" placeholder="Masukkan password Anda" required>
                    </div>

                    <button type="submit" class="w-full bg-primary-blue text-white font-bold py-3 px-4 rounded-lg hover:bg-secondary-blue focus:outline-none focus:ring-2 focus:ring-secondary-blue focus:ring-offset-2 transition duration-150 shadow-md hover:shadow-lg">
                        Masuk
                    </button>
                </form>

                <div id="error-message" class="mt-6 p-3 bg-red-100 text-red-700 border border-red-400 rounded-lg text-sm text-center" style="display:none;">
                    Username atau password salah. Silakan coba lagi.
                </div>

                <div class="text-center mt-6 text-sm text-gray-500">
                    <p>Lupa kata sandi? <a href="/forgot-password" class="text-secondary-blue hover:underline">Reset di sini.</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>