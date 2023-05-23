        </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-exit" tabindex="-1" aria-labelledby="modal-exitLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-exitLabel">Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Anda yakin ingin melanjutkan keluar?</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="<?= base_url('auth/logout') ?>" type="button" class="btn btn-primary">Ya, keluar</a>
            </div>
        </div>
    </div>
</div>

    <div id="toast-notif" data-bs-delay="2500" class="bs-toast toast toast-placement-ex m-2 bg-primary fade top-0 start-50 translate-middle-x" role="alert" aria-live="polite" aria-atomic="true">
        <div class="toast-header">
            <i class='bx bxs-bell-ring me-2'></i>
            <div id="toast-title" class="me-auto fw-semibold"></div>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
        </div>
        <div id="toast-desc" class="toast-body"></div>
    </div>

    <!-- build -->
    <script src="<?= base_url() ?>public/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url() ?>public/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url() ?>public/assets/vendor/libs/datatables/datatables.min.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url() ?>public/assets/js/main.js"></script>

    <script>
        var csrf        = $('meta[name="csrf_token"')
        var targetToast = document.getElementById('toast-notif')
        var toastNotif  = bootstrap.Toast.getOrCreateInstance(targetToast)
        var show_toast  = function(title, desc){
            toastNotif.show()
            $('#toast-notif #toast-title').text(title)
            $('#toast-notif #toast-desc').html(desc)
        }
        var formatRupiah = money => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(money);
        var ajaxSelect   = (idElement, url, isModal = true ,placeholder = 'Choose...', dropdownParent = $('#modal')) => {
            let obj = {
                placeholder: placeholder,
                maximumSelectionLength: 3,
                width:"100%",
                ajax: {
                    url : url,
                    type:'POST',
                    dataType: 'JSON',
                    delay: 500,
                    minimumInputLength: 4,
                    data: params => ({s: params.term, csrf_token: csrf.attr('content')}),
                    processResults: res => {
                        csrf.attr('content', res.csrf_hash)
                        return {
                            results: $.map(res.data, function(item){
                                return {
                                    id  : item.id,
                                    text: item.name
                                }
                            })
                        };
                    }
                }
            }

            if(isModal){
                obj.dropdownParent = dropdownParent
            }
            $(idElement).select2(obj);
        }


    </script>

    </body>
</html>