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

        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <p class="text-center">
                    <a href="/" class="d-flex align-items-center justify-content-center">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Back to homepage
                    </a>
                </p>
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </main>


    <!-- Footer assets (external libraries) -->
    <?= $this->include('layouts/_footer_assets') ?>

    <?= $this->renderSection('scripts') ?>
</body>

</html>