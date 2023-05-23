<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="keywords" content>
    <meta name="description" content>
    <!-- Open Graph -->
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:keywords" content />
    <meta property="og:description" content />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="Bunglon Steel" />
    <link rel="canonical" href="<?= base_url() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/assets/front/style.css') ?>">
    <script src="<?= base_url('public/assets/vendor/jquery/jquery.js') ?>"></script>
    <meta name="<?= $this->security->get_csrf_token_name() ?>" content="<?= $this->security->get_csrf_hash() ?>">
    <script>
        var csrf = $('meta[name="csrf_token"]')
    </script>
</head>

<body class="dark:bg-slate-900 text-slate-600 dark:text-slate-400">
    <div class="px-3 mb-16">