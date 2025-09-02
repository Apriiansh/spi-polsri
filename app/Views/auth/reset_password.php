<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SPI POLSRI</title>
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
                <h1 class="text-3xl font-extrabold text-primary-blue">Reset Password</h1>
                <p class="text-gray-500 mt-2">Masukkan password baru Anda.</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-lg text-sm text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/update-password" method="post">
                <input type="hidden" name="token" value="<?= $token ?? '' ?>">
                <div class="mb-5">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-secondary-blue transition duration-150" placeholder="Masukkan password baru" required>
                </div>

                <div class="mb-6">
                    <label for="password_confirm" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-secondary-blue transition duration-150" placeholder="Konfirmasi password baru" required>
                </div>

                <button type="submit" class="w-full bg-primary-blue text-white font-bold py-3 px-4 rounded-lg hover:bg-secondary-blue focus:outline-none focus:ring-2 focus:ring-secondary-blue focus:ring-offset-2 transition duration-150 shadow-md hover:shadow-lg">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</body>

</html>