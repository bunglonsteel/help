<div class="layout-page">
    <?php $this->load->view('layout/admin/topbar'); ?>

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Breadcrumb -->
        <div class="container-breadcrumb my-2">
            <h3 class="fw-bold mb-1">Tambah postingan</h3>
            <nav aria-label="breadcrumb mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('admin/dashboard') ?>">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('admin/posts') ?>">Postingan</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah postingan</li>
                </ol>
            </nav>
        </div>
        <!-- End Breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card p-md-3">
                    <div class="card-body">
                        <form action="<?= base_url('admin/posts/add') ?>" method="POST" class="row g-2 g-lg-3">
                            <div class="col-md-7 col-lg-9">
                                <label class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="Ketikan judul" value="<?= set_value('title'); ?>">
                                <small>Slug : <span id="slug"><?= set_value('slug'); ?></span></small>
                                <?= form_error('title', '<small class="invalid-feedback d-block">', '</small>'); ?>
                            </div>
                            <div class="col-md-5 col-lg-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select id="category" name="category" style="display:none">
                                    <option value="">Choose</option>
                                </select>
                                <?= form_error('category', '<small class="invalid-feedback d-block">', '</small>'); ?>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="desc" rows="2" placeholder="Deskripsi"><?= set_value('desc'); ?></textarea>
                                <?= form_error('desc', '<small class="invalid-feedback d-block">', '</small>'); ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Isi konten <span class="text-danger">*</span></label>
                                <textarea id="summernote" name="content" style="display:none"><?= set_value('content'); ?></textarea>
                                <?= form_error('content', '<small class="invalid-feedback d-block">', '</small>'); ?>
                            </div>
                            <div class="col-8">
                                <div class="form-check ps-0 form-switch d-flex">
                                    <label class="form-check-label me-1 me-md-3" for="stat">Aktifkan sebagai draft</label>
                                    <input class="form-check-input ms-0" name="status" type="checkbox" id="stat" value="0" <?= set_value('status') ? "checked" : ''; ?>>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <input id="csrf" hidden name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                <input hidden name="slug" value="<?= set_value('content'); ?>">
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script async src="<?= base_url() ?>public/assets/vendor/sweetalert/sweetalert2.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/select2/select2.min.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/summernote/summernote-lite.js"></script>

<script>
    $(function() {
        $('#summernote').summernote({
            placeholder: 'Ketikan catatan disini..',
            codeviewIframeFilter: true,
            disableDragAndDrop: true,
            height: 250,
            lang: "id-ID",
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['picture', 'link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete: function(target) {
                    $.delete(target[0].src);
                }
            },
        });

        $('#category').on('change', function(e) {
            $('#csrf').attr('value', csrf.attr('content'))
        })

        $('input[name="title"]').on('input', function(e) {
            const pattern = /[^a-zA-Z0-9]\s*$/g
            this.value = this.value.replace(pattern, ' ')
            let temp = this.value.trim()
            let result = temp.replaceAll(/ +/g, '-').toLowerCase()

            $('input[name="slug"]').val(result)
            $('#slug').html(result)
        })

        $.upload = function(file) {
            let data = new FormData();
            data.append('file', file, file.name);
            data.append('csrf_token', csrf.attr('content'));

            $.ajax({
                method: 'POST',
                url: '<?= base_url('admin/posts/upload_image_summernote') ?>',
                contentType: false,
                cache: false,
                processData: false,
                data: data,
                dataType: 'JSON',
                success: function(res) {
                    if (res.error) {
                        show_toast('Mohon Maaf', res.message)
                    }

                    if (res.success) {
                        $('#summernote').summernote('insertImage', res.data);
                    }
                    $('#csrf').val(res.csrf_hash)
                    csrf.attr('content', res.csrf_hash)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function(src) {
            $.ajax({
                method: 'POST',
                url: '<?= base_url('admin/posts/delete_image_summernote') ?>',
                cache: false,
                dataType: "JSON",
                data: {
                    src: src,
                    csrf_token: csrf.attr('content')
                },
                success: function(res) {
                    if (res.success) {
                        show_toast('Berhasil', res.message)
                    }
                    $('#csrf').val(res.csrf_hash)
                    csrf.attr('content', res.csrf_hash)
                }
            });
        };

        ajaxSelect('#category', '<?= base_url('admin/categories/select_categories') ?>', false)
    });
</script>