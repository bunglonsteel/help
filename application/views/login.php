<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login</title>
    <meta name="description" content="" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/css/pages/page-auth.css" />
    <script src="<?= base_url() ?>public/assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url() ?>public/assets/js/config.js"></script>
    <style>
        .fs-7 {
            font-size: 14px;
        }

        .py-2_5 {
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;
        }

        input:focus {
            border-color: #0d9488 !important;
        }

        .btn-primary {
            background-color: #0d9488;
            border: #0d9488;
        }

        .btn-primary:hover {
            background-color: #0d9488;
        }

        .alert-success {
            background-color: #ebfcf5;
            border-color: rgba(199, 246, 227, 0.3);
            color: #00D67F;
        }
    </style>
</head>

<body>

    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2 mt-3 text-center">Login 👋</h4>
                        <p class="mb-4 text-center">Please login to your account.</p>
                        <?php
                        $message = $this->session->flashdata('message');
                        if (isset($message)) {
                            echo  $message;
                            $this->session->unset_userdata('message');
                        }
                        ?>
                        <form class="mb-3" action="<?= base_url('auth') ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username / Email</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Ketikan username / email" autofocus />
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="mb-4 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <script src="<?= base_url() ?>public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url() ?>public/assets/vendor/js/menu.js"></script>
    <!-- Main JS -->
    <script src="<?= base_url() ?>public/assets/js/main.js"></script>
</body>

</html>