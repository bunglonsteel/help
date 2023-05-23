<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('admin/dashboard') ?>" class="app-brand-link justify-content-center" style="flex-grow:1;">
            <span class="app-brand-text menu-text fw-bolder ms-2" style="font-size:1.75rem;">Help</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= $title == 'Dashboard' ? 'active' : ''?>">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-alt"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Aktivitas</span></li>
        <li class="menu-item <?= strtolower($title) == 'postingan' || strtolower($title) == "kategori" ? 'active' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layer"></i>
                <div>Postingan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item <?= strtolower($title) == 'postingan' ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/posts') ?>" class="menu-link circle">
                        <div>Semua postingan</div>
                    </a>
                </li>
                <li class="menu-item <?= strtolower($title) == 'kategori' ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/categories') ?>" class="menu-link circle">
                        <div>Kategori</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
        <li class="menu-item <?= $title == 'Settings' ? 'active' :''?>">
            <a href="<?= base_url('admin/settings') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Pengaturan</div>
            </a>
        </li> -->
    </ul>
</aside>
        <!-- / Menu -->