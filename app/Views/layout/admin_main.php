<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#3730a3',
                        sidebar: '#1e293b',
                        'sidebar-hover': '#334155'
                    }
                }
            }
        }
    </script>
    <style>
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <div class="flex">
        <?= $this->include('layout/admin_sidebar') ?>

        <main class="flex-1 ml-64 transition-all duration-300">
            <div class="p-8">
                <div class="glass-effect rounded-2xl shadow-xl border border-white/20 p-8">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add loading state for navigation
        document.querySelectorAll('a[href^="/admin"]').forEach(link => {
            link.addEventListener('click', function(e) {
                this.style.opacity = '0.7';
                this.style.pointerEvents = 'none';
                setTimeout(() => {
                    this.style.opacity = '1';
                    this.style.pointerEvents = 'auto';
                }, 2000);
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>