<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'User Panel' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        'primary-dark': '#1e40af',
                        sidebar: '#1e293b',
                        'sidebar-hover': '#334155',
                        'user-primary': '#6366f1',
                        'user-primary-dark': '#4f46e5'
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

        .gradient-border {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2px;
            border-radius: 1rem;
        }

        .gradient-border-content {
            background: white;
            border-radius: calc(1rem - 2px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-indigo-50 min-h-screen">
    <div class="flex">
        <?= $this->include('layout/user_sidebar') ?>

        <main class="flex-1 ml-64 transition-all duration-300">
            <div class="p-8">
                <div class="glass-effect rounded-2xl shadow-xl border border-white/20 p-8">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.documentElement.style.scrollBehavior = 'smooth';

        document.querySelectorAll('a[href^="/user"]').forEach(link => {
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
</body>

</html>