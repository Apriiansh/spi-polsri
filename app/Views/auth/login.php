<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Metadata untuk SEO dan Responsivitas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Halaman login resmi untuk Sistem Informasi Poltekkes Sriwijaya (SPI POLSRI). Akses akun Anda untuk mengelola data dan informasi akademik.">

    <!-- Title yang deskriptif untuk SEO -->
    <title>Login - SPI POLSRI</title>

    <!-- Google Fonts - Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Kustomisasi Tailwind untuk font Inter -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 antialiased">
    <div class="flex items-center justify-center min-h-screen p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-300 hover:scale-105">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Login</h1>
                <!-- <p class="text-gray-500 mt-2">Masukkan kredensial Anda untuk melanjutkan.</p> -->
            </div>

            <!-- Formulir Login -->
            <!-- Catatan: `action` dan `value` ini perlu disesuaikan di sisi server -->
            <form action="/login" method="post">
                <!-- CSRF Field (untuk demo, ini statis) -->
                <input type="hidden" name="csrf_token" value="your_csrf_token_here">

                <!-- Username/Email Field -->
                <div class="mb-5">
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username atau Email</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150" placeholder="Masukkan username atau email Anda" required>
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150" placeholder="Masukkan password Anda" required>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 shadow-md hover:shadow-lg">
                    Masuk
                </button>
            </form>

            <!-- Pesan Error Statis untuk Demo Styling -->
            <!-- Ini adalah contoh bagaimana pesan error akan terlihat. Logicnya perlu diimplementasikan di sisi server. -->
            <div id="error-message" class="mt-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md text-sm text-center" style="display:none;">
                Username atau password salah. Silakan coba lagi.
            </div>

        </div>
    </div>
</body>

</html>