<?php helper('site'); ?>
<!DOCTYPE html>
<html lang="en" style="font-size: 14px;">
<head>
    <link rel="icon" href="<?= base_url('public/assets/dist/img/favicon.ico') ?>">
    <meta name="csrf-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= siteTitle($pageName ?? '') ?></title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.min.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <?= $this->include('theme/navbar') ?>
    <?= $this->include('theme/sidebar') ?>
    <?= $this->renderSection('content') ?>

    <footer class="main-footer no-print">
        <strong>&copy; <?= date('Y') ?> BCC Scan2Fetch.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0</div>
    </footer>
</div>

<script src="<?= base_url('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/assets/dist/js/adminlte.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?= base_url('public/assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/assets/plugins/toastr/toastr.min.js') ?>"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>