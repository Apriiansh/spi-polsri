<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SPI POLSRI</title>
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
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-primary-blue">Lupa Password</h1>
                <p class="text-gray-500 mt-2">Masukkan email Anda untuk menerima link reset password.</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-lg text-sm text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-400 rounded-lg text-sm text-center">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="/send-reset-link" method="post">
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-secondary-blue transition duration-150" placeholder="Masukkan email Anda" required>
                </div>

                <button type="submit" class="w-full bg-primary-blue text-white font-bold py-3 px-4 rounded-lg hover:bg-secondary-blue focus:outline-none focus:ring-2 focus:ring-secondary-blue focus:ring-offset-2 transition duration-150 shadow-md hover:shadow-lg">
                    Kirim Link Reset
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-500">
                <p>Kembali ke <a href="/login" class="text-secondary-blue hover:underline">halaman login</a>.</p>
            </div>
        </div>
    </div>
</body>

</html>