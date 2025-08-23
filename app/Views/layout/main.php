<?php

/**
 * Main Layout Template - Optimized Version
 * SPI POLSRI - Satuan Pengawas Internal
 */

// Helper function for secure output
function safe_output($data, $encoding = 'UTF-8')
{
    return htmlspecialchars($data ?? '', ENT_QUOTES | ENT_HTML5, $encoding);
}

// Configuration
$siteName = 'SPI POLSRI';
$siteDescription = 'Satuan Pengawas Internal Politeknik Negeri Sriwijaya - Mewujudkan tata kelola yang baik melalui pengawasan berkualitas tinggi';
$pageTitle = $title ?? $siteName;
$fullTitle = ($title && $title !== $siteName) ? $title . ' - ' . $siteName : $siteName;
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= safe_output($description ?? $siteDescription) ?>">
    <meta name="keywords" content="SPI, POLSRI, Pengawasan Internal, Audit, Gratifikasi, Politeknik Negeri Sriwijaya">
    <meta name="author" content="SPI POLSRI">
    <meta name="theme-color" content="#2563eb">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= safe_output($pageTitle) ?>">
    <meta property="og:description" content="<?= safe_output($description ?? $siteDescription) ?>">
    <meta property="og:image" content="<?= safe_output(base_url('images/polsri-og.jpg')) ?>">
    <meta property="og:url" content="<?= safe_output(current_url()) ?>">
    <meta property="og:site_name" content="<?= safe_output($siteName) ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="<?= safe_output($pageTitle) ?>">
    <meta property="twitter:description" content="<?= safe_output($description ?? $siteDescription) ?>">
    <meta property="twitter:image" content="<?= safe_output(base_url('images/polsri-og.jpg')) ?>">

    <title><?= safe_output($fullTitle) ?></title>

    <!-- Preload critical resources -->
    <link rel="preload" href="<?= base_url('fonts/inter-var.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= base_url('css/main.min.css') ?>" as="style">

    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdn.tailwindcss.com">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon-16x16.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('images/apple-touch-icon.png') ?>">

    <!-- Critical CSS -->
    <style>
        /* Critical above-the-fold styles */
        :root {
            --primary: #2563eb;
            --secondary: #1e40af;
            --accent: #3b82f6;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #f0f9ff, #e0f2fe);
            min-height: 100vh;
            line-height: 1.6;
            color: #1f2937;
        }

        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary);
            color: white;
            padding: 8px;
            border-radius: 4px;
            text-decoration: none;
            z-index: 100;
            font-size: 0.875rem;
        }

        .skip-link:focus {
            top: 6px;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Loading transition for content */
        .main-content {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-out 0.1s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Focus styles for accessibility */
        :focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#2563eb',
                        'secondary': '#1e40af',
                        'accent': '#3b82f6',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-subtle': 'bounceSubtle 2s infinite',
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts with display swap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col antialiased">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-link">
        Lewati ke konten utama
    </a>

    <!-- Navigation -->
    <?= $this->include('layout/navbar') ?>

    <!-- Main Content -->
    <main id="main-content" class="main-content container mx-auto px-4 sm:px-6 lg:px-8 py-6 flex-grow" role="main">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <?= $this->include('layout/footer') ?>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-6 right-6 bg-primary hover:bg-secondary text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 opacity-0 pointer-events-none z-40"
        aria-label="Kembali ke atas">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Enhanced JavaScript -->
    <script>
        'use strict';

        class SPILayoutManager {
            constructor() {
                this.backToTopBtn = document.getElementById('back-to-top');
                this.init();
            }

            init() {
                this.setupBackToTop();
                this.setupSmoothScrolling();
                this.setupImageOptimization();
                this.setupAccessibility();
                this.setupPerformanceMonitoring();
            }

            // Back to top functionality
            setupBackToTop() {
                if (!this.backToTopBtn) return;

                let ticking = false;
                const toggleBackToTop = () => {
                    if (!ticking) {
                        requestAnimationFrame(() => {
                            const shouldShow = window.pageYOffset > 300;
                            this.backToTopBtn.classList.toggle('opacity-0', !shouldShow);
                            this.backToTopBtn.classList.toggle('pointer-events-none', !shouldShow);
                            this.backToTopBtn.classList.toggle('opacity-100', shouldShow);
                            ticking = false;
                        });
                        ticking = true;
                    }
                };

                window.addEventListener('scroll', toggleBackToTop, {
                    passive: true
                });

                this.backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // Smooth scrolling for anchor links
            setupSmoothScrolling() {
                document.addEventListener('click', (e) => {
                    if (e.target.matches('a[href^="#"]')) {
                        e.preventDefault();
                        const target = document.querySelector(e.target.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                            // Update URL without page jump
                            history.pushState(null, null, e.target.getAttribute('href'));
                        }
                    }
                });
            }

            // Optimize image loading
            setupImageOptimization() {
                if ('IntersectionObserver' in window) {
                    const imageObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                if (img.dataset.src) {
                                    img.src = img.dataset.src;
                                    img.removeAttribute('data-src');
                                }
                                img.classList.add('opacity-100');
                                imageObserver.unobserve(img);
                            }
                        });
                    }, {
                        rootMargin: '50px 0px'
                    });

                    document.querySelectorAll('img[data-src], img[loading="lazy"]').forEach(img => {
                        img.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                        imageObserver.observe(img);
                    });
                }
            }

            // Enhanced accessibility features
            setupAccessibility() {
                // Focus management for dynamic content
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        // Close any open modals or dropdowns
                        document.querySelectorAll('.modal-open, .dropdown-open').forEach(el => {
                            el.classList.remove('modal-open', 'dropdown-open');
                        });
                    }
                });

                // Announce dynamic content changes to screen readers
                const announceToScreenReader = (message) => {
                    const announcement = document.createElement('div');
                    announcement.setAttribute('aria-live', 'polite');
                    announcement.setAttribute('aria-atomic', 'true');
                    announcement.className = 'sr-only';
                    announcement.textContent = message;
                    document.body.appendChild(announcement);
                    setTimeout(() => document.body.removeChild(announcement), 1000);
                };

                // Make this available globally
                window.announceToScreenReader = announceToScreenReader;
            }

            // Performance monitoring
            setupPerformanceMonitoring() {
                if ('performance' in window) {
                    window.addEventListener('load', () => {
                        // Measure performance metrics
                        setTimeout(() => {
                            const perfData = performance.getEntriesByType('navigation')[0];
                            if (perfData) {
                                const metrics = {
                                    pageLoadTime: Math.round(perfData.loadEventEnd - perfData.loadEventStart),
                                    domContentLoaded: Math.round(perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart),
                                    firstByte: Math.round(perfData.responseStart - perfData.requestStart)
                                };

                                // Log performance metrics (only in development)
                                if (window.location.hostname === 'localhost' || window.location.hostname.includes('dev')) {
                                    console.log('Performance Metrics:', metrics);
                                }
                            }
                        }, 0);
                    });
                }
            }
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => new SPILayoutManager());
        } else {
            new SPILayoutManager();
        }

        // Service Worker registration for PWA (optional)
        if ('serviceWorker' in navigator && 'production' === '<?= ENVIRONMENT ?>') {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered'))
                    .catch(error => console.log('SW registration failed'));
            });
        }
    </script>

    <!-- Additional CSS for enhanced styling -->
    <style>
        /* Enhanced animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceSubtle {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-4px);
            }

            60% {
                transform: translateY(-2px);
            }
        }

        /* Enhanced shadows */
        .shadow-soft {
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
        }

        .shadow-soft-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Button enhancements */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--primary));
            transition: all 0.2s ease;
            will-change: transform, box-shadow;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.25);
        }

        /* Form enhancements */
        .form-input:focus {
            ring-width: 2px;
            ring-color: var(--primary);
            border-color: var(--primary);
        }

        /* Screen reader only content */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Print styles */
        @media print {

            .no-print,
            #back-to-top,
            nav,
            footer {
                display: none !important;
            }

            body {
                background: white !important;
                font-size: 12pt;
            }

            .main-content {
                margin: 0;
                padding: 0;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --primary: #000080;
                --secondary: #000060;
                --accent: #0000a0;
            }
        }

        /* Dark mode preparation */
        @media (prefers-color-scheme: dark) {
            /* Will be implemented based on design requirements */
        }
    </style>
</body>

</html>