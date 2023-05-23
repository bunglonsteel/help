</div>
<footer class="py-4 border-t dark:border-t-slate-800 text-center px-3">
    <span class="text-xs">Copyright &copy; <?= date('Y') ?> Theroom , All right reserved.</span>
</footer>

<?php
$message = $this->session->flashdata('success_login');
if (isset($message)) : ?>
    <div id="toast-success" class="active fixed bottom-8 left-1/2 -translate-x-1/2 transition flex items-center w-full max-w-xs px-4 py-3 text-slate-500 bg-white rounded-lg shadow-2xl border backdrop-blur-sm dark:border-slate-800 dark:text-slate-300 dark:bg-slate-800/50" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">Login successfull, thankyou.</div>
    </div>

<?php
endif;
?>


<script src="<?= base_url('public/assets/front/main.js') ?>"></script>
</body>

</html>