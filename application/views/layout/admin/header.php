<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?= $title ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/js/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/css/pages/page-auth.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/js/datatables/datatables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/js/select2/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/js/sweetalert/sweetalert2.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/js/summernote/summernote-lite.css" rel="stylesheet">
    <script src="<?= base_url() ?>public/assets/vendor/js/helpers.js"></script>
    <script src="<?= base_url() ?>public/assets/js/config.js"></script>
    <script src="<?= base_url() ?>public/assets/vendor/js/jquery/jquery.js"></script>
    <style>
        .badge {
            text-transform: capitalize;
        }
    </style>
    <style>
        .note-modal {
            position: absolute;
        }

        .note-modal-backdrop {
            z-index: 1040;
        }

        .note-modal-backdrop {
            position: relative;
        }

        .note-modal-footer {
            height: 60px;
        }

        .note-form-group {
            padding-bottom: 0;
        }

        .note-dropdown-item h1 {
            font-size: 2.22rem;
        }

        .note-editable p {
            font-family: Inter;
            font-size: 15px;
        }

        .note-editor .dropdown-toggle::after {
            all: unset;
        }

        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
        }

        .note-editor ul {
            list-style-type: disc;
        }

        .note-modal .note-group-image-url,
        .note-modal[aria-label="Help"] .note-modal-footer {
            display: none;
        }

        .note-modal .note-modal-content {
            border: none;
            border-radius: 8px;
        }

        .note-modal .note-modal-header {
            border: none;
            padding: 10px 10px 10px 20px;
        }

        .note-editable {
            background: #fff;
        }

        .note-editable img {
            width: 100%;
        }
    </style>
    <meta name="<?= $this->security->get_csrf_token_name() ?>" content="<?= $this->security->get_csrf_hash() ?>">

    </div>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">