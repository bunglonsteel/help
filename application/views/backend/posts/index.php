<div class="layout-page">
    <?php $this->load->view('layout/admin/topbar'); ?>

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Breadcrumb -->
        <div class="container-breadcrumb my-2">
            <h3 class="fw-bold mb-1">Postingan</h3>
            <nav aria-label="breadcrumb mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('admin/dashboard') ?>">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Semua postingan</li>
                </ol>
            </nav>
        </div>
        <!-- End Breadcrumb -->

        <div class="row">
            <div class="col-12 mt-4">

                <?= $this->session->flashdata('message'); ?>
                <div class="card p-2 pt-3 p-md-3">
                    <div class="card-header p-0 pb-3 mb-3 d-flex align-items-center justify-content-between border-bottom">
                        <h5 class="mb-0 ms-2">Daftar postingan</h5>
                        <a href="<?= base_url('admin/posts/add') ?>" class="btn btn-sm btn-primary">
                            <span class="tf-icons bx bx-plus"></span>
                            Postingan
                        </a>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table id="table" class="table dataTable table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="fw-bold" scope="row">#</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Terakhir Update</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script async src="<?= base_url() ?>public/assets/vendor/js/sweetalert/sweetalert2.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/js/datatables/dataTables.min.js"></script>
<script>
    $(function() {
        const table = $('#table')

        table.DataTable({
            dom: '<"row"<"col-sm-6 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row align-items-center"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            drawCallback: function() {
                $('#example_paginate').addClass('pagination align-items-center justify-content-end');
                $('select').addClass('form-select')
                $('select').css('padding', '0.3rem 1.6rem 0.3rem 0.875rem')
                $('input[type="search"]').addClass('form-control')
            },
            language: {
                search: "",
                searchPlaceholder: "Search",
                paginate: {
                    previous: '←',
                    next: '→'
                },
                processing: `<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>`
            },
            responsive: true,
            scrollX: true,
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: {
                url: '<?= base_url() ?>admin/posts',
                type: 'POST',
                data: function(e) {
                    e.csrf_token = csrf.attr('content');
                },
                dataSrc: function(e) {
                    csrf.attr('content', e.csrf_hash)
                    return e.data
                }
            },
            columnDefs: [{
                target: [6],
                orderable: false,
            }, ]
        });

        $(document).on('click', '.delete', function(e) {
            Swal.fire({
                html: `<span class="swalfire bg-soft-danger my-3">
                        <div class="swalfire-icon">
                            <i class='bx bx-trash text-danger'></i>
                        </div>
                    </span>
                    <div>
                        <h5 class="text-dark">Hapus</h5>
                        <p class="fs-6 mt-2">Anda yakin ingin menghapus postingan ini?</p>
                    </div>`,
                customClass: {
                    content: 'p-3 text-center',
                    actions: 'justify-content-end mt-1 p-0',
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-soft-dark me-2'
                },
                width: 300,
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                buttonsStyling: false
            }).then((e) => {
                if (e.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>admin/posts/remove",
                        data: "target=" + $(this).data('id') + "&csrf_token=" + csrf.attr('content'),
                        dataType: "JSON",
                        success: function(res) {
                            if (res.error) {
                                show_toast('Mohon maaf', res.message)
                            }

                            if (res.success) {
                                show_toast('Berhasil', res.message)
                            }
                            csrf.attr('content', res.csrf_hash)
                            table.DataTable().ajax.reload();
                        }
                    });
                }
            })
        })
    });
</script>