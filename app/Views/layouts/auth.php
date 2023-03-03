<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DDiary- <?= $title ?></title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url()?>img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>img/favicon/favicon-16x16.png">
    <!-- Header assets (external libraries) -->
    <?= $this->include('layouts/_header_assets') ?>

    <!-- Styles -->
    <?= $this->renderSection('styles') ?>
</head>

<body>

    <main>
        <!-- Dynamci content injected -->
        <?= $this->renderSection('content') ?>
    </main>


    <!-- Footer assets (external libraries) -->
    <?= $this->include('layouts/_footer_assets') ?>

    <?= $this->renderSection('scripts') ?>
</body>

</html>