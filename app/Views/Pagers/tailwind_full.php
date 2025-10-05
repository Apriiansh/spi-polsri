<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="flex items-center space-x-1.5 md:space-x-3">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="pager-arrow p-2 md:p-3 bg-transparent hover:bg-blue-500 text-gray-300 hover:text-white flex items-center justify-center rounded-full transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>" class="pager-arrow p-2 md:p-3 bg-transparent hover:bg-blue-500 text-gray-300 hover:text-white flex items-center justify-center rounded-full transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li>
                <?php if ($link['active']) : ?>
                    <span class="inline-block px-4 py-2 text-sm md:text-sm font-medium bg-blue-600 text-white shadow-md rounded-full mx-0.5 md:mx-1"><?= $link['title'] ?></span>
                <?php else : ?>
                    <a href="<?= $link['uri'] ?>" class="inline-block px-4 py-2 text-sm md:text-sm font-medium text-gray-300 hover:bg-blue-500 hover:text-white rounded-full mx-0.5 md:mx-1 transition-all duration-200">
                        <?= $link['title'] ?>
                    </a>
                <?php endif ?>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="pager-arrow p-2 md:p-3 bg-transparent hover:bg-blue-500 text-gray-300 hover:text-white flex items-center justify-center rounded-full transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="pager-arrow p-2 md:p-3 bg-transparent hover:bg-blue-500 text-gray-300 hover:text-white flex items-center justify-center rounded-full transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>