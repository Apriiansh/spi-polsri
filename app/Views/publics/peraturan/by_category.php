<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>

    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-block p-4 bg-white/10 backdrop-blur-sm rounded-xl mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($title) ?></h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<!-- Content Section -->
<div class="container mx-auto px-6 py-12">
    <?php if (empty($peraturan)) : ?>
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-file-alt text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Peraturan</h3>
            <p class="text-sm text-gray-500">Saat ini tidak ada peraturan yang tersedia untuk kategori ini.</p>
        </div>
    <?php else : ?>

        <?php
        $grouped = [];
        foreach ($peraturan as $item) {
            $grouped[$item['peraturan']][] = $item;
        }

            $priority = ['Undang-Undang', 'Peraturan Pemerintah', 'Peraturan Presiden'];
            $ordered = [];

            if (isset($grouped['Undang-Undang'])) {
                $ordered['Undang-Undang'] = $grouped['Undang-Undang'];
                unset($grouped['Undang-Undang']);
            }
            foreach (['Peraturan Pemerintah', 'Peraturan Presiden'] as $key) {
                if (isset($grouped[$key])) {
                    $ordered[$key] = $grouped[$key];
                    unset($grouped[$key]);
                }
            }
            foreach ($grouped as $key => $items) {
                $ordered[$key] = $items;
            }
        ?>

        <?php foreach ($ordered as $peraturanKey => $items) : ?>
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 border-b-2 border-blue-500 pb-3 mb-6 uppercase">
                    <?= esc($peraturanKey) ?>
                </h2>
                <div class="space-y-2">
                    <?php foreach ($items as $index => $item) : ?>
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                            <!-- Clickable Header -->
                            <button 
                                onclick="toggleItem('item-<?= $peraturanKey ?>-<?= $index ?>')"
                                class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition-colors duration-150 group">
                                <div class="flex items-start gap-3 flex-1">
                                    <!-- Title -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-base font-medium text-gray-800 group-hover:text-blue-600 transition-colors pr-2">
                                            <?= esc($item['judul']) ?>
                                        </h3>
                                    </div>
                                </div>
                                
                                <!-- Expand Icon -->
                                <div class="flex-shrink-0 ml-3">
                                    <svg id="icon-<?= $peraturanKey ?>-<?= $index ?>" 
                                         class="w-5 h-5 text-gray-400 transform transition-transform duration-200" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </button>
                            
                            <!-- Expandable Content -->
                            <div id="item-<?= $peraturanKey ?>-<?= $index ?>" 
                                 class="hidden border-t border-gray-200 bg-gray-50">
                                <div class="p-4 flex items-center justify-between">
                                    <a href="<?= base_url('peraturan/download/' . $item['id']) ?>"
                                        class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Pagination -->
        <?php if ($pager->getPageCount() > 1) : ?>
            <div class="mt-8">
                <?= $pager->links('default', 'tailwind_full') ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>

<script>
function toggleItem(id) {
    const content = document.getElementById(id);
    const icon = document.getElementById('icon-' + id.replace('item-', ''));
    
    if (content.classList.contains('hidden')) {
        // Expand
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(45deg)';
    } else {
        // Collapse
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>

<?= $this->endSection() ?>