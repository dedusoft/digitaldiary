<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DDiary- <?= $title ?></title>

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