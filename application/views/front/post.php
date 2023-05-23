<div class="relative flex items-end bg-teal-600 dark:bg-slate-700/10 h-40 rounded-b-3xl bg-no-repeat bg-cover bg-center mb-7" style="background-image: url('<?= base_url('public/image/default/overlay.png') ?>');">
    <div class="absolute top-5 left-5 right-5">
        <div class="flex items-center justify-between">

            <a href="<?= base_url() ?>" class="flex gap-2 items-center py-2 px-5 rounded-xl bg-white dark:bg-slate-600 text-sm text-slate-500 dark:text-slate-300">
                <svg class="w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span class="hidden md:block">Back</span>
            </a>
            <div class="flex gap-2 items-center">
                <div id="darkModeToggle" class="relative w-12 h-7 bg-slate-100 dark:bg-slate-600 transition-transform duration-200 ease-linear rounded-full shadow-lg" aria-checked="false">
                    <span class="bg-white absolute flex justify-center items-center top-1 left-1 w-5 h-5 rounded-full shadow-md transition duration-200 ease-linear opacity-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </span>
                    <span class="bg-white absolute flex justify-center items-center top-1 right-1 w-5 h-5 rounded-full shadow-md transition duration-200 ease-linear opacity-0">
                        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                    </span>
                </div>
                <?php if ($this->user->type == "superadmin") : ?>
                    <a href="<?= base_url('admin/dashboard') ?>" class="flex gap-1 bg-slate-50 py-2 px-3 text-xs leading-4 rounded-lg font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="max-w-7xl w-full lg:px-5 mx-auto mb-7">
        <div class="flex items-center gap-x-3">
            <span class="flex items-center gap-2 bg-white/40 dark:bg-slate-600 backdrop-blur-sm text-sm text-white dark:text-slate-300 rounded-r-lg lg:rounded-lg font-semibold px-5 py-3">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="line-clamp-1"><?= $post->category ?></span>
            </span>
            <span class="bg-slate-200 dark:bg-slate-500 w-full" style="height:1px;"></span>
        </div>
    </div>
</div>
<div class="max-w-7xl lg:px-5 mx-auto">
    <article class="notes">
        <div class="mb-7">
            <h1><?= $post->title ?></h1>
            <span class="flex gap-2 items-center text-sm font-bold text-slate-500 dark:text-slate-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <?= date('d M Y', strtotime($post->created_at)) ?>
            </span>
        </div>
        <?= html_entity_decode($post->content)  ?>

    </article>
</div>