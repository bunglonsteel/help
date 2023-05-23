<div class="layout-page">
    <?php $this->load->view('layout/admin/topbar'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Semua Postingan</span>
                            <h3 class="card-title mb-2"><?= $posts->total ?></h3>
                        </div>
                        <div class="bx bx-layer" style="font-size:50px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Postingan Publish</span>
                            <h3 class="card-title mb-2"><?= $posts->publish ?></h3>
                        </div>
                        <div class="bx bx-paper-plane" style="font-size:50px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Postingan Draft</span>
                            <h3 class="card-title mb-2"><?= $posts->draft ?></h3>
                        </div>
                        <div class="bx bx-edit-alt" style="font-size:50px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Semua Kategori</span>
                            <h3 class="card-title mb-2"><?= $categories->total ?></h3>
                        </div>
                        <div class="bx bx-grid-alt" style="font-size:50px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

